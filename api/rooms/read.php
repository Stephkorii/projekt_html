<?php
require_once __DIR__ . '/../config.php';

$sql = "SELECT * FROM rooms";
$result = $conn->query($sql);

$rooms = [];
while ($row = $result->fetch_assoc()) {
    $rooms[] = $row;
}

echo json_encode($rooms);
?>