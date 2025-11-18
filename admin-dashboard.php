<?php include('connect.php');

if(!isset($_SESSION['username']) || $_SESSION['usertype'] != 'admin') {
    header("Location: index2.php");
    exit();
}

$admin_username = $_SESSION['username'];

$total_requests = mysqli_query($conn, "SELECT COUNT(*) as count FROM requests");
$total_row = mysqli_fetch_array($total_requests);
$total = $total_row['count'];

$pending_requests = mysqli_query($conn, "SELECT COUNT(*) as count FROM requests WHERE status = 'Pending'");
$pending_row = mysqli_fetch_array($pending_requests);
$pending = $pending_row['count'];

$approved_requests = mysqli_query($conn, "SELECT COUNT(*) as count FROM requests WHERE status = 'Approved'");
$approved_row = mysqli_fetch_array($approved_requests);
$approved = $approved_row['count'];

$recent_activity = mysqli_query($conn, "
    SELECT firstname, lastname, document_type, status, created_at 
    FROM requests 
    ORDER BY created_at DESC 
    LIMIT 6
");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Barangay Tandang Sora Admin Dashboard</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <style>
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: "Montserrat", sans-serif;
}

body {
  background: linear-gradient(to bottom right, #f8f8fb, #e9ebff);
  color: #333;
  max-width: 100%;
  overflow-x: hidden;
}

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

.admin-input {
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.search {
  display: flex;
  border: 1px solid #ddd;
  border-radius: 25px;
  overflow: hidden;
  box-shadow: 0 4px 10px rgba(0,0,0,0.15);
}

.search input[type="search"] {
  flex-grow: 1;
  width: 350px;
  border: none;
  outline: none;
  padding: 10px 15px;
}

.search button {
  background: #8e6bde;
  color: white;
  border: none;
  width: 45px;
  cursor: pointer;
  transition: 0.3s;
}
.search button:hover {
  background: #6d53ba;
}

.period-selector {
  display: flex;
  align-items: center;
  color: #505094;
}

.period-selector > select {
  border-radius: 10px;
  margin-left: 10px;
  color: #505094;
  border: 1px solid #8e6bde;
  padding: 6px 10px;
}

.stats {
  display: flex;
  justify-content: center;
  gap: 40px;
  margin: 40px 0;
  flex-wrap: wrap;
}

.stat-box {
  width: 280px;
  height: 180px;
  background: linear-gradient(145deg, #69698f, #8e6bde);
  padding: 20px;
  border-radius: 20px;
  text-align: center;
  box-shadow: 0 10px 20px rgba(0,0,0,0.2);
  transition: 0.3s;
}
.stat-box:hover {
  transform: translateY(-5px);
}

.stat-box p {
  color: #ffffff;
  font-size: 15px;
}

.stat-box h2 {
  font-size: 45px;
  color: #fff;
  margin-top: 25px;
}

.activity-section table {
  width: 100%;
  border-collapse: collapse;
  margin-top: 20px;
  border-radius: 12px;
  overflow: hidden;
  box-shadow: 0 8px 16px rgba(0,0,0,0.1);
}

.activity-section th {
  background: #8e6bde;
  color: white;
  text-align: left;
  padding: 12px 15px;
}

.activity-section td {
  padding: 12px 15px;
  background: #faf9ff;
  border-bottom: 1px solid #e1dcf5;
}

.pending { color: #a1a1a1; font-weight: 600; }
.success { color: #007a3f; font-weight: 600; }
.approved { color: #007a3f; font-weight: 600; }
.released { color: #ff2828; font-weight: 600; }
.completed { color: #007a3f; font-weight: 600; }

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
        <a class="active" href="admin-dashboard.php">Dashboard</a>
        <a href="admin-all-users.php">All Users</a>
        <a href="admin-all-requests.php">All Requests</a>
        <a href="admin-reports.php">Reports</a>
        <a href="admin-settings.php">Settings</a>
    </aside>

    <section class="dashboard">
      <h3>DASHBOARD</h3>
      <div class="dashboard-content">
        <div class="admin-input">
          <form class="search" method="GET">
            <button type="submit"><i class="fas fa-search"></i></button>
            <input type="search" name="search" placeholder="Search..." value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
          </form>
          <div class="period-selector">
            <p><b>PERIOD</b></p>
            <select>
              <option value="ALL" selected>ALL</option>
              <option value="OPTION 2">THIS MONTH</option>
              <option value="OPTION 3">THIS YEAR</option>
            </select>
          </div>
        </div>

        <div class="stats">
          <div class="stat-box">
            <p><b>TOTAL REQUESTS</b></p>
            <h2><?php echo $total; ?></h2>
          </div>
          <div class="stat-box">
            <p><b>PENDING APPROVALS</b></p>
            <h2><?php echo $pending; ?></h2>
          </div>
          <div class="stat-box">
            <p><b>APPROVED</b></p>
            <h2><?php echo $approved; ?></h2>
          </div>
        </div>

        <div class="activity-section">
          <table>
            <thead>
              <tr>
                <th>Recent Activity</th>
                <th>Document Type</th>
                <th>Status</th>
                <th>Date</th>
              </tr>
            </thead>
            <tbody>
              <?php
                if(mysqli_num_rows($recent_activity) > 0) {
                  while($row = mysqli_fetch_array($recent_activity, MYSQLI_ASSOC)) {
                    $fullname = htmlspecialchars($row['firstname'] . ' ' . $row['lastname']);
                    $doc_type = htmlspecialchars($row['document_type']);
                    $status = htmlspecialchars($row['status']);
                    $date = date('M d, Y - h:i A', strtotime($row['created_at']));
                    
                    $status_class = 'pending';
                    if($status === 'Approved') $status_class = 'approved';
                    elseif($status === 'Completed') $status_class = 'completed';
                    
                    echo "
                      <tr>
                        <td>$fullname</td>
                        <td>$doc_type</td>
                        <td class='$status_class'>$status</td>
                        <td>$date</td>
                      </tr>
                    ";
                  }
                } else {
                  echo "<tr><td colspan='4'>No recent activity</td></tr>";
                }
              ?>
            </tbody>
          </table>
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