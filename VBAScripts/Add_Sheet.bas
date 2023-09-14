Sub Add_Sheet()

 Dim sheetNum As Integer, i As Integer

 sheetNum = Application.InputBox("How many sheets do you want to add to the workbook?", "Add Sheets", , , , , , 1)

 If sheetNum = False Then
  Exit Sub
  
 Else
 
   For i = 1 To sheetNum
   Worksheets.Add
   
   Next i
   
 End If
 
End Sub


