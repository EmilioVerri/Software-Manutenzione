<?php

include('./pdf/fpdf.php');
function tutteLeMacchinePDF(){
  $pdf = new FPDF(); // Create a new FPDF instance
  $pdf->SetMargins(40, 30); // Set left, top margins (in mm)
  $pdf->SetTitle('Tutte le Macchine'); // Set PDF title
  $pdf->SetAuthor('Emilio Verri'); // Set PDF author
  $pdf->AddPage(); // Add a new page to the PDF
  $pdf->SetFont('Arial', 'B', 14); // Set bold Arial font size 16
  $pdf->Cell(0, 7, 'ELENCO ATTREZZATURE E IMPIANTI ', 1, 1, 'C'); // Add title cell
  $pdf->SetFont('Arial', '', 12); // Set regular Arial font size 12
  
$pdf = new FPDF(); // Create a new FPDF instance

// Set margins and document properties (optional)
$pdf->SetMargins(20, 15); // Set left, top margins (in mm)
$pdf->SetTitle('Tutte le Macchine'); // Set PDF title
$pdf->SetAuthor('Emilio Verri'); // Set PDF author

$pdf->AddPage(); // Add a new page to the PDF

// Define table headers and data (replace with your actual data)
$headers = array('Sigla', 'Nome', 'Cat.', 'Reparto', 'Manutenzione', 'Ultima Man.', 'Prox Man.');





$my_conn = new PDO('sqlite:manutentori.db');
$secondquery = $my_conn->prepare("SELECT * FROM 'manutenzioni'");
$secondquery->execute();


$data = array(
);

foreach($secondquery as $row){
  $info=array($row['Sigla'], $row['Nome'], $row['Cat'], $row['Reparto'], $row['Manutenzione'], $row['UltimaMan'], $row['ProxMan']);
  array_push($data,$info);
}




// Set font and cell width for headers
$pdf->SetFont('Arial', 'B', 12); // Set bold Arial font size 12
$cellWidth = $pdf->GetPageWidth() - 22; // Adjust margin as needed
$cellWidth = $cellWidth / count($headers);

// Create table headers
foreach ($headers as $header) {
    $pdf->Cell($cellWidth, 7, $header, 1, 0, 'C'); // Header cell with border, no line break, centered
}
$pdf->Ln(7); // Add a line break after headers

// Set font for data
$pdf->SetFont('Arial', '', 7); // Set regular Arial font size 7

// Print data rows with automatic page breaks and cell wrapping
foreach ($data as $row) {
    $pdf->Cell($cellWidth, 7, $row[0], 1, 0); // Code
    $pdf->Cell($cellWidth, 7, $row[1], 1, 0); // Description (wrapping enabled)
    $pdf->Cell($cellWidth, 7, $row[2], 1, 0); // Brand
    $pdf->Cell($cellWidth, 7, $row[3], 1, 0); // Model
    $pdf->Cell($cellWidth, 7, $row[4], 1, 0); // Year
    $pdf->Cell($cellWidth, 7, $row[5], 1, 0); // Status
    $pdf->Cell($cellWidth, 7, $row[6], 1, 1, 'L'); // Notes (wrapping enabled)

    // Check if next row would overflow and add a new page if needed
    $currentY = $pdf->GetY();
    if ($currentY + 7 > $pdf->GetPageHeight() - 20) {
        $pdf->AddPage();
    }
}

  $pdf->Output('tutteLeMacchine.pdf', 'F'); // Generate and save the PDF as 'my_pdf.pdf'
  echo '<script>window.open("tutteLeMacchine.pdf", "_blank");</script>';
}

    ?>