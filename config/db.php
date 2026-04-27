<?php
if ($_SERVER['HTTP_HOST'] === 'localhost' || $_SERVER['HTTP_HOST'] === '127.0.0.1') {

    $host = "localhost";
    $user = "root";
    $pass = "";
    $db   = "smartphysics_db";

} else {

    $host = "sql208.infinityfree.com";
    $user = "if0_41769123";
    $pass = "vokEWPvZDo4ULS";
    $db   = "if0_41769123_smarttuition";

}

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$conn->set_charset('utf8mb4');
?>