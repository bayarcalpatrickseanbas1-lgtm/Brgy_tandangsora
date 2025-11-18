<?php
include("connect.php");

if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($conn, $_GET['id']);

    // Delete user from user table
    $sql = "DELETE FROM user WHERE id = '$id'";

    if (mysqli_query($conn, $sql)) {
        echo "<script type='text/javascript'>alert('User Deleted!'); window.location.href = 'admin-all-users.php';</script>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
} else {
    header("Location: admin-all-users.php");
    exit();
}
?>
