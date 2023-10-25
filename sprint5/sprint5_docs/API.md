# API Documentation

-   The base URL for requests is https://cis3760f23-01.socs.uoguelph.ca/
-   Our API is defined as /courses/\<functionality>/
    -   **The last forward slash is important**

---

### `GET /courses/getAllCourses/`

Get a list of all courses in the coursesDB database

> https://cis3760f23-01.socs.uoguelph.ca/courses/getAllCourses/

```
[
    {
        "courseCode": "ACCT*1220",
        "courseName": "Introductory Financial Accounting",
        "prerequisites": "()",
        "restrictions": "{ACCT*2220}"
    },
    {
        "courseCode": "ACCT*1240",
        "courseName": "Applied Financial Accounting",
        "prerequisites": "ACCT*1220 OR ACCT*2220",
        "restrictions": "{ACCT*2240}"
    }...
]
```

-   This endpoint does not accept any query parameters
-   This endpoint will return:
    -   **200** if the courses are fetched successfully from the database
    -   **405** if the request method given was not GET
    -   **500** if the connection to the database failed or fetching fails

### `GET /courses/getAllCoursesCopy/`

Get a list of all courses in the coursesDBCopy database (used to verify POST, PUT, and DELETE operations)

> https://cis3760f23-01.socs.uoguelph.ca/courses/getAllCoursesCopy/

```
[
    {
        "courseCode": "ACCT*1220",
        "courseName": "Introductory Financial Accounting",
        "prerequisites": "()",
        "restrictions": "{ACCT*2220}"
    },
    {
        "courseCode": "ACCT*1240",
        "courseName": "Applied Financial Accounting",
        "prerequisites": "ACCT*1220 OR ACCT*2220",
        "restrictions": "{ACCT*2240}"
    }...
]
```

-   This endpoint does not accept any query parameters
-   This endpoint will return:
    -   **200** if the courses are fetched successfully from the database
    -   **405** if the request method given was not GET
    -   **500** if the connection to the database failed or fetching fails

### `GET /courses/getCourseByCode/?course_code={course_code}`

Get course details using the respective course code

> https://cis3760f23-01.socs.uoguelph.ca/courses/getCourseByCode/?course_code=cis*1300

```
[
    {
        "courseCode": "CIS*1300",
        "courseName": "Programming",
        "prerequisites": "()",
        "restrictions": "{CIS*1500}"
    }
]
```

-   This endpoint will return:
    -   **200** if the course is fetched successfully from the database
    -   **400** if the query parameter is not included in the call
    -   **404** if the course code was not found in the database
    -   **405** if the request method given was not GET
    -   **500** if the connection to the database failed or fetching fails

### `GET /courses/getCourseByName/?course_name={course_name}`

Get course details using the respective course name using fuzzy search

> https://cis3760f23-01.socs.uoguelph.ca/courses/getCourseByName/?course_name=discrete

```
[
    {
        "courseCode": "CIS*1910",
        "courseName": "Discrete Structures in Computing I",
        "prerequisites": "()",
        "restrictions": "{}"
    },
    {
        "courseCode": "CIS*2910",
        "courseName": "Discrete Structures in Computing II",
        "prerequisites": "(CIS*1300 OR ENGG*1410) AND (CIS*1910 OR ENGG*1500)",
        "restrictions": "{}"
    }
]
```

-   This endpoint will return:
    -   **200** if the course(s) is fetched successfully from the database
    -   **400** if the query parameter is not included in the call
    -   **404** if the course name was not found in the database
    -   **405** if the request method given was not GET
    -   **500** if the connection to the database failed or fetching fails

### `GET /courses/getCoursesByPrereq/?prerequisites={course_code1[,|]course_code2[,|] ...}`

**NOTE**: The course codes can be separated by the comma or pipe symbol and is explained why below

Get courses by their prerequisites using the course code(s)

> https://cis3760f23-01.socs.uoguelph.ca/courses/getCourseByPrereq/?prerequisites=cis*3490

```
[
    {
        "courseCode": "CIS*3150",
        "courseName": "Theory of Computation",
        "prerequisites": "CIS*2750 AND CIS*3490",
        "restrictions": "{}"
    },
    {
        "courseCode": "CIS*4520",
        "courseName": "Introduction to Cryptography",
        "prerequisites": "CIS*3490",
        "restrictions": "{CIS*4110}"
    },
    {
        "courseCode": "CIS*4780",
        "courseName": "Computational Intelligence",
        "prerequisites": "CIS*3490 AND (CIS*3750 OR CIS*3760) AND (CIS*2460 OR STAT*2040)",
        "restrictions": "{}"
    }
]
```

When a comma is used to separate prerequisites, a logical AND will be used

> https://cis3760f23-01.socs.uoguelph.ca/courses/getCourseByPrereq/?prerequisites=cis*3490,cis*2750

```
[
    {
        "courseCode": "CIS*3150",
        "courseName": "Theory of Computation",
        "prerequisites": "CIS*2750 AND CIS*3490",
        "restrictions": "{}"
    }
]
```

When a '|' symbol is used to separate prerequisites, a logical OR will be used

> https://cis3760f23-01.socs.uoguelph.ca/courses/getCourseByPrereq/?prerequisites=cis*3490|cis*2750

```
[
    {
        "courseCode": "CIS*3150",
        "courseName": "Theory of Computation",
        "prerequisites": "CIS*2750 AND CIS*3490",
        "restrictions": "{}"
    },
    {
        "courseCode": "CIS*4520",
        "courseName": "Introduction to Cryptography",
        "prerequisites": "CIS*3490",
        "restrictions": "{CIS*4110}"
    },
    {
        "courseCode": "CIS*4780",
        "courseName": "Computational Intelligence",
        "prerequisites": "CIS*3490 AND (CIS*3750 OR CIS*3760) AND (CIS*2460 OR STAT*2040)",
        "restrictions": "{}"
    },
    {
        "courseCode": "CIS*3150",
        "courseName": "Theory of Computation",
        "prerequisites": "CIS*2750 AND CIS*3490",
        "restrictions": "{}"
    },
    {
        "courseCode": "CIS*3260",
        "courseName": "Software Design IV",
        "prerequisites": "CIS*2750 AND CIS*3250 AND CIS*3760",
        "restrictions": "{}"
    },
    {
        "courseCode": "CIS*3760",
        "courseName": "Software Engineering",
        "prerequisites": "CIS*2750 AND CIS*3750",
        "restrictions": "{}"
    },
    {
        "courseCode": "CIS*4020",
        "courseName": "Data Science",
        "prerequisites": "CIS*2750 AND MATH*1160 AND STAT*2040",
        "restrictions": "{}"
    },
    {
        "courseCode": "CIS*4030",
        "courseName": "Mobile Computing",
        "prerequisites": "CIS*2030 AND CIS*2750 AND CIS*3110",
        "restrictions": "{}"
    },
    {
        "courseCode": "CIS*4250",
        "courseName": "Software Design V",
        "prerequisites": "CIS*2750 AND CIS*3260",
        "restrictions": "{}"
    },
    {
        "courseCode": "CIS*4720",
        "courseName": "Image Processing and Vision",
        "prerequisites": "CIS*2750 AND CIS*3110 AND (CIS*2460 OR STAT*2040)",
        "restrictions": "{}"
    }
]
```

If no query parameter is given, the endpoint will return courses with **NO** prerequisites

> https://cis3760f23-01.socs.uoguelph.ca/courses/getCoursesByPrereq/

```
[
    {
        "courseCode": "ACCT*1220",
        "courseName": "Introductory Financial Accounting",
        "prerequisites": "()",
        "restrictions": "{ACCT*2220}"
    },
    {
        "courseCode": "AGR*1110",
        "courseName": "Introduction to the Agri-Food Systems",
        "prerequisites": "()",
        "restrictions": "{AGR*1100,AGR*1250}"
    }...
]
```

-   This endpoint will return:
    -   **200** if the course(s) is fetched successfully from the database
    -   **404** if no matching prerequisites were found in the database or if the query parameter is not properly formatted
    -   **405** if the request method given was not GET
    -   **500** if the connection to the database failed or fetching fails

### `GET /courses/getCoursesByRestrictions/?restrictions={course_code1[,|]course_code2[,|] ...}`

**NOTE**: The course codes can be separated by the comma or pipe symbol and is explained why below

Get courses by their restrictions using the course code(s)

> https://cis3760f23-01.socs.uoguelph.ca/courses/getCoursesByRestrictions/?restrictions=cis*1500

```
[
    {
        "courseCode": "CIS*1300",
        "courseName": "Programming",
        "prerequisites": "()",
        "restrictions": "{CIS*1500}"
    }
]
```

When a comma is used to separate restrictions, a logical AND will be used

> https://cis3760f23-01.socs.uoguelph.ca/courses/getCoursesByRestrictions/?restrictions=cis*1500,cis*1300

```
{
    "error": "No matching restrictions found"
}
```

When a '|' is used to separate restrictions, a logical OR will be used

> https://cis3760f23-01.socs.uoguelph.ca/courses/getCoursesByRestrictions/?restrictions=cis*1500|cis*1300

```
[
    {
        "courseCode": "CIS*1300",
        "courseName": "Programming",
        "prerequisites": "()",
        "restrictions": "{CIS*1500}"
    },
    {
        "courseCode": "CIS*1500",
        "courseName": "Introduction to Programming",
        "prerequisites": "()",
        "restrictions": "{CIS*1300}"
    }
]
```

If no query parameter is given, the endpoint will return courses with **NO** restrictions

> https://cis3760f23-01.socs.uoguelph.ca/courses/getCoursesByRestrictions/

```
[
    {
        "courseCode": "ACCT*2230",
        "courseName": "Management Accounting",
        "prerequisites": "ACCT*1220 OR ACCT*2220",
        "restrictions": "{}"
    },
    {
        "courseCode": "ACCT*3230",
        "courseName": "Intermediate Management Accounting",
        "prerequisites": "ACCT*2230",
        "restrictions": "{}"
    }...
]
```

-   This endpoint will return:
    -   **200** if the course(s) is fetched successfully from the database
    -   **404** if no matching restrictions were found in the database or the query parameter is not properly formatted
    -   **405** if the request method given was not GET
    -   **500** if the connection to the database failed or fetching fails

### `POST /courses/postCourses/`

Update the coursesDBCopy table with a new course

> https://cis3760f23-01.socs.uoguelph.ca/courses/postCourses/

You must provide a JSON body like this:

```
{
    "courseCode": "CS*101",
    "courseName": "Introduction to Computer Science",
    "prerequisites": "()",
    "restrictions": "{}"
}
```

Adding the same course twice will return a 400 with:

```
{
    "error": "Course code already exists"
}
```

If you want prerequisites to be empty, type in the field with "()". For example, "prerequisites": "()".

If you want restrictions to be empty, type in the field with "{}". For example, "restrictions": "{}".

Adding a course with incomplete info such as excluding restrictions will return a 400 with:

```
{
    "error": "Incomplete course data in the request"
}
```

-   This endpoint will return:
    -   **200** if the course is added successfully to the database
    -   **405** if the request method given was not POST
    -   **400** if the course information is incomplete, i.e., one or more of course code, course name, prerequisite or restriction is missing. For example, the following input will display the message {'error' => 'Incomplete course data in the request'}:
    -   **500** if the connection to the database failed or fetching fails

### `PUT /courses/update/`

Update a specific course's information in the coursesDBCopy table using a mandatory courseCode property

> https://cis3760f23-01.socs.uoguelph.ca/courses/update/

You must provide a JSON body like this:

```
{
    "courseCode": "CIS*1200",
    "courseName": "Intoduction to Programming",
    "prerequisites": "CIS*1000"
}
```

This will update the course CIS\*1200 with the value of the other properties specified

On successful update, the endpoint will return a JSON response like this:

```
{
    "message": "Current Info",
    "originalRow": {
        "courseCode": "\"CIS*1200\"",
        "courseName": "Intro to Programming",
        "prerequisites": "CIS*1000",
        "restrictions": "\"{CIS*1000}\""
    }
}{
    "message": "Update successful",
    "updatedRow": {
        "courseCode": "\"CIS*1200\"",
        "courseName": "Introduction to Programming",
        "prerequisites": "CIS*1000",
        "restrictions": "\"{CIS*1000}\""
    }
}
```

All 3 fields can be updated at once and only the fields that you want to update should be stated

If the update is not for courseName, prerequisites, and restrictions, it will then return "error": "No valid update data provided" which is a 400 bad request

-   This endpoint will return:
    -   **200** if the course is retrieved successfully from the database
    -   **400** if invalid data is input or missing courseCode in the request
    -   **405** if the request method given was not PUT
    -   **500** if the connection to the database failed or fetching fails

### `DELETE /courses/delete/`

Delete a course from the coursesDBCopy table by the courseCode

> https://cis3760f23-01.socs.uoguelph.ca/courses/delete/

You must provide a JSON body like this:

```
{
    "courseCode": "cis*1300"
}
```

On successful deletion, the endpoint will return this:

```
{
    "message": "Course deleted successfully"
}
```

-   This endpoint will return:
    -   **200** if the course is found and deleted successfully from the database
    -   **400** if invalid data is input or missing courseCode in the request body
    -   **404** if the course was not found in the database
    -   **405** if the request method given was not DELETE
    -   **500** if the connection to the database failed or fetching fails
