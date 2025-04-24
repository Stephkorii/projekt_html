<?php
session_start();

if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: ../login.php');
    exit;
}

require_once __DIR__ . '/../../api/config.php';

$sql = "SELECT * FROM rooms";
$result = $conn->query($sql);
$rooms = $result->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Szobák</title>
    <link rel="stylesheet" href="../assets/css/admin.css">
</head>
<body>
    <header>
        <h1>Szobák</h1>
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
                    <th>Szoba szám</th>
                    <th>Típus</th>
                    <th>Ár</th>
                    <th>Kapacitás</th>
                    <th>Státusz</th>
                    <th>Műveletek</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($rooms as $room): ?>
                    <tr>
                        <td><?php echo $room['room_number']; ?></td>
                        <td><?php echo $room['room_type']; ?></td>
                        <td><?php echo $room['price']; ?></td>
                        <td><?php echo $room['capacity']; ?></td>
                        <td><?php echo $room['status']; ?></td>
                        <td>
                            <a href="edit.php?id=<?php echo $room['id']; ?>">Szerkesztés</a>
                            <a href="delete.php?id=<?php echo $room['id']; ?>">Törlés</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </main>
</body>
</html> 