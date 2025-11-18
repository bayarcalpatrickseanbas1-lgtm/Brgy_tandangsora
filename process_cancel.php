<?php
include("connect.php");
include("session_check.php");

if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['request_id'])) {
    $request_id = mysqli_real_escape_string($conn, $_POST['request_id']);
    $username = $_SESSION['username'];

    // Check if the request belongs to the logged-in user and is pending
    $check_sql = "SELECT id FROM requests WHERE id = '$request_id' AND username = '$username' AND status = 'Pending'";
    $check_result = mysqli_query($conn, $check_sql);

    if(mysqli_num_rows($check_result) > 0) {
        // Update the status to Canceled
        $update_sql = "UPDATE requests SET status = 'Canceled' WHERE id = '$request_id'";
        if(mysqli_query($conn, $update_sql)) {
            echo "Request canceled successfully!";
        } else {
            echo "Error canceling request: " . mysqli_error($conn);
        }
    } else {
        echo "Request not found or cannot be canceled.";
    }
} else {
    echo "Invalid request.";
}
?>
