<?php
session_start();

if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: ../login.php');
    exit;
}

require_once __DIR__ . '/../../api/config.php';

$guest_id = $_GET['id'];

// 1. Töröljük a vendéghez tartozó foglalásokat
$sql = "DELETE FROM bookings WHERE guest_id = $guest_id";
if ($conn->query($sql)) {
    // 2. Töröljük a vendéget
    $sql = "DELETE FROM guests WHERE id = $guest_id";
    if ($conn->query($sql)) {
        header('Location: index.php');
        exit;
    } else {
        die("Hiba történt a vendég törlése során.");
    }
} else {
    die("Hiba történt a foglalások törlése során.");
}
?>