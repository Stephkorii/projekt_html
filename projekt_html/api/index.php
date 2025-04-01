<?php
require_once __DIR__ . '/config.php';

header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type");

$request_method = $_SERVER['REQUEST_METHOD'];
$request_uri = $_SERVER['REQUEST_URI'];

// Végpontok kezelése
switch ($request_method) {
    case 'GET':
        if (preg_match('/\/api\/bookings$/', $request_uri)) {
            require __DIR__ . '/bookings/read.php';
        } elseif (preg_match('/\/api\/rooms$/', $request_uri)) {
            require __DIR__ . '/rooms/read.php';
        } elseif (preg_match('/\/api\/guests$/', $request_uri)) {
            require __DIR__ . '/guests/read.php';
        } else {
            http_response_code(404);
            echo json_encode(["message" => "Endpoint not found"]);
        }
        break;

    case 'POST':
        if (preg_match('/\/api\/bookings$/', $request_uri)) {
            require __DIR__ . '/bookings/create.php';
        } elseif (preg_match('/\/api\/guests$/', $request_uri)) {
            require __DIR__ . '/guests/create.php';
        } else {
            http_response_code(404);
            echo json_encode(["message" => "Endpoint not found"]);
        }
        break;

    default:
        http_response_code(405);
        echo json_encode(["message" => "Method not allowed"]);
        break;
}
?>