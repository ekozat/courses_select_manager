<?php
header("Content-Type: application/json");
header('Access-Control-Allow-Origin: *');

require 'db_connection.php';

$conn = open_con();

if (!$conn) {
    http_response_code(500);
    echo json_encode(array('error' => 'Failed to connect to the database'));
} else {
    $databaseName = 'cis3760';
    if (mysqli_select_db($conn, $databaseName)) {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {

            $sql = "SELECT * FROM coursesDB";

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

                    http_response_code(200);
                    echo json_encode($data);
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
