# Test Cases:

**Test Case 1:**

- Description: Submitting the course entry form with a valid course code.
- Input: Course code for a single course.
- Expected Result: The course is added to the user's session.
---
**Test Case 2:**
- Description: Submitting the course entry form without a course code.
- Input: Empty course code field.
- Expected Result: Error message - "Missing course code in the request, required."
---
**Test Case 3:**
- Description: Adding multiple courses using the course entry form.
- Input: Multiple course codes, one at a time.
- Expected Result: All courses are added to the user's session.
---
**Test Case 4:**
- Description: Saving recommended courses as a PDF.
- Input: Clicking the "Save" button for a recommended course.
- Expected Result: The course details are saved as a downloadable PDF file.
---
**Test Case 5:**
- Description: Clearing the entered past courses.
- Input: Clicking the "Clear" button on the course entry form.
- Expected Result: All previously entered past courses are cleared, and a confirmation prompt is shown.
---
**Test Case 6:**
- Description: Searching for a specific course code within the recommended list.
- Input: Entering a course code into the search bar.
- Expected Result: The recommended courses are dynamically filtered based on the search input, and the user can see instant search results.
---
**Test Case 7:**
- Description: Requesting course recommendations without providing any past courses.
- Input: No past courses provided.
- Expected Result: Error message - "No past courses provided for recommendations."
---
**Test Case 8:**
- Description: Requesting course recommendations with valid past courses.
- Input: Valid past courses.
- Expected Result: A list of recommended future courses is displayed.
---
**Test Case 9:**
- Description: Applying a subject filter to the recommended courses.
- Input: Selecting a specific subject from the filter.
- Expected Result: Only recommended courses related to the selected subject are displayed.
---
**Test Case 10:**
- Description: Attempting to filter recommended courses without selecting a subject.
- Input: Clicking "Filter" without selecting a subject.
- Expected Result: Error message - "Please select a subject to filter."
---
**Test Case 11:**
- Description: Searching for a course code that does not exist within the recommended list.
- Input: Entering an invalid course code into the search bar.
- Expected Result: No search results are displayed, and a message indicates no matches found.
---
**Test Case 12:**
- Description: Clicking the "Clear" button to clear past courses without confirming the action.
- Input: Clicking "Clear" without confirming the prompt.
- Expected Result: No action is taken, and the confirmation prompt remains.
---
**Test Case 13:**
- Description: Searching for a specific course code with a case-insensitive query within the recommended list.
- Input: Entering a course code with mixed case into the search bar.
- Expected Result: The recommended courses are dynamically filtered, and the search is case-insensitive, displaying relevant results.
---
**Test Case 14:**
- Description: Searching for a course code that does not exist within the recommended list.
- Input: Entering a non-existent course code into the search bar.
- Expected Result: No search results are displayed, and a message indicates no matches found.
---