<?php

include ('./pdf/fpdf.php');


///////////////////////////////////////////////// INIZIO RIEPILOGO MENSILE //////////////////////////////////////////////
function riepilogoMensile($periodoDaEstrarre)
{

  $pdf = new FPDF(); // Create a new FPDF instance
  $pdf->SetMargins(40, 30); // Set left, top margins (in mm)
  $pdf->SetTitle('Riepilogo Mensile delle Manutenzioni'); // Set PDF title
  $pdf->SetAuthor('Emilio Verri'); // Set PDF author
  $pdf->AddPage(); // Add a new page to the PDF
  $pdf->SetFont('Arial', 'B', 14); // Set bold Arial font size 16
  $pdf->Cell(0, 7, 'RIEPILOGO MENSILE ', 1, 1, 'C'); // Add title cell
  $pdf->SetFont('Arial', '', 12); // Set regular Arial font size 12

  $pdf = new FPDF(); // Create a new FPDF instance

  // Set margins and document properties (optional)
  $pdf->SetMargins(20, 15); // Set left, top margins (in mm)

  $pdf->SetAuthor('Emilio Verri'); // Set PDF author


  $pdf->AddPage(); // Add a new page to the PDF

  // Define table headers and data (replace with your actual data)
  $headers = array('Sigla', 'Nome', 'Cat.', 'Reparto', 'Manutenzione', 'Data');




  $my_conn = new PDO('sqlite:manutentori.db');
  $secondquery = $my_conn->prepare("SELECT * FROM 'storici'");
  $secondquery->execute();


  $data = array(
  );
  $countManutenzioni=0;
  foreach ($secondquery as $row) {

    $dataMese = $row['data'];

    $meseInput = $periodoDaEstrarre;
    $stessoMese = stessoMese($dataMese, $meseInput);
    if ($stessoMese == "ok") {


      $identificativo = $row['manutenzione'];
      $my_conn = new PDO('sqlite:manutentori.db');
      $firstquery = $my_conn->prepare("SELECT * FROM 'manutenzioni' WHERE identificativo='{$identificativo}'");
      $firstquery->execute();
      
      foreach ($firstquery as $raw) {
        $info = array($raw['Sigla'], $raw['Nome'], $raw['Cat'], $raw['Reparto'], $raw['Manutenzione'], $dataMese);
        array_push($data, $info);
        $countManutenzioni++;
      }


    } else {

    }

  }

  // Set font and cell width for headers
  $pdf->SetFont('Arial', 'B', 12); // Set bold Arial font size 12
  $cellWidth = $pdf->GetPageWidth() - 22; // Adjust margin as needed
  $cellWidth = $cellWidth / count($headers);



  $pdf->Cell(0, 7, 'RIEPILOGO MENSILE ', 1, 1, 'C'); // Add title cell
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
    $pdf->Cell($cellWidth, 7, $row[5], 1, 1, 'L'); // Notes (wrapping enabled)

    // Check if next row would overflow and add a new page if needed
    $currentY = $pdf->GetY();
    if ($currentY + 7 > $pdf->GetPageHeight() - 20) {
      $pdf->AddPage();
    }
  }



  // Set footer position (adjust Y coordinate as needed)
  $footerY = $pdf->GetPageHeight() - 20;
  $pdf->SetY($footerY);
  $stampa="Totale manutenzioni:"." ".$countManutenzioni;
  // Set font and alignment for footer text
  $pdf->SetFont('Arial', 'B', 10); // Bold Arial font size 10
  $pdf->Cell(0, 7,$stampa, 0, 1, 'C'); // Footer cell with centered alignment

  $pdf->SetTitle('Riepilogo Mensile delle Manutenzioni'); // Set PDF title


  $pdf->Output('riepilogoMensile.pdf', 'F'); // Generate and save the PDF as 'my_pdf.pdf'
  echo '<script>window.open("riepilogoMensile.pdf", "_blank");</script>';
}

/////////////////////////////////////////////// FINE RIEPILOGO MENSILE //////////////////////////////////////////////////
















/////////////////////////////////INIZIO FUNZIONE TUTTE LE MACCHINE PDF /////////////////////////////////////
function tutteLeMacchinePDF()
{
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

  $pdf->SetAuthor('Emilio Verri'); // Set PDF author


  $pdf->AddPage(); // Add a new page to the PDF

  // Define table headers and data (replace with your actual data)
  $headers = array('Sigla', 'Nome', 'Cat.', 'Reparto', 'Manutenzione', 'Ultima Man.', 'Prox Man.');





  $my_conn = new PDO('sqlite:manutentori.db');
  $secondquery = $my_conn->prepare("SELECT * FROM 'manutenzioni'");
  $secondquery->execute();


  $data = array(
  );

  foreach ($secondquery as $row) {
    $info = array($row['Sigla'], $row['Nome'], $row['Cat'], $row['Reparto'], $row['Manutenzione'], $row['UltimaMan'], $row['ProxMan']);
    array_push($data, $info);
  }




  // Set font and cell width for headers
  $pdf->SetFont('Arial', 'B', 12); // Set bold Arial font size 12
  $cellWidth = $pdf->GetPageWidth() - 22; // Adjust margin as needed
  $cellWidth = $cellWidth / count($headers);



  $pdf->Cell(0, 7, 'ELENCO ATTREZZATURE E IMPIANTI ', 1, 1, 'C'); // Add title cell
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

  $pdf->SetTitle('Tutte le Macchine'); // Set PDF title


  $pdf->Output('tutteLeMacchine.pdf', 'F'); // Generate and save the PDF as 'my_pdf.pdf'
  echo '<script>window.open("tutteLeMacchine.pdf", "_blank");</script>';
}

/////////////////////////////////FINE FUNZIONE TUTTE LE MACCHINE PDF /////////////////////////////////////







/////////////////////////////////INIZIO FUNZIONE STORICO MACCHINA PDF /////////////////////////////////////


function storicoMacchinaPDF($identificativo, $codice)
{
  $pdf = new FPDF(); // Create a new FPDF instance
  $pdf->SetMargins(40, 30); // Set left, top margins (in mm)
  $pdf->SetTitle('Storico Macchina'); // Set PDF title
  $pdf->SetAuthor('Emilio Verri'); // Set PDF author
  $pdf->AddPage(); // Add a new page to the PDF
  $pdf->SetFont('Arial', 'B', 14); // Set bold Arial font size 16
  $pdf->Cell(0, 7, 'STORICO MACCHINA ', 1, 1, 'C'); // Add title cell
  $pdf->SetFont('Arial', '', 12); // Set regular Arial font size 12

  $pdf = new FPDF(); // Create a new FPDF instance

  // Set margins and document properties (optional)
  $pdf->SetMargins(20, 15); // Set left, top margins (in mm)

  $pdf->SetAuthor('Emilio Verri'); // Set PDF author


  $pdf->AddPage(); // Add a new page to the PDF

  // Define table headers and data (replace with your actual data)
  $headers = array('Codice', 'Data', 'Esito', 'Note');





  $my_conn = new PDO('sqlite:manutentori.db');
  $secondquery = $my_conn->prepare("SELECT * FROM 'storici' WHERE manutenzione='{$identificativo}'");
  $secondquery->execute();


  $data = array(
  );

  foreach ($secondquery as $row) {
    $info = array($codice, $row['data'], $row['esito'], $row['note']);
    array_push($data, $info);
  }




  // Set font and cell width for headers
  $pdf->SetFont('Arial', 'B', 12); // Set bold Arial font size 12
  $cellWidth = $pdf->GetPageWidth() - 22; // Adjust margin as needed
  $cellWidth = $cellWidth / count($headers);



  $pdf->Cell(0, 7, 'STORICO MACCHINA', 1, 1, 'C'); // Add title cell
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
    $pdf->Cell($cellWidth, 7, $row[3], 1, 1, 'L'); // Notes (wrapping enabled)

    // Check if next row would overflow and add a new page if needed
    $currentY = $pdf->GetY();
    if ($currentY + 7 > $pdf->GetPageHeight() - 20) {
      $pdf->AddPage();
    }
  }

  $pdf->SetTitle('Storico Macchina'); // Set PDF title


  $pdf->Output('storicoMacchina.pdf', 'F'); // Generate and save the PDF as 'my_pdf.pdf'
  echo '<script>window.open("storicoMacchina.pdf", "_blank");</script>';


}

////////////////////////////////// FINE STORICO MACCHINA PDF //////////////////////////////////////



///////////////////////////////// INIZIO MACCHINE EFFETTUATE IN DATA //////////////////////////////


function macchineEffettuateInData($dataInput)
{
  $pdf = new FPDF(); // Create a new FPDF instance
  $pdf->SetMargins(40, 30); // Set left, top margins (in mm)
  $pdf->SetTitle('Macchine Effettuate in Data'); // Set PDF title
  $pdf->SetAuthor('Emilio Verri'); // Set PDF author
  $pdf->AddPage(); // Add a new page to the PDF
  $pdf->SetFont('Arial', 'B', 14); // Set bold Arial font size 16
  $pdf->Cell(0, 7, 'MACCHINE EFFETTUATE IN DATA', 1, 1, 'C'); // Add title cell
  $pdf->SetFont('Arial', '', 12); // Set regular Arial font size 12

  $pdf = new FPDF(); // Create a new FPDF instance

  // Set margins and document properties (optional)
  $pdf->SetMargins(20, 15); // Set left, top margins (in mm)

  $pdf->SetAuthor('Emilio Verri'); // Set PDF author


  $pdf->AddPage(); // Add a new page to the PDF

  // Define table headers and data (replace with your actual data)
  $headers = array('Data', 'Sigla', 'Nome');





  $my_conn = new PDO('sqlite:manutentori.db');
  $secondquery = $my_conn->prepare("SELECT * FROM 'storici'");
  $secondquery->execute();




  $data = array(
  );

  foreach ($secondquery as $row) {

    $my_conn = new PDO('sqlite:manutentori.db');
    if ($dataInput == $row['data']) {
      $insidequery = $my_conn->prepare("SELECT * FROM 'manutenzioni' WHERE identificativo='{$row['manutenzione']}'");
      $insidequery->execute();
      $info = array($row['data']);

      //print_r($info);

      $identificativo = $row['manutenzione'];
      //$info=array($row['Sigla'], $row['Nome'], $row['Cat'], $row['Reparto'], $row['Manutenzione']);
      foreach ($insidequery as $select) {
        if ($identificativo == $select['identificativo']) {
          $Sigla = $select['Sigla'];
          array_push($info, $Sigla);
          $Nome = $select['Nome'];
          array_push($info, $Nome);
        }
        //$add=$select['data'];
        //print_r($add);
        //array_push($info,$add);

        array_push($data, $info);
        //print_r($add);
      }
    }


  }





  // Set font and cell width for headers
  $pdf->SetFont('Arial', 'B', 12); // Set bold Arial font size 12
  $cellWidth = $pdf->GetPageWidth() - 22; // Adjust margin as needed
  $cellWidth = $cellWidth / count($headers);



  $pdf->Cell(0, 7, 'MACCHINE EFFETTUATE IN DATA', 1, 1, 'C'); // Add title cell
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
    $pdf->Cell($cellWidth, 7, $row[2], 1, 1, 'L'); // Notes (wrapping enabled)

    // Check if next row would overflow and add a new page if needed
    $currentY = $pdf->GetY();
    if ($currentY + 7 > $pdf->GetPageHeight() - 20) {
      $pdf->AddPage();
    }
  }

  $pdf->SetTitle('Macchine Effettuate in Data'); // Set PDF title


  $pdf->Output('macchineEffettuateInData.pdf', 'F'); // Generate and save the PDF as 'my_pdf.pdf'
  echo '<script>window.open("macchineEffettuateInData.pdf", "_blank");</script>';

}

///////////////////////////////// FINE MACCHINE EFFETTUATE IN DATA //////////////////////////////























///////////////////////////////// INIZIO MACCHINE IN PROGRAMMA PER DATA //////////////////////////////
function macchineInProgrammaPerData($dataInputProg)
{
  $pdf = new FPDF(); // Create a new FPDF instance
  $pdf->SetMargins(40, 30); // Set left, top margins (in mm)
  $pdf->SetTitle('Macchine in Programma per Data'); // Set PDF title
  $pdf->SetAuthor('Emilio Verri'); // Set PDF author
  $pdf->AddPage(); // Add a new page to the PDF
  $pdf->SetFont('Arial', 'B', 14); // Set bold Arial font size 16
  $pdf->Cell(0, 7, 'MACCHINE IN PROGRAMMA PER DATA', 1, 1, 'C'); // Add title cell
  $pdf->SetFont('Arial', '', 12); // Set regular Arial font size 12

  $pdf = new FPDF(); // Create a new FPDF instance

  // Set margins and document properties (optional)
  $pdf->SetMargins(20, 15); // Set left, top margins (in mm)

  $pdf->SetAuthor('Emilio Verri'); // Set PDF author


  $pdf->AddPage(); // Add a new page to the PDF

  // Define table headers and data (replace with your actual data)
  $headers = array('Sigla', 'Nome', 'Cat.', 'Reparto', 'Manutenzione', 'Ultima Man.', 'Prox Man.');





  $my_conn = new PDO('sqlite:manutentori.db');
  $secondquery = $my_conn->prepare("SELECT * FROM 'manutenzioni'");
  $secondquery->execute();


  $data = array(
  );

  foreach ($secondquery as $row) {
    if ($row['ProxMan'] == $dataInputProg) {
      $info = array($row['Sigla'], $row['Nome'], $row['Cat'], $row['Reparto'], $row['Manutenzione'], $row['UltimaMan'], $row['ProxMan']);
      array_push($data, $info);
    }
  }




  // Set font and cell width for headers
  $pdf->SetFont('Arial', 'B', 12); // Set bold Arial font size 12
  $cellWidth = $pdf->GetPageWidth() - 22; // Adjust margin as needed
  $cellWidth = $cellWidth / count($headers);



  $pdf->Cell(0, 7, 'MACCHINE IN PROGRAMMA PER DATA ', 1, 1, 'C'); // Add title cell
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

  $pdf->SetTitle('Macchine in Programma per data'); // Set PDF title


  $pdf->Output('macchineInProgrammaPerData.pdf', 'F'); // Generate and save the PDF as 'my_pdf.pdf'
  echo '<script>window.open("macchineInProgrammaPerData.pdf", "_blank");</script>';
}






///////////////////////////////// FINE MACCHINE IN PROGRAMMA PER DATA //////////////////////////////
?>