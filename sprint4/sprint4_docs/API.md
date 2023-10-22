# API Documentation

### Consists of GET, POST, PUT, DELETE methods and how they are implemented

-   The base URL for requests is https://cis3760f23-01.socs.uoguelph.ca/
-   Our API is defined as /courses/\<functionality>/
    -   **The last forward slash is important**

### GET

#### These endpoints will always return a JSON array of objects where each object contains a courseCode, courseName, prerequisites, and restrictions

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
-   **Get all courses from backup table** (THIS IS USED TO VERIFY UPDATE, POST, AND DELETE METHODS)
    -   https://cis3760f23-01.socs.uoguelph.ca/courses/getAllCoursesCopy/
    -   This endpoint does not accept any query parameters
    -   This endpoint will return:
        -   **200** if the courses are fetched successfully from the coursesDBCopy table in the database
        -   **405** if the request method given was not GET
        -   **500** if the connection to the database failed or fetching fails
-   **Get course by course code**
    -   https://cis3760f23-01.socs.uoguelph.ca/courses/?course_code=cis*1300
    -   This endpoint accepts a query parameter called **course_code** which has to match the exact course code including the \* character (capitalization does not matter)
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

### POST

### How to test the POST endpoint

###These endpoints will be used to add object containing course code, course name, prerequisite and restriction in the form JSON array
    ```shell
    {
        "courseCode": "CS*101",
        "courseName": "Introduction to Computer Science",
        "prerequisites": "()",
        "restrictions": "{}"
    }
    ```
-   https://cis3760f23-01.socs.uoguelph.ca/courses/postCourses/
-   On Postman select POST and paste in the URL https://cis3760f23-01.socs.uoguelph.ca/courses/postCourses/
-   Navigate to body select raw and choose JSON
-   Inputting just courseCode as the following and sending it will add the object to database.

    ```shell
    {
        "courseCode": "CS*101",
        "courseName": "Introduction to Computer Science",
        "prerequisites": "()",
        "restrictions": "{}"
    }
    ```
    -   Trying to add the same object twice with the same course code will give display following error message, and will not add the course.
        {"error":"Course code already exists"}
    ```

-   **NOTE:** This endpoint mutates the coursesDB table
-   If you want prerequisites to be empty, type in the field with "()". For example, "prerequisites": "()".
-   If you want restrictions to be empty, type in the field with "{}". For example, "restrictions": "{}".
-   This endpoint will return:
    -   **200** if the course is added successfully to the database
    -   **405** if the request method given was not PUT
    -   **500** if the connection to the database failed or fetching fails

### PUT

### How to test the PUT endpoint

**PUT requires a courseCode for it to work**

-   https://cis3760f23-01.socs.uoguelph.ca/courses/update/
-   On Postman select PUT and paste in the URL https://cis3760f23-01.socs.uoguelph.ca/courses/update/
-   Navigate to body select raw and choose JSON
-   Inputting just courseCode as this will give you the stored information on courseCode, courseName, prerequisites and restrictions
    ```
    {
        "courseCode": "CIS*1300"
    }
    ```
    -   To update any of courseName, prerequisites and restrictions add it to the json
        -   For example, if you want to update courseName and prerequisites, you'll do it as follows
    ```
    {
        "courseCode": "CIS*1200",
        "courseName": "Intoduction to Programming",
        "prerequisites": "CIS*1000"
    }
    ```
    -   If you have one field set to ""
        -   For example, "prerequisites": "" it will update the prerequisite field with ""
-   It will return the current info associated with the course code for the above example where we updated courseName and prereq

```
{
    "message": "Current Info",
    "originalRow": {
        "courseCode": "\"CIS*1200\"",
        "courseName": "\"Introduction to Computing\"",
        "prerequisites": "\"()\"",
        "restrictions": "\"{CIS*1000}\""
    }
}
{
    "message": "Update successful",
    "updatedRow": {
        "courseCode": "\"CIS*1200\"",
        "courseName": "Intoduction to Programming",
        "prerequisites": "CIS*1000",
        "restrictions": "\"{CIS*1000}\""
    }
}
```

-   **NOTE:** This endpoint mutates the coursesDBCopy table and not the main one
-   All 3 fields can be updated at once and only the fields that you want to update should be stated
-   If the update is not for courseName, prerequisites, and restrictions, it will then return "error": "No valid update data provided" which is a 400 bad request
-   This endpoint will return:
    -   **200** if the course is retrieved successfully from the database
    -   **400** if invalid data is input or missing courseCode in the request
    -   **405** if the request method given was not PUT
    -   **500** if the connection to the database failed or fetching fails

### DELETE

-   **Delete course by course code**
    -   https://cis3760f23-01.socs.uoguelph.ca/courses/delete/
    -   You must pass in a JSON body consisting of the correct course code that you would like deleted like this:
    ```
    {
        "courseCode": "cis*1300"
    }
    ```
    -   **NOTE:** This endpoint mutates the coursesDBCopy table and not the main one
    -   This endpoint will return:
        -   **200** if the course is found and deleted successfully from the database
        -   **400** if invalid data is input or missing courseCode in the request body
        -   **404** if the course was not found in the database
        -   **405** if the request method given was not DELETE
        -   **500** if the connection to the database failed or fetching fails
