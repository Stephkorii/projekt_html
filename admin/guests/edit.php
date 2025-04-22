<?php
session_start();

if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: ../login.php');
    exit;
}

require_once __DIR__ . '/../../api/config.php';

$guest_id = $_GET['id'];
$sql = "SELECT * FROM guests WHERE id = $guest_id";
$result = $conn->query($sql);
$guest = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    $sql = "UPDATE guests SET name = '$name', email = '$email', phone = '$phone' WHERE id = $guest_id";
    if ($conn->query($sql)) {
        header('Location: index.php');
        exit;
    } else {
        $error = "Hiba történt a vendég frissítése során.";
    }
}
?>

<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vendég szerkesztése</title>
    <link rel="stylesheet" href="../assets/css/admin.css">
</head>
<body>
    <header>
        <h1>Vendég szerkesztése</h1>
        <nav>
            <ul>
                <li><a href="index.php">Vissza a vendégekhez</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <?php if (isset($error)): ?>
            <p class="error"><?php echo $error; ?></p>
        <?php endif; ?>
        <form method="POST">
            <label for="name">Név:</label>
            <input type="text" id="name" name="name" value="<?php echo $guest['name']; ?>" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?php echo $guest['email']; ?>" required>

            <label for="phone">Telefonszám:</label>
            <input type="tel" id="phone" name="phone" value="<?php echo $guest['phone']; ?>" required>

            <button type="submit">Mentés</button>
        </form>
    </main>
</body>
</html>