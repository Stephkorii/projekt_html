<?php
session_start();

if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: ../login.php');
    exit;
}

require_once __DIR__ . '/../../api/config.php';

$booking_id = $_GET['id'];
$sql = "SELECT bookings.*, guests.name as guest_name, rooms.room_type 
        FROM bookings 
        JOIN guests ON bookings.guest_id = guests.id 
        JOIN rooms ON bookings.room_id = rooms.id 
        WHERE bookings.id = $booking_id";
$result = $conn->query($sql);
$booking = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $status = $_POST['status'];
    $sql = "UPDATE bookings SET status = '$status' WHERE id = $booking_id";
    if ($conn->query($sql)) {
        header('Location: index.php');
        exit;
    } else {
        $error = "Hiba történt a foglalás frissítése során.";
    }
}
?>

<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Foglalás szerkesztése</title>
    <link rel="stylesheet" href="../assets/css/admin.css">
</head>
<body>
    <header>
        <h1>Foglalás szerkesztése</h1>
        <nav>
            <ul>
                <li><a href="index.php">Vissza a foglalásokhoz</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <?php if (isset($error)): ?>
            <p class="error"><?php echo $error; ?></p>
        <?php endif; ?>
        <form method="POST">
            <label for="status">Státusz:</label>
            <select id="status" name="status" required>
                <option value="pending" <?php echo $booking['status'] === 'pending' ? 'selected' : ''; ?>>Függőben</option>
                <option value="confirmed" <?php echo $booking['status'] === 'confirmed' ? 'selected' : ''; ?>>Megerősítve</option>
                <option value="cancelled" <?php echo $booking['status'] === 'cancelled' ? 'selected' : ''; ?>>Törölve</option>
                <option value="completed" <?php echo $booking['status'] === 'completed' ? 'selected' : ''; ?>>Befejezve</option>
            </select>

            <button type="submit">Mentés</button>
        </form>
    </main>
</body>
</html>