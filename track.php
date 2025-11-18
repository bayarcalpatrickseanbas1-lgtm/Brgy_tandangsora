<?php include('session_check.php'); ?>
<!DOCTYPE html>
<html lang="en">
  <head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Track Request | Barangay Tandang Sora</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <style>
    :root {
      --sidebar-color: #01497c;
      --sidebar-hover: #013a63;
      --accent: #b5d2e8;
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

    /* ==== SIDEBAR (Official Layout) ==== */
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

    /* ==== MAIN CONTENT ==== */
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
      display: flex;
      align-items: center;
      gap: 10px;
    }
    .header button {
      background-color: var(--sidebar-color);
      color: white;
      border: none;
      padding: 8px 18px;
      border-radius: 20px;
      cursor: pointer;
      font-weight: 600;
      transition: background 0.3s;
    }
    .header button:hover {
      background-color: var(--sidebar-hover);
    }

    /* ==== TABLE SECTION ==== */
    .table-container {
      background-color: white;
      border-radius: 20px;
      box-shadow: 0 6px 18px rgba(0,0,0,0.1);
      padding: 30px 40px;
      width: 100%;
      max-width: 1000px;
      margin: 0 auto;
    }
    .table-container h2 {
      color: var(--sidebar-color);
      text-align: center;
      margin-bottom: 25px;
      font-size: 22px;
    }
    table {
      width: 100%;
      border-collapse: collapse;
      background-color: white;
      border-radius: 12px;
      overflow: hidden;
    }
    th, td {
      padding: 14px 12px;
      text-align: left;
      border-bottom: 1px solid #ddd;
      font-size: 15px;
    }
    th {
      background-color: var(--sidebar-color);
      color: white;
      font-weight: 700;
    }
    tr:hover {
      background-color: #f5faff;
    }
    .status-pending {
      color: #e3a008;
      font-weight: 700;
      padding: 6px 12px;
      background: #fff3cd;
      border-radius: 20px;
      display: inline-block;
      text-align: center;
    }
    .status-processing {
      color: #0077b6;
      font-weight: 700;
      padding: 6px 12px;
      background: #cfe2ff;
      border-radius: 20px;
      display: inline-block;
      text-align: center;
    }
    .status-completed {
      color: #008000;
      font-weight: 700;
      padding: 6px 12px;
      background: #d1e7dd;
      border-radius: 20px;
      display: inline-block;
      text-align: center;
    }
    .status-rejected {
      color: #dc3545;
      font-weight: 700;
      padding: 6px 12px;
      background: #f8d7da;
      border-radius: 20px;
      display: inline-block;
      text-align: center;
    }
    .empty-message {
      text-align: center;
      padding: 60px 20px;
      color: #666;
    }
    .empty-message i {
      font-size: 60px;
      color: #b5d2e8;
      display: block;
      margin-bottom: 20px;
    }
    .empty-message h3 {
      color: var(--sidebar-color);
      font-size: 20px;
      margin-bottom: 10px;
    }
    .empty-message p {
      color: #999;
      margin-bottom: 20px;
    }
    .empty-message a {
      background-color: var(--sidebar-color);
      color: white;
      padding: 10px 20px;
      border-radius: 8px;
      text-decoration: none;
      transition: background 0.3s;
      display: inline-block;
    }
    .empty-message a:hover {
      background-color: var(--sidebar-hover);
    }
    .cancel-btn {
      background-color: #dc3545;
      color: white;
      border: none;
      padding: 6px 12px;
      border-radius: 8px;
      cursor: pointer;
      font-size: 14px;
      font-weight: 600;
      transition: background 0.3s;
    }
    .cancel-btn:hover {
      background-color: #b02a2a;
    }
  </style>
</head>

<body>
  <!-- SIDEBAR -->
  <div class="sidebar">
    <img src="img/tandangSora-logo.svg" alt="Logo">
    <h2>Barangay<br>Tandang Sora</h2>
    <a href="residents-dashboard-page.php"><i class="fa-solid fa-house"></i> Dashboard</a>
    <a href="request.php"><i class="fa-solid fa-file-lines"></i> Request Document</a>
    <a href="track.php" class="active"><i class="fa-solid fa-location-arrow"></i> Track Request</a>
    <a href="profile.php"><i class="fa-solid fa-user"></i> Profile</a>
    <a href="help.php"><i class="fa-solid fa-circle-question"></i> Help</a>
    <a href="logout.php"><i class="fa-solid fa-right-from-bracket"></i> Logout</a>
  </div>

  <!-- MAIN CONTENT -->
  <div class="main">
    <div class="header">
      <h1><i class="fa-solid fa-location-arrow"></i> Track Request</h1>
      <button onclick="window.location.href='residents-dashboard-page.php'"><i class="fa-solid fa-arrow-left"></i> Back</button>
    </div>

    <div class="table-container">
      <h2>Request History</h2>
      
      <?php
        // Get the logged-in username from session
        $username = $_SESSION['username'];
        
        // Query to get all requests for the current user
        $sql = "SELECT id, reference_number, lastname, firstname, document_type, status, created_at FROM requests WHERE username = '$username' ORDER BY created_at DESC";
        
        $result = mysqli_query($conn, $sql);
        
        if(!$result) {
          echo "<div class='empty-message'><p>Error retrieving requests: " . mysqli_error($conn) . "</p></div>";
        } else if(mysqli_num_rows($result) == 0) {
          // No requests found for this user
          echo "
          <div class='empty-message'>
            <i class='fa-solid fa-inbox'></i>
            <h3>No Requests Yet</h3>
            <p>You haven't submitted any document requests yet.</p>
            <a href='request.php'><i class='fa-solid fa-plus'></i> Make a New Request</a>
          </div>
          ";
        } else {
          // Display table with user's requests
          echo "
          <table>
            <thead>
              <tr>
                <th>Reference Number</th>
                <th>Full Name</th>
                <th>Document Type</th>
                <th>Status</th>
                <th>Date Submitted</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
          ";
          
          // Loop through each request
          while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $reference = htmlspecialchars($row['reference_number']);
            $fullname = htmlspecialchars($row['firstname'] . ' ' . $row['lastname']);
            $doctype = htmlspecialchars($row['document_type']);
            $status = htmlspecialchars($row['status']);
            $date = date('M d, Y', strtotime($row['created_at']));
            
            // Determine status class
            $status_class = 'status-pending';
            if($status === 'Approved') {
              $status_class = 'status-processing';
            } else if($status === 'Completed') {
              $status_class = 'status-completed';
            } else if($status === 'Denied') {
              $status_class = 'status-rejected';
            } else if($status === 'Canceled') {
              $status_class = 'status-rejected';
            }
            
            $actions = '';
            if($status === 'Pending') {
              $actions = "<a href='user-cancel.php?id={$row['id']}' class='cancel-btn' onclick=\"return confirm('Are you sure you want to cancel this request?');\">Cancel</a>";
            }

            echo "
              <tr>
                <td><strong>$reference</strong></td>
                <td>$fullname</td>
                <td>$doctype</td>
                <td><span class='$status_class'>$status</span></td>
                <td>$date</td>
                <td>$actions</td>
              </tr>
            ";
          }
          
          echo "
            </tbody>
          </table>
          ";
        }
      ?>
    </div>
  </div>

  <script>
    function cancelRequest(requestId) {
      if (confirm('Are you sure you want to cancel this request?')) {
        fetch('process_cancel.php', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
          },
          body: 'request_id=' + requestId
        })
        .then(response => response.text())
        .then(data => {
          alert(data);
          location.reload();
        })
        .catch(error => {
          console.error('Error:', error);
          alert('An error occurred while canceling the request.');
        });
      }
    }
  </script>

</body>
</html>
