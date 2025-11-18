<?php
include("connect.php");
include("session_check.php");

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_SESSION["username"];
    $lastname = mysqli_real_escape_string($conn, $_POST["lastName"]);
    $firstname = mysqli_real_escape_string($conn, $_POST["firstName"]);
    $middlename = mysqli_real_escape_string($conn, $_POST["middleName"]);
    $gender = mysqli_real_escape_string($conn, $_POST["gender"]);
    $age = mysqli_real_escape_string($conn, $_POST["age"]);
    $residency = mysqli_real_escape_string($conn, $_POST["residency"]);
    $address = mysqli_real_escape_string($conn, $_POST["address"]);
    $contact = mysqli_real_escape_string($conn, $_POST["contact"]);
    $email = mysqli_real_escape_string($conn, $_POST["email"]);
    $idtype = mysqli_real_escape_string($conn, $_POST["idType"]);
    $doctype = mysqli_real_escape_string($conn, $_POST["documentType"]);
    $purpose = mysqli_real_escape_string($conn, $_POST["purpose"]);

    $reference_number = "REF" . strtoupper(bin2hex(random_bytes(4)));

    // Handle file uploads
    $front_id_path = "";
    $back_id_path = "";

    if(isset($_FILES['frontID']) && $_FILES['frontID']['error'] == 0) {
        $front_id_path = 'uploads/' . time() . '_front_' . basename($_FILES['frontID']['name']);
        move_uploaded_file($_FILES['frontID']['tmp_name'], $front_id_path);
    }

    if(isset($_FILES['backID']) && $_FILES['backID']['error'] == 0) {
        $back_id_path = 'uploads/' . time() . '_back_' . basename($_FILES['backID']['name']);
        move_uploaded_file($_FILES['backID']['tmp_name'], $back_id_path);
    }

    $sql = "INSERT INTO requests (username, reference_number, lastname, firstname, middlename, gender, age, residency, address, contact, email, id_type, document_type, purpose, status, front_id_path, back_id_path, created_at)
            VALUES ('$username', '$reference_number', '$lastname', '$firstname', '$middlename', '$gender', '$age', '$residency', '$address', '$contact', '$email', '$idtype', '$doctype', '$purpose', 'Pending', '$front_id_path', '$back_id_path', NOW())";

    if(mysqli_query($conn, $sql)) {
        header("Location: request_success.php?reference=$reference_number");
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
        exit();
    }
} else {
    header("Location: request.php");
    exit();
}
?>