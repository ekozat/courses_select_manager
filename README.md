# F23_CIS3760_101

# Team

-   Team Lead:
    -   Maneesh K. Wijewardhana
-   Team Members:
    -   Sara Adi
    -   Emily Kozatchiner
    -   Fee Kim Ah-Poa
    -   Simardeep Singh

## How to Run

1. Open the Microsoft Excel file which contains the UI and parsed courses (make sure to enable macros)
2. Navigate to the input courses sheet and input your completed courses and credits completed
3. Click the generate eligible courses button

## Name

Sprint 2

## Description

F23 CIS\*3760 Sprint 2:

The purpose of this sprint was to have an Excel UI that the student can enter their courses in, then have an output of the courses they are eligible to take are.

The criteria that we needed to meet were:

-   The UI is easy to use
-   Have multiple sheets (all course data, input courses, output courses)
-   Only use VBA to generate courses

## Visuals

![excel-ui](./Photos/excel-ui.png)
![excel-ui2](./Photos/excel-ui2.png)
![excel-ui3](./Photos/excel-ui3.png)

## Team Approach

This project had multiple parts to it:

1.  Re-parse prerequisites in the parser script so it would be easy to use in VBA
2.  Parse out restrictions in the parser script so that eligibility criteria can be met for the student
3.  Create an easy to use Excel UI with buttons and input cells
    -   This included having inputs for completed courses and completed credits
4.  Create VBA scripts that parse out the prerequisites and check if the student is eligible to take a course, if so, add it to the sheet

Currently, this VBA script only works on Windows due to utilizing regex

## Authors and acknowledgment

    - Sara Adi
    - Emily Kozatchiner
    - Fee Kim Ah-Poa
    - Maneesh K. Wijewardhana
    - Simardeep Singh

## Project status

Completed
