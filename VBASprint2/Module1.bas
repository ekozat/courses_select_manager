Sub GetPrereq()
    Dim courseSheet As Worksheet
    Dim prereqSheet As Worksheet
    
    ' Change prereqSheet to UI input
    Set courseSheet = ThisWorkbook.Sheets("parsed_courses")
    Set prereqSheet = ThisWorkbook.Sheets("Input")
    
    Dim coursesTaken() As String
    Dim completedCredits As Double
    
    completedCredits = CDbl(prereqSheet.Range("B2").Value)
    Debug.Print "Completed Credits: " & completedCredits
    
    
    ' Initialize a collection to store available courses
    Dim availableCourses As Collection
    Set availableCourses = New Collection
    
    ' Initialize destination row
    Dim DestRow As Long
    DestRow = 1

    Dim lastInputRow As Long
    Dim lastPrereqRow As Long
    
    ' Accounts for header rows
    Dim startRow As Long
    startRow = 2
    
    
    Dim i As Long
    Dim j As Long


    ' Figure out the last cell
    lastInputRow = prereqSheet.Cells(prereqSheet.Rows.Count, "A").End(xlUp).Row
    'Debug.Print "The last row is: " & lastInputRow
    
    ' Resize the array
    ReDim coursesTaken(0 To lastInputRow - startRow)

    For i = startRow To lastInputRow
        ' Change to 2 for column headers
        coursesTaken(i - startRow) = Trim(prereqSheet.Cells(i, 1).Value)
        'Debug.Print "Courses Taken: " & coursesTaken(i - startRow)
    Next i
    
    ' Figure out the last cell
    lastPrereqRow = courseSheet.Cells(courseSheet.Rows.Count, "A").End(xlUp).Row
    'Debug.Print "The last row is: " & lastPrereqRow
    
    ' Reset to 0
    i = 0
  


    ' Loop through ALL parsed courses
    For i = startRow To lastPrereqRow
        'Get the prerequisite string
        Dim courseString As String
        courseString = courseSheet.Cells(i, 3).Value
        'Debug.Print "Original String: " & courseString
        
        'add it to the loop to check if credit meets course requirements
        completedCredits = CDbl(prereqSheet.Range("B2").Value)
        
       
        
        Dim resultString As String
        resultString = courseString
        
        'replace , and | with logic expression AND, OR
        
        resultString = Replace(resultString, ",", " AND")
        resultString = Replace(resultString, "|", " OR ")
        
        Dim Found As Boolean
        Found = False
        
        
          j = 0

        ' Loop through input courses and replace them with "True"
        For j = LBound(coursesTaken) To UBound(coursesTaken)
        
            ' Use a case-insensitive comparison
           If InStr(1, resultString, coursesTaken(j), vbTextCompare) > 0 Then
                resultString = Replace(resultString, coursesTaken(j), "True", , 1, vbTextCompare)
                Found = True
                
            'need to check this else statement as False is notbeing replaced in the string
           Else
                resultString = Replace(resultString, coursesTaken(j), "False", , 1, vbTextCompare)
                
         End If

        Next j

        
        'if no courses completed meet the prerequisites, result string is false as no courses will be eligible to be taken
        If Not Found Then
            resultString = "False"
        End If
        
        Debug.Print "Resulting: " & resultString
        
    Next i
End Sub


