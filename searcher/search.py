from os import path
import csv

csv_file = "parsed_courses.csv"

# Discuss with the groupt to change export of the file to diff dir
parentpath = path.abspath(path.dirname(path.dirname(__file__)))
filepath = path.join(parentpath, "parser", csv_file)

# Read the data from the CSV file
with open(filepath, mode='r', newline='', encoding='utf-8') as file:
    fieldnames = ["course code", "course name", "prerequisites"]
    reader = csv.DictReader(file, fieldnames=fieldnames)

    # iteration example
    for row in reader:
        print(reader.line_num)

    