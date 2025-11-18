<?php include('session_check.php'); ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Request Document | Barangay Tandang Sora</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>
      $( function() {
        $( "#birthdate" ).datepicker({
          dateFormat: "mm/dd/yy"
        });
      } );
    </script>
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
      .form-container {
        background-color: white;
        border-radius: 20px;
        box-shadow: 0 6px 18px rgba(0,0,0,0.1);
        padding: 35px 40px;
        width: 100%;
        max-width: 850px;
        margin: 0 auto;
      }
      .form-container h2 {
        color: var(--sidebar-color);
        margin-bottom: 20px;
        text-align: center;
      }
      form {
        display: flex;
        flex-direction: column;
        gap: 25px;
      }
      .form-group {
        display: flex;
        flex-direction: column;
      }
      label {
        font-weight: 600;
        margin-bottom: 6px;
        color: #333;
      }
      .required {
        color: red;
      }
      input, select, textarea {
        padding: 12px 14px;
        border: 1.5px solid #d0d7de;
        border-radius: 10px;
        font-size: 15px;
        transition: border 0.3s;
      }
      input:focus, select:focus, textarea:focus {
        border-color: var(--sidebar-color);
        outline: none;
      }
      .row {
        display: flex;
        gap: 20px;
      }
      .row .form-group {
        flex: 1;
      }
      textarea {
        resize: none;
        height: 100px;
      }
      .id-upload {
        display: flex;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 20px;
      }
      .id-box {
        flex: 1;
        min-width: 200px;
        background: #f5faff;
        border: 2px dashed #b5d2e8;
        border-radius: 12px;
        padding: 20px;
        text-align: center;
        cursor: pointer;
        transition: all 0.3s;
        position: relative;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
      }
      .id-box:hover {
        background: #e9f4fb;
        border-color: var(--sidebar-color);
      }
      .id-box i {
        font-size: 40px;
        color: var(--sidebar-color);
        margin-bottom: 10px;
      }
      .id-box p {
        margin: 0;
      }
      .id-box img {
        max-width: 100%;
        height: 120px;
        object-fit: cover;
        border-radius: 10px;
        display: none;
        margin-top: 10px;
      }
      .submit-btn {
        background-color: var(--sidebar-color);
        color: white;
        border: none;
        padding: 14px;
        font-size: 16px;
        border-radius: 12px;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.3s ease;
      }
      .submit-btn:hover {
        background-color: var(--sidebar-hover);
        transform: translateY(-3px);
      }
      .popup-overlay {
        display: none;
        position: fixed;
        inset: 0;
        background: rgba(0, 0, 0, 0.6);
        justify-content: center;
        align-items: center;
        z-index: 999;
        overflow-y: auto;
      }
      .popup {
        background: white;
        padding: 30px 40px;
        border-radius: 15px;
        text-align: center;
        box-shadow: 0 5px 20px rgba(0,0,0,0.2);
        width: 90%;
        max-width: 600px;
        max-height: 90vh;
        overflow-y: auto;
        animation: fadeIn 0.3s ease;
      }
      .popup h3 {
        color: var(--sidebar-color);
        margin-bottom: 15px;
      }
      .popup p {
        color: #333;
        margin-bottom: 10px;
        text-align: left;
      }
      .popup-section {
        background: #f9fcff;
        border-radius: 12px;
        padding: 15px;
        margin-bottom: 15px;
        text-align: left;
      }
      .popup-section h4 {
        color: var(--sidebar-color);
        margin-bottom: 10px;
      }
      .popup img {
        width: 100%;
        border-radius: 10px;
        margin-top: 10px;
        max-height: 200px;
        object-fit: cover;
      }
      .popup button {
        background-color: var(--sidebar-color);
        color: white;
        border: none;
        padding: 10px 25px;
        border-radius: 10px;
        font-weight: 600;
        cursor: pointer;
        transition: 0.3s;
        margin: 5px;
      }
      .popup button:hover {
        background-color: var(--sidebar-hover);
      }
      .success {
        text-align: center;
        padding: 30px;
      }
      .success i {
        font-size: 50px;
        color: #22c55e;
        margin-bottom: 15px;
      }
      @keyframes fadeIn {
        from { transform: scale(0.8); opacity: 0; }
        to { transform: scale(1); opacity: 1; }
      }
    </style>
  </head>
  <body>
    <div class="sidebar">
      <img src="img/tandangSora-logo.svg" alt="Logo">
      <h2>Barangay<br>Tandang Sora</h2>
      <a href="residents-dashboard-page.php"><i class="fa-solid fa-house"></i> Dashboard</a>
      <a href="request.php" class="active"><i class="fa-solid fa-file-lines"></i> Request Document</a>
      <a href="track.php"><i class="fa-solid fa-location-arrow"></i> Track Request</a>
      <a href="profile.php"><i class="fa-solid fa-user"></i> Profile</a>
      <a href="help.php"><i class="fa-solid fa-circle-question"></i> Help</a>
      <a href="logout.php"><i class="fa-solid fa-right-from-bracket"></i> Logout</a>
    </div>

    <div class="main">
      <div class="header">
        <h1><i class="fa-solid fa-file-lines"></i> Request Document</h1>
        <button onclick="window.location.href='residents-dashboard-page.php'"><i class="fa-solid fa-arrow-left"></i> Back</button>
      </div>

      <div class="form-container">
        <h2>Request for Barangay Document</h2>
        <form id="requestForm" method="POST" action="process_request.php" enctype="multipart/form-data">
          <div class="row">
            <div class="form-group">
              <label>Last Name <span class="required">*</span></label>
              <input type="text" name="lastName" id="lastName" placeholder="Enter your last name" required>
            </div>
            <div class="form-group">
              <label>First Name <span class="required">*</span></label>
              <input type="text" name="firstName" id="firstName" placeholder="Enter your first name" required>
            </div>
            <div class="form-group">
              <label>Middle Name</label>
              <input type="text" name="middleName" id="middleName" placeholder="Optional">
            </div>
          </div>

          <div class="row">
            <div class="form-group">
              <label>Birthdate <span class="required">*</span></label>
              <input type="text" id="birthdate" name="birthdate" placeholder="MM/DD/YYYY" required>
            </div>
            <div class="form-group">
              <label>Age <span class="required">*</span></label>
              <input type="number" name="age" id="age" placeholder="Enter your age" required>
            </div>
            <div class="form-group">
              <label>Gender <span class="required">*</span></label>
              <select id="gender" name="gender" required>
                <option value="" disabled selected>Select gender</option>
                <option>Male</option>
                <option>Female</option>
                <option>Other</option>
              </select>
            </div>
          </div>

          <div class="form-group">
            <label>Complete Address <span class="required">*</span></label>
            <input type="text" name="address" id="address" placeholder="Enter your full address" required>
          </div>

          <div class="row">
            <div class="form-group">
              <label>Contact Number <span class="required">*</span></label>
              <input type="text" name="contact" id="contact" placeholder="Enter your contact number" required>
            </div>
            <div class="form-group">
              <label>Email Address <span class="required">*</span></label>
              <input type="email" name="email" id="email" placeholder="Enter your email" required>
            </div>
          </div>

          <div class="form-group">
            <label>Valid ID Type <span class="required">*</span></label>
            <select id="idType" name="idType" required>
              <option value="" disabled selected>Select ID type</option>
              <option>School ID</option>
              <option>Barangay ID</option>
              <option>Voter's ID</option>
              <option>Senior Citizen ID</option>
              <option>PWD ID</option>
              <option>PRC ID</option>
              <option>PhilHealth ID</option>
              <option>Passport</option>
              <option>Driver's Licence</option>
              <option>SSS Card</option>
              <option>UMID Card</option>
            </select>
          </div>

          <div class="form-group">
            <label>Upload Valid ID (Front and Back) <span class="required">*</span></label>
            <div class="id-upload">
              <div class="id-box" onclick="document.getElementById('frontID').click()">
                <i class="fa-solid fa-id-card"></i>
                <p>Upload Front ID</p>
                <input type="file" id="frontID" name="frontID" accept="image/*" style="display:none" required>
                <img id="frontPreview" alt="Front ID Preview">
              </div>
              <div class="id-box" onclick="document.getElementById('backID').click()">
                <i class="fa-regular fa-id-card"></i>
                <p>Upload Back ID</p>
                <input type="file" id="backID" name="backID" accept="image/*" style="display:none" required>
                <img id="backPreview" alt="Back ID Preview">
              </div>
            </div>
          </div>

          <div class="form-group">
            <label>Type of Document <span class="required">*</span></label>
            <select id="documentType" name="documentType" required>
              <option value="" disabled selected>Select document type</option>
              <option>Barangay Clearance</option>
              <option>Certificate of Residency</option>
              <option>Certificate of Indigency</option>
              <option>Business Clearance</option>
            </select>
          </div>

          <div class="form-group">
            <label>Purpose of Request <span class="required">*</span></label>
            <textarea id="purpose" name="purpose" placeholder="Enter purpose of your request..." required></textarea>
          </div>

          <button type="submit" class="submit-btn" id="submitBtn"><i class="fa-solid fa-paper-plane"></i> Submit Request</button>
        </form>
      </div>
    </div>

    <div class="popup-overlay" id="confirmationPopup">
      <div class="popup">
        <h3>Confirm Your Information</h3>
        <div id="confirmationDetails"></div>
        <button id="editBtn">Edit</button>
        <button id="confirmBtn">Confirm Request</button>
      </div>
    </div>

    <script>
      const form = document.getElementById('requestForm');
      const confirmationPopup = document.getElementById('confirmationPopup');
      const editBtn = document.getElementById('editBtn');
      const confirmBtn = document.getElementById('confirmBtn');

      form.addEventListener('submit', e => {
        e.preventDefault();
        
        // Check if images are uploaded
        const frontFile = document.getElementById('frontID').files[0];
        const backFile = document.getElementById('backID').files[0];
        
        if(!frontFile || !backFile) {
          alert('Please upload both front and back ID photos');
          return;
        }

        const data = {
          lastName: document.getElementById('lastName').value,
          firstName: document.getElementById('firstName').value,
          middleName: document.getElementById('middleName').value,
          birthdate: document.getElementById('birthdate').value,
          age: document.getElementById('age').value,
          gender: document.getElementById('gender').value,
          address: document.getElementById('address').value,
          contact: document.getElementById('contact').value,
          email: document.getElementById('email').value,
          idType: document.getElementById('idType').value,
          documentType: document.getElementById('documentType').value,
          purpose: document.getElementById('purpose').value
        };

        const frontPreview = document.getElementById('frontPreview').src;
        const backPreview = document.getElementById('backPreview').src;

        const details = document.getElementById('confirmationDetails');
        details.innerHTML = `
          <div class="popup-section"><h4>Personal Information</h4>
            <p><b>Name:</b> ${data.firstName} ${data.middleName} ${data.lastName}</p>
            <p><b>Birthdate:</b> ${data.birthdate}</p>
            <p><b>Age:</b> ${data.age}</p>
            <p><b>Gender:</b> ${data.gender}</p>
          </div>
          <div class="popup-section"><h4>Contact Information</h4>
            <p><b>Address:</b> ${data.address}</p>
            <p><b>Contact:</b> ${data.contact}</p>
            <p><b>Email:</b> ${data.email}</p>
          </div>
          <div class="popup-section"><h4>Identification</h4>
            <p><b>ID Type:</b> ${data.idType}</p>
            <img src="${frontPreview}" alt="Front ID">
            <img src="${backPreview}" alt="Back ID">
          </div>
          <div class="popup-section"><h4>Request Details</h4>
            <p><b>Document Type:</b> ${data.documentType}</p>
            <p><b>Purpose:</b> ${data.purpose}</p>
          </div>`;
        confirmationPopup.style.display = 'flex';
      });

      editBtn.onclick = () => confirmationPopup.style.display = 'none';
      
      confirmBtn.onclick = () => {
        form.submit();
      };

      document.getElementById('frontID').addEventListener('change', function() {
        const file = this.files[0];
        const preview = document.getElementById('frontPreview');
        if (file) {
          const reader = new FileReader();
          reader.onload = e => {
            preview.src = e.target.result;
            preview.style.display = 'block';
          };
          reader.readAsDataURL(file);
        }
      });
      
      document.getElementById('backID').addEventListener('change', function() {
        const file = this.files[0];
        const preview = document.getElementById('backPreview');
        if (file) {
          const reader = new FileReader();
          reader.onload = e => {
            preview.src = e.target.result;
            preview.style.display = 'block';
          };
          reader.readAsDataURL(file);
        }
      });
    </script>
  </body>
</html>