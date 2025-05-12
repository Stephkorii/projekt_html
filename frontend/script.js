document.addEventListener('DOMContentLoaded', function () {
    // Foglalási űrlap beküldése
    document.getElementById('booking-form').addEventListener('submit', function (event) {
        event.preventDefault();
        createBooking();
    });
});

// Foglalás létrehozása
function createBooking() {
    const formData = {
        check_in: document.getElementById('check-in').value,
        check_out: document.getElementById('check-out').value,
        room_type: document.getElementById('room-type').value,
        guests: document.getElementById('guests').value,
        name: document.getElementById('name').value,
        email: document.getElementById('email').value,
        phone: document.getElementById('phone').value
    };

    fetch('http://localhost/projekt_html/api/bookings/create.php', {
    method: 'POST',
    headers: {
        'Content-Type': 'application/json'
    },
    body: JSON.stringify(formData)
})

        .then(response => {
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            return response.json();
        })
        .then(data => {
            alert(data.message); // Sikeres foglalás üzenet
            if (data.message === "Booking created successfully") {
                document.getElementById('booking-form').reset(); // Űrlap ürítése
            }
        })
        .catch(error => {
            console.error('Hiba:', error);
            alert('Hiba történt a foglalás során: ' + error.message);
        });
}


