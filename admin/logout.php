<?php
session_start();

// Töröljük a sessiont
session_unset();
session_destroy();

// Átirányítjuk a felhasználót a bejelentkezési oldalra
header('Location: login.php');
exit;
?>