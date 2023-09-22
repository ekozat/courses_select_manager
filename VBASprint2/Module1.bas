Attribute VB_Name = "Module1"
Sub GetPrereq()
    Dim courseSheet As Worksheet
    Dim prereqSheet As Worksheet
    
    'Change prereqSheet to UI input
    Set courseSheet = ThisWorkbook.Sheets("parsed_courses")
    Set prereqSheet = ThisWorkbook.Sheets("Input")
    
    
    Dim coursesTaken() As String
    Dim prereqs() As String
    
    Dim regex As Object
    Set regex = CreateObject("VBScript.RegExp")
    regex.Pattern = "([A-Z]{3,4}\*\d{4})"
    regex.Global = True
    
    ' Initialize a collection to store available courses
    Dim availableCourses As Collection
    Set availableCourses = New Collection
    
    ' Initialize destination row
    DestRow = 1
    
    'Read all the courses taken - COMPLETE
    'Go through each line and try to calculate the condition
    'if the course is not present - it will be a false
    'if result is false = do not add course to list
    'if result is true = add course and display
    
    Dim lastInputRow As Long
    Dim lastPrereqRow As Long
    
    'Accounts for header rows
    Dim startRow As Integer
    startRow = 2
    
    'reset to 0 every loop
    Dim i As Long
    Dim j As Long
    Dim k As Long

    
    'figure out last cell
    lastInputRow = prereqSheet.Cells(prereqSheet.Rows.Count, "A").End(xlUp).Row
    Debug.Print "The last row is: " & lastInputRow
    
    ' Resize the array
    ReDim coursesTaken(0 To lastInputRow)

    For i = startRow To lastInputRow
        ' change to 2 for column headers
        coursesTaken(i - 2) = prereqSheet.Cells(i, 1).Value
        
    Next i
    
    For i = 0 To lastInputRow
        'Print courses taken
        Debug.Print "" & coursesTaken(i)
    Next i
    
    ' STEP 2 - read through each logic expression
    
    'figure out last cell
    lastPrereqRow = courseSheet.Cells(courseSheet.Rows.Count, "A").End(xlUp).Row
    ' Debug.Print "The last row is: " & lastRow
    
    Dim course As Object
    Dim courseBool() As String
    Dim found As Boolean
    found = False
    
    Dim resultString As String
    
    i = 0
    j = 0
    k = 0
    For i = startRow To lastPrereqRow
        ' extract all courses from prerequisites
        Set course = regex.Execute(courseSheet.Cells(i, 3).Value)
        
        ReDim courseBool(0 To course.Count)
        
        ' Debug.Print "course:" & course.Count
        
        resultString = courseSheet.Cells(i, 3).Value
        
        j = 0
        found = False
        ' loop through all courses regexed PER prereq string (each row)
        ' compare all matches to coursesTaken and see if it matches
        For j = 0 To course.Count - 1
            ' define course to replace
            subStr = course(j).Value
            ' Debug.Print "course" & subStr
            
            
            ' loop through all taken courses to determine
            k = 0
            For k = 0 To lastInputRow - 1
                If course(j).Value = coursesTaken(k) Then
                    'Debug.Print "courses Taken:" & coursesTaken(k)
                    resultString = Replace(resultString, subStr, "True")
                    
                    Debug.Print "Original String: " & courseSheet.Cells(i, 3).Value
                    Debug.Print "Result String: " & resultString
                    
                    found = True
                    Exit For
                    'Debug.Print "" & courseBool(j) - test
                End If
            Next k
            
            ' If the pattern was not found, set resultString to "False"
            If Not found Then
                resultString = Replace(resultString, subStr, "False")
                Debug.Print "Original String: " & courseSheet.Cells(i, 3).Value
                Debug.Print "Result String: " & resultString
            End If
        
        Next j
        
        ' STEP 3 - Create logic expression and calculate result
        'courseSheet.Cells(i, 3).Value
            
            
        
        ' test print statement for successful regex parsing
        'For j = 0 To course.Count - 1
        '    Debug.Print "Match " & j + 1 & ": " & course(j).Value
        'Next j
        

    Next i
    
    ' i=0 for next for loop outside of here
    
End Sub

