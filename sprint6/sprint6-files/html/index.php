<?php
// Set the content type to HTML
header('Content-Type: text/html; charset=UTF-8');

// Define variables for the content
$title = "F’23 CIS*3760: Group 101";
$greeting = "Greetings and welcome to our digital realm!";
$description1 = "We’re group 101, although we’re small in size, we're mighty in effort!";
$description2 = "Prepare to embark on a journey with us as we dive into Sprint 3. We look forward to showcasing our collective talents and pushing the boundaries of what's achievable in the digital realm. Welcome aboard!";

$downloadFile = 'parsed_courses.xlsm';

$title2 = "Meet the Team";

// Team images
$teamMembers = array(
    array('name' => 'Sara', 'imagePath' => 'sara.jpg'), // Replace with actual paths and names
    array('name' => 'Simardeep', 'imagePath' => 'simardeep.png'),
    array('name' => 'Emily', 'imagePath' => 'emily.png'),
    array('name' => 'Maneesh', 'imagePath' => 'maneesh.png'),
    array('name' => 'FeeKim', 'imagePath' => 'feeKim.png')
);

// Generate the entire HTML page using PHP
$html = <<<HTML
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hero Page</title>
    <link rel="stylesheet" type="text/css" href="index.css">
</head>
<body>
    <div class="container">
        <div class="text">
            <h2>$title</h2>
            <p>$greeting</p>
            <p>$description1</p>
            <p>$description2</p>
        </div>
        <div class="buttons-container">
            <div class="download-button">
                <a href="parsed_courses.xlsm" download class="download-button">Download File</a>
            </div>

            <div class="download-button">
                <a href="apidocs.php" class="download-button">API Documentation</a>
            </div>
        </div>
    </div>

    <div class="team">
        <div class="team-text">
            <h2>$title2</h2>
        </div>
        <div class="team-members">
HTML;

// Loop through team members and create the HTML for each
foreach ($teamMembers as $member) {
    $name = $member['name'];
    $imagePath = $member['imagePath'];
    $href = strtolower($name);
    $html .= <<<HTML
            <div class="team-member">
                <a href="$href"><img src="$imagePath" alt="$name's Headshot"></a>
                <p>$name</p>
            </div>
HTML;
}

$html .= <<<HTML
        </div>
    </div>
</body>
</html>
HTML;

// Output the generated HTML
echo $html;
?>
