<?php include('connect.php');

if(!isset($_SESSION['username']) || $_SESSION['usertype'] != 'admin') {
    header("Location: index2.php");
    exit();
}

$admin_username = $_SESSION['username'];
$message = '';

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete_user'])) {
    $user_id = mysqli_real_escape_string($conn, $_POST['user_id']);

    $delete_login = "DELETE FROM login WHERE username = (SELECT Username FROM user WHERE id = '$user_id')";
    if(mysqli_query($conn, $delete_login)) {
        $delete_users = "DELETE FROM user WHERE id = '$user_id'";
        if(mysqli_query($conn, $delete_users)) {
            $message = '<div class="alert alert-success">User deleted successfully!</div>';
        }
    }
}

$users_query = mysqli_query($conn, "
    SELECT u.id, u.FirstName, u.LastName, u.Email, u.ContactNumber, l.username, l.usertype
    FROM user u
    LEFT JOIN login l ON u.Username = l.username
    ORDER BY u.FirstName ASC
");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>User Management - Admin</title>
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

.card-table {
  background: var(--card-bg); border-radius:20px;
  box-shadow:0 10px 25px var(--card-shadow); overflow:hidden;
}

table { width:100%; border-collapse:collapse; }
th, td { padding:14px; text-align:center; font-size:14px; }
th { background: var(--primary-color); color:white; font-weight:600; }
tr:nth-child(even) { background:#f2f4fb; }

.action-btn {
  padding:6px 12px; border-radius:12px; color:white; font-size:13px;
  margin:2px 3px; font-weight:600; text-decoration:none; border:none; cursor:pointer; transition:0.3s;
}

.delete { background: #d9534f; }
.delete:hover { background: #b02a2a; transform: translateY(-1px);}

.user-type {
  padding: 4px 10px;
  border-radius: 10px;
  font-size: 12px;
  font-weight: 600;
}

.type-user {
  background: #cfe2ff;
  color: #0c5ba3;
}

.type-admin {
  background: #fff3cd;
  color: #856404;
}

.modal {
  display: none;
  position: fixed;
  z-index: 1000;
  left: 0;
  top: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0,0,0,0.5);
}

.modal-content {
  background-color: white;
  margin: 10% auto;
  padding: 25px;
  border-radius: 12px;
  width: 90%;
  max-width: 400px;
  box-shadow: 0 5px 20px rgba(0,0,0,0.3);
}

.modal-header {
  font-size: 18px;
  font-weight: 700;
  color: var(--primary-dark);
  margin-bottom: 15px;
}

.modal-buttons {
  display: flex;
  gap: 10px;
  justify-content: flex-end;
  margin-top: 20px;
}

.modal-btn {
  padding: 8px 16px;
  border: none;
  border-radius: 8px;
  cursor: pointer;
  font-weight: 600;
  transition: 0.3s;
}

.modal-btn-cancel {
  background: #e0e0e0;
  color: #333;
}

.modal-btn-confirm {
  background: #d9534f;
  color: white;
}

.modal-btn-confirm:hover {
  background: #b02a2a;
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
        <a href="admin-users.php" class="active">User Management</a>
        <a href="admin-requests.php">Document Requests</a>
        <a href="admin-reports.php">Reports</a>
        <a href="admin-settings.php">Settings</a>
    </aside>

    <section class="dashboard">
      <h3>USER MANAGEMENT</h3>
      <div class="dashboard-content">

        <?php echo $message; ?>

        <div class="card-table">
          <table>
            <thead>
              <tr>
                <th>Full Name</th>
                <th>Username</th>
                <th>Email</th>
                <th>Contact</th>
                <th>User Type</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              <?php
                if(mysqli_num_rows($users_query) > 0) {
                  while($row = mysqli_fetch_array($users_query, MYSQLI_ASSOC)) {
                    $id = $row['id'];
                    $fullname = htmlspecialchars($row['FirstName'] . ' ' . $row['LastName']);
                    $username = htmlspecialchars($row['username']);
                    $email = htmlspecialchars($row['Email']);
                    $contact = htmlspecialchars($row['ContactNumber']);
                    $usertype = htmlspecialchars($row['usertype']);
                    
                    $type_class = ($usertype === 'admin') ? 'type-admin' : 'type-user';
                    
                    echo "
                      <tr>
                        <td>$fullname</td>
                        <td>$username</td>
                        <td>$email</td>
                        <td>$contact</td>
                        <td><span class='user-type $type_class'>" . strtoupper($usertype) . "</span></td>
                        <td>
                          <button class='action-btn delete' onclick=\"openDeleteModal($id, '$fullname')\">Delete</button>
                        </td>
                      </tr>
                    ";
                  }
                } else {
                  echo "<tr><td colspan='6'>No users found</td></tr>";
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

  <div id="deleteModal" class="modal">
    <div class="modal-content">
      <div class="modal-header">Delete User</div>
      <p>Are you sure you want to delete <strong id="userName"></strong>? This action cannot be undone.</p>
      <form id="deleteForm" method="POST">
        <input type="hidden" name="user_id" id="userId">
        <input type="hidden" name="delete_user" value="1">
        <div class="modal-buttons">
          <button type="button" class="modal-btn modal-btn-cancel" onclick="closeDeleteModal()">Cancel</button>
          <button type="submit" class="modal-btn modal-btn-confirm">Delete</button>
        </div>
      </form>
    </div>
  </div>

  <script>
    function openDeleteModal(userId, userName) {
      document.getElementById('userId').value = userId;
      document.getElementById('userName').textContent = userName;
      document.getElementById('deleteModal').style.display = 'block';
    }
    
    function closeDeleteModal() {
      document.getElementById('deleteModal').style.display = 'none';
    }
    
    window.onclick = function(event) {
      const modal = document.getElementById('deleteModal');
      if (event.target == modal) {
        modal.style.display = 'none';
      }
    }
  </script>

</body>
</html>