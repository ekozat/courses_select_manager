# F23_CIS3760_101

# Team

-   Team Lead:
    -   Simardeep Singh
-   Team Members:
    -   Sara Adi
    -   Maneesh K. Wijewardhana
    -   Fee Kim Ah-Poa
    -   Emily Kozatchiner

# Purpose

The purpose of this file is to list all user stories that will be used to help program the solution for sprint 7, and plan ahead for future sprints.

# Maneesh Wijewardhana's User Stories

**Title:** No query parameters in GET requests

**Priority:** High

**Estimate (in hrs):** -

**User Story:** As a user, when I make a GET request to retrieve course information of any sort, I would like to be able to submit a JSON body specifying what I need and preferrably aso be able to submit a JSON body specifying what I need and preferably as a POST request

**Acceptance Criteria:**:

-   GET requests that specify query parameters should instead accept a JSON body
-   These requests should be POST as per standards
-   The behaviour of the endpoint should remain the same, just a structural change should be seen

**Title:** Responsive Design

**Priority:** High

**Estimate (in hrs):** -

**User Story:** As a user, when navigating throughout the website, it should conform to different screen sizes and adjust size appropriately

**Acceptance Criteria:**:

-   The website should be able to be easily navigated on large screens, laptop screens, and mobile screens
-   No website information should be cut off or sized in an inconsistent manner due to viewing on a small screen

**Title:** Accessible Website

**Priority:** High

**Estimate (in hrs):** -

**User Story:** As a user, I should be able to navigate the website using accessible features such as screen readers and/or the keyboard

**Acceptance Criteria:**:

-   The HTML on the website should use the correct tags
-   The HTML on the website should have proper accessible tags and alt text
-   A good accessibility score should be obtained using `https://www.accessibilitychecker.org/`

**Title:** Code quality

**Priority:** High

**Estimate (in hrs):** -

**User Story:** As a developer, when looking through the website code, it should be easy to understand and iterate on

**Acceptance Criteria:**:

-   Proper use of functions and variable names should be in place
-   All areas of possible errors are checked and handled correctly and gracefully
-   Use `http://www.cs.otago.ac.nz/cosc345/resources/nasa-10-rules.htm` as a reference

**Title:** Automated Testing

**Priority:** High

**Estimate (in hrs):** -

**User Story:** As a developer, when making changes to the website code, a series of automated tests should run to ensure previous functionality still works as expected

**Acceptance Criteria:**:

-   An ability to run a script which runs many front-end tests is present
-   A proper testing tool such as Puppeteer or Playwright is used

# Sara Adi's User Stories
**Title:** Course Prerequisites Tree Diagram

**Priority:** High

**Estimate (in hrs):** -

**User Story:**  As a user, I want to graph course prerequisites as a tree diagram on the website

**Acceptance Criteria:**:

-   The site prompts the user to select a subject
-   The user clicks generate tree
-   A tree is generated.

**Title:** Complex pre-requsites

**Priority:** High

**Estimate (in hrs):** -

**User Story:**  As a user, I want the tree diagram to showcase all prerequistes including the ones that have an OR / AND relationship

**Acceptance Criteria:**:

-   The site prompts the user to select a subject
-   The user clicks generate tree
-   A tree is generated that has nodes whos edged are connected dispite the pre-req being an AND / OR

**Title:** No pre-req courses

**Priority:** High

**Estimate (in hrs):** -

**User Story:**  As a user, I want the tree diagram to showcase courses (nodes) with no pre-req (courses)

**Acceptance Criteria:**:

-   The site prompts the user to select a subject
-   The user clicks generate tree
-   A tree is generated that has nodes who do not have edges

# Fee Kim's User Stories
**Title:** Hovering over a course

**Priority:** Low

**Estimate (in hrs):** -

**User Story:**  As a user, I want to be able to get the name of the course upon hovering over it

**Acceptance Criteria:**:
-   Upon hovering on the tree you should be able to get the course name when hovering over the course code

**Title:** clicking on a course

**Priority:** Low

**Estimate (in hrs):** -

**User Story:**  As a user, I want to be able to get the prerequistes in a way that is easy to be read

**Acceptance Criteria:**:
-   Upon on clicking on the course code shape, the arrows will be changed to another colour for easy interaction with the tree
-   It will be clearer to the user to follow the prerequisites