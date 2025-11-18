<?php include('connect.php');

if(!isset($_SESSION['username']) || $_SESSION['usertype'] != 'admin') {
    header("Location: index2.php");
    exit();
}

$admin_username = $_SESSION['username'];
$message = '';
$message_type = '';

$admin_query = mysqli_query($conn, "SELECT * FROM login WHERE username = '$admin_username'");
$admin = mysqli_fetch_array($admin_query, MYSQLI_ASSOC);

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['change_password'])) {
    $old_password = mysqli_real_escape_string($conn, $_POST['old_password']);
    $new_password = mysqli_real_escape_string($conn, $_POST['new_password']);
    $confirm_password = mysqli_real_escape_string($conn, $_POST['confirm_password']);

    if($admin['password'] !== $old_password) {
        $message = "Incorrect current password!";
        $message_type = "error";
    } elseif($new_password !== $confirm_password) {
        $message = "New passwords do not match!";
        $message_type = "error";
    } elseif(strlen($new_password) < 6) {
        $message = "Password must be at least 6 characters!";
        $message_type = "error";
    } else {
        $update_sql = "UPDATE login SET password = '$new_password' WHERE username = '$admin_username'";
        if(mysqli_query($conn, $update_sql)) {
            $message = "Password changed successfully!";
            $message_type = "success";
            $admin['password'] = $new_password;
        } else {
            $message = "Error updating password: " . mysqli_error($conn);
            $message_type = "error";
        }
    }
}

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['save_system'])) {
    $barangay_name = mysqli_real_escape_string($conn, $_POST['barangay_name']);
    $contact_email = mysqli_real_escape_string($conn, $_POST['contact_email']);
    
    $message = "System settings updated successfully!";
    $message_type = "success";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Settings - Admin</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <style>
:root {
  --primary-color: #69698f;
  --primary-dark: #505094;
  --highlight-color: #8e6bde;
  --bg-gradient: linear-gradient(to bottom right, #f8f8fb, #e9ebff);
  --card-bg: #fff;
  --card-shadow: rgba(0,0,0,0.15);
  --btn-hover: #5f55c0;
}

* { margin:0; padding:0; box-sizing:border-box; font-family:"Montserrat", sans-serif; }
body { background: var(--bg-gradient); display:flex; flex-direction: column; }

hr {
  margin: 0 30px;
  border: none;
  border-top: 1px solid #ddd;
}

.top-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 15px 40px;
  background: white;
  box-shadow: 0 2px 10px rgba(0,0,0,0.1);
  border-bottom: 3px solid #8e6bde;
}

.header-left {
  display: flex;
  align-items: center;
  gap: 15px;
}

.logo {
  width: 80px;
  height: 80px;
  border-radius: 50%;
  border: 3px solid #8e6bde;
}

.header-text p {
  font-size: 12px;
  color: #666;
  line-height: 1.3;
}

.header-text h2 {
  color: #505094;
  font-size: 20px;
}

.header-right {
  display: flex;
  align-items: center;
  gap: 20px;
}

.admin-username {
  color: #505094;
  font-weight: 600;
  font-size: 14px;
}

.logout-link {
  background: #8e6bde;
  color: white;
  padding: 8px 18px;
  border-radius: 20px;
  text-decoration: none;
  transition: 0.3s;
  font-weight: 600;
  font-size: 13px;
}

.logout-link:hover {
  background: #6d53ba;
}

.main-container {
  display: flex;
  margin: 0;
}

.sidebar {
  width: 220px;
  background: linear-gradient(180deg, #69698f, #986cf4);
  color: white;
  min-height: 100vh;
  padding-top: 40px;
  border-radius: 0 15px 15px 0;
  box-shadow: 4px 0 15px rgba(0,0,0,0.1);
  position: sticky;
  top: 0;
}

.admin-profile {
  display: flex;
  flex-flow: column;
  justify-content: center;
  align-items: center;
  margin-bottom: 20px;
}

.sidebar .admin-profile .profile-image {
  width: 70px;
  height: 70px;
  border-radius: 100px;
  margin-bottom: 10px;
  border: 2px solid white;
}

.sidebar .admin-profile h3 {
  color: #ffffff;
  margin-top: 0;
  margin-bottom: 25px;
  letter-spacing: 1px;
  font-size: 16px;
}

.sidebar a {
  display: flex;
  flex-flow: column;
  margin-left: 10px;
  padding: 12px 15px;
  text-decoration: none;
  text-align: right;
  color: #ffffff;
  cursor: pointer;
  transition: 0.4s;
  border-radius: 8px 0 0 8px;
  font-size: 14px;
}

.sidebar a.active, .sidebar a:hover {
  background: #f3f3f8;
  color: #8e6bde;
  transform: translateX(6px);
  box-shadow: inset 5px 0 0 #8e6bde;
}

.dashboard {
  flex: 1;
  padding: 40px;
}

.dashboard h3 {
  color: #505094;
  margin-bottom: 20px;
  font-size: 22px;
}

.dashboard-content {
  background: white;
  border-radius: 15px;
  padding: 30px;
  box-shadow: 0 10px 25px rgba(0,0,0,0.1);
  width: 100%;
}

.alert {
  padding: 12px 18px;
  border-radius: 8px;
  margin-bottom: 20px;
  font-weight: 600;
}

.alert-success {
  background: #d1e7dd;
  color: #0f5132;
  border: 1px solid #badbcc;
}

.alert-error {
  background: #f8d7da;
  color: #842029;
  border: 1px solid #f5c2c7;
}

.settings-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
  gap: 30px;
}

.card {
  background: white;
  border: 1px solid #e9e9ee;
  border-radius: 15px;
  padding: 25px;
  box-shadow: 0 4px 12px rgba(0,0,0,0.08);
}

.card h4 {
  color: var(--highlight-color);
  margin-bottom: 20px;
  font-size: 18px;
  display: flex;
  align-items: center;
  gap: 10px;
}

.form-group {
  margin-bottom: 15px;
  display: flex;
  flex-direction: column;
}

label {
  font-size: 14px;
  font-weight: 600;
  color: #333;
  margin-bottom: 6px;
}

input, select {
  padding: 10px 12px;
  border: 1px solid #ddd;
  border-radius: 8px;
  outline: none;
  transition: 0.2s;
  font-size: 14px;
  font-family: inherit;
}

input:focus, select:focus {
  border-color: var(--highlight-color);
  box-shadow: 0 0 0 3px rgba(142, 107, 222, 0.1);
}

input:disabled {
  background: #f5f5f5;
  color: #999;
}

.save-btn {
  background: var(--highlight-color);
  color: white;
  padding: 10px 20px;
  border: none;
  border-radius: 10px;
  font-weight: 600;
  cursor: pointer;
  transition: 0.3s;
  box-shadow: 0 4px 12px rgba(0,0,0,0.1);
}

.save-btn:hover {
  background: var(--btn-hover);
  transform: translateY(-2px);
}

.footer {
  background: white;
  padding: 20px 40px;
  text-align: left;
  border-top: 3px solid #8e6bde;
}

.footer-top {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding-bottom: 20px;
}

.footer-left h3 {
  color: #505094;
}

.footer-bottom {
  border-top: 1px solid #ddd;
  padding-top: 15px;
  font-size: 12px;
  text-transform: uppercase;
  color: #666;
}
  </style>
</head>
<body>

  <header class="top-header">
    <div class="header-left">
      <img src="img/tandangSora-logo.svg" alt="Barangay Logo" class="logo">
      <div class="header-text">
        <p>REPUBLIC OF THE PHILIPPINES<br>
        NATIONAL CAPITAL REGION<br>
        QUEZON CITY</p>
        <h2>BARANGAY TANDANG SORA</h2>
      </div>
    </div>
    <div class="header-right">
      <span class="admin-username">Username: <?php echo htmlspecialchars($admin_username); ?></span>
      <a href="logout.php" class="logout-link">Logout</a>
    </div>
  </header>
<hr>

  <main class="main-container">
    <aside class="sidebar">
        <div class="admin-profile">
          <img src="img/tandangSora-logo.svg" class="profile-image" alt="Admin Profile">
          <h3>ADMIN</h3>
        </div>
        <a href="admin-dashboard.php">Dashboard</a>
        <a href="admin-users.php">User Management</a>
        <a href="admin-requests.php">Document Requests</a>
        <a href="admin-reports.php">Reports</a>
        <a href="admin-settings.php" class="active">Settings</a>
    </aside>

    <section class="dashboard">
      <h3>SETTINGS</h3>
      <div class="dashboard-content">

        <?php 
          if($message) {
            $alert_class = ($message_type === 'success') ? 'alert-success' : 'alert-error';
            echo "<div class='alert $alert_class'>" . htmlspecialchars($message) . "</div>";
          }
        ?>

        <div class="settings-grid">
          <!-- Account Settings Card -->
          <div class="card">
            <h4><i class="fas fa-user-lock"></i> Account Settings</h4>
            <form method="POST">
              <div class="form-group">
                <label>Admin Username</label>
                <input type="text" value="<?php echo htmlspecialchars($admin_username); ?>" disabled>
              </div>
              <div class="form-group">
                <label>Current Password</label>
                <input type="password" name="old_password" placeholder="Enter current password" required>
              </div>
              <div class="form-group">
                <label>New Password</label>
                <input type="password" name="new_password" placeholder="Enter new password" required>
              </div>
              <div class="form-group">
                <label>Confirm Password</label>
                <input type="password" name="confirm_password" placeholder="Confirm new password" required>
              </div>
              <button type="submit" name="change_password" class="save-btn"><i class="fas fa-save"></i> Change Password</button>
            </form>
          </div>

          <!-- System Settings Card -->
          <div class="card">
            <h4><i class="fas fa-cogs"></i> System Settings</h4>
            <form method="POST">
              <div class="form-group">
                <label>Barangay Name</label>
                <input type="text" name="barangay_name" placeholder="e.g., Barangay Tandang Sora" value="Barangay Tandang Sora">
              </div>
              <div class="form-group">
                <label>Contact Email</label>
                <input type="email" name="contact_email" placeholder="barangay@example.com" value="barangay.tandangsora@quezon.gov.ph">
              </div>
              <div class="form-group">
                <label>Theme</label>
                <select>
                  <option>Default (Violet)</option>
                  <option>Light</option>
                  <option>Dark</option>
                </select>
              </div>
              <button type="submit" name="save_system" class="save-btn"><i class="fas fa-save"></i> Save Settings</button>
            </form>
          </div>

          <!-- System Information Card -->
          <div class="card">
            <h4><i class="fas fa-info-circle"></i> System Information</h4>
            <div class="form-group">
              <label>System Version</label>
              <input type="text" value="1.0.0" disabled>
            </div>
            <div class="form-group">
              <label>Database Status</label>
              <input type="text" value="Connected" style="border-color: #28a745; background: #d1e7dd;" disabled>
            </div>
            <div class="form-group">
              <label>Last Backup</label>
              <input type="text" value="<?php echo date('M d, Y - h:i A'); ?>" disabled>
            </div>
          </div>
        </div>

      </div>
    </section>
  </main>

<hr>
  <footer class="footer">
    <div class="footer-top">
      <div class="footer-left">
        <h3>BARANGAY TANDANG SORA</h3>
        <p>116 Mindanao Avenue, Tandang Sora Barangay Hall, Quezon City, Philippines</p>
        <p>Hotline: 09295132453 | Emergency: 911</p>
      </div>
    </div>
    <div class="footer-bottom">
      <p>ALL RIGHTS RESERVED. 2025</p>
    </div>
  </footer>

</body>
</html>