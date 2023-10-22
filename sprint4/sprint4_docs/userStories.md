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
