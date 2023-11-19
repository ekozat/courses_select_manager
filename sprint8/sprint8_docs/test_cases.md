# Test Cases:

**Test Case 0:**

Description: Specifying course data in JSON body for POST requests should be an array of 1 or more strings

Input: 

For any endpoint that retrieves information about a course, should allow for that property such as courseCode, courseName, subject, etc to be specified using an array of 1 or more strings

```
{
    courseName: ['intelligence', 'computing']
}
```

```
{
    courseCode: ['cis*1300', 'cis*1500']
}
```

Expected Result:

The logic should retrieve all the information for what the user specifies in the array

**Test Case 1:**

Description: Getting courses by code

Input:

`POST https://cis3760f23-01.socs.uoguelph.ca/courses/getCourseByCode/`

```
{
    "courseCode": ["cis*1300"]
}
```

Expected Result:

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

**Test Case 2:**

Description: Getting courses by name

Input:

`POST https://cis3760f23-01.socs.uoguelph.ca/courses/getCourseByName/`

```
{
    "courseName": ["intelligence"]
}
```

Expected Result:

```
[
    {
        "courseCode": "CIS*4780",
        "courseName": "Computational Intelligence",
        "prerequisites": "CIS*3490 AND (CIS*3750 OR CIS*3760) AND (CIS*2460 OR STAT*2040)",
        "restrictions": "{}"
    },
    {
        "courseCode": "PHIL*3370",
        "courseName": "Ethics of Artificial Intelligence",
        "prerequisites": "1.50 credits in Philosophy OR 7.50 credits",
        "restrictions": "{}"
    }
]
```

**Test Case 3:**

Description: Getting courses by subject

Input:

`POST https://cis3760f23-01.socs.uoguelph.ca/courses/getCoursesBySubject/`

```
{
    "subject": ["HROB"]
}
```

Expected Result:

```
[
    {
        "courseCode": "HROB*2010",
        "courseName": "Foundations of Leadership",
        "prerequisites": "()",
        "restrictions": "{UNIV*2000}"
    },
    {
        "courseCode": "HROB*2090",
        "courseName": "Individuals and Groups in Organizations",
        "prerequisites": "()",
        "restrictions": "{HROB*2100,HROB*4000,PSYC*3080}"
    },
    {
        "courseCode": "HROB*2200",
        "courseName": "Labour Relations",
        "prerequisites": "2.00 credits",
        "restrictions": "{ECON*2200}"
    },
    {
        "courseCode": "HROB*2290",
        "courseName": "Human Resources Management",
        "prerequisites": "BUS*2090 OR BUS*2220 OR HROB*2090",
        "restrictions": "{BUS*3000,HROB*2100,HROB*3000,PSYC*3070}"
    },
    {
        "courseCode": "HROB*3010",
        "courseName": "Compensation Systems",
        "prerequisites": "BUS*3000 OR HROB*2100 OR HROB*2290 OR HROB*3000 OR PSYC*3070",
        "restrictions": "{}"
    },
    {
        "courseCode": "HROB*3030",
        "courseName": "Occupational Health and Safety",
        "prerequisites": "9.00 credits AND (BUS*3000 OR HROB*2100 OR HROB*2290 OR HROB*3000 OR PSYC*3070)",
        "restrictions": "{}"
    },
    {
        "courseCode": "HROB*3070",
        "courseName": "Recruitment and Selection",
        "prerequisites": "BUS*3000 OR HROB*2100 OR HROB*2290 OR HROB*3000 OR PSYC*3070",
        "restrictions": "{}"
    },
    {
        "courseCode": "HROB*3090",
        "courseName": "Training and Development",
        "prerequisites": "BUS*3000 OR HROB*2100 OR HROB*2290 OR HROB*3000 OR PSYC*3070",
        "restrictions": "{}"
    },
    {
        "courseCode": "HROB*3100",
        "courseName": "Developing Management and Leadership Competencies",
        "prerequisites": "9.00 credits AND HROB*2010 AND (HROB*2090 OR HROB*2100)",
        "restrictions": "{}"
    },
    {
        "courseCode": "HROB*4010",
        "courseName": "Leadership Certificate Capstone",
        "prerequisites": "HROB*2010 AND (PHIL*2120 OR PHIL*2600 OR POLS*3440 OR (2 of BUS*3000 OR EDRD*3140 OR EDRD*3160 OR EDRD*4120 OR HROB*2090 OR HROB*2290 OR HROB*3000 OR MGMT*2150 OR PHIL*2100 OR POLS*2250 plus 120 hours of leadership experience.))",
        "restrictions": "{}"
    },
    {
        "courseCode": "HROB*4030",
        "courseName": "Advanced Topics In Leadership and Organizational Management",
        "prerequisites": "12.50 credits AND (BUS*3000 OR HROB*2100 OR HROB*2290 OR HROB*3000 OR PSYC*3070)",
        "restrictions": "{}"
    },
    {
        "courseCode": "HROB*4060",
        "courseName": "Human Resource Planning",
        "prerequisites": "15.00 credits AND (BUS*3000 OR HROB*2100 OR HROB*2290 OR HROB*3000 OR PSYC*3070)",
        "restrictions": "{}"
    }
]
```

**Test Case 4:**

Description: Getting courses by prerequisites using AND logic

Input:

`POST https://cis3760f23-01.socs.uoguelph.ca/courses/getCoursesByPrereq/`

```
{
    "courseCode": [cis*2750, cis*3490]
    "type": "AND"
}
```

Expected Result:

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

**Test Case 5:**

Description: Getting courses by prerequisites using OR logic

Input:

`POST https://cis3760f23-01.socs.uoguelph.ca/courses/getCoursesByPrereq/`

```
{
    "courseCode": [cis*2750, cis*3490]
    "type": "OR"
}
```

Expected Result:

```
[
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
    },
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

**Test Case 6:**

Description: Getting courses by restrictions using AND logic

Input:

`POST https://cis3760f23-01.socs.uoguelph.ca/courses/getCoursesByRestrictions/`

```
{
    "courseCode": ["cis*1300"]
    "type": "AND"
}
```

Expected Result:

```
[
    {
        "courseCode": "CIS*1500",
        "courseName": "Introduction to Programming",
        "prerequisites": "()",
        "restrictions": "{CIS*1300}"
    }
]
```

**Test Case 7:**

Description: Getting courses by restrictions using OR logic

Input:

`POST https://cis3760f23-01.socs.uoguelph.ca/courses/getCoursesByRestrictions/`

```
{
    "courseCode": ["cis*1300", "cis*1500"]
    "type": "OR"
}
```

Expected Result:

```
[
    {
        "courseCode": "CIS*1500",
        "courseName": "Introduction to Programming",
        "prerequisites": "()",
        "restrictions": "{CIS*1300}"
    },
    {
        "courseCode": "CIS*1300",
        "courseName": "Programming",
        "prerequisites": "()",
        "restrictions": "{CIS*1500}"
    }
]
```

**Test Case 8:**

Description: Choosing subject to generate tree

Input: When selecting a subject from the dropdown. For e.g CIS 

Expected Result: Subject Chosen will display the selected course. This will be Subject Chosen : CIS

**Test Case 9:**

Description: Clicking on generate tree after selecting subject

Input: When clicking on the generate tree button after selecting subject

Expected Result: The graph of all prequisites for the subject will be displayed


**Test Case 9:**

Description: Clicking on generate all courses tree 

Input: When clicking on the generate all courses tree button without selecting subject

Expected Result: The graph of all prequisites for the courses will be displayed