<?php include('session_check.php'); ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile | Barangay Tandang Sora</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
      :root {
        --sidebar-color: #01497c;
        --sidebar-hover: #013a63;
        --accent-text: #1e2b6f;
      }
      * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: "Montserrat", sans-serif;
      }
      body {
        display: flex;
        height: 100vh;
        background: linear-gradient(to bottom right, #f9fcff, #eef6fb);
        overflow: hidden;
      }
      .sidebar {
        width: 260px;
        background-color: var(--sidebar-color);
        color: white;
        display: flex;
        flex-direction: column;
        align-items: center;
        padding-top: 30px;
        box-shadow: 4px 0 15px rgba(0,0,0,0.15);
        border-radius: 0 20px 20px 0;
      }
      .sidebar img {
        width: 110px;
        height: 110px;
        object-fit: contain;
        margin-bottom: 10px;
      }
      .sidebar h2 {
        font-size: 18px;
        margin-bottom: 30px;
        text-align: center;
        line-height: 1.3;
      }
      .sidebar a {
        text-decoration: none;
        color: white;
        width: 90%;
        padding: 12px 15px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 10px;
        transition: all 0.3s ease;
      }
      .sidebar a:hover {
        background-color: var(--sidebar-hover);
        transform: translateX(4px);
      }
      .sidebar a.active {
        background-color: white;
        color: var(--sidebar-color);
        font-weight: 700;
      }
      .main {
        flex: 1;
        padding: 40px 60px;
        overflow-y: auto;
      }
      .header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 25px;
      }
      .header h1 {
        color: var(--sidebar-color);
        font-size: 26px;
        font-weight: 800;
      }
      .profile-container {
        background-color: white;
        border-radius: 20px;
        box-shadow: 0 6px 18px rgba(0,0,0,0.1);
        padding: 35px 40px;
        width: 100%;
        max-width: 950px;
        margin: 0 auto;
      }
      .profile-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-end;
        border-bottom: 2px solid #e5e7eb;
        padding-bottom: 12px;
        margin-bottom: 25px;
      }
      .profile-header h2 {
        font-size: 28px;
        font-weight: 800;
        color: var(--accent-text);
      }
      .profile-body {
        display: flex;
        flex-wrap: wrap;
        gap: 30px;
      }
      .profile-pic {
        width: 220px;
        height: 250px;
        background: #e8f1f9;
        border-radius: 15px;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
        box-shadow: 0 4px 10px rgba(0,0,0,0.1);
      }
      .profile-pic img {
        width: 100%;
        height: 100%;
        object-fit: cover;
      }
      .profile-details {
        flex: 1;
        min-width: 300px;
      }
      .name-block {
        border-bottom: 2px solid #d1d5db;
        padding-bottom: 10px;
        margin-bottom: 15px;
      }
      .name-block h3 {
        margin: 0;
        color: #000;
        font-size: 24px;
        font-weight: 700;
      }
      .name-block h4 {
        color: #4b5563;
        font-size: 16px;
        margin-top: 4px;
      }
      .info-grid {
        display: grid;
        gap: 12px;
      }
      .info-display {
        padding: 12px;
        border: 1.5px solid #d0d7de;
        border-radius: 10px;
        font-size: 15px;
        background-color: #f9f9f9;
        color: #333;
      }
      .row {
        display: flex;
        gap: 12px;
      }
      .row .info-display {
        flex: 1;
      }
      .error-message {
        color: #dc3545;
        padding: 15px;
        background-color: #f8d7da;
        border: 1px solid #f5c6cb;
        border-radius: 8px;
        margin-bottom: 20px;
      }
    </style>
  </head>
  <body>
  <div class="sidebar">
      <img src="img/tandangSora-logo.svg" alt="Logo">
      <h2>Barangay<br>Tandang Sora</h2>
      <a href="residents-dashboard-page.php"><i class="fa-solid fa-house"></i> Dashboard</a>
      <a href="request.php"><i class="fa-solid fa-file-lines"></i> Request Document</a>
      <a href="track.php"><i class="fa-solid fa-location-arrow"></i> Track Request</a>
      <a href="profile.php" class="active"><i class="fa-solid fa-user"></i> Profile</a>
      <a href="help.php"><i class="fa-solid fa-circle-question"></i> Help</a>
      <a href="logout.php"><i class="fa-solid fa-right-from-bracket"></i> Logout</a>
    </div>
    <div class="main">
      <div class="header">
        <h1><i class="fa-solid fa-user"></i> Profile</h1>
      </div>
      <div class="profile-container">
        <div class="profile-header">
          <h2>Profile Information</h2>
        </div>

        <?php
          // Get the logged-in username
          $username = $_SESSION['username'];

          // Query to get user info from the user table
          $sql = "SELECT FirstName, LastName, Address, Birthday, ContactNumber, Email FROM user WHERE Username = '$username'";

          $result = mysqli_query($conn, $sql);

          if(!$result) {
            echo "<div class='error-message'>Error retrieving profile: " . mysqli_error($conn) . "</div>";
          } else if(mysqli_num_rows($result) == 0) {
            echo "<div class='error-message'>Profile information not found.</div>";
          } else {
            $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

            // Extract and sanitize data
            $firstname = htmlspecialchars($row['FirstName']);
            $surname = htmlspecialchars($row['LastName']);
            $address = htmlspecialchars($row['Address']);
            $birthday = htmlspecialchars($row['Birthday']);
            $contact = htmlspecialchars($row['ContactNumber']);
            $email = htmlspecialchars($row['Email']);

            // Calculate age from birthday
            $birthDate = new DateTime($birthday);
            $today = new DateTime();
            $age = $today->diff($birthDate)->y;

            // Format birthday to readable format
            $birthdayFormatted = date('M d, Y', strtotime($birthday));
        ?>

        <div class="profile-body">
          <div class="profile-pic">
            <img src="img/profile-icon.svg" alt="Profile Picture">
          </div>
          <div class="profile-details">
            <div class="name-block">
              <h3><?php echo $surname; ?>,</h3>
              <h4><?php echo $firstname; ?></h4>
            </div>
            <div class="info-grid">
              <div class="info-display"><?php echo $address; ?></div>
              <div class="row">
                <div class="info-display"><?php echo $birthdayFormatted; ?></div>
                <div class="info-display"><?php echo $age; ?> years old</div>
              </div>
              <div class="info-display"><?php echo $contact; ?></div>
              <div class="info-display"><?php echo $email; ?></div>
            </div>
          </div>
        </div>

        <?php
          }
        ?>

      </div>
    </div>
  </body>
</html>