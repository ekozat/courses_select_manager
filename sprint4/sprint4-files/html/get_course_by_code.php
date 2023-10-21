<?php
header("Content-Type: application/json");

require 'db_connection.php';

$conn = open_con();

if (!$conn) {
    echo json_encode(array('error' => 'Failed to connect to the database'));
} else {
    $databaseName = 'cis3760';
    if (mysqli_select_db($conn, $databaseName)) {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $courseCode = mysqli_real_escape_string($conn, $_GET['course_code']);

            $sql = "SELECT * FROM coursesDB WHERE courseCode = '\"$courseCode\"'";

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
                        echo json_encode(array('error' => 'Course not found'));
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
?>
