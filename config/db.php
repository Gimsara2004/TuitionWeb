<?php
// Auto-detect environment
if ($_SERVER['HTTP_HOST'] === 'localhost' || $_SERVER['HTTP_HOST'] === '127.0.0.1') {

    // ── LOCAL (XAMPP) ──────────────────────
    $host = "localhost";
    $user = "root";
    $pass = "";
    $db   = "smartphysics_db";

} else {

    // ── PRODUCTION ────────────────────────
    // Update these when you deploy to a live host
    $host = "your_host";
    $user = "your_db_user";
    $pass = "your_db_pass";
    $db   = "your_db_name";

}

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$conn->set_charset('utf8mb4');
?>
