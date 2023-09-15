from os import path
import csv

csv_file = "parsed_courses.csv"

# Discuss with the groupt to change export of the file to diff dir
parentpath = path.abspath(path.dirname(path.dirname(__file__)))
filepath = path.join(parentpath, "parser", csv_file)

def name_search():
    # Input course they want to find
    course_name = input("Enter the course name: ")

    # Read the data from the CSV file
    with open(filepath, mode='r', newline='', encoding='utf-8') as file:
        fieldnames = ["course code", "course name", "prerequisites"]
        reader = csv.DictReader(file, fieldnames=fieldnames)
        found = False

        # search iteration
        for row in reader:
            # consider match
            if row['course name'].casefold() == course_name.casefold():

                # table formatting
                print("\n{:^30}|{:^30}|{:^30}".format("Course Code", "Course Name", "Prerequisites"))
                for x in range(95): 
                    print("-", end="")
                print("\n{:^30}|{:^30}|{:^30}".format(row['course code'], row['course name'], row['prerequisites']))

                found = True
                break
        
        # match missing
        if found is False:
            print("Match not found.")

    file.close()

    print("\n") #maybe we should clear instead of newline?


def subject_search():
# Get the subject abbreviation from user
    subject_name = input("Enter the Course Name: ")
    sub_upper = subject_name.upper()


    # Read the data from the CSV file
    with open(filepath, mode='r', newline='', encoding='utf-8') as file:
        fieldnames = ["course code", "course name", "prerequisites"]
        reader = csv.DictReader(file, fieldnames=fieldnames)

        # Initialize a list to store matching rows
        matching_rows = []
        
        # Iterate through the rows in the CSV file
        for row in reader:

            # Ensure that 'course code' is a valid column name in your CSV file
            if 'course code' in row:
                course_code = row['course code']
                
                # Check if the course code starts with the given subject
                if course_code.startswith(sub_upper):
                    matching_rows.append(row)

        if not matching_rows:
            print("Subject doesn't exist")
        else:
            # matching_rows contains the rows that needs to be output

            for row in matching_rows:
                print(row)


    file.close()

    print("\n")


def code_search():
# Input text to search for (e.g., "CIS 1300" or "CIS1300" or "CIS*1300")
    search_text = input("Enter a course code to search for: ").replace(" ", "").replace("*", "")
    search_text_Upp = search_text.upper()

    with open(filepath, mode='r', newline='', encoding='utf-8') as file:
        fieldnames = ["course code", "course name", "prerequisites"]
        reader = csv.DictReader(file, fieldnames=fieldnames)
        
        # Initialize a list to store matching rows
        matching_rows = []
        
        # Iterate through the rows in the CSV file
        for row in reader:
            # Extract the course code and remove spaces and asterisks
            course_code = row['course code'].replace(" ", "").replace("*", "")
            
            # Check if the course code contains the search text
            if search_text_Upp in course_code:
                matching_rows.append(row)

        if not matching_rows:
            print("No matching rows found.")
        else:
            # Display the matching rows
            for row in matching_rows:
                #print (row)
                print("\n")
                print("-------------------------------------------------------------------------------------------------")
                print("\n")
                print("Course Code:", row['course code'])
                print("\n")
                print("Course Name:", row['course name'])
                print("\n")
                print("Prerequisites:", row['prerequisites'])
                print("\n")
                print("-------------------------------------------------------------------------------------------------")
                print()
    file.close()
    
    print("\n")




while True:
    print("Welcome to the prerequisite searcher! \n\nPlease type in the number of the search would you like to execute.")
    print("1. Course Name Search")
    print("2. Subject Search")
    print("3. Course Code Search")
    print("4. Exit")
    
    choice = input("Enter your choice: ")
    
    if choice == '1': name_search()
    elif choice == '2': subject_search()
    elif choice == '3': code_search()
    elif choice == '4':
        print("Thank you for searching.")
        break
    else:
        print("Invalid choice. Please select a valid option.")
        

    