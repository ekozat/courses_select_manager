Sub outputSheetName()

  Dim i As Integer

  For i = 1 To Sheets.Count
   Cells(i, 2).Value = Sheets(i).Name
  Next i

End Sub
