<?php
header('Content-Type: application/json');
 
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Retrieve the course ID from the query parameters
    $courseID = isset($_GET['id']) ? $_GET['id'] : null;
 
    if ($courseID === null) {
        // Handle the case where the courseID is missing
        http_response_code(400); 
        echo "Missing courseID parameter";
        exit;
    }
 
    $apiUrl = "https://cis3760f23-13.socs.uoguelph.ca/site/rest-api/courses.php?id=" . urlencode($courseID);
    $response = file_get_contents($apiUrl);

    if ($response !== false) {
        // Return the course data as a JSON response
        echo $response;
    } else {
        // Handle the case where the API request fails
        http_response_code(500); // Internal Server Error
        echo "Failed to fetch course data";
    }
    
} else {
    // Handle the case where the request method is not GET
    http_response_code(405); // Method Not Allowed
    echo "Method not allowed";
    exit;
}
?>