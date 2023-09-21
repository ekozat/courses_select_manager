import re
import csv
import os

class Course:
    def __init__(self, code, name, prerequisites):
        self.code = code
        self.name = name
        self.prerequisites = prerequisites

    def __str__(self):
        return f"Course Code: {self.code}\nCourse Name: {self.name}\nPrerequisites: {self.prerequisites}"

def parse_courses(input_file_path, output_csv_file):
    try:
        with open(input_file_path, "r", encoding="ISO-8859-1") as file:
            file_contents = file.read()
            file_contents = file_contents.strip()
            if not file_contents:
              print("ERROR: Empty File. Please Try Another File")
              exit()
        # This is where the first course starts
        start = file_contents.split("Accounting (ACCT)")[3].strip()

        courses = []

        # Split the text into course blobs using "Location(s):" as the delimiter since every course has a location at the end
        course_blobs = re.split(r"Location\(s\):", start)

        # Define a regular expression pattern to match course codes and course names combined and prerequisites separately
        course_pattern = r"([A-Z]{3,4}\*\d{4})\s+(.*?)\s+\[[\d.]+\]"
        prerequisite_pattern = r"Prerequisite\(s\):(.*?)(Restriction\(s\)|Location\(s\)|Co-requisite\(s\)|Equate\(s\)|Offering\(s\)|Department\(s\))"

        # Loop through each course blob and extract the first course code
        for blob in course_blobs:
            blob = blob.strip()
            # DOTALL flag will allow us to span multiple lines
            matches = re.search(course_pattern, blob, re.DOTALL)
            if matches:
                course_code = matches.group(1)
                course_name = matches.group(2)
                # Since some course names span two lines and contain other useless info, we split on double space so we can take the first element in that array
                course_name = course_name.split("  ")[0].strip()
                prerequisites = re.findall(prerequisite_pattern, blob, re.DOTALL)
                # Since some courses do not have prerequisites, handle that case separately
                if course_code and course_name:
                    if prerequisites:
                        prerequisites_str = prerequisites[0][0].strip()
                        # Replace 'or' with '|' and 'and' with '&' to match your requirement
                        prerequisites_str = prerequisites_str.replace("or", "|").replace("and", "&")

                        # Handle the special cases for "Completion of ...", "&...", multiple options within parentheses, and "<#> of ..."
                        prerequisites_str = re.sub(r'Completion of &([\d.]+) credits including', r'&Completion of \1 credits including', prerequisites_str)
                        prerequisites_str = re.sub(r'&(\d+\.\d+ credits including)', r'\1', prerequisites_str)
                        prerequisites_str = re.sub(r'\((.*?)\)', lambda x: x.group(1).replace(", ", "|"), prerequisites_str)
                        prerequisites_str = re.sub(r'<#> of (.*?)', r'(\1)', prerequisites_str)
                        
                        courses.append(Course(course_code, course_name, prerequisites_str))
                    else:
                        courses.append(Course(course_code, course_name, ""))

        # If we added dupelicated courses, make sure to remove them before exporting to csv
        seen_codes = set()
        non_dupe_courses = []
        for course in courses:
            if course.code not in seen_codes:
                non_dupe_courses.append(course)
                seen_codes.add(course.code)

        # Create a list of dictionaries for the data
        data = [{"course code": course.code, "course name": course.name, "prerequisites": course.prerequisites} for course in non_dupe_courses]

        # Write the data to a CSV file
        with open(output_csv_file, mode='w', newline='', encoding='utf-8') as file:
            fieldnames = ["course code", "course name", "prerequisites"]
            writer = csv.DictWriter(file, fieldnames=fieldnames)

            # Write the header row
            writer.writeheader()

            # Write the data rows
            writer.writerows(data)
        
        return True, "Successfully parsed and saved to CSV."
    except FileNotFoundError:
        return False, "Input file not found."
    except Exception as e:
        return False, f"An error occurred: {str(e)}"

# Hardcoded input and output file names
input_file_path = "../f23_courses1.txt"
output_csv_file = "parsed_courses.csv"


if input_file_path.endswith(".txt"):
  result, message = parse_courses(input_file_path, output_csv_file)
  print(message)
else:
    print("ERROR: Please provide .txt file format")
  

