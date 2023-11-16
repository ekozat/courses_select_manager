<?php $pageTitle = "Course Tree Page"?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script type="text/javascript" src="https://unpkg.com/vis-network/standalone/umd/vis-network.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="index.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@300&family=Merriweather:wght@300&display=swap" rel="stylesheet">
    <!-- link bootstrap -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    <title><?php echo $pageTitle; ?></title>
</head>
<body>
    <div class="home">
      <a href="/" aria-label="Home"><button class="btn-home" aria-label="home button"><i class="fa fa-home"></i></button></a>
    </div>

    <!-- hero page -->
    <div class="container hero-img col-xxl-8 px-4 py-5">
        <div class="row flex-lg-row-reverse align-items-center g-5 py-5">
            <div class="col-10 col-sm-8 col-lg-6">
                <img src="images/treeImg.webp" class="d-block mx-lg-auto img-fluid" alt="hero image" loading="lazy">
            </div>
            <div class="col-lg-6">
                <div class="lc-block mb-3">
                    <div editable="rich">
                        <h2 class="fw-bold display-5">UoG Course Tree Generator</h2>
                    </div>
                </div>

                <div class="lc-block mb-3">
                    <div editable="rich">
                        <p class="lead">Introducing our Course Tree Generator – The Ultimate tool to allow you to see all the relations behind any course you want! Simply choose which subject you are interested in, and click the button to generate the tree! Have fun and happy pre-requiste searching.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="dropdown" id="genTreeDropdown">
        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-expanded="false">
            Select Subject
        </button>
        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
        </div>
        <div id="chosenSubject">Subject Chosen: <span id="subjectValue"></span></div>
    </div>

    <div id="genTreeBtn" class="lc-block d-grid gap-2 d-md-flex justify-content-md-start"><a class="btn btn-dark px-4 me-md-2" aria-label = "Generate Course Tree" role="button">Generate Course Tree</a>
    </div>

    <div id="tree-container"></div>
    
    <script type="text/javascript">
    async function getSubjects() {
      const response = await fetch("https://cis3760f23-01.socs.uoguelph.ca/courses/getSubjects/", {
        method: "GET",
        mode: "cors",
        headers: {
          "Content-Type": "application/json"
        }
      });
      return response.json()
    }

    document.addEventListener("DOMContentLoaded", async function() {
      let dropdownMenu = document.querySelector(".dropdown-menu");
      const data = await getSubjects()
      data.forEach(subject => {
        const dropdownItem = document.createElement("a");
        dropdownItem.classList.add("dropdown-item");
        dropdownItem.textContent = subject;
        dropdownMenu.appendChild(dropdownItem);
      });

      // Courses for a specific subject in order to gen tree
      let genTreeCourses = [];
      let initialCourseIds = [];
      
      // Get the value in the dropdown and populate a list with relevant courses
      dropdownMenu.addEventListener("click", async function(e) {
        genTreeCourses = []
        const subject = e.target.innerText;
        const response = await fetch("https://cis3760f23-01.socs.uoguelph.ca/courses/getCoursesBySubject/", {
          method: "POST",
          mode: "cors",
          headers: {
              "Content-Type": "application/json"
          },
          body: JSON.stringify({
            subject: [subject]
          }),
        });
        const data = await response.json();
        data.forEach((d) => {
          genTreeCourses.push(d.courseCode);
        });
        subjectValue.textContent = subject;
      });

      const generate_button = document.getElementById("genTreeBtn");
      generate_button.addEventListener("click", async function() {

        let nodes = []
        let edges = []

        // this will create nodes for every course in the subject
        genTreeCourses.forEach((course) => {
          nodes.push({
            id: course,
            label: course
          })
        })

        async function buildChartData(courseId) {
          const courses = await fetch("https://cis3760f23-01.socs.uoguelph.ca/courses/getCoursesByPrereq/", {
            method: "POST",
            mode: "cors",
            body: JSON.stringify({
              prerequisites: [courseId],
              type: "AND",
            }),
          });

          const data = await courses.json()
          return data;
        }

        // this is where we create the edges based on API call
        for (const course of genTreeCourses) {
          await buildChartData(course).then((courses) => {
            courses.forEach(async (c) => {
              edges.push({
                from: course,
                to: c.courseCode
              })
            })
          })
        }

        let container = document.getElementById('tree-container');
        let data = {
          nodes: nodes,
          edges: edges
        };

        let options = {
          edges: {
            smooth: true,
            arrows: { to: true },
          },
        };

        let network = new vis.Network(container, data, options)
      });
    });
  </script>
</body>
</html>

