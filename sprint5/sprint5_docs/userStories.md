# F23_CIS3760_101

# Team

-   Team Lead:
    -   Emily Kozatchiner
-   Team Members:
    -   Sara Adi
    -   Simardeep Singh
    -   Evan Ferguson
    -   Fee Kim Ah-Poa
    -   Maneesh K. Wijewardhana


# Purpose

The purpose of this file is to list all user stories that will be used to help program the solution for sprint 4, and plan ahead for future sprints.

# Emily Kozatchiner's User Stories

**Title:** Successful GET request from database

**Priority:** High

**Estimate (in hrs):** - 

**User Story:** As user I should be able to fetch a GET request for a particular query from the MySQL database.

**Acceptance Criteria:**
- The GET request should have an appropriate endpoint to fetch and display the data that correlates to the written query.
- The API call should accept multiple query parameters specifying different data.
- The API call should handle error incorrect query parameters
- The API call should handle server-side errors

# Maneesh Wijewardhana's User Stories

**Title:** Successful POST request from database

**Priority:** High

**Estimate (in hrs):** - 

**User Story:** As a user I should be able to call a POST endpoint to add data to the MySQL database.

**Acceptance Criteria:**
- The POST request should have an appropriate endpoint to fetch and display the data that correlates to the written query.
- The API call should accept a request body specifying different data to be added.
- The API call should handle error incorrect request body and duplicate courses
- The API call should handle server-side errors

**Title:** HTTP Status Codes

**Priority:** High

**Estimate (in hrs):** - 

**User Story:** As a user, the server should return with the correct HTTP status codes when a successful request has been made or an invalid one

**Acceptance Criteria:**
- The GET, POST, PUT, and DELETE request methods should return:
    -   200 on success
    -   400 if the user provided an incorrect request
    -   404 if the request contents do not exist on the server
    -   405 if the wrong method was used
    -   500 if the server had an error

**Title:** Getting courses by prerequisites with OR logic

**Priority:** High

**Estimate (in hrs):** - 

**User Story:** As a user, when I send a request to get courses by their prerequisites, I want to specify the prerequisites as OR so if any course matches, then I want to see the result

**Acceptance Criteria:**
- The GET request to /courses/getCoursesByPrereq with query parameters prerequisites=cis*2910|cis*3490 should return courses that have either one as its prerequisite

**Title:** Getting courses by prerequisites with AND logic

**Priority:** High

**Estimate (in hrs):** - 

**User Story:** As a user, when I send a request to get courses by their prerequisites, I want to specify the prerequisites as AND so all the courses specified need to match in order to get the result

**Acceptance Criteria:**
- The GET request to /courses/getCoursesByPrereq with query parameters prerequisites=cis*2750,cis*3490 should return courses that have both as its prerequisite

# Fee Kim Ah-Poa's User Stories

**Title:** Successful PUT request from database

**Priority:** High

**Estimate (in hrs):** - 

**User Story:** As a user I should be able to call a PUT endpoint to update data in the MySQL database.

**Acceptance Criteria:**
- The PUT request should have an appropriate endpoint to fetch data that will match the query.
- The API should accept several updates for a specific course.
- The courseCode will be the required input data so that we can update the fields accordingly.
- The API call should handle error incorrect query parameters.
- The API call should handle server-side errors.

# Simardeep Singh's User Stories

**Title:** Delete Course by Course Code via DELETE Request

**Priority:** Medium

**Estimate (in hrs):** -

**User Story:** As a user, I want to be able to call a DELETE endpoint to remove a course and its related data from the MySQL database by providing its course code.

**Acceptance Criteria:**
- The DELETE request should have a well-defined endpoint to delete a course based on its course code, such as `https://cis3760f23-01.socs.uoguelph.ca/courses/delete/`.
- The DELETE request must accept a JSON request body containing the course code to be deleted.
- The DELETE request should successfully delete the course from the `coursesDBCopy` table in the database when the provided course code matches a record.
- The DELETE request should result in a response with an HTTP status code of 404 if the given course code cannot be found in the 'coursesDBCopy' table.
- The DELETE request ought should result in a response with an HTTP status code of 400 if the request body is empty or contains inaccurate information.
- Only the HTTP DELETE method should be supported by the DELETE request. A response with an HTTP status code of 405 should be returned if an alternative HTTP method is employed.
- The DELETE request should return a result with an HTTP status code of 500 if the database connection fails or if there are any server-side issues.

**Title:** Prevent Duplicate Data Entry via POST Request

**Priority:** Medium

**Estimate (in hrs):**

**User Story:** As a user, I want the system to prevent adding duplicate data when making a POST request to add a course to the MySQL database.

**Acceptance Criteria:**
- The POST request should have a defined endpoint to add a course object to the database, such as `https://cis3760f23-01.socs.uoguelph.ca/courses/postCourses/
- The POST request must accept a JSON request body that contains course details, including course code, course name, prerequisites, and restrictions.
- The system should validate whether a course with the provided course code already exists in the database.
- If an attempt is made to add a course with a duplicate course code, the POST request should return a response with an HTTP status code of 409 (Conflict), along with an error message indicating that the course code already exists:

   ```json
   {
       "error": "Course code already exists"
   }
   ```
- The POST request should add the course to the database's 'coursesDB' table if the course code is distinct and does not already exist there.
- The POST request should be designed to handle potential server-side errors or connection failures. If such errors occur, it should return a response with an HTTP status code of 500.

**Title:** Handle Missing or Empty Prerequisites and Restrictions

**Priority:** Medium

**Estimate (in hrs):**

**User Story:** As a user, I want the system to gracefully handle scenarios where course prerequisites or restrictions may be absent or present without a value when making a POST request to add a course to the MySQL database.

**Acceptance Criteria:**
- The POST request should have a well-defined endpoint for adding a course object to the database, such as `https://example.com/api/addCourse/`.
- The POST request must accept a JSON request body that contains course details, including:
   - `courseCode`: The unique identifier for the course.
   - `courseName`: The name of the course.
   - `prerequisites`: An optional field specifying course prerequisites. If absent, it should default to "()".
   - `restrictions`: An optional field specifying course restrictions. If absent, it should default to "{}".

# Sara Adi's User Stories

**Title:** Backup Database for DELETE Requests

**Priority:** High

**Estimate (in hrs):** - 

**User Story:** As a database admin / user, I want to ensure that when a DELETE call is requested, a seperate database for deleted entries is used, instead of the intial full load database.

**Acceptance Criteria:**
- There should be at minumum two tables in the database. 
- One has all courses including those that were previously deleted (initially entry). 
- The second is the table with the updated, DELETED courses removed
- Any DELETE request will use the second table.

**Title:** Get a list of subjects

**Priority:** High

**Estimate (in hrs):** - 

**User Story:** As a user, I want to be able to get a list of all subjects in the database so I can use them to search for courses later.

**Acceptance Criteria:**
- When a user make a GET request to the /subjects endpoint, the system should respond with a list of all unique subjects available in the database.
- The response should be in JSON format and include an array of subject names.
- Each subject name in the array should be a string without leading or trailing spaces.
- If there are no subjects in the database, the request should display an approporaite message.
- The endpoint should return an appropriate HTTP status code (e.g., 200) to indicate a successful response.

**Title:** Get a list of courses when specifiying the subject

**Priority:** High

**Estimate (in hrs):** - 

**User Story:** As a user, I want to be able to get a list of all courses based on the subject I input.

**Acceptance Criteria:**
- When a user is to make a GET request to the /courses/getCoursesBySubject endpoint with a valid "subject" parameter, the system should respond with a list of courses that match the specified subject.
- The "subject" parameter should be case-insensitive, allowing users to input subjects in any case (e.g., "HROB," "hrob," "Hrob," etc.).
- The response should be in JSON format and include an array of course objects, where each object represents a course.
- Each course object should contain at least the following attributes:
    - courseCode: The course code or identifier.
    - courseName: The name or title of the course.
    - prerequisites: The prerequisites for the course (if available).
    - restrictions: Any restrictions on the course (if available).
- If there are no subjects in the database, the request should display an approporaite message.
- The endpoint should return an appropriate HTTP status code (e.g., 200) to indicate a successful response.


