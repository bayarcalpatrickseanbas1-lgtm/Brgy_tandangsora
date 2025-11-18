<?php
include("connect.php");

if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($conn, $_GET['id']);

    // Update request status to Approved
    $sql = "UPDATE requests SET status = 'Approved' WHERE id = '$id'";

    if (mysqli_query($conn, $sql)) {
        echo "<script type='text/javascript'>alert('Request Approved!'); window.location.href = 'admin-all-requests.php';</script>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
} else {
    header("Location: admin-all-requests.php");
    exit();
}
?>
