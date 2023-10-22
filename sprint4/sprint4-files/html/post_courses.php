<?php
header("Content-Type: application/json");

require 'db_connection.php';

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Read and parse the JSON data from the request body
    $json_data = file_get_contents('php://input');
    $course_data = json_decode($json_data, true);

    // Validate and sanitize the input data as needed

    // Ensure that all required fields are present
    if (isset($course_data['courseCode']) && isset($course_data['courseName']) && isset($course_data['prerequisites']) && isset($course_data['restrictions'])) {
        $courseCode = $course_data['courseCode'];
        $courseName = $course_data['courseName'];
        $prerequisites = $course_data['prerequisites'];
        $restrictions = $course_data['restrictions'];

        // Connect to the database
        $conn = open_con();

        if ($conn) {
            // Select the appropriate database
            mysqli_select_db($conn, "cis3760");

            $courseCode = mysqli_real_escape_string($conn, $courseCode);
            $courseName = mysqli_real_escape_string($conn, $courseName);
            $prerequisites = mysqli_real_escape_string($conn, $prerequisites);
            $restrictions = mysqli_real_escape_string($conn, $restrictions);

            // Check if the courseCode already exists
            $check_query = "SELECT COUNT(*) FROM coursesDBCopy WHERE courseCode = '$courseCode'";
            $result = mysqli_query($conn, $check_query);
            $row = mysqli_fetch_array($result);
            $count = $row[0];

            if ($count > 0) {
                // Course code already exists
                close_con($conn);
                http_response_code(400); // 400 Bad Request
                echo json_encode(array('error' => 'Course code already exists'));
            } else {
                // Insert the new course data into the database
                $sql = "INSERT INTO coursesDBCopy (courseCode, courseName, prerequisites, restrictions) VALUES ('$courseCode', '$courseName', '$prerequisites', '$restrictions')";

                if (mysqli_query($conn, $sql)) {
                    // Course data successfully added
                    close_con($conn);
                    http_response_code(201); // 201 Created
                    echo json_encode(array('message' => 'Course added successfully'));
                } else {
                    // Database insertion error
                    close_con($conn);
                    http_response_code(500); // 500 Internal Server Error
                    echo json_encode(array('error' => 'Failed to add course to the database'));
                }
            }
        } else {
            // Database connection error
            http_response_code(500); // 500 Internal Server Error
            echo json_encode(array('error' => 'Failed to connect to the database'));
        }
    } else {
        // Incomplete or missing data in the request
        http_response_code(400); // 400 Bad Request
        echo json_encode(array('error' => 'Incomplete course data in the request'));
    }
} else {
    // Incorrect request method
    http_response_code(405); // 405 Method Not Allowed
    echo json_encode(array('error' => 'Incorrect request method'));
}
?>
