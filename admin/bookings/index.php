<?php
session_start();

if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: ../login.php');
    exit;
}

require_once __DIR__ . '/../../api/config.php';

$sql = "SELECT bookings.*, guests.name as guest_name, rooms.room_type 
        FROM bookings 
        JOIN guests ON bookings.guest_id = guests.id 
        JOIN rooms ON bookings.room_id = rooms.id";
$result = $conn->query($sql);
$bookings = $result->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Foglalások</title>
    <link rel="stylesheet" href="../assets/css/admin.css">
</head>
<body>
    <header>
        <h1>Foglalások</h1>
        <nav>
            <ul>
                <li><a href="../dashboard.php">Vissza az irányítópulthoz</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <table>
            <thead>
                <tr>
                    <th>Vendég</th>
                    <th>Szoba</th>
                    <th>Érkezés</th>
                    <th>Távozás</th>
                    <th>Státusz</th>
                    <th>Műveletek</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($bookings as $booking): ?>
                    <tr>
                        <td><?php echo $booking['guest_name']; ?></td>
                        <td><?php echo $booking['room_type']; ?></td>
                        <td><?php echo $booking['check_in']; ?></td>
                        <td><?php echo $booking['check_out']; ?></td>
                        <td><?php echo $booking['status']; ?></td>
                        <td>
                            <a href="edit.php?id=<?php echo $booking['id']; ?>">Szerkesztés</a>
                            <a href="delete.php?id=<?php echo $booking['id']; ?>">Törlés</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </main>
</body>
</html>