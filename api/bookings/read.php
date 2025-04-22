<?php
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/bookings.php';

$sql = "SELECT bookings.*, guests.name as guest_name, rooms.room_type 
        FROM bookings 
        JOIN guests ON bookings.guest_id = guests.id 
        JOIN rooms ON bookings.room_id = rooms.id";
$result = $conn->query($sql);

$bookings = [];
while ($row = $result->fetch_assoc()) {
    $bookings[] = $row;
}

echo json_encode($bookings);
?>