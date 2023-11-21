<?php
// Set the content type to HTML
header('Content-Type: text/html; charset=UTF-8');

// Define variables for the content
$title = "F’23 CIS*3760: Group 101";
$greeting = "Greetings and welcome to our digital realm!";
$description1 = "We’re group 101! Although we’re small in size, we're mighty in effort! Also this is to test CI/CD";
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
    <link rel="stylesheet" type="text/css" href="index.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Hero Page</title>
    
</head>
<body>
    <!-- hero page -->
    <section id = "hero-main">
        <div class="container col-xxl-8 px-4 py-5">
            <div class="row flex-lg-row-reverse align-items-center g-5 py-5">
                <div class="col-10 col-sm-8 col-lg-6">
                    <div class="lc-block d-grid gap-2 d-md-flex flex-md-column justify-content-md-start">
                         <a class="btn btn-dark px-4 me-md-2" aria-label="Download File" href="parsed_courses.xlsm"  download class="download-button" role="button">Download .xlsm Course File</a>
                        <a class="btn btn-outline-secondary px-4 search-info-btn" aria-label="API Documentation" href="apidocs" role="button">API Documentation</a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="lc-block mb-3">
                        <div editable="rich">
                            <h2 class = "display-5">$title</h2>
                            <p>$greeting</p>
                            <p>$description1</p>
                            <p>$description2</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- course generator -->
    <section id = "generator">
        <div class="container col-xxl-8 px-4 py-5 course-generator">
            <div class="row flex-lg-row-reverse align-items-center g-5 py-5">
                <div class="col-10 col-sm-8 col-lg-6">
                    <img src="laptop-homepage.png" class="d-block mx-lg-auto img-fluid" alt="hero image" loading="lazy">
                </div>
                <div class="col-lg-6">
                    <div class="lc-block mb-3">
                        <div editable="rich">
                            <h2 class="fw-bold display-5">UoG Student Course Generator</h2>
                        </div>
                    </div>

                    <div class="lc-block mb-3">
                        <div editable="rich">
                            <p class="lead">Click on the button below to start planning your academic future!
                            </p>
                        </div>
                    </div>

                    <div class="lc-block d-grid gap-2 d-md-flex justify-content-md-start"><a class="btn btn-dark px-4 me-md-2" aria-label = "Start Now!" href="course_generator" role="button">Start Now!</a>
                    </div>

                </div>
            </div>
        </div>
    </section>
    <hr>

    <div class="team-text">
        <h2 class = "title-team">$title2</h2>
    </div>
    <div class="row justify-content-center mx-auto">
HTML;

// Loop through team members and create the HTML for each
foreach ($teamMembers as $index => $member) {
    $name = $member['name'];
    $imagePath = $member['imagePath'];
    $href = strtolower($name);
    $marginLeftClass = $index === 0 ? 'ml-2' : ''; // Add margin-left to the first team member
    $html .= <<<HTML
            <div class="col-md-2 team-member $marginLeftClass">
                <a href="$href"><img src="$imagePath" alt="$name's Headshot" class="rounded-circle img-fluid" style="width: 150px; height: 150px;"></a>
                <p>$name</p>
            </div>
HTML;
}

$html .= <<<HTML
    </div>
</body>
</html>
HTML;

// Output the generated HTML
echo $html;
?>

