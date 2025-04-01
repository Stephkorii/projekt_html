<?php
session_start();

if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: ../login.php');
    exit;
}

require_once __DIR__ . '/../../api/config.php';

$message_id = $_GET['id'];
$sql = "DELETE FROM messages WHERE id = $message_id";
if ($conn->query($sql)) {
    header('Location: index.php');
    exit;
} else {
    die("Hiba történt az üzenet törlése során.");
}
?>