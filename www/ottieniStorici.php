<?php
if (isset($_GET['identificativo'])) {





    $identificativoEstratto = $_GET['identificativo'];
    $my_conn = new PDO('sqlite:manutentoriCopy.db');

  // Query per ottenere gli storici ordinati per data convertita in formato YYYY-MM-DD HH:MM:SS
  $queryDue = $my_conn->prepare("
  SELECT * FROM 'storici' 
  WHERE manutenzione = :identificativo 
  ORDER BY SUBSTR(data, 7, 4) || '-' || SUBSTR(data, 4, 2) || '-' || SUBSTR(data, 1, 2) || ' ' || SUBSTR(data, 12, 8) DESC
");
$queryDue->bindParam(':identificativo', $identificativoEstratto);
$queryDue->execute();

$risultato = $queryDue->fetchAll(PDO::FETCH_ASSOC);

foreach ($risultato as $estrazioneDue) {
  echo "
          <td id='storici' style='display:none'>{$estrazioneDue['id']}</td>
          <td id='storici' style='display:none'>{$estrazioneDue['data']}</td>
          <td id='storici' style='display:none'>{$estrazioneDue['esito']}</td>
          <td id='storici' style='display:none'>{$estrazioneDue['note']}</td>
          <td id='storici' style='display:none'>{$estrazioneDue['manutenzione']}</td>";
}

}
?>