<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hotel_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$request_method = $_SERVER['REQUEST_METHOD'];

if ($request_method === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);

    if (json_last_error() !== JSON_ERROR_NONE) {
        http_response_code(400);
        echo json_encode(["message" => "Érvénytelen JSON adat"]);
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
        echo json_encode(["message" => "Érvénytelen dátum"]);
        exit;
    }

    $sql = "INSERT INTO bookings (check_in, check_out, room_type, guests, name, email, phone) VALUES ('$check_in', '$check_out', '$room_type', '$guests', '$name', '$email', '$phone')";
    if ($conn->query($sql)) {
        echo json_encode(["message" => "Foglalás sikeres"]);
    } else {
        http_response_code(500);
        echo json_encode(["message" => "Hiba történt a foglalás során: " . $conn->error]);
    }
}

function validateDate($date) {
    $d = DateTime::createFromFormat('Y-m-d', $date);
    return $d && $d->format('Y-m-d') === $date;
}

$conn->close();
?>