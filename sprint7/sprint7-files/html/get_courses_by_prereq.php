<?php

header("Content-Type: application/json");

require 'db_connection.php';

function check_valid($conn, $course_code, $course_num)
{
    if (isset($course_num) && (strlen($course_num) == 3 || strlen($course_num) == 4 || ($course_num == "" && $course_code == ""))) {
        return true;
    } else {
        http_response_code(404);
        echo json_encode(array('error' => 'Malformed prerequisite array'));
        close_con($conn);
        return false;
    }
}

$conn = open_con();

if (!$conn) {
    echo json_encode(array('error' => 'Failed to connect to the database'));
} else {
    $databaseName = 'cis3760';
    if (mysqli_select_db($conn, $databaseName)) {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            if (isset($_GET['prerequisites'])) {
                $prerequisites = $_GET['prerequisites'];
                if (str_contains($prerequisites, "|")) {
                    $prerequisitesArray = explode('|', $prerequisites);
                    $data = array();

                    foreach ($prerequisitesArray as $prerequisite) {
                        // Check if the prerequisite has 3 or 4 numbers after the letters
                        $parts = explode('*', $prerequisite);
                        $courseCode = $parts[0];
                        $courseNumber = $parts[1];
                        if (check_valid($conn, $courseCode, $courseNumber)) {
                            $escapedPrerequisite = mysqli_real_escape_string($conn, trim($prerequisite));
                            $sql = "SELECT * FROM coursesDB WHERE prerequisites LIKE '%$escapedPrerequisite%'";

                            $result = $conn->query($sql);

                            if ($result) {
                                while ($row = $result->fetch_assoc()) {
                                    // Remove quotation marks from the values
                                    foreach ($row as $key => $value) {
                                        $row[$key] = str_replace('"', '', $value);
                                    }
                                    $data[] = $row;
                                }
                            }
                        } else {
                            return;
                        }
                    }
                    if (empty($data)) {
                        http_response_code(404);
                        echo json_encode(array('error' => 'No matching prerequisites found'));
                    } else {
                        echo json_encode($data);
                    }
                } else {
                    $prerequisitesArray = explode(',', $prerequisites);
                    $data = array();

                    $condition = array();
                    $combined  = "";

                    foreach ($prerequisitesArray as $prerequisite) {
                        // Check if the prerequisite has 3 or 4 numbers after the letters
                        $parts = explode('*', $prerequisite);
                        $courseCode = $parts[0];
                        $courseNumber = $parts[1];

                        if (check_valid($conn, $courseCode, $courseNumber)) {
                            $escapedPrerequisite = mysqli_real_escape_string($conn, trim($prerequisite));
                            // Build each AND case
                            $condition[] = "prerequisites LIKE '%$escapedPrerequisite%'";
                        } else {
                            return;
                        }

                        // Combine all conditions with AND
                        $combined = implode(' AND ', $condition);
                    }

                    $sql = "SELECT * FROM coursesDB WHERE $combined";

                    $result = $conn->query($sql);

                    if ($result) {
                        while ($row = $result->fetch_assoc()) {
                            // Remove quotation marks from the values
                            foreach ($row as $key => $value) {
                                $row[$key] = str_replace('"', '', $value);
                            }
                            $data[] = $row;
                        }
                    }

                    if (empty($data)) {
                        http_response_code(404);
                        echo json_encode(array('error' => 'No matching prerequisites found'));
                    } else {
                        echo json_encode($data);
                    }
                }

            } else {
                $data = array();
                $sql = "SELECT * FROM coursesDB WHERE prerequisites = '\"()\"' ";
                $result = $conn->query($sql);
                if ($result) {
                    while ($row = $result->fetch_assoc()) {
                        // Remove quotation marks from the values
                        foreach ($row as $key => $value) {
                            $row[$key] = str_replace('"', '', $value);
                        }
                        $data[] = $row;
                    }
                }
                http_response_code(200);
                echo json_encode($data);
            }
        } else {
            http_response_code(405);
            echo json_encode(array('error' => 'Incorrect request method'));
        }
    } else {
        http_response_code(500);
        echo json_encode(array('error' => 'Failed to select the database'));
    }
    close_con($conn);
}

