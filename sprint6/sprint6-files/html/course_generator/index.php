<?php $pageTitle = "Course Generator Page"?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="index.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@300&family=Merriweather:wght@300&display=swap" rel="stylesheet">
    
    <title><?php echo $pageTitle; ?></title>
</head>
<body>
  <div class="image-row">
      <div class="image-container">
          <img src="./books.png" alt="books">
      </div>
      <h1>Student Course Generator</h1>
      <div class="image-container">
          <img src="./books.png" alt="books">
      </div>
  </div>
  
  <div class="home">
      <a href="/"><button class="btn-home"><i class="fa fa-home"></i></button></a>
  </div>
  
  <div class="input-course-container">
      <h2>Step 1: Input Taken Courses</h2>
      <p>Input the courses that you have taken below one at a time, clicking the “Add Course” button after each input.
      Note: The input should be in the format of SUBJECT*COURSE NUM, for example; CIS*2500.</p>
      <div class="submit-course">
          <input type="text" id="course" name="course" placeholder="Input Course..."><br>
          <button class="btn1">Add Course</button>
      </div>
      <div class="enteredCoursesList">
        <h3>Courses inputted so far:</h3>
        <ul id="enteredCourses"></ul>
      </div>
  </div>
 
  <div class="generate-course-container">
      <h2>Step 2: Course Recommendations</h2>
      <p>Please confirm that all the courses you have taken are listed above. When ready, please click the button below to generate recomended courses.<p>
      <div class="generate-course">
          <button class="btn2">Generate Courses</button>
      </div>
    </div>
    
    <!-- div to display recommended courses -->
    <div class="recommended-courses">
        <h2>Recommended Courses:</h2>
            <ul id="recommended-courses-list">
                <!-- Recommended courses will be displayed here -->
            </ul>
  </div>
 
  <div class="course-data-container">
    <h2>Step 3: View Course Details</h2>
    <p>Enter a course code in the format of SUBJECT*COURSE NUM in order to view its details.</p>
    <div class="submit-course-detail">
      <input type="text" id="course-detail" name="course-detail" placeholder="Input Course..."><br>
      <button class="btn3">Search Course</button>
    </div>
  </div>
 
  <script type="text/javascript">
    document.addEventListener("DOMContentLoaded", function() {
      let add_course_btn = document.querySelector(".btn1");
      let courseInput = document.getElementById("course");
      let enteredCoursesList = document.getElementById("enteredCourses");
      let recommendedCoursesList = document.getElementById("recommendedCoursesList");
 
      // Collect entered courses
      let enteredCourses = [];
 
      add_course_btn.addEventListener("click", function() {
        let courseValue = courseInput.value;
 
        let splitCourse = courseValue.split('*');
 
        if (splitCourse.length === 2 && splitCourse[0] !== '' && splitCourse[1] !== '' && splitCourse[1].trim() !== '' && !isNaN(splitCourse[1])) {
          enteredCourses.push(splitCourse[0] + "*" + splitCourse[1]); // Add to the list of entered courses
 
          let listItem = document.createElement("li");
          listItem.textContent = splitCourse[0] + "*" + splitCourse[1];
          enteredCoursesList.appendChild(listItem);
 
          courseInput.value = "";
        } else {
          alert("Please enter the course in the format of SUBJECT*COURSE NUM, for example; CIS*2500");
        }
      });
 
// Generate Courses button click event
function generateAndDisplayRecommendedCourses() {
        let enteredCoursesInput = document.getElementById("enteredCourses");
        enteredCoursesInput.value = JSON.stringify(enteredCourses);

        // Make an AJAX request to generate_recommendations.php
        let xhr = new XMLHttpRequest();
        xhr.open("POST", "generate_recommendations.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                let response = JSON.parse(xhr.responseText);

                // Check if the response contains recommended courses
                if (response.recommendedCourses) {
                    response.recommendedCourses.sort((a, b) => {
                      return a.courseCode.localeCompare(b.courseCode, undefined, { sensitivity: 'base' });
                    });
                    let recommendedCoursesList = document.getElementById("recommended-courses-list");
                    recommendedCoursesList.innerHTML = ""; // Clear the list

                    // Display only the course codes in the list
                    response.recommendedCourses.forEach(function(course) {
                        let courseCode = course.courseCode;
                        let courseName = course.courseName;
                        let listItem = document.createElement("li");
                        listItem.textContent = courseCode + " - " + courseName;
                        recommendedCoursesList.appendChild(listItem);
                    });
                }
            }
        };
        xhr.send("enteredCourses=" + JSON.stringify(enteredCourses));
    }
 
      let generateCourseBtn = document.querySelector(".btn2");
      generateCourseBtn.addEventListener("click", generateAndDisplayRecommendedCourses);
    });
  </script>
</body>
</html>

