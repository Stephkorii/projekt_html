<?php
session_start();

if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: ../login.php');
    exit;
}

require_once __DIR__ . '/../../api/config.php';

$sql = "SELECT * FROM guests";
$result = $conn->query($sql);
$guests = $result->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vendégek</title>
    <link rel="stylesheet" href="../assets/css/admin.css">
</head>
<body>
    <header>
        <h1>Vendégek</h1>
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
                    <th>Név</th>
                    <th>Email</th>
                    <th>Telefonszám</th>
                    <th>Műveletek</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($guests as $guest): ?>
                    <tr>
                        <td><?php echo $guest['name']; ?></td>
                        <td><?php echo $guest['email']; ?></td>
                        <td><?php echo $guest['phone']; ?></td>
                        <td>
                            <a href="edit.php?id=<?php echo $guest['id']; ?>">Szerkesztés</a>
                            <a href="delete.php?id=<?php echo $guest['id']; ?>">Törlés</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </main>
</body>
</html>