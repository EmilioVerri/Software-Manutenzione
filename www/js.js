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



        //Zona sottostante
        const infor = document.getElementById('informazione');
        const visig = arrayValori[0];
        const vinom = arrayValori[1];
        infor.textContent = visig + " - " + vinom;



        //identificativoPerStorico
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
  checkbox.addEventListener('click', function() {
    submitButton.click(); // Trigger submit button click
  });
} else {
}



const cambiami = document.getElementById('cambiami');
const subitCambiami = document.getElementById('subitCambiami');

if(subitCambiami){
  cambiami.addEventListener('click', function() {
    subitCambiami.click(); // Trigger submit button click
  });
}else{
  
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

















