<?php

header("Content-Type: application/json");

require 'db_connection.php';

$conn = open_con();

if (!$conn) {
    echo json_encode(array('error' => 'Failed to connect to the database'));
} else {
    $databaseName = 'cis3760';
    if (mysqli_select_db($conn, $databaseName)) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $json_data = file_get_contents('php://input');
            $subject_data = json_decode($json_data, true);

            if (isset($subject_data['subject'])) {
                if (empty($subject_data['subject'])) {
                    http_response_code(404);
                    echo json_encode(array('error' => 'Array cannot be empty'));
                    close_con($conn);
                    return;
                }
                $subjects = $subject_data['subject'];
            } else {
                http_response_code(404);
                echo json_encode(array('error' => 'subject property not found'));
                close_con($conn);
                return;
            }

            $likeConditions = array_map(function ($code) {
                return "courseCode LIKE '%" . $code . "%'";
            }, $subjects);

            // Construct the SQL query with multiple LIKE conditions joined by OR
            $conditions = implode(" OR ", $likeConditions);
            $sql = "SELECT * FROM coursesDB WHERE " . $conditions;

            try {
                $result = $conn->query($sql);

                if ($result) {
                    $data = array();

                    while ($row = $result->fetch_assoc()) {
                        // Remove quotation marks from the values
                        foreach ($row as $key => $value) {
                            $row[$key] = str_replace('"', '', $value);
                        }
                        $data[] = $row;
                    }

                    close_con($conn);

                    if (empty($data)) {
                        http_response_code(404);
                        echo json_encode(array('error' => 'No courses found for the given subject'));
                    } else {
                        echo json_encode($data);
                    }
                } else {
                    http_response_code(500);
                    echo json_encode(array('error' => 'Failed to fetch data from the database'));
                }
            } catch (Exception $e) {
                http_response_code(500);
                echo json_encode(array('error' => $e->getMessage()));
            }
        } else {
            http_response_code(405);
            echo json_encode(array('error' => 'Incorrect request method'));
        }
    } else {
        http_response_code(500);
        echo json_encode(array('error' => 'Failed to select the database'));
    }
}
