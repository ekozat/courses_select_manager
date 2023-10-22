# Test Cases:

**Test Case 1:**
- Description: Sending a PUT request without coursecode
- Input: can be coursename, prerequisites, restrictions or no input
- Expected Result: "Missing courseCode in the request, required"

**Test Case 2:**
- Description: Sending a PUT request with coursecode
- Input: add coursecode and any other fields that wants to be updated
- Expected Result: "Update successful"

**Test Case 3:**
- Description: Sending a PUT request with coursecode but invalid fields
- Input: add coursecode and any other fields that wants to be updated
- Expected Result: "No valid update data provided"

**Test Case 4:**
- Description: Sending a PUT request with coursecode but valid fields
- Input: add coursecode and any other fields that wants to be updated
- Expected Result: The current data for the coursecode and the updated data will be displayed

**Test Case 5:**
- Description: Sending a POST request with a new course
- Input: Add a new course with a unique course code, course name, prerequisites, and restrictions.
- Expected Result: The course should be added successfully, and the response should confirm the addition with an HTTP status code 201 (Created) and a message like "Course added successfully."

**Test Case 6:**
- Description: Sending a POST request with an existing course code
- Input: Attempt to add a new course with a course code that already exists in the database.
- Expected Result: The system should prevent adding duplicate data. The response should include an error message like "Course code already exists" with an HTTP status code 409.

**Test Case 7:**
- Description: Sending a POST request with an invalid request method
- Input: Make a POST request to add a new course, but use an incorrect request method (e.g., GET, PUT, DELETE).
- Expected Result: The system should only accept POST requests for adding new courses. If an invalid request method is used, it should return an HTTP status code 405 with an error message like "Incorrect request method."

**Test Case 8:**
- Description: Sending a DELETE request for an existing course
- Input: Make a DELETE request to remove an existing course by specifying the course code in the request body.
- Expected Result: The course should be deleted successfully from the database. The response should confirm the deletion with an HTTP status code 200 and a message like "Course deleted successfully."

**Test Case 9:**
- Description: Sending a DELETE request for a non-existing course
- Input: Attempt to delete a course with a course code that does not exist in the database.
- Expected Result: If the course is not found in the database, the system should return an HTTP status code 404 with an error message like "Course not found in the database."

**Test Case 10:**
- Description: Sending a DELETE request with an invalid request method
- Input: Submit a DELETE request with an incorrect request method (e.g., GET, POST).
- Expected Result: The system should only accept DELETE requests for course deletion. If the request method is incorrect, it should return an HTTP status code 405.
