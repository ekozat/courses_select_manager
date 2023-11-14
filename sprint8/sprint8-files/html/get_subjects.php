<?php
header("Content-Type: application/json");

require 'db_connection.php';

function handleHttpError($errorCode, $errorMessage = '') {
    http_response_code($errorCode);
    echo json_encode(array('error' => $errorMessage));
    exit;
}

$conn = open_con();

if (!$conn) {
    handleHttpError(500, 'Failed to connect to the database');
} else {
    $databaseName = 'cis3760';
    if (mysqli_select_db($conn, $databaseName)) {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $sql = "SELECT courseCode FROM coursesDB";

            try {
                $result = $conn->query($sql);
                if ($result) {
                    $subjects = array();

                    while ($row = $result->fetch_assoc()) {
                        $courseCode = $row['courseCode'];
                        // Extract the subject by splitting the course code
                        $subject = explode('*', $courseCode)[0];
                        // Remove double quotes
                        $subject = trim($subject, "\"");
                        $subjects[] = $subject;
                    }

                    // Remove duplicates
                    $uniqueSubjects = array_unique($subjects);

                    close_con($conn);

                    http_response_code(200);
                    echo json_encode(array_values($uniqueSubjects));
                } else {
                    handleHttpError(500, 'Failed to fetch data from the database');
                }
            } catch (Exception $e) {
                handleHttpError(500, $e->getMessage());
            }
        } else {
            handleHttpError(405, 'Incorrect request method');
        }
    } else {
        handleHttpError(500, 'Failed to select the database');
    }
}
?>
