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




