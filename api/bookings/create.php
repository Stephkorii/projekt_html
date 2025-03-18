<?php
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/bookings.php';

$data = json_decode(file_get_contents('php://input'), true);

if (json_last_error() !== JSON_ERROR_NONE) {
    http_response_code(400);
    echo json_encode(["message" => "Invalid JSON data"]);
    exit;
}

$check_in = $data['check_in'];
$check_out = $data['check_out'];
$room_type = $data['room_type'];
$guests = $data['guests'];
$name = $data['name'];
$email = $data['email'];
$phone = $data['phone'];

if (!validateDate($check_in) || !validateDate($check_out)) {
    http_response_code(400);
    echo json_encode(["message" => "Invalid date format"]);
    exit;
}

    $room_id = getRoomIdByType($room_type);
    if (!$room_id) {
        http_response_code(400);
        echo json_encode(["message" => "Invalid room type"]);
        exit;
    }

    $guest_id = createOrGetGuest($name, $email, $phone);
    if (!$guest_id) {
        http_response_code(500);
        echo json_encode(["message" => "Error creating guest"]);
        exit;
    }

$sql = "INSERT INTO bookings (guest_id, room_id, check_in, check_out, status) VALUES ('$guest_id', '$room_id', '$check_in', '$check_out', 'pending')";
if ($conn->query($sql)) {
    echo json_encode(["message" => "Booking created successfully"]);
} else {
    http_response_code(500);
    echo json_encode(["message" => "Error creating booking: " . $conn->error]);
}
?>