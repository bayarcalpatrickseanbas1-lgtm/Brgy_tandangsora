<?php
include("connect.php");

if(!isset($_SESSION["username"])) {
    header("Location: index2.php");
    exit();
}

$username = $_SESSION["username"];

$sql = "SELECT * FROM login WHERE username = '$username'";
$result = mysqli_query($conn, $sql);

if(!$result || mysqli_num_rows($result) == 0) {
    session_unset();
    session_destroy();
    header("Location: index2.php");
    exit();
}

$user_data = mysqli_fetch_array($result, MYSQLI_ASSOC);
?>