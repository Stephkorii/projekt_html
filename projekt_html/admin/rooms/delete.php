<?php
session_start();

if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: ../login.php');
    exit;
}

require_once __DIR__ . '/../../api/config.php';

$room_id = $_GET['id'];
$sql = "DELETE FROM rooms WHERE id = $room_id";
if ($conn->query($sql)) {
    header('Location: index.php');
    exit;
} else {
    die("Hiba történt a szoba törlése során.");
}
?>