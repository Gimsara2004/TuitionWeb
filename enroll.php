<?php
include 'config/db.php';
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name    = $conn->real_escape_string(trim($_POST['sname']   ?? ''));
    $grade   = $conn->real_escape_string(trim($_POST['grade']   ?? ''));
    $subject = $conn->real_escape_string(trim($_POST['subject'] ?? ''));
    $batch   = $conn->real_escape_string(trim($_POST['batch']   ?? ''));
    $pname   = $conn->real_escape_string(trim($_POST['pname']   ?? ''));
    $phone   = $conn->real_escape_string(trim($_POST['phone']   ?? ''));
    $msg     = $conn->real_escape_string(trim($_POST['msg']     ?? ''));

    if (!$name) {
        echo json_encode(['status' => 'error', 'message' => "Please enter the student's full name."]);
        exit();
    }
    if (!$subject) {
        echo json_encode(['status' => 'error', 'message' => 'Please select a subject/class type.']);
        exit();
    }
    if (!$phone) {
        echo json_encode(['status' => 'error', 'message' => 'Please enter a contact number.']);
        exit();
    }

    $sql = "INSERT INTO enrollments (name, grade, subject, batch, pname, phone, message)
            VALUES ('$name','$grade','$subject','$batch','$pname','$phone','$msg')";

    if ($conn->query($sql)) {
        echo json_encode([
            'status'  => 'success',
            'message' => "Thank you $name! Your enrollment request has been received. We'll contact you within 24 hours to confirm your spot."
        ]);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Something went wrong. Please try again.']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request.']);
}
?>
