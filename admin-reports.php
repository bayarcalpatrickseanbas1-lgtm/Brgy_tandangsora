<?php include('connect.php');

if(!isset($_SESSION['username']) || $_SESSION['usertype'] != 'admin') {
    header("Location: index2.php");
    exit();
}

$admin_username = $_SESSION['username'];

$total_requests = mysqli_query($conn, "SELECT COUNT(*) as count FROM requests");
$total_row = mysqli_fetch_array($total_requests);
$total = $total_row['count'];

$approved = mysqli_query($conn, "SELECT COUNT(*) as count FROM requests WHERE status = 'Approved'");
$approved_row = mysqli_fetch_array($approved);
$approved_count = $approved_row['count'];

$pending = mysqli_query($conn, "SELECT COUNT(*) as count FROM requests WHERE status = 'Pending'");
$pending_row = mysqli_fetch_array($pending);
$pending_count = $pending_row['count'];

$rejected = mysqli_query($conn, "SELECT COUNT(*) as count FROM requests WHERE status = 'Rejected'");
$rejected_row = mysqli_fetch_array($rejected);
$rejected_count = $rejected_row['count'];

$recent = mysqli_query($conn, "
    SELECT username, email, message, created_at
    FROM reports
    ORDER BY created_at DESC
    LIMIT 10
") or die("Query failed: " . mysqli_error($conn));

$total_users = mysqli_query($conn, "SELECT COUNT(*) as count FROM user");
$users_row = mysqli_fetch_array($total_users);
$users_count = $users_row['count'];

$total_reports = mysqli_query($conn, "SELECT COUNT(*) as count FROM reports");
$reports_row = mysqli_fetch_array($total_reports);
$reports_count = $reports_row['count'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Reports - Admin</title>
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
  padding: 20px;
  box-shadow: 0 10px 25px rgba(0,0,0,0.1);
  width: 100%;
}

.stats {
  display: flex;
  justify-content: center;
  gap: 30px;
  margin: 30px 0;
  flex-wrap: wrap;
}

.stat-box {
  width: 220px;
  height: 140px;
  background: linear-gradient(145deg, #69698f, #8e6bde);
  padding: 20px;
  border-radius: 15px;
  text-align: center;
  box-shadow: 0 10px 20px rgba(0,0,0,0.2);
  transition: 0.3s;
}

.stat-box:hover {
  transform: translateY(-5px);
}

.stat-box p {
  color: #ffffff;
  font-size: 13px;
}

.stat-box h2 {
  font-size: 40px;
  color: #fff;
  margin-top: 15px;
}

.section-heading {
  color: var(--primary-dark);
  margin-top: 25px;
  margin-bottom: 15px;
  font-size: 18px;
  font-weight: 700;
}

.card-table {
  background: var(--card-bg); border-radius:20px;
  box-shadow:0 10px 25px var(--card-shadow); overflow:hidden;
}

table { width:100%; border-collapse:collapse; }
th, td { padding:12px; text-align:center; font-size:14px; }
th { background: var(--primary-color); color:white; font-weight:600; }
tr:nth-child(even) { background:#f2f4fb; }

.status-badge {
  padding: 4px 10px;
  border-radius: 10px;
  font-size: 12px;
  font-weight: 600;
}

.status-pending {
  background: #fff3cd;
  color: #856404;
}

.status-approved {
  background: #d1e7dd;
  color: #0f5132;
}

.status-rejected {
  background: #f8d7da;
  color: #842029;
}

.export-btn {
  background: var(--highlight-color);
  color: white;
  border: none;
  padding: 10px 20px;
  border-radius: 12px;
  font-weight: 600;
  cursor: pointer;
  transition: 0.3s;
  box-shadow: 0 4px 12px rgba(0,0,0,0.1);
  margin-top: 20px;
}

.export-btn:hover {
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
      <span class="admin-username">Admin: <?php echo htmlspecialchars($admin_username); ?></span>
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
        <a href="admin-reports.php" class="active">Reports</a>
        <a href="admin-settings.php">Settings</a>
    </aside>

    <section class="dashboard">
      <h3>REPORTS</h3>
      <div class="dashboard-content">

        <div class="stats">
          <div class="stat-box">
            <p><b>TOTAL REQUESTS</b></p>
            <h2><?php echo $total; ?></h2>
          </div>
          <div class="stat-box">
            <p><b>APPROVED</b></p>
            <h2><?php echo $approved_count; ?></h2>
          </div>
          <div class="stat-box">
            <p><b>PENDING</b></p>
            <h2><?php echo $pending_count; ?></h2>
          </div>
          <div class="stat-box">
            <p><b>REJECTED</b></p>
            <h2><?php echo $rejected_count; ?></h2>
          </div>
          <div class="stat-box">
            <p><b>TOTAL USERS</b></p>
            <h2><?php echo $users_count; ?></h2>
          </div>
          <div class="stat-box">
            <p><b>SYSTEM REPORTS</b></p>
            <h2><?php echo $reports_count; ?></h2>
          </div>
        </div>

        <div class="section-heading">Resident Reports</div>
        <div class="card-table">
          <table>
            <thead>
              <tr>
                <th>Username</th>
                <th>Email</th>
                <th>Message</th>
                <th>Date Requested</th>
              </tr>
            </thead>
            <tbody>
              <?php
                if(mysqli_num_rows($recent) > 0) {
                  while($row = mysqli_fetch_array($recent, MYSQLI_ASSOC)) {
                    $username = htmlspecialchars($row['username']);
                    $email = htmlspecialchars($row['email']);
                    $message = htmlspecialchars($row['message']);
                    $date = date('M d, Y', strtotime($row['created_at']));
                    
                    echo "
                      <tr>
                        <td>$username</td>
                        <td>$email</td>
                        <td>$message</td>
                        <td>$date</td>
                      </tr>
                    ";
                  }
                } else {
                  echo "<tr><td colspan='4'>No reports</td></tr>";
                }
              ?>
            </tbody>
          </table>
        </div>

        <button class="export-btn"><i class="fas fa-download"></i> Export Report</button>

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