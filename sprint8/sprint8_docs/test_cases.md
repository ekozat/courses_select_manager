# Test Cases:

**Test Case 1:**
- **Description:** Choosing subject to generate tree
- **Input:** Selecting a subject from the dropdown, e.g., "CIS"
- **Expected Result:** The text "Subject Chosen: CIS" should be displayed, indicating the selected course.

**Test Case 2:**
- **Description:** Clicking on "Generate Tree" after selecting a subject
- **Input:** Clicking the "Generate Tree" button after choosing a subject
- **Expected Result:** A graph representing all prerequisites for the selected subject (e.g., CIS) should be displayed.

**Test Case 3:**
- **Description:** Clicking on "Generate All Courses Tree" without selecting a subject
- **Input:** Clicking the "Generate All Courses Tree" button without choosing any subject
- **Expected Result:** A tree displaying prerequisites for all courses should be shown.

**Test Case 4:**
- **Description:** Searching for a specific course
- **Input:** Entering a course code in the search input and clicking the search button
- **Expected Result:** If the course code exists, it should be highlighted and focused in the graph. If not found, an appropriate message (e.g., "Course not found!") should be displayed.

**Test Case 5:**
- **Description:** Switching between light and dark modes
- **Input:** Toggling the dark mode switch on/off
- **Expected Result:** The background color and text color should change accordingly between light and dark modes without affecting the functionality.

**Test Case 6:**
- **Description:** Exporting Tree Diagram
- **Input:** Choosing the tree and clicking on download Tree button.
- **Expected Result:** The tree diagram should be downloaded in the PNG format.

**Test Case 7:**
- **Description:** Highlighting Node and Arrows with Colors
- **Input:** Click on a specific node in the tree diagram.
- **Expected Result:**
    - The selected node becomes highlighted.
    - Incoming arrows leading to the selected node should be displayed in blue.
    - Outgoing arrows from the selected node should be displayed in red.

**Test Case 8:** 
- **Description:** Verify the presence of a border surrounding the canvas containing the tree diagram.
- **Input:** Inspect the tree diagram area visually.
- **Expected Result**: A visible border should be observed outlining the entire tree diagram canvas, ensuring containment and a structured appearance.

**Test Case 9:**
- **Description:** Test the error message displayed when attempting to search for a course that does not exist in the diagram.
- **Input**: Enter a non-existent course code into the search box.
- **Expected Result:** An error message should be displayed, explicitly indicating that the searched course does not exist within the diagram.

**Test Case 10:** 
- **Description:** Validate the format and clarity of the error message for a non-existent course search.
- **Input:** Attempt to search for a course that is not present within the tree diagram.
- **Expected Result:** The error message should be clearly presented, stating the absence of the searched course within the diagram in a manner that is easily understandable and concise for the user.

**Test Case 11:**
- **Description:** Ensure loading icon is present for the rendering duration of the diagram, and is hidden when the diagram is not being rendered.
- **Input:** Press the generate course diagram button and note the loading icon and its disapearance when diagram is generated
- **Expected Result:** The loading icon is present when rendering, and not present when a diagram is drawn or when page is first loaded.

**Test Case 12:** 
- **Description:** Test that when subject is chosen from the dropdown, it dynamically outputs the choice to the user
- **Input:** Choose a subject from the dropdown. 
- **Expected Result:** The paragraph below the dropdown should now display the chosen subject.