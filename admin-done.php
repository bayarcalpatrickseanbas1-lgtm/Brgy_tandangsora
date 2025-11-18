<?php
include("connect.php");

if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($conn, $_GET['id']);

    // Update request status to Completed, set Payment to Paid, Service to Received
    $sql = "UPDATE requests SET status = 'Completed', Payment = 'Paid', Service = 'Received' WHERE id = '$id'";

    if (mysqli_query($conn, $sql)) {
        echo "<script type='text/javascript'>alert('Request Completed!'); window.location.href = 'admin-all-requests.php';</script>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
} else {
    header("Location: admin-all-requests.php");
    exit();
}
?>
