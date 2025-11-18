<?php
include("connect.php");
include("session_check.php");

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_SESSION["username"];
    $email = mysqli_real_escape_string($conn, $_POST["email"]);
    $message = mysqli_real_escape_string($conn, $_POST["message"]);

    $sql = "INSERT INTO reports (username, email, message, created_at) 
            VALUES ('$username', '$email', '$message', NOW())";

    if(mysqli_query($conn, $sql)) {
        header("Location: report_success.php?");
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
        exit();
    }
} else {
    header("Location: help.php");
    exit();
}
?>