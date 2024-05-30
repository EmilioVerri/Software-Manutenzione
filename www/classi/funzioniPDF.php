<?php

include('./pdf/fpdf.php');
function tutteLeMacchinePDF(){
  $pdf = new FPDF(); // Create a new FPDF instance
  $pdf->SetMargins(20, 15); // Set left, top margins (in mm)
  $pdf->SetTitle('Tutte le Macchine'); // Set PDF title
  $pdf->SetAuthor('Emilio Verri'); // Set PDF author
  $pdf->AddPage(); // Add a new page to the PDF
  $pdf->SetFont('Arial', 'B', 16); // Set bold Arial font size 16
  $pdf->Cell(0, 10, 'ELENCO ATTREZZATURE E IMPIANTI ', 1, 1, 'C'); // Add title cell
  $pdf->SetFont('Arial', '', 12); // Set regular Arial font size 12
  
  $pdf->Output('my_pdf.pdf', 'F'); // Generate and save the PDF as 'my_pdf.pdf'
  echo '<script>window.open("my_pdf.pdf", "_blank");</script>';
}

    ?>