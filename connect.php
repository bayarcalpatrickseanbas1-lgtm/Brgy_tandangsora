<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$db = "barangay_db";

$conn = new mysqli($servername, $username, $password, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$conn->set_charset("utf8mb4");

// Create database and tables if they don't exist
$sql = file_get_contents('sql.txt');
if ($sql !== false) {
    $statements = array_filter(array_map('trim', explode(';', $sql)));
    foreach ($statements as $statement) {
        if (!empty($statement)) {
            $conn->query($statement);
        }
    }
}
?>
