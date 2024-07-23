// Télécharger la liste en CSV
document.getElementById('download-csv').addEventListener('click', function () {
    let table = document.getElementById('users-table');
    let rows = table.querySelectorAll('tr');
    let csvContent = '';

    rows.forEach(function (row) {
        let cols = row.querySelectorAll('td, th');
        let rowData = Array.from(cols).map(col => col.innerText).join(',');
        csvContent += rowData + '\n';
    });

    let blob = new Blob([csvContent], { type: 'text/csv;charset=utf-8;' });
    let link = document.createElement('a');
    link.href = URL.createObjectURL(blob);
    link.download = 'users.csv';
    link.click();
});

// Télécharger la liste en PDF
document.getElementById('download-pdf').addEventListener('click', function () {
    const { jsPDF } = window.jspdf;
    const doc = new jsPDF();
    
    const table = document.getElementById('users-table');
    const headers = Array.from(table.querySelectorAll('thead tr th')).map(header => header.innerText);
    const rows = Array.from(table.querySelectorAll('tbody tr')).map(row => 
        Array.from(row.querySelectorAll('td')).map(cell => cell.innerText)
    );

    doc.autoTable({
        head: [headers],
        body: rows
    });

    doc.save('users.pdf');
});

function toggleHistorique() {
    var tableContainer = document.getElementById('table-container');
    if (tableContainer.style.display === "none") {
        tableContainer.style.display = "block";
    } else {
        tableContainer.style.display = "none";
    }
}