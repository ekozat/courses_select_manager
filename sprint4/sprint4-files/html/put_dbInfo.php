<?php
header("Content-Type: application/json");

require 'db_connection.php';
$conn = open_con();

if (!$conn) {
    http_response_code(500);
    echo json_encode(array('error' => 'Failed to connect to the database'));
} else {
    // Check if it's a PUT request
    if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
        parse_str(file_get_contents('php://input'), $putData);

        $courseCode = isset($putData['courseCode']) ? $putData['courseCode'] : null;

        $courseName = isset($putData['courseName']) ? $putData['courseName'] : null;
        $prerequisites = isset($putData['prerequisites']) ? $putData['prerequisites'] : null;
        $restrictions = isset($putData['restrictions']) ? $putData['restrictions'] : null;

        $databaseName = "cis3760";

        if (mysqli_select_db($conn, $databaseName)) {
            if (!is_null($courseCode)) {
                $courseCode = '"' . addslashes($courseCode) . '"';

                // Retrieve the original row
                $selectOriginalRowSql = "SELECT * FROM coursesDBCopy WHERE courseCode = '$courseCode'";
                $originalResult = $conn->query($selectOriginalRowSql);
                $originalRow = $originalResult->fetch_assoc();
                echo json_encode(array('message' => 'Current Info', 'originalRow' => $originalRow));

                $updateStatements = array();

                if (!is_null($courseName)) {
                    $updateStatements[] = "courseName = '$courseName'";
                }

                if (!is_null($prerequisites)) {
                    $updateStatements[] = "prerequisites = '$prerequisites'";
                }

                if (!is_null($restrictions)) {
                    $updateStatements[] = "restrictions = '$restrictions'";
                }

                if (!empty($updateStatements)) {
                    $updateSql = implode(', ', $updateStatements);
                    $sql = "UPDATE coursesDBCopy SET $updateSql WHERE courseCode ='$courseCode'";

                    try {
                        if ($conn->query($sql)) {
                            // Set the HTTP response code to 200 (OK)
                            http_response_code(200);

                            // Retrieve the updated row
                            $selectUpdatedRowSql = "SELECT * FROM coursesDBCopy WHERE courseCode = '$courseCode'";
                            $result = $conn->query($selectUpdatedRowSql);

                            if ($result) {
                                $updatedRow = $result->fetch_assoc();
                                echo json_encode(array('message' => 'Update successful', 'updatedRow' => $updatedRow));
                        

                            } else {
                                http_response_code(500);
                                echo json_encode(array('error' => 'Failed to retrieve the updated row from the database'));
                            }
                        } else {
                            http_response_code(500);
                            echo json_encode(array('error' => 'Failed to update data in the database'));
                        }
                    } catch (Exception $e) {
                        http_response_code(500);
                        echo json_encode(array('error' => $e->getMessage()));
                    }
                } else {
                    http_response_code(400); // Bad Request
                    echo json_encode(array('error' => 'No valid update data provided'));
                }
            } else {
                http_response_code(400); // Bad Request
                echo json_encode(array('error' => 'Missing courseCode in the request, required'));
            }
        } else {
            http_response_code(500);
            echo json_encode(array('error' => 'Failed to select the database'));
        }
    } else {
        http_response_code(405); // Method Not Allowed
        echo json_encode(array('error' => 'Invalid request method'));
    }

    close_con($conn);
}
?>