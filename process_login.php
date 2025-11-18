<?php
include("connect.php");

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($conn, $_POST["username"]);
    $password = mysqli_real_escape_string($conn, $_POST["password"]);

    // Check login table first (unified authentication)
    $login_sql = "SELECT * FROM login WHERE username = '$username' AND password = MD5('$password')";
    $login_result = mysqli_query($conn, $login_sql);

    if(mysqli_num_rows($login_result) > 0) {
        $row = mysqli_fetch_assoc($login_result);
        $_SESSION["username"] = $username;
        $_SESSION["usertype"] = $row["usertype"];
        if($row["usertype"] == "admin") {
            header("Location: admin-dashboard.php");
        } else {
            header("Location: residents-dashboard-page.php");
        }
        exit();
    }

    // Fallback to legacy admin table
    $admin_sql = "SELECT * FROM admin WHERE Username = '$username' AND Password = '$password'";
    $admin_result = mysqli_query($conn, $admin_sql);

    if(mysqli_num_rows($admin_result) > 0) {
        $_SESSION["username"] = $username;
        $_SESSION["usertype"] = "admin";
        header("Location: admin-dashboard.php");
        exit();
    }

    // Check user table
    $user_sql = "SELECT * FROM user WHERE Username = '$username' AND Password = MD5('$password') AND Status = 'Active'";
    $user_result = mysqli_query($conn, $user_sql);

    if(mysqli_num_rows($user_result) > 0) {
        $_SESSION["username"] = $username;
        $_SESSION["usertype"] = "user";
        header("Location: residents-dashboard-page.php");
        exit();
    }

    // If no match found
    header("Location: login.php?error=invalid");
    exit();
} else {
    header("Location: login.php");
    exit();
}
?>
