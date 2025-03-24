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

    fetch('http://localhost/projekt_html/api/bookings/', {
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

// Üzenet küldése
function sendContactMessage() {
    const formData = {
        name: document.getElementById('contact-name').value,
        email: document.getElementById('contact-email').value,
        message: document.getElementById('message').value
    };

    fetch('./api/contact', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(formData)
    })
        .then(response => response.json())
        .then(data => {
            alert(data.message); // Sikeres üzenetküldés üzenet
            if (data.message === "Message sent successfully") {
                document.getElementById('contact-form').reset(); // Űrlap ürítése
            }
        })
        .catch(error => {
            console.error('Hiba:', error);
            alert('Hiba történt az üzenet küldése során.');
        });
}