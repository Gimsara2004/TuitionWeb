<?php
if ($_SERVER['HTTP_HOST'] === 'localhost' || $_SERVER['HTTP_HOST'] === '127.0.0.1') {

    $host = "localhost";
    $user = "root";
    $pass = "";
    $db   = "smartphysics_db";

} else {

    $host = "sql313.infinityfree.com";
    $user = "if0_41753756";
    $pass = "veqq2TXu9xQd";
    $db   = "if0_41753756_smartphysics";

}

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$conn->set_charset('utf8mb4');
?>