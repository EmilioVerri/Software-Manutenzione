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
      }
    });
  } else {
    console.error('Table element with ID "scorribile" not found!');
  }
});


