# F23_CIS3760_101
# Team
- Team Lead: 
    - Sara Adi
- Team Members:
    - Emily Kozatchiner
    - Evan Ferguson
    - Fee Kim Ah-Poa
    - Maneesh K. Wijewardhana
    - Simardeep Singh

# Purpose
The purpose of this file is to share any research notes that we took while learning more about VBA

# Sara Adi's Notes:
- A Microsoft Excel VBA (Visual Basic for Applications) application is a set of customized, automated functions and commands created to enhance Excel's capabilities. 
- Automation: Excel VBA automates tasks in Excel by writing custom code (macros) that can perform actions like calculations, data manipulation, and formatting automatically.
- Customization: It allows users to create personalized tools and features tailored to specific needs, such as automating repetitive tasks, generating reports, or building interactive forms within Excel.
- Coding: Users write VBA code using the VBA editor integrated into Excel. This code consists of instructions in a programming language (Visual Basic) that tells Excel what to do.
- Event-Driven: VBA applications can be triggered by specific events, like clicking a button or opening a workbook, making them respond to user actions or changes in the data.
- Macros: VBA macros are scripts that bundle a series of actions into a single command. Users can record macros by performing tasks manually, and Excel will generate the VBA code automatically.

Notes:
- Developer tab to utilize VBA is usually disabled. Turn on through "Customize Ribbon" on the settings of excel
- Alt + F11 shortcut to open the VB tab

Video: https://www.youtube.com/watch?v=CMlKBwKcFJc
Link: https://www.simplilearn.com/tutorials/excel-tutorial/excel-vba

# Maneesh Wijewardhana's Notes:
- Can assign macros to UI elements in spreadsheets such as buttons
- Can join strings using the '&' operator
- To create a function, you insert a new Module
- There exists Sub-Procedures that are functions but do not return a value and can be called without a call keyword
- Some common syntax to know are:
-   ```excel-vba
        `Creates a popup message box
        MsgBox "Hello World"
    ```
-   ```excel-vba
        `Creates an input box that returns the value entered
        InputBox(prompt[,title][,default][,xpos][,ypos][,helpfile,context])
    ```
-   ```excel-vba
        `Declares a variable with a data type
        `Numeric Data Types: byte, integer, long, single, double, currency, and decimal
        `Non-Numeric Data Types: string, date, boolean, object, and variant
        Dim <<variable_name>> As <<variable_type>>
    ```
-   ```excel-vba
        `Constants cannot be changed during the execution of the program
        Const <<constant_name>> As <<constant_type>> = <<constant_value>>
    ```
-   ```excel-vba
        if(boolean_expression) Then
           Statement 1
           .....
           .....
           Statement n
        End If
    ```
-   ```excel-vba
        While condition(s)
           [statements 1]
           [statements 2]
           ...
           [statements n]
        Wend
    ```






# Fee Kim Ah-Poa's Notes:
- VBA (Virtual Basic for Applications) is an event-driven programming language from Microsoft used mainly in MS Excel, MS Access.
- VBA is an automation known as Macro to generate charts, reports, calculations.
- It helps build personalized applications to improve proficiency of the applications.
- VBA is a high-level language
- Among VBA, Excel VBA is the common one
- VBA makes use of simple English statements to write instructions
- It allows you to organize information
- It allows interaction between Office applications
- VBA macro cannot be saved as .docx instead .docm to protect Office users against viruses and dangerous macro code




Links:
        - https://www.javatpoint.com/vba
        - https://learn.microsoft.com/en-us/office/vba/library-reference/concepts/getting-started-with-vba-in-office





















