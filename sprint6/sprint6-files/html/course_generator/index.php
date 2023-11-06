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
        <h3>Courses inputted so far:</h3>
        <button class="clear-btn">Clear</button>
      <div class="enteredCoursesList">
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

    <div class="recommended-heading">
      <!-- <h3>Recommended Courses:</h3> -->
      <button class="clear-btn-rec">Clear</button>
    </div>

    <div class="recommended-courses">
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

  <div class="detail-heading">
    <button class="clear-btn-detail">Clear</button>
  </div>

  <div class="courseDetails">
      <!-- Course Details will be displayed here -->
      <p id=code-detail></p>
      <p id=name-detail></p>
      <p id=dept-detail></p>
      <p id=desc-detail></p>
      <p id=location-detail></p>
      <p id=prereq-detail></p>
      <p id=restr-detail></p>
      <p id=equates-detail></p>
      <p id=term-detail></p>
      <p id=weight-detail></p>
  </div>

  <script type="text/javascript">
    document.addEventListener("DOMContentLoaded", function() {
      // all functionality buttons
      let add_course_btn = document.querySelector(".btn1");
      let display_course_btn = document.querySelector(".btn3");
      let recommendedCoursesContainer = document.querySelector('.recommended-courses');
      let courseDetailsContainer = document.querySelector('.courseDetails');

      // clear buttons
      let clear_button = document.querySelector(".clear-btn");
      let clear_button_rec = document.querySelector(".clear-btn-rec");
      let clear_btn_detail = document.querySelector(".clear-btn-detail");

      //Function 1 - course list compilation
      let courseInput = document.getElementById("course");
      let enteredCoursesList = document.getElementById("enteredCourses");
      let recommendedCoursesList = document.getElementById("recommended-courses-list");

      //Function 3 - input course detail
      let courseDetail = document.getElementById("course-detail");
      // Output
      let codeDetail = document.getElementById("code-detail");
      let nameDetail = document.getElementById("name-detail");
      let prereqDetail = document.getElementById("prereq-detail");
      let restrDetail = document.getElementById("restr-detail");
      let equatesDetail = document.getElementById("equates-detail");
      let deptDetail = document.getElementById("dept-detail");
      let descDetail = document.getElementById("desc-detail");
      let locationDetail = document.getElementById("location-detail");
      let termDetail = document.getElementById("term-detail");
      let weightDetail = document.getElementById("weight-detail");


      // Collect entered courses
      let enteredCourses = [];

      // Event listener for adding a course to the list
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

      /*** FUNCTION 3: Event listener for the display of courses at the bottom.***/
      display_course_btn.addEventListener("click", function() {
        let courseValue = courseDetail.value;
        // courseDetailsContainer.style.backgroundColor = "#D9D9D9";

        let splitCourse = courseValue.split('*');

        if (splitCourse.length === 2 && splitCourse[0] !== '' && splitCourse[1] !== '' && splitCourse[1].trim() !== '' && !isNaN(splitCourse[1])) {

          let apiUrl = 'get_course_details.php?id=' + encodeURIComponent(courseValue);

          // call get by course ID endpoint
          fetch(apiUrl, {
            method: 'GET',
            headers: {
              'Content-Type': 'application/json',
            },
          })
            .then(response => {
              if (!response.ok) {
                throw new Error('Network response was not ok');
              }
              return response.json();
            })
            .then(data => {
              // if the array is empty
              if (data.length == 0){
                alert("Error: Inputted course does not exist. Please try again")
                codeDetail.textContent = "";
                nameDetail.textContent = "";
                deptDetail.textContent = "";
                descDetail.textContent = "";
                locationDetail.textContent = "";
                termDetail.textContent = "";
                weightDetail.textContent = "";
                prereqDetail.textContent = "";
                restrDetail.textContent = "";
                equatesDetail.textContent = "";
              }
              else{
                  // Handle the data you received from the GET request.
                codeDetail.textContent = "Course Code: " + courseValue;
                nameDetail.textContent = "Course Name: " + data[0].courseName;
                descDetail.textContent = "Description: " + data[0].description;
                prereqDetail.textContent = "Prerequisites: " + data[0].prereqList;
                restrDetail.textContent = "Restrictions: " + data[0].restrictList;
                equatesDetail.textContent = "Equates: " + data[0].Equates;
                deptDetail.textContent = "Department: " + data[0].department;
                locationDetail.textContent = "Location: " + data[0].location;
                termDetail.textContent = "Term: " + data[0].term;
                weightDetail.textContent = "Weight: " + data[0].weight;
              }
            })
            .catch(error => {
              console.error('There was a problem with the fetch operation:', error);
            });
        } else {
          alert("Please enter the course in the format of SUBJECT*COURSE NUM, for example; CIS*2500");
        }
      });

      // Event listeners for clearing list and recs
      clear_button.addEventListener("click", function() {
        enteredCourses = [];
        enteredCoursesList.innerHTML = "";
      })

      clear_button_rec.addEventListener("click", function() {
        recommendedCoursesList.innerHTML = "";
        // recommendedCoursesContainer.style.backgroundColor = null;
      })

      clear_btn_detail.addEventListener("click", function() {
        // courseDetailsContainer.style.backgroundColor = null;
        courseDetail.value = "";
        codeDetail.textContent= "";
        nameDetail.textContent = "";
        prereqDetail.textContent = "";
        restrDetail.textContent = "";
        deptDetail.textContent = "";
        descDetail.textContent = "";
        locationDetail.textContent = "";
        termDetail.textContent = "";
        weightDetail.textContent = "";
        equatesDetail.textContent = "";
      })

// Generate Courses button click event
function generateAndDisplayRecommendedCourses() {
        let enteredCoursesInput = document.getElementById("enteredCourses");
        enteredCoursesInput.value = JSON.stringify(enteredCourses);

        let recommendedCoursesContainer = document.querySelector('.recommended-courses');
        // recommendedCoursesContainer.style.backgroundColor = "#D9D9D9";

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

