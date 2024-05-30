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





        //Creazione di un sotto array in cui mostra i valori estratti da php dei <td> che si trovano sotto al <tr> con id="storiciLista"
          //inizio AAAAAAAAAAAAAAAAAAAAAAAAAAAAAA 
         // Get all 'tr' elements with the ID "storiciLista"
const storicoRows = document.querySelectorAll('tr[id="storiciLista"]');

// Create an empty array to store all the 'td' value arrays
const storicoValuesArrays = [];

// Iterate through each 'tr' element
for (const storicoRow of storicoRows) {
  // Create an array for the 'td' values with ID "storici" of the current 'tr'
  const storicoTds = Array.from(storicoRow.querySelectorAll('td[id="storici"]'));  // Target td with ID "storici"
  
  // Extract text content from each 'td' and create a new array
  const storicoValues = storicoTds.map(td => td.textContent);  
  
  // Add the 'td' value array to the 'storicoValuesArrays'
  storicoValuesArrays.push(storicoValues);
}

// Assuming you have the 'arrayValori' containing all elements





const tableDaPopolare = document.querySelector('.daPopolare');
tableDaPopolare.innerHTML = '';
if (arrayValori.length > 8 && tableDaPopolare.children.length === 0) {

// Ignore the first 8 elements
const remainingData = arrayValori.slice(8);

// Create subarrays of 5 elements each
const subarrays = [];
for (let i = 0; i < remainingData.length; i += 5) {
  subarrays.push(remainingData.slice(i, i + 5));
}

// Get the table element with class "daPopolare"
const tableDaPopolare = document.querySelector('.daPopolare');

// Function to create and append a 'tr' with 'td' elements
function createTableRow(subarray) {
  // Skip the first and last element
  const valuesToInsert = subarray.slice(1, -1);

  // Create a new 'tr' element
  const newRow = document.createElement('tr');

  // Create and append 'td' elements for each value
  for (const value of valuesToInsert) {
    const newTd = document.createElement('td');
    newTd.textContent = value;
    newRow.appendChild(newTd);
  }

  // Append the new 'tr' to the 'tableDaPopolare'
  tableDaPopolare.appendChild(newRow);
}

// Populate the table with rows from subarrays
for (const subarray of subarrays) {
  createTableRow(subarray);
}


}
else{
    tableDaPopolare.innerHTML = '';
}

// FINEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEE













        // Ultima manutenzione
        const inputField = document.getElementById('ultimaManutenzione');
        const valoreInserire = arrayValori[5];
        inputField.value = valoreInserire;

        // Prossima Manutenzione
        const pM = document.getElementById('proxManutenzione');
        const vipm = arrayValori[6];
        pM.value = vipm;

        // Codice
        const codice = document.getElementById('codice');
        const vicodice = arrayValori[0];
        codice.value = vicodice;

        // Descrizione Attrezzatura
        const descattrz = document.getElementById('descattrz');
        const videscattrz = arrayValori[1];
        descattrz.value = videscattrz;

        // Reparto
        const reparto = document.getElementById('reparto');
        const vireparto = arrayValori[3];
        reparto.value = vireparto;

        // Periodo (radio buttons)
        const radioButtons = document.getElementsByName('checkbox-group');
        const valoreRadio = arrayValori[4];
        for (const radioButton of radioButtons) {
          if (radioButton.value === valoreRadio) {
            radioButton.checked = true;
          }
        }

        // Select (loop through options)
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

        // Zona sottostante
        const infor = document.getElementById('informazione');
        const visig = arrayValori[0];
        const vinom = arrayValori[1];
        infor.textContent = visig + " - " + vinom;

        // identificativoPerStorico
        const ide = document.getElementById('identificativoPerStorico');
        const viide = arrayValori[7];
        ide.value = viide;


      }
    });
  } else {
    console.error('Table element with ID "scorribile" not found!');
  }
});




//////////////////////////////////////////////////////////////////
//chiamata post sul checked del "visualizza solo manutenzioni in scadenza o scadute"
const checkbox = document.getElementById('myCheckbox');
const submitButton = document.getElementById('submitButton');

if (submitButton) {
  checkbox.addEventListener('click', function () {
    submitButton.click(); // Trigger submit button click
  });
} else {
}



const cambiami = document.getElementById('cambiami');
const subitCambiami = document.getElementById('subitCambiami');

if (subitCambiami) {
  cambiami.addEventListener('click', function () {
    subitCambiami.click(); // Trigger submit button click
  });
} else {

}






/////////////////////////////////////////////////////////////////////
// Al click sul campo input, inserisce la data di oggi
function insertDate(inputFieldId) {
  // Get the current date
  const today = new Date();
  const day = today.getDate().toString().padStart(2, '0');
  const month = (today.getMonth() + 1).toString().padStart(2, '0'); // Adjust for 0-based month indexing
  const year = today.getFullYear();

  // Format the date as dd/mm/yyyy
  const formattedDate = `${day}/${month}/${year}`;

  // Set the formatted date into the input field
  const inputField = document.getElementById(inputFieldId);
  if (inputField) {
    inputField.value = formattedDate;
  } else {
    console.error(`Cannot find input field with ID: ${inputFieldId}`);
  }
}

// Add an event listener for the click event on the input field
const inputFieldId = 'yourInputFieldId'; // Replace with the actual ID of your input field
const inputField = document.getElementById(inputFieldId);
if (inputField) {
  inputField.addEventListener('click', () => insertDate(inputFieldId));
} else {
  console.error(`Cannot find input field with ID: ${inputFieldId}`);
}




// Al secondo campo input , al click sul campo input, inserisce la data di oggi
function insertDate(dateDue) {
  // Get the current date
  const today = new Date();
  const day = today.getDate().toString().padStart(2, '0');
  const month = (today.getMonth() + 1).toString().padStart(2, '0'); // Adjust for 0-based month indexing
  const year = today.getFullYear();

  // Format the date as dd/mm/yyyy
  const formattedDate = `${day}/${month}/${year}`;

  // Set the formatted date into the input field
  const dateDu = document.getElementById(dateDue);
  if (dateDu) {
    dateDu.value = formattedDate;
  } else {
    console.error(`Cannot find input field with ID: ${dateDue}`);
  }
}

// Add an event listener for the click event on the input field
const dateDue = 'date'; // Replace with the actual ID of your input field
const dateDu = document.getElementById(dateDue);
if (dateDu) {
  dateDu.addEventListener('click', () => insertDate(dateDue));
} else {
  console.error(`Cannot find input field with ID: ${dateDue}`);
}

















