// Admin JavaScript kód
document.addEventListener('DOMContentLoaded', function () {
    // Példa: Figyeljük a táblázat sorok kattintását
    const rows = document.querySelectorAll('table tbody tr');
    rows.forEach(row => {
        row.addEventListener('click', () => {
            alert('Sor kiválasztva: ' + row.cells[0].innerText);
        });
    });
});