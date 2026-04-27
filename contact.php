<?php
include 'config/db.php';
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name    = $conn->real_escape_string(trim($_POST['cname']   ?? ''));
    $email   = $conn->real_escape_string(trim($_POST['cemail']  ?? ''));
    $phone   = $conn->real_escape_string(trim($_POST['cphone']  ?? ''));
    $message = $conn->real_escape_string(trim($_POST['cmsg']    ?? ''));

    if (!$name) {
        echo json_encode(['status' => 'error', 'message' => 'Please enter your name.']);
        exit();
    }
    if (!$message) {
        echo json_encode(['status' => 'error', 'message' => 'Please enter your message.']);
        exit();
    }

    $sql = "INSERT INTO messages (name, email, phone, message)
            VALUES ('$name','$email','$phone','$message')";

    if ($conn->query($sql)) {
        echo json_encode([
            'status'  => 'success',
            'message' => "Thank you $name! Your message has been received. We'll reply within 24 hours."
        ]);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Something went wrong. Please try again.']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request.']);
}
?>