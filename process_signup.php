<?php
include("connect.php");

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstname = mysqli_real_escape_string($conn, $_POST["FirstName"]);
    $surname = mysqli_real_escape_string($conn, $_POST["Surname"]);
    $address = mysqli_real_escape_string($conn, $_POST["Address"]);
    $birthday = mysqli_real_escape_string($conn, $_POST["Birthday"]);
    $contact = mysqli_real_escape_string($conn, $_POST["ContactNumber"]);
    $email = mysqli_real_escape_string($conn, $_POST["Email"]);
    $username = mysqli_real_escape_string($conn, $_POST["Username"]);
    $password = mysqli_real_escape_string($conn, $_POST["Password"]);
    $confirm_password = mysqli_real_escape_string($conn, $_POST["ConfirmPassword"]);

    if(empty($firstname) || empty($surname) || empty($address) || empty($birthday) ||
       empty($contact) || empty($email) || empty($username) || empty($password) || empty($confirm_password)) {
        header("Location: signup.php?error=all_fields");
        exit();
    }

    if($password != $confirm_password) {
        header("Location: signup.php?error=passwords_mismatch");
        exit();
    }

    // Check if username already exists in user table
    $check_sql = "SELECT * FROM user WHERE Username = '$username'";
    $check_result = mysqli_query($conn, $check_sql);

    if(mysqli_num_rows($check_result) > 0) {
        header("Location: signup.php?error=username_exists");
        exit();
    }

    // Insert into user table with Status = 'Active'
    $insert_sql = "INSERT INTO user (FirstName, LastName, Email, Username, Password, Status, Address, Birthday, ContactNumber)
                   VALUES ('$firstname', '$surname', '$email', '$username', MD5('$password'), 'Active', '$address', '$birthday', '$contact')";

    if(mysqli_query($conn, $insert_sql)) {
        session_start();
        $_SESSION["username"] = $username;
        $_SESSION["usertype"] = "user";
        header("Location: residents-dashboard-page.php");
        exit();
    } else {
        header("Location: signup.php?error=db_error");
        exit();
    }
} else {
    header("Location: signup.php");
    exit();
}
?>
