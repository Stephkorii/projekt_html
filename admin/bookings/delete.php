<?php
session_start();

if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: ../login.php');
    exit;
}

require_once __DIR__ . '/../../api/config.php';

$booking_id = $_GET['id'];
$sql = "DELETE FROM bookings WHERE id = $booking_id";
if ($conn->query($sql)) {
    header('Location: index.php');
    exit;
} else {
    die("Hiba történt a foglalás törlése során.");
}
?>