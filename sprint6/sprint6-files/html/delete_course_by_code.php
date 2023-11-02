<?php
header("Content-Type: application/json");
header('Access-Control-Allow-Origin: *');

require 'db_connection.php';

$conn = open_con();

if (!$conn) {
    echo json_encode(array('error' => 'Failed to connect to the database'));
} else {
    $databaseName = 'cis3760';
    if (mysqli_select_db($conn, $databaseName)) {
        if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
            $input_data = json_decode(file_get_contents('php://input'), true);
            if (!isset($input_data['courseCode'])) {
                http_response_code(400);
                echo json_encode(array('error' => 'Malformed courseCode parameter'));
                return;
            }

            $courseCode = mysqli_real_escape_string($conn, $input_data['courseCode']);

            $sql = "DELETE FROM coursesDBCopy WHERE courseCode = '\"$courseCode\"'";

            try {
                $result = $conn->query($sql);
                if ($result) {
                    $affectedRows = mysqli_affected_rows($conn);
                    close_con($conn);
                    if ($affectedRows > 0) {
                        echo json_encode(array('message' => 'Course deleted successfully'));
                    } else {
                        http_response_code(404);
                        echo json_encode(array('error' => 'Course not found'));
                    }
                } else {
                    http_response_code(500);
                    echo json_encode(array('error' => 'Failed to delete data from the database'));
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
