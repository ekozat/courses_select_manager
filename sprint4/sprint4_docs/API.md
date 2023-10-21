# API Documentation

### Consists of GET, POST, PUT, DELETE methods and how they are implemented

-   The base URL for requests is https://cis3760f23-01.socs.uoguelph.ca/
-   Our API is defined as /courses/\<functionality>/
    -   **The last forward slash is important**

### GET
#### These endpoints will always return an JSON array of objects where each object contains a courseCode, courseName, prerequisites, and restrictions
    {
        "courseCode": "CIS*1200",
        "courseName": "Introduction to Computing",
        "prerequisites": "()",
        "restrictions": "{CIS*1000}"
    }
-   **Get all courses**
    -   https://cis3760f23-01.socs.uoguelph.ca/courses/getAllCourses/
    -   This endpoint does not accept any query parameters
    -   This endpoint will return:
        -   **200** if the courses are fetched successfully from the database
        -   **405** if the request method given was not GET
        -   **500** if the connection to the database failed or fetching fails
-   **Get course by course code**
    -   https://cis3760f23-01.socs.uoguelph.ca/courses/?course_code=cis*1300
    -   This endpoint accepts a query parameter called **course_code** which has to match the exact course code including the * character (capitalization does not matter)
    -   This endpoint will return:
        -   **200** if the course is fetched successfully from the database
        -   **400** if the query parameter is not included in the call
        -   **404** if the course code was not found in the database
        -   **405** if the request method given was not GET
        -   **500** if the connection to the database failed or fetching fails
-   **Get course by course name**
    -   https://cis3760f23-01.socs.uoguelph.ca/courses/?course_name=computing
    -   This endpoint accepts a query parameter called **course_name** which can be any string and will return course names that contain the string specified in it
    -   This endpoint will return:
        -   **200** if the course(s) is fetched successfully from the database
        -   **400** if the query parameter is not included in the call
        -   **404** if the course name was not found in the database
        -   **405** if the request method given was not GET
        -   **500** if the connection to the database failed or fetching fails
-   **Get course(s) by prerequisite(s)**
    -   https://cis3760f23-01.socs.uoguelph.ca/courses/getCoursesByPrereq/?prerequisites=cis*3490
    -   https://cis3760f23-01.socs.uoguelph.ca/courses/getCoursesByPrereq/?prerequisites=cis*3490,cis*2750
    -   This endpoint accepts a query parameter called **prerequisites** which can be comma separated values of course codes (capitalization does not matter but \* char does)
    -   If no query parameter is given, the endpoint will return courses with **NO** prerequisites
        -   https://cis3760f23-01.socs.uoguelph.ca/courses/getCoursesByPrereq/
    -   The endpoint will return rows where any of the given prerequisites exist, so logically it is using **OR** logic
    -   This endpoint will return:
        -   **200** if the course(s) is fetched successfully from the database
        -   **404** if no matching prerequisites were found in the database or if the query parameter is not properly formatted
        -   **405** if the request method given was not GET
        -   **500** if the connection to the database failed or fetching fails
-   **Get course(s) by restrictions(s)**
    -   https://cis3760f23-01.socs.uoguelph.ca/courses/getCoursesByRestrictions/?restrictions=cis*1300
    -   https://cis3760f23-01.socs.uoguelph.ca/courses/getCoursesByRestrictions/?restrictions=cis*1300,cis*1500
    -   This endpoint accepts a query parameter called **restrictions** which can be comma separated values of course codes (capitalization does not matter but \* char does)
    -   If no query parameter is given, the endpoint will return courses with **NO** restrictions
        -   https://cis3760f23-01.socs.uoguelph.ca/courses/getCoursesByRestrictions/
    -   The endpoint will return rows where any of the given restrictions exist, so logically it is using **OR** logic
    -   This endpoint will return:
        -   **200** if the course(s) is fetched successfully from the database
        -   **404** if no matching restrictions were found in the database or the query parameter is not properly formatted
        -   **405** if the request method given was not GET
        -   **500** if the connection to the database failed or fetching fails



### PUT
#### This endpoint will always return an JSON array of objects where each object contains a courseCode, courseName, prerequisites, and restrictions

    **PUT requires a coursecode for it to work
    - https://cis3760f23-01.socs.uoguelph.ca/courses/update/

    - It will return the current info associated with the course code 
    
    "message": "Current Info",
    "originalRow": {
        "courseCode": "\"CIS*1300\"",
        "courseName": "\"Programming\"",
        "prerequisites": "\"()\"",
        "restrictions": "\"{CIS*1500}\""
    }
    - When a courseCode and either courseName, prerequisites, and restrictions, it will return the updated row
    For example, if courseName was changed to Introduction to Programming
    "message": "Update successful",
    "updatedRow": {
        "courseCode": "\"CIS*1300\"",
        "courseName": "Intoduction to Programming",
        "prerequisites": "\"()\"",
        "restrictions": "\"{CIS*1500}\""
    }
    - All 3 fields can be updated at once
    - If the update is not for courseName, prerequisites, and restrictions, it will then return a  "error": "No valid update data provided" which is a 400 bad request

    -   This endpoint will return:
    -   **200** if the course is retrieved successfully from the database
    -   **400** if invalid data is input or missing courseCode in the request
    -   **405** if the request method given was not PUT
    -   **500** if the connection to the database failed or fetching fails
