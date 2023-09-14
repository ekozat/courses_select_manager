from os import path

basepath = path.dirname(__file__)
filepath = path.abspath(path.join(basepath, "CIS3760", "f23_cis3760_101", "parser", "parsed_courses.csv"))

csv_file = "parsed_courses.csv"

# Write the data to a CSV file
with open(csv_file, mode='r', newline='', encoding='utf-8') as file:
    fieldnames = ["course code", "course name", "prerequisites"]
    reader = csv.DictReader(file, fieldnames=fieldnames)
    