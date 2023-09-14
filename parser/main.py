import re


class Course:
    def __init__(self, code, name, prerequisites):
        self.code = code
        self.name = name
        self.prerequisites = prerequisites

    def __str__(self):
        return f"Course Code: {self.code}\nCourse Name: {self.name}\nPrerequisites: {self.prerequisites}"


# Use the correct encoding so out program doesn't crash and read char by char making sure to remove newlines and spaces
with open("../f23_courses1.txt", "r", encoding="ISO-8859-1") as file:
    file_contents = file.read()
    file_contents.strip()

# This is where the first course starts
start = file_contents.split("Accounting (ACCT)")[3].strip()

courses = []

# Split the text into course blobs using "Location(s):" as the delimiter since every course has a location at the end
course_blobs = re.split(r"Location\(s\):", start)

# Define a regular expression pattern to match course codes and course name combined and prereq seperately
course_pattern = r"([A-Z]{3,4}\*\d{4})\s+(.*?)\s+\[[\d.]+\]"
prerequisite_pattern = r"Prerequisite\(s\):(.*?)(Restriction\(s\)|Location\(s\)|Co-requisite\(s\)|Equate\(s\)|Offering\(s\)|Department\(s\))"

# Loop through each course blob and extract the first course code
for blob in course_blobs:
  blob.strip()
  # DOTALL flag will allow us to span multiple lines
  matches = re.search(course_pattern, blob, re.DOTALL)
  if matches:
    course_code = matches.group(1)
    course_name = matches.group(2)
    # Since some course names span two lines and contain other useless info, we split on double space so we can take the first element in that array
    course_name = course_name.split("  ")[0].strip()
    prerequisites = re.findall(prerequisite_pattern, blob, re.DOTALL)
    # Since some courses do not have prereq, handle that case seperately
    if course_code and course_name and not prerequisites:
      courses.append(Course(course_code, course_name, []))
    elif course_code and course_name and prerequisites:
      courses.append(
          Course(course_code, course_name, prerequisites[0][0].strip()))

for course in courses:
  print(course)
  print('\n')
