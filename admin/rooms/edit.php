<?php
session_start();

if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: ../login.php');
    exit;
}

require_once __DIR__ . '/../../api/config.php';

$room_id = $_GET['id'];
$sql = "SELECT * FROM rooms WHERE id = $room_id";
$result = $conn->query($sql);
$room = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $room_number = $_POST['room_number'];
    $room_type = $_POST['room_type'];
    $price = $_POST['price'];
    $capacity = $_POST['capacity'];
    $status = $_POST['status'];

    $sql = "UPDATE rooms SET room_number = '$room_number', room_type = '$room_type', price = '$price', capacity = '$capacity', status = '$status' WHERE id = $room_id";
    if ($conn->query($sql)) {
        header('Location: index.php');
        exit;
    } else {
        $error = "Hiba történt a szoba frissítése során.";
    }
}
?>

<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Szoba szerkesztése</title>
    <link rel="stylesheet" href="../assets/css/admin.css">
</head>
<body>
    <header>
        <h1>Szoba szerkesztése</h1>
        <nav>
            <ul>
                <li><a href="index.php">Vissza a szobákhoz</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <?php if (isset($error)): ?>
            <p class="error"><?php echo $error; ?></p>
        <?php endif; ?>
        <form method="POST">
            <label for="room_number">Szoba szám:</label>
            <input type="text" id="room_number" name="room_number" value="<?php echo $room['room_number']; ?>" required>

            <label for="room_type">Típus:</label>
            <input type="text" id="room_type" name="room_type" value="<?php echo $room['room_type']; ?>" required>

            <label for="price">Ár:</label>
            <input type="number" id="price" name="price" value="<?php echo $room['price_per_night']; ?>" required>

            <label for="capacity">Kapacitás:</label>
            <input type="number" id="capacity" name="capacity" value="<?php echo $room['capacity']; ?>" required>

            <label for="status">Státusz:</label>
            <select id="status" name="status" required>
                <option value="available" <?php echo $room['status'] === 'available' ? 'selected' : ''; ?>>Elérhető</option>
                <option value="occupied" <?php echo $room['status'] === 'occupied' ? 'selected' : ''; ?>>Foglalt</option>
                <option value="maintenance" <?php echo $room['status'] === 'maintenance' ? 'selected' : ''; ?>>Karbantartás</option>
            </select>

            <button type="submit">Mentés</button>
        </form>
    </main>
</body>
</html>