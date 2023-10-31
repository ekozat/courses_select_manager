<?php
header("Content-Type: application/json");

require 'db_connection.php';

$conn = open_con();

if (!$conn) {
    http_response_code(500);
    echo json_encode(array('error' => 'Failed to connect to the database'));
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
