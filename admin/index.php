<?php
session_start();

// Ellenőrizzük, hogy a felhasználó be van-e jelentkezve
if (!isset($_SESSION['admin_logged_in'])) {
    // Ha nincs bejelentkezve, irányítsuk a bejelentkezési oldalra
    header('Location: login.php');
    exit;
} else {
    // Ha be van jelentkezve, irányítsuk az irányítópultra
    header('Location: dashboard.php');
    exit;
}
?>