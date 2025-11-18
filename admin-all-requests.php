<?php include('connect.php');

if(!isset($_SESSION['username']) || $_SESSION['usertype'] != 'admin') {
    header("Location: index2.php");
    exit();
}

$admin_username = $_SESSION['username'];

$pending_requests = mysqli_query($conn, "
    SELECT id, reference_number, firstname, lastname, document_type, status, created_at, Fee, Payment, Service
    FROM requests
    WHERE status = 'Pending'
    ORDER BY created_at DESC
");

$approved_requests = mysqli_query($conn, "
    SELECT id, reference_number, firstname, lastname, document_type, status, created_at, Fee, Payment, Service
    FROM requests
    WHERE status = 'Approved'
    ORDER BY created_at DESC
");

$completed_requests = mysqli_query($conn, "
    SELECT id, reference_number, firstname, lastname, document_type, status, created_at, Fee, Payment, Service
    FROM requests
    WHERE status = 'Completed'
    ORDER BY created_at DESC
");

$denied_requests = mysqli_query($conn, "
    SELECT id, reference_number, firstname, lastname, document_type, status, created_at, Fee, Payment, Service
    FROM requests
    WHERE status = 'Denied'
    ORDER BY created_at DESC
");

$canceled_requests = mysqli_query($conn, "
    SELECT id, reference_number, firstname, lastname, document_type, status, created_at, Fee, Payment, Service
    FROM requests
    WHERE status = 'Canceled'
    ORDER BY created_at DESC
");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>All Document Requests - Admin</title>
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

.section-heading {
  color: var(--primary-dark);
  margin-top: 25px;
  margin-bottom: 15px;
  font-size: 18px;
  font-weight: 700;
}

.card-table {
  background: var(--card-bg); border-radius:20px;
  box-shadow:0 10px 25px var(--card-shadow); overflow:hidden; margin-bottom:30px;
}

table { width:100%; border-collapse:collapse; }
th, td { padding:12px; text-align:center; font-size:14px; }
th { background: var(--primary-color); color:white; font-weight:600; }
tr:nth-child(even) { background:#f2f4fb; }

.action-btn {
  padding:6px 12px; border-radius:12px; color:white; font-size:13px;
  margin:2px 3px; font-weight:600; text-decoration:none; border:none; cursor:pointer; transition:0.3s;
}

.approve { background: var(--primary-color); }
.approve:hover { background: var(--btn-hover); transform: translateY(-1px); }

.reject { background: #d9534f; }
.reject:hover { background: #b02a2a; transform: translateY(-1px); }

.done { background: #5cb85c; }
.done:hover { background: #4cae4c; transform: translateY(-1px); }

.delete { background: #d9534f; }
.delete:hover { background: #b02a2a; transform: translateY(-1px); }

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
        <a href="admin-all-requests.php" class="active">All Requests</a>
        <a href="admin-reports.php">Reports</a>
        <a href="admin-settings.php">Settings</a>
    </aside>

    <section class="dashboard">
      <h3>ALL DOCUMENT REQUESTS</h3>
      <div class="dashboard-content">

        <div class="section-heading">Pending Requests</div>
        <div class="card-table">
          <table>
            <thead>
              <tr>
                <th>Reference #</th>
                <th>Full Name</th>
                <th>Document Type</th>
                <th>Fee</th>
                <th>Payment</th>
                <th>Service</th>
                <th>Status</th>
                <th>Date Submitted</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              <?php
                if(mysqli_num_rows($pending_requests) > 0) {
                  while($row = mysqli_fetch_array($pending_requests, MYSQLI_ASSOC)) {
                    $fullname = htmlspecialchars($row['firstname'] . ' ' . $row['lastname']);
                    $ref = htmlspecialchars($row['reference_number']);
                    $doc_type = htmlspecialchars($row['document_type']);
                    $fee = htmlspecialchars($row['Fee'] ?: 'N/A');
                    $payment = htmlspecialchars($row['Payment']);
                    $service = htmlspecialchars($row['Service']);
                    $date = date('M d, Y', strtotime($row['created_at']));
                    $id = $row['id'];

                    echo "
                      <tr>
                        <td><strong>$ref</strong></td>
                        <td>$fullname</td>
                        <td>$doc_type</td>
                        <td>$fee</td>
                        <td>$payment</td>
                        <td>$service</td>
                        <td>Pending</td>
                        <td>$date</td>
                        <td>
                          <a href='admin-approve.php?id=$id' class='action-btn approve' onclick=\"return confirm('Are you sure to approve this request?');\">Approve</a>
                          <a href='admin-reject.php?id=$id' class='action-btn reject' onclick=\"return confirm('Are you sure to reject this request?');\">Reject</a>
                          <a href='requestdelete2.php?id=$id' class='action-btn delete' onclick=\"return confirm('Are you sure to delete this request?');\">Delete</a>
                        </td>
                      </tr>
                    ";
                  }
                } else {
                  echo "<tr><td colspan='9'>No pending requests</td></tr>";
                }
              ?>
            </tbody>
          </table>
        </div>

        <div class="section-heading">Approved Requests</div>
        <div class="card-table">
          <table>
            <thead>
              <tr>
                <th>Reference #</th>
                <th>Full Name</th>
                <th>Document Type</th>
                <th>Fee</th>
                <th>Payment</th>
                <th>Service</th>
                <th>Status</th>
                <th>Date Submitted</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              <?php
                if(mysqli_num_rows($approved_requests) > 0) {
                  while($row = mysqli_fetch_array($approved_requests, MYSQLI_ASSOC)) {
                    $fullname = htmlspecialchars($row['firstname'] . ' ' . $row['lastname']);
                    $ref = htmlspecialchars($row['reference_number']);
                    $doc_type = htmlspecialchars($row['document_type']);
                    $fee = htmlspecialchars($row['Fee'] ?: 'N/A');
                    $payment = htmlspecialchars($row['Payment']);
                    $service = htmlspecialchars($row['Service']);
                    $date = date('M d, Y', strtotime($row['created_at']));
                    $id = $row['id'];

                    echo "
                      <tr>
                        <td><strong>$ref</strong></td>
                        <td>$fullname</td>
                        <td>$doc_type</td>
                        <td>$fee</td>
                        <td>$payment</td>
                        <td>$service</td>
                        <td>Approved</td>
                        <td>$date</td>
                        <td>
                          <a href='admin-done.php?id=$id' class='action-btn done' onclick=\"return confirm('Are you sure to mark this request as completed?');\">Mark as Completed</a>
                        </td>
                      </tr>
                    ";
                  }
                } else {
                  echo "<tr><td colspan='9'>No approved requests</td></tr>";
                }
              ?>
            </tbody>
          </table>
        </div>

        <div class="section-heading">Completed Requests</div>
        <div class="card-table">
          <table>
            <thead>
              <tr>
                <th>Reference #</th>
                <th>Full Name</th>
                <th>Document Type</th>
                <th>Fee</th>
                <th>Payment</th>
                <th>Service</th>
                <th>Status</th>
                <th>Date Submitted</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              <?php
                if(mysqli_num_rows($completed_requests) > 0) {
                  while($row = mysqli_fetch_array($completed_requests, MYSQLI_ASSOC)) {
                    $fullname = htmlspecialchars($row['firstname'] . ' ' . $row['lastname']);
                    $ref = htmlspecialchars($row['reference_number']);
                    $doc_type = htmlspecialchars($row['document_type']);
                    $fee = htmlspecialchars($row['Fee'] ?: 'N/A');
                    $payment = htmlspecialchars($row['Payment']);
                    $service = htmlspecialchars($row['Service']);
                    $date = date('M d, Y', strtotime($row['created_at']));
                    $id = $row['id'];

                    echo "
                      <tr>
                        <td><strong>$ref</strong></td>
                        <td>$fullname</td>
                        <td>$doc_type</td>
                        <td>$fee</td>
                        <td>$payment</td>
                        <td>$service</td>
                        <td>Completed</td>
                        <td>$date</td>
                        <td>
                          <a href='requestdelete2.php?id=$id' class='action-btn delete' onclick=\"return confirm('Are you sure to delete this request?');\">Delete</a>
                        </td>
                      </tr>
                    ";
                  }
                } else {
                  echo "<tr><td colspan='9'>No completed requests</td></tr>";
                }
              ?>
            </tbody>
          </table>
        </div>

        <div class="section-heading">Denied Requests</div>
        <div class="card-table">
          <table>
            <thead>
              <tr>
                <th>Reference #</th>
                <th>Full Name</th>
                <th>Document Type</th>
                <th>Fee</th>
                <th>Payment</th>
                <th>Service</th>
                <th>Status</th>
                <th>Date Submitted</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              <?php
                if(mysqli_num_rows($denied_requests) > 0) {
                  while($row = mysqli_fetch_array($denied_requests, MYSQLI_ASSOC)) {
                    $fullname = htmlspecialchars($row['firstname'] . ' ' . $row['lastname']);
                    $ref = htmlspecialchars($row['reference_number']);
                    $doc_type = htmlspecialchars($row['document_type']);
                    $fee = htmlspecialchars($row['Fee'] ?: 'N/A');
                    $payment = htmlspecialchars($row['Payment']);
                    $service = htmlspecialchars($row['Service']);
                    $date = date('M d, Y', strtotime($row['created_at']));
                    $id = $row['id'];

                    echo "
                      <tr>
                        <td><strong>$ref</strong></td>
                        <td>$fullname</td>
                        <td>$doc_type</td>
                        <td>$fee</td>
                        <td>$payment</td>
                        <td>$service</td>
                        <td>Denied</td>
                        <td>$date</td>
                        <td>
                          <a href='requestdelete2.php?id=$id' class='action-btn delete' onclick=\"return confirm('Are you sure to delete this request?');\">Delete</a>
                        </td>
                      </tr>
                    ";
                  }
                } else {
                  echo "<tr><td colspan='9'>No denied requests</td></tr>";
                }
              ?>
            </tbody>
          </table>
        </div>

        <div class="section-heading">Canceled Requests</div>
        <div class="card-table">
          <table>
            <thead>
              <tr>
                <th>Reference #</th>
                <th>Full Name</th>
                <th>Document Type</th>
                <th>Fee</th>
                <th>Payment</th>
                <th>Service</th>
                <th>Status</th>
                <th>Date Submitted</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              <?php
                if(mysqli_num_rows($canceled_requests) > 0) {
                  while($row = mysqli_fetch_array($canceled_requests, MYSQLI_ASSOC)) {
                    $fullname = htmlspecialchars($row['firstname'] . ' ' . $row['lastname']);
                    $ref = htmlspecialchars($row['reference_number']);
                    $doc_type = htmlspecialchars($row['document_type']);
                    $fee = htmlspecialchars($row['Fee'] ?: 'N/A');
                    $payment = htmlspecialchars($row['Payment']);
                    $service = htmlspecialchars($row['Service']);
                    $date = date('M d, Y', strtotime($row['created_at']));
                    $id = $row['id'];

                    echo "
                      <tr>
                        <td><strong>$ref</strong></td>
                        <td>$fullname</td>
                        <td>$doc_type</td>
                        <td>$fee</td>
                        <td>$payment</td>
                        <td>$service</td>
                        <td>Canceled</td>
                        <td>$date</td>
                        <td>
                          <a href='requestdelete2.php?id=$id' class='action-btn delete' onclick=\"return confirm('Are you sure to delete this request?');\">Delete</a>
                        </td>
                      </tr>
                    ";
                  }
                } else {
                  echo "<tr><td colspan='9'>No canceled requests</td></tr>";
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
