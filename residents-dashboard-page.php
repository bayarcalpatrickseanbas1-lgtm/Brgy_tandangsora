<?php include('session_check.php'); ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <title>Barangay Tandang Sora Dashboard</title>
    <style>
      :root {
        --primary-brand: #01497c;
        --primary-hover: #013a63;
      }
      * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: "Montserrat", sans-serif;
      }
      body {
        background: linear-gradient(to bottom right, #f9fcff, #eef6fb);
        min-height: 100vh;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: flex-start;
      }
      .navbar {
        width: 100%;
        background: var(--primary-brand);
        color: white;
        padding: 15px 40px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        box-shadow: 0 4px 10px rgba(0,0,0,0.15);
      }
      .nav-left {
        display: flex;
        align-items: center;
        gap: 15px;
      }
      .nav-logo {
        width: 45px;
        height: 45px;
      }
      .nav-left h2 {
        font-size: 20px;
        letter-spacing: 0.5px;
      }
      .nav-right {
        display: flex;
        align-items: center;
        gap: 20px;
      }
      .username-display {
        font-size: 14px;
        font-weight: 500;
        color: #dce9f4;
        background: rgba(255, 255, 255, 0.15);
        padding: 6px 12px;
        border-radius: 20px;
      }
      .nav-icon {
        color: white;
        font-size: 22px;
        text-decoration: none;
        transition: color 0.3s ease;
      }
      .nav-icon:hover {
        color: #bcd6ea;
      }
      .logout-btn {
        background: white;
        color: var(--primary-brand);
        border: none;
        padding: 8px 18px;
        border-radius: 20px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s;
        text-decoration: none;
        display: flex;
        align-items: center;
        gap: 5px;
      }
      .logout-btn:hover {
        background: var(--primary-hover);
        color: white;
      }
      .main-content {
        background-color: #fff;
        border-radius: 0 0 25px 25px;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
        padding: 40px 60px;
        width: 90%;
        max-width: 1400px;
        flex: 1;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
      }
      .header {
        display: flex;
        align-items: center;
        justify-content: space-between;
      }
      .welcome-text {
        flex: 1;
        text-align: left;
      }
      .welcome-text h3 {
        font-size: 26px;
        color: #000;
        text-shadow: 0 2px 3px rgba(0, 0, 0, 0.2);
      }
      .highlight {
        color: var(--primary-brand);
        font-weight: 1000;
      }
      .welcome-text p {
        font-size: 16px;
        color: #444;
        margin-top: 8px;
        line-height: 1.5;
      }
      .seal {
        width: 140px;
        height: 140px;
        object-fit: contain;
        margin-bottom: 10px;
      }
      .map-wrapper {
        position: relative;
        border-radius: 12px;
        overflow: hidden;
        width: 420px;
        height: 280px;
        box-shadow: 0 6px 10px rgba(0, 0, 0, 0.15);
      }
      .map-wrapper iframe {
        width: 100%;
        height: 100%;
        border: 0;
      }
      .divider {
        height: 3px;
        width: 100%;
        background-color: var(--primary-brand);
        border-radius: 2px;
        margin: 25px 0;
      }

      .buttons {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 35px;
        flex-wrap: wrap;
      }
      .btn {
        background-color: var(--primary-brand);
        color: white;
        border: none;
        width: 190px;
        height: 130px;
        border-radius: 18px;
        clip-path: polygon(0% 0%, 65% 0%, 100% 35%, 100% 100%, 0% 100%);
        font-size: 15px;
        cursor: pointer;
        transition: all 0.3s ease;
        box-shadow: 0px 6px 12px rgba(0, 0, 0, 0.15);
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        text-align: center;
        text-decoration: none;
      }
      .btn .icon-circle {
        background-color: white;
        color: var(--primary-brand);
        width: 55px;
        height: 55px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 10px;
        font-size: 22px;
        box-shadow: 0 3px 6px rgba(0, 0, 0, 0.1);
      }
      .btn:hover {
        background-color: var(--primary-hover);
        transform: translateY(-3px) scale(1.02);
        box-shadow: 0 10px 18px rgba(1, 73, 124, 0.25);
      }
      .btn span {
        font-size: 13px;
        font-weight: 600;
        line-height: 18px;
        color: white;
      }
    </style>
  </head>
  <body>
    <div class="navbar">
      <div class="nav-left">
        <img src="img/tandangSora-logo.svg" class="nav-logo">
        <h2>Barangay Tandang Sora</h2>
      </div>
      <div class="nav-right">
        <a href="profile.php" class="nav-icon"><i class="fa-solid fa-user"></i></a>
        <div class="username-display"><?php echo htmlspecialchars($_SESSION['username']); ?></div>
        <a href="logout.php" class="logout-btn">Logout</a>
      </div>
    </div>

    <div class="main-content">
      <div class="header">
        <div class="welcome-text">
          <img class="seal" src="img/tandangSora-logo.svg">
          <h3>WELCOME TO <span class="highlight"><br>BARANGAY TANDANG SORA</span></h3>
          <p><strong>— Bringing faster and more<br>convenient public service<br>right at your fingertips.</strong></p>
        </div>
        <div class="map-wrapper">
          <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3859.543830475277!2d121.02963607445642!3d14.681810175084559!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3397b6d5ea2c8c41%3A0x3f5f609865a14a61!2sTandang%20Sora%20Barangay%20Hall!5e0!3m2!1sen!2sph!4v1762071269882!5m2!1sen!2sph" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
      </div>
      <div class="divider"></div>
      <div class="buttons">
        <a href="request.php" class="btn">
          <div class="icon-circle"><i class="fa-solid fa-file-lines"></i></div>
          <span>REQUEST<br>DOCUMENT</span>
        </a>
        <a href="track.php" class="btn">
          <div class="icon-circle"><i class="fa-solid fa-location-arrow"></i></div>
          <span>TRACK<br>REQUEST</span>
        </a>
        <a href="profile.php" class="btn">
          <div class="icon-circle"><i class="fa-solid fa-user"></i></div>
          <span>PROFILE</span>
        </a>
        <a href="help.php" class="btn">
          <div class="icon-circle"><i class="fa-solid fa-circle-question"></i></div>
          <span>HELP</span>
        </a>
      </div>
    </div>
  </body>
</html>