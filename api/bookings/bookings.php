<?php
function validateDate($date) {
    $d = DateTime::createFromFormat('Y-m-d', $date);
    return $d && $d->format('Y-m-d') === $date;
}

function getRoomIdByType($room_type) {
    global $conn;
    $sql = "SELECT id FROM rooms WHERE room_type = '$room_type' AND status = 'available' LIMIT 1";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row['id'];
    }
    return null;
}

function createOrGetGuest($name, $email, $phone) {
    global $conn;
    $sql = "SELECT id FROM guests WHERE email = '$email' LIMIT 1";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row['id'];
    } else {
        $sql = "INSERT INTO guests (name, email, phone) VALUES ('$name', '$email', '$phone')";
        if ($conn->query($sql)) {
            return $conn->insert_id;
        } else {
            return null;
        }
    }
}
?>