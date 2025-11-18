<?php
include("connect.php");

if(!isset($_SESSION['username']) || $_SESSION['usertype'] != 'admin') {
    header("Location: index2.php");
    exit();
}

if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($conn, $_GET['id']);

    // Delete request from requests table
    $sql = "DELETE FROM requests WHERE id = '$id'";

    if (mysqli_query($conn, $sql)) {
        echo "<script type='text/javascript'>alert('Request Deleted!'); window.location.href = 'admin-all-requests.php';</script>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
} else {
    header("Location: admin-all-requests.php");
    exit();
}
?>
