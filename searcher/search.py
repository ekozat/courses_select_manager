from os import path
import csv

csv_file = "parsed_courses.csv"

# Discuss with the groupt to change export of the file to diff dir
parentpath = path.abspath(path.dirname(path.dirname(__file__)))
filepath = path.join(parentpath, "parser", csv_file)

def course_search():
    # Input course they want to find
    course_name = input("Enter the course name: ")

    # Read the data from the CSV file
    with open(filepath, mode='r', newline='', encoding='utf-8') as file:
        fieldnames = ["course code", "course name", "prerequisites"]
        reader = csv.DictReader(file, fieldnames=fieldnames)

        # iteration example
        for row in reader:
            if row['course name'].casefold() == course_name.casefold():
                print("we found it boys")
                break
            print(reader.line_num)

    file.close()

    print("\n") #maybe we should clear instead of newline?

def subject_search():
    print("\n")

def code_search():
    print("\n")

while True:
    print("Welcome to the prerequisite searcher! \n\nPlease type in the number of the search would you like to execute.")
    print("1. Course Specific Search")
    print("2. Subject Search")
    print("3. Course Code Search")
    print("4. Exit")
    
    choice = input("Enter your choice: ")
    
    if choice == '1': course_search()
    elif choice == '2': subject_search()
    elif choice == '3': code_search()
    elif choice == '4':
        print("Thank you for searching.")
    else:
        print("Invalid choice. Please select a valid option.")
        

    