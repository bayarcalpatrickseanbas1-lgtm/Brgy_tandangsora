<?php
include("connect.php");
include("session_check.php");

if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($conn, $_GET['id']);
    $username = $_SESSION['username'];

    // Check if the request belongs to the logged-in user and is pending
    $check_sql = "SELECT id FROM requests WHERE id = '$id' AND username = '$username' AND status = 'Pending'";
    $check_result = mysqli_query($conn, $check_sql);

    if (mysqli_num_rows($check_result) > 0) {
        // Update request status to Canceled, set Payment/Service to Canceled
        $sql = "UPDATE requests SET status = 'Canceled', Payment = 'Canceled', Service = 'Canceled' WHERE id = '$id'";

        if (mysqli_query($conn, $sql)) {
            echo "<script type='text/javascript'>alert('Request Canceled!'); window.location.href = 'track.php';</script>";
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    } else {
        echo "<script type='text/javascript'>alert('Request not found or cannot be canceled.'); window.location.href = 'track.php';</script>";
    }
} else {
    header("Location: track.php");
    exit();
}
?>
