<?php
session_start();

if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: login.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Irányítópult</title>
    <link rel="stylesheet" href="assets/css/admin.css">
</head>
<body>
    <header>
        <h1>Admin Irányítópult</h1>
        <nav>
            <ul>
                <li><a href="bookings/">Foglalások</a></li>
                <li><a href="guests/">Vendégek</a></li>
                <li><a href="rooms/">Szobák</a></li>
                <li><a href="logout.php">Kijelentkezés</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <section>
            <h2>Üdvözöljük az admin felületen!</h2>
            <p>Itt kezelheti a foglalásokat, vendégeket, szobákat és üzeneteket.</p>
        </section>
    </main>
</body>
</html>