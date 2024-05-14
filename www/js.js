document.addEventListener('DOMContentLoaded', function () {
  const table = document.getElementById('scorribile');
  let selectedRow = null; // Keep track of the currently selected row

  if (table) {
    table.addEventListener('click', function (event) {
      if (event.target.tagName === 'TD') {
        // Select the entire row (TR) containing the clicked TD
        const row = event.target.parentNode;

        // Deselect the previously selected row (if any)
        if (selectedRow) {
          selectedRow.classList.remove('selected');
        }

        // Select the clicked row
        row.classList.add('selected');
        selectedRow = row;

        // Scroll to the selected row if it's below the visible area
        if (row.offsetTop > window.innerHeight) {
          row.scrollIntoView({ behavior: 'smooth' });
        }

        // Log values of all td within the selected row
        const selectedRowTds = row.querySelectorAll('td');
        console.log('Valori riga selezionata: ', Array.from(selectedRowTds).map(td => td.textContent));
        const arrayValori = Array.from(selectedRowTds).map(td => td.textContent);

        //ultimaManutenzione
        const inputField = document.getElementById('ultimaManutenzione');
        const valoreInserire = arrayValori[5];
        inputField.value = valoreInserire;

        //Prossima Manutenzione
        const pM = document.getElementById('proxManutenzione');
        const vipm = arrayValori[6];
        pM.value = vipm;


        //Codice
        const codice = document.getElementById('codice');
        const vicodice = arrayValori[0];
        codice.value = vicodice;


        //Descrizione Attrezzatura
        const descattrz = document.getElementById('descattrz');
        const videscattrz = arrayValori[1];
        descattrz.value = videscattrz;

        //Reparto
        const reparto = document.getElementById('reparto');
        const vireparto = arrayValori[3];
        reparto.value = vireparto;



        //stessa cosa per il periodo
        const radioButtons = document.getElementsByName('checkbox-group');
        const valoreRadio = arrayValori[4];
        for (const radioButton of radioButtons) {
          if (radioButton.value === valoreRadio) {
            radioButton.checked = true;
          }
        }

        //stessa cosa per la select



        //stessa cosa però per la select
        const selectMenu = document.getElementById('idMenuSelect');
        const valoreSelezione = arrayValori[2];
        for (const option of selectMenu.options) {
          if (arrayValori.includes(option.value)) {
            option.selected = true;
          }
        }

        const identificativo = document.getElementById('identificativo2');
        const viidentificativo = arrayValori[7];
        identificativo.value = viidentificativo;


      }
    });
  } else {
    console.error('Table element with ID "scorribile" not found!');
  }
});




//////////////////////////////////////////////////////////////////
//chiamata post sul checked del "visualizza solo manutenzioni in scadenza o scadute"
const checkbox = document.getElementById('myCheckbox');
const isCheckedField = document.getElementById('isChecked');
checkbox.addEventListener('change', handleCheckboxChange);
function handleCheckboxChange() {
  const isChecked = checkbox.checked;
  isCheckedField.value = isChecked ? 1 : 0;

  if (isChecked) {
    makePostRequestOnChecked();
  } else {
    makePostRequestOnUnchecked();
  }
}









//se checcato
function makePostRequestOnChecked() {
  // Inside makePostRequestOnChecked and makePostRequestOnUnchecked functions
  const db = new SQL.Database(); // Create SQLite database instance
  db.open('manutentori.db'); // Open the database file

  // Execute the query and handle the response
  db.exec('SELECT * FROM manutenzioni', function (results) {
    console.log('Query results:', results); // Process or display query results
  });

  db.close(); // Close the database connection

}


//se NON checcato
function makePostRequestOnUnchecked() {
  // Inside makePostRequestOnChecked and makePostRequestOnUnchecked functions
  const db = new SQL.Database(); // Create SQLite database instance
  db.open('manutentori.db'); // Open the database file

  // Execute the query and handle the response
  db.exec('SELECT * FROM manutenzioni', function (results) {
    console.log('Query results:', results); // Process or display query results
  });

  db.close(); // Close the database connection

}
//fine controllo checked 






















