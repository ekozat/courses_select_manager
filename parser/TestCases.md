The file contains different test cases which test various scenarios and functionalities that the code should handle correctly:

# Test Cases:

**Test Case 1: Valid Input File**

- Description: Test using a valid input file, which contains course information.
- Input: A valid input file with course information.
- Expected Result: The program should accurately read the input file and produce a CSV file with the data.

**Test Case 2: Missing Input File**

- Description: Test the code without input file.
- Input: A path to an invalid or missing input file.
- Expected Result: The code must gracefully handle the issue and display the proper error message.

**Test Case 3: Invalid Input File Format**

- Description: Test the code with an unsupported input file format. 
- Input: An unsupported input file format. For example: Non-text file.
- Expected Result: If the file format is not supported, the function should handle the problem and provide an appropriate error message.

**Test Case 4: Empty Input File**

- Description: Test the code with an empty input file.
- Input: An empty input file.
- Expected Result: The code must handle empty files and output a notice stating that there are no courses to parse.

**Test Case 5: Valid Course Data**

- Description: Test the code with valid course data in the input file.
- Input: A valid input file containing one or more courses.
- Expected Result: The program should properly interpret the course data, and output the results to the CSV file.

**Test Case 6: Course Data with Prerequisites**

- Description: Test course data that contains prerequisites.
- Input: Input file with courses containing prerequisites.
- Expected Result: The prerequisites should be accurately parsed by the code and stored in the Course objects.

**Test Case 7: Course Data without Prerequisites**

- Description: Test the code with course data that does not have any prerequisites.
- Input: Input file with courses that do not have prerequisites.
- Expected Result: Courses without prerequisites should be properly parsed and stored by the code.

**Test Case 8: Valid Output CSV File**
- Description: Test that the code generates a valid CSV output file.
- Input: Valid input file with course data.
- Expected Result: The produced CSV file must be properly structured and include the course data that has been processed.

**Test Case 9: Performance Testing**

- Description: With a large input file including a lot of courses, evaluate the code's performance.
- Input: A large input file with a substantial amount of course data.
- Expected Result: The code should output the CSV file without experiencing any performance concerns when handling the big input.
