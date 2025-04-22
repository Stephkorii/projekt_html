<?php
require_once __DIR__ . '/../config.php';

$data = json_decode(file_get_contents('php://input'), true);

if (json_last_error() !== JSON_ERROR_NONE) {
    http_response_code(400);
    echo json_encode(["message" => "Invalid JSON data"]);
    exit;
}

$name = $data['name'];
$email = $data['email'];
$phone = $data['phone'];

$sql = "INSERT INTO guests (name, email, phone) VALUES ('$name', '$email', '$phone')";
if ($conn->query($sql)) {
    echo json_encode(["message" => "Guest created successfully"]);
} else {
    http_response_code(500);
    echo json_encode(["message" => "Error creating guest: " . $conn->error]);
}
?>