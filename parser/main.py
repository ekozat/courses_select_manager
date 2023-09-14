import re


class Course:
    # TODO: define property 'name'
    def __init__(self, code, prerequisites):
        self.code = code
        # self.name = name
        self.prerequisites = prerequisites

    # TODO: add property 'name'
    def __str__(self):
        return f"Course Code: {self.code}\nPrerequisites: {self.prerequisites}"


with open("../f23_courses2.txt", "r", encoding="ISO-8859-1") as file:
    file_contents = file.read()
    file_contents.strip()

# This is where the first course starts
start = file_contents.split("Accounting (ACCT)")[3].strip()

courses = []

# Split the text into course blobs using "Location(s):" as the delimiter since every course has a location at the end
course_blobs = re.split(r"Location\(s\):", start)

# Define a regular expression pattern to match course codes
# TODO: Try to also capture the course name. This does the code only, the name is right next to the code but need to figure out when to stop reading it
course_pattern = r"([A-Z]{3,4}\*\d{4})"
prerequisite_pattern = r"Prerequisite\(s\):(.*?)(Restriction\(s\)|Location\(s\)|Co-requisite\(s\)|Equate\(s\)|Offering\(s\)|Department\(s\))"

# Loop through each course blob and extract the first course code
for blob in course_blobs:
    course_codes = re.findall(course_pattern, blob)
    # Use re.findall with re.DOTALL to find all prerequisites in the text
    prerequisites = re.findall(prerequisite_pattern, blob, re.DOTALL)
    if course_codes and not prerequisites:
        courses.append(Course(course_codes[0], []))
    elif course_codes and prerequisites:
        courses.append(Course(course_codes[0], prerequisites[0][0].strip()))

for course in courses:
    print(course)
