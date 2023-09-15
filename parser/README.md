# Course Parser

### Compiling and Running

-   Ensure you have python3 installed on your machine
-   Navigate to the parser directory and run the script by typing `python3 main.py` in your terminal
-   A new file will be generated called `parsed_courses.csv` which you can open in any preferred spreadsheet editor

### Initial Approach

Our first thought was to use the file f23_courses2.txt since it looked more structured than f23_courses1.txt.

The steps consisted of:
1. Start reading from the first course line by line
2. Once you hit the word "Location(s):" you know you have a new course on the next line so parse out the code and name from it
3. Once you hit the word "Prerequisite(s):" parse this until you hit one of the other colon separated words

This method surprisingly parsed most courses fine but due to inconsistencies within the file itself that made our initial assumption false. It resulted in some prerequisites not getting parsed fully, certain course codes not showing up at all, and a myriad of other small edge case issues.

We needed to think of a new approach.

### New Approach

We decided on reading the f23_courses1.txt character by character instead and utilizing regular expressions to parse out what we needed.

The steps were as follows:

1. Start reading from the first course character by character
2. Separate out "course blobs" which were done by splitting on the word "Location(s):"
3. Define a regular expression that captures the course code and everything after until square brackets which denotes the end of course name
    - `r"([A-Z]{3,4}\*\d{4})\s+(.*?)\s+\[[\d.]+\]"`
4. Define a regular expression that captures the prerequisite and ensures to stop capturing once hitting a new colon separated word
    - `r"Prerequisite\(s\):(.*?)(Restriction\(s\)|Location\(s\)|Co-requisite\(s\)|Equate\(s\)|Offering\(s\)|Department\(s\))"`
5. Loop through the course blobs and apply the course details regex and prerequisite regex making sure to use the DOTALL flag which ensures multiline capturing as certain prerequisites and course names spanned two lines
6. Parse out only the course title by splitting the course name by double space as the delimiter and taking the first element in the array
7. Since some courses do not have prerequisites, handle that case separately by assigning prerequisite and empty array
8. In case the file has duplicated courses, filter those courses out
9. Create respective column names, write our data into rows, and export the entirety as a csv

### Future Goals

Although the parser does everything we need, there are some aspects of it that can be improved or features that need to be added later on. These include:

1.  Parsing out prerequisites themselves since at some point, we will have to store them in a more organized way so that it is easier to check student eligibility
    -   Examples:
        -   (ACCT\*3330 or BUS\*3330), (ACCT\*3340 or BUS\*3340)
        -   Completion of 7.50 credits including (1 of GEOG\*2460, STAT\*2040, STAT\*2060, STAT\*2080)
2.  Parsing out restrictions
