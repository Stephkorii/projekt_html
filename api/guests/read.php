<?php
require_once __DIR__ . '/../config.php';

$sql = "SELECT * FROM guests";
$result = $conn->query($sql);

$guests = [];
while ($row = $result->fetch_assoc()) {
    $guests[] = $row;
}

echo json_encode($guests);
?>