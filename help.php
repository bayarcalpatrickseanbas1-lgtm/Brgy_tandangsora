<?php include('session_check.php'); ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Help | Barangay Tandang Sora</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600;700;800&display=swap" rel="stylesheet">
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

      /* ===== SIDEBAR ===== */
      .sidebar {
        width: 260px;
        background-color: var(--sidebar-color);
        color: white;
        display: flex;
        flex-direction: column;
        align-items: center;
        padding-top: 30px;
        box-shadow: 4px 0 15px rgba(0, 0, 0, 0.15);
        border-radius: 0 20px 20px 0;
        flex-shrink: 0;
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

      /* ===== MAIN CONTENT ===== */
      main {
        flex: 1;
        padding: 60px 80px;
        background-color: #fff;
        overflow-y: auto;
        border-radius: 20px 0 0 20px;
        margin: 20px;
        box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.05);
      }

      .help-heading {
        color: var(--sidebar-color);
        font-size: 30px;
        margin-bottom: 25px;
        font-weight: 800;
        text-align: center;
      }

      .help-panel {
        background: #fff;
        border-radius: 15px;
        border: 2px solid #e9e9ee;
        padding: 40px;
        box-shadow: 0 8px 16px rgba(16, 24, 40, 0.07);
        margin: 0 auto;
        max-width: 850px;
      }

      .help-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 20px;
      }

      .help-tile {
        background: linear-gradient(180deg, #3058f4, #5a7dff);
        border-radius: 10px;
        color: white;
        border: none;
        padding: 18px;
        box-shadow: 0 4px 16px rgba(1, 73, 124, 0.2);
        display: flex;
        align-items: center;
        gap: 16px;
        cursor: pointer;
        text-align: left;
        min-height: 88px;
        font-size: 15px;
        transition: background 0.18s, box-shadow 0.18s, transform 0.11s;
      }

      .help-tile:hover,
      .help-tile:focus {
        background: linear-gradient(180deg, #1f46e0, #3058f4);
        box-shadow: 0 18px 32px rgba(22, 56, 178, 0.24);
        outline: 2px solid #3058f4;
        transform: translateY(-2px) scale(1.03);
      }

      .tile-icon img {
        width: 42px;
        height: 42px;
      }

      .tile-title {
        font-weight: 700;
        letter-spacing: 0.6px;
      }

      .report-row {
        display: flex;
        justify-content: center;
        margin-top: 30px;
      }

      .report-btn {
        background: linear-gradient(180deg, #1f46e0, #3058f4);
        color: white;
        border: none;
        padding: 12px 30px;
        border-radius: 24px;
        font-weight: 700;
        font-size: 17px;
        cursor: pointer;
        box-shadow: 0 4px 16px rgba(1, 73, 124, 0.2);
        transition: background 0.18s, box-shadow 0.18s, transform 0.11s;
      }

      .report-btn:hover,
      .report-btn:focus {
        background: linear-gradient(180deg, #5a7dff, #1f46e0);
        box-shadow: 0 20px 36px rgba(22, 56, 178, 0.19);
        outline: 2px solid #3058f4;
        transform: scale(1.04);
      }

      /* ==== POPUP ==== */
      .popup {
        display: none;
        position: fixed;
        inset: 0;
        background: rgba(0, 0, 0, 0.5);
        justify-content: center;
        align-items: center;
        animation: fadeIn 0.3s ease forwards;
        z-index: 999;
        overflow-y: auto;
      }

      @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
      }

      .popup-content {
        background: #fff;
        padding: 25px 30px;
        border-radius: 15px;
        width: 90%;
        max-width: 600px;
        text-align: left;
        position: relative;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
        margin: auto;
        max-height: 85vh;
        overflow-y: auto;
      }

      .popup-content h2 {
        color: var(--sidebar-color);
        margin-top: 0;
        text-align: center;
        margin-bottom: 20px;
      }

      .close-btn {
        position: absolute;
        top: 10px;
        right: 15px;
        font-size: 20px;
        cursor: pointer;
        color: #555;
      }

      .popup-section {
        margin-bottom: 15px;
      }

      .popup-section h3 {
        color: var(--sidebar-color);
        font-size: 16px;
        margin-bottom: 8px;
      }

      .popup-section p {
        color: #555;
        font-size: 14px;
        line-height: 1.6;
        margin-bottom: 10px;
      }

      .popup-section ul, .popup-section ol {
        margin-left: 20px;
        color: #555;
        font-size: 14px;
        line-height: 1.6;
      }

      .popup-section li {
        margin-bottom: 8px;
      }

      .info-box {
        background: #f0f4ff;
        border-left: 4px solid var(--sidebar-color);
        padding: 12px;
        border-radius: 5px;
        margin: 10px 0;
        font-size: 14px;
        color: #555;
      }

      .in-progress {
        background: #fff3cd;
        border-left: 4px solid #ffc107;
        padding: 12px;
        border-radius: 5px;
        margin: 10px 0;
        font-size: 14px;
        color: #856404;
      }

      /* ==== REPORT FORM ==== */
      .report-form {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 15px;
        margin-top: 10px;
      }

      .report-form .form-group {
        width: 100%;
        max-width: 380px;
        display: flex;
        flex-direction: column;
        text-align: left;
      }

      .report-form label {
        font-weight: 600;
        color: var(--sidebar-color);
        font-size: 14px;
        margin-bottom: 5px;
      }

      .report-form input,
      .report-form textarea {
        width: 100%;
        padding: 10px;
        border-radius: 8px;
        border: 1px solid #ccc;
        font-family: inherit;
        font-size: 14px;
        resize: none;
      }

      .report-form textarea {
        min-height: 100px;
      }

      .report-form .button-row {
        display: flex;
        justify-content: flex-end;
        gap: 10px;
        width: 100%;
        max-width: 380px;
        margin-top: 10px;
      }

      .report-form button {
        padding: 10px 20px;
        border: none;
        border-radius: 20px;
        font-weight: 700;
        cursor: pointer;
        transition: background 0.2s;
      }

      .submit-btn {
        background: linear-gradient(180deg, #1f46e0, #3058f4);
        color: white;
      }

      .submit-btn:hover {
        background: linear-gradient(180deg, #5a7dff, #1f46e0);
      }

      .cancel-btn {
        background: #ddd;
        color: #333;
      }

      .cancel-btn:hover {
        background: #bbb;
      }
    </style>
  </head>

  <body>
    <!-- Sidebar -->
    <div class="sidebar">
      <img src="img/tandangSora-logo.svg" alt="Logo">
      <h2>Barangay<br>Tandang Sora</h2>
      <a href="residents-dashboard-page.php"><i class="fa-solid fa-house"></i> Dashboard</a>
      <a href="request.php"><i class="fa-solid fa-file-lines"></i> Request Document</a>
      <a href="track.php"><i class="fa-solid fa-location-arrow"></i> Track Request</a>
      <a href="profile.php"><i class="fa-solid fa-user"></i> Profile</a>
      <a href="help.php" class="active"><i class="fa-solid fa-circle-question"></i> Help</a>
      <a href="logout.php"><i class="fa-solid fa-right-from-bracket"></i> Logout</a>
    </div>

    <!-- Main Section -->
    <main>
      <h1 class="help-heading">How can we help you?</h1>
      <div class="help-panel">
        <div class="help-grid">
          <button class="help-tile" onclick="openPopup('guidePopup')">
            <div class="tile-icon"><img src="img/step-by-step-icon.svg" alt=""></div>
            <div class="tile-title">STEP-BY-STEP<br>GUIDE</div>
          </button>
          <button class="help-tile" onclick="openPopup('troubleshootPopup')">
            <div class="tile-icon"><img src="img/common-issue-icon.svg" alt=""></div>
            <div class="tile-title">COMMON ISSUE &<br>TROUBLESHOOTING</div>
          </button>
          <button class="help-tile" onclick="openPopup('contactPopup')">
            <div class="tile-icon"><img src="img/contact-help-icon.svg" alt=""></div>
            <div class="tile-title">CONTACT &<br>SUPPORT</div>
          </button>
          <button class="help-tile" onclick="openPopup('faqPopup')">
            <div class="tile-icon"><img src="img/faqs-icon.svg" alt=""></div>
            <div class="tile-title">FAQS</div>
          </button>
        </div>

        <div class="report-row">
          <button class="report-btn" onclick="openPopup('reportPopup')">REPORT AN ISSUE</button>
        </div>
      </div>
    </main>

    <!-- ==== POPUPS ==== -->
    <div id="guidePopup" class="popup">
      <div class="popup-content">
        <span class="close-btn" onclick="closePopup('guidePopup')">&times;</span>
        <h2>Step-by-Step Guide</h2>
        
        <div class="popup-section">
          <h3>How to Request a Document</h3>
          <ol>
            <li><strong>Log in or Sign up</strong> - Create an account if you don't have one yet.</li>
            <li><strong>Navigate to "Request Document"</strong> - Click on the "Request Document" button in the dashboard.</li>
            <li><strong>Fill in Your Information</strong> - Provide your personal details including name, address, contact information, and years of residency.</li>
            <li><strong>Select Document Type</strong> - Choose the type of document you need (Barangay Clearance, Certificate of Residency, etc.).</li>
            <li><strong>Upload Valid ID</strong> - Upload clear photos of your valid ID (front and back).</li>
            <li><strong>State Your Purpose</strong> - Explain why you need the document.</li>
            <li><strong>Review and Submit</strong> - Review your information and click "Submit Request".</li>
            <li><strong>Save Your Reference Number</strong> - You will receive a reference number to track your request.</li>
          </ol>
        </div>

        <div class="popup-section">
          <h3>How to Track Your Request</h3>
          <ol>
            <li><strong>Go to "Track Request"</strong> - Click the "Track Request" button in the dashboard.</li>
            <li><strong>View Your Status</strong> - See all your submitted requests with their current status (Pending, Approved, Completed, or Rejected).</li>
            <li><strong>Check Submission Date</strong> - View when you submitted each request.</li>
            <li><strong>Wait for Updates</strong> - Requests are typically processed within 3-5 business days.</li>
          </ol>
        </div>

        <div class="popup-section">
          <h3>Processing Timeline</h3>
          <p><strong>Typical Processing Time:</strong> 3-5 business days from submission</p>
          <div class="info-box">
            <strong>Note:</strong> Processing time may vary depending on the document type and current workload. You will receive an email notification when your document is ready for pickup.
          </div>
        </div>

        <div class="popup-section">
          <h3>Pickup Instructions</h3>
          <p><strong>Location:</strong> Barangay Tandang Sora Hall<br>
          <strong>Address:</strong> 116 Mindanao Avenue, Tandang Sora, Quezon City<br>
          <strong>Office Hours:</strong> Monday to Friday, 8:00 AM to 5:00 PM</p>
          <p>Please bring your valid ID when picking up your document.</p>
        </div>
      </div>
    </div>

    <div id="troubleshootPopup" class="popup">
      <div class="popup-content">
        <span class="close-btn" onclick="closePopup('troubleshootPopup')">&times;</span>
        <h2>Common Issues & Troubleshooting</h2>
        
        <div class="in-progress">
          <strong><i class="fa-solid fa-hammer"></i> In Progress</strong><br>
          This module is currently under development as the website is still in the deployment phase.
        </div>

        <div class="popup-section">
          <h3>Experiencing Issues?</h3>
          <p>If you encounter any problems while using this service, we're here to help!</p>
          <p>We encourage you to use the <strong>"Report an Issue"</strong> button to inform us of any technical problems or concerns you face. This helps us improve the system and address issues more quickly.</p>
        </div>

        <div class="popup-section">
          <h3>How to Report an Issue</h3>
          <ol>
            <li>Click on the <strong>"REPORT AN ISSUE"</strong> button at the bottom of the Help page.</li>
            <li>Provide your name and email address.</li>
            <li>Describe the issue or problem in detail.</li>
            <li>Click "Submit" to send your report to our support team.</li>
            <li>Our team will review your report and contact you as soon as possible.</li>
          </ol>
        </div>

        <div class="info-box">
          <strong>Quick Tips:</strong><br>
          • Make sure your browser is up-to-date<br>
          • Clear your browser cache if pages don't load correctly<br>
          • Use a stable internet connection<br>
          • Upload clear photos of your ID documents
        </div>
      </div>
    </div>

    <div id="contactPopup" class="popup">
      <div class="popup-content">
        <span class="close-btn" onclick="closePopup('contactPopup')">&times;</span>
        <h2>Contact & Support</h2>
        
        <div class="popup-section">
          <h3>Barangay Tandang Sora</h3>
          <p><strong>Address:</strong><br>
          116 Mindanao Avenue, Tandang Sora Barangay Hall<br>
          Quezon City, Philippines 1107</p>
        </div>

        <div class="popup-section">
          <h3>Contact Information</h3>
          <p><strong>Hotline:</strong> (02) 9295-1324 / 09295-132453<br>
          <strong>Email:</strong> barangay.tandangsora@quezon.gov.ph<br>
          <strong>Emergency:</strong> 911</p>
        </div>

        <div class="popup-section">
          <h3>Office Hours</h3>
          <p><strong>Monday to Friday:</strong> 8:00 AM - 5:00 PM<br>
          <strong>Saturday:</strong> 8:00 AM - 12:00 PM<br>
          <strong>Sunday & Holidays:</strong> Closed</p>
        </div>

        <div class="popup-section">
          <h3>Document Pickup</h3>
          <p>Approved documents can be picked up during office hours at the Barangay Hall. Please bring your valid ID and reference number when picking up.</p>
        </div>

        <div class="info-box">
          <strong>Support Hours:</strong> We are available during office hours to answer your inquiries and assist with your document requests.
        </div>
      </div>
    </div>

    <div id="faqPopup" class="popup">
      <div class="popup-content">
        <span class="close-btn" onclick="closePopup('faqPopup')">&times;</span>
        <h2>Frequently Asked Questions</h2>
        
        <div class="popup-section">
          <h3>What documents can I request?</h3>
          <p>You can request the following documents through this system:</p>
          <ul>
            <li>Barangay Clearance</li>
            <li>Certificate of Residency</li>
            <li>Certificate of Indigency</li>
            <li>Business Clearance</li>
          </ul>
        </div>

        <div class="popup-section">
          <h3>How long does it take to process a request?</h3>
          <p>Requests are typically processed within 3-5 business days. You will be notified via email once your document is ready for pickup.</p>
        </div>

        <div class="popup-section">
          <h3>Do I need to pay a fee for the documents?</h3>
          <p>Please contact the Barangay Hall directly for information about processing fees and payment methods.</p>
        </div>

        <div class="popup-section">
          <h3>What ID documents are accepted?</h3>
          <p>Accepted valid IDs include:</p>
          <ul>
            <li>PhilSys (PSN)</li>
            <li>Driver's License</li>
            <li>Passport</li>
            <li>UMID</li>
            <li>Voter's ID</li>
            <li>QCID</li>
          </ul>
        </div>

        <div class="popup-section">
          <h3>Can I cancel or modify my request?</h3>
          <p>For cancellations or modifications, please contact the Barangay Hall directly during office hours.</p>
        </div>

        <div class="popup-section">
          <h3>What if I forgot my password?</h3>
          <p>You will need to contact the support team or visit the Barangay Hall for assistance with password recovery.</p>
        </div>
      </div>
    </div>

    <div id="reportPopup" class="popup">
      <div class="popup-content">
        <span class="close-btn" onclick="closePopup('reportPopup')">&times;</span>
        <h2>Report an Issue</h2>
        <form class="report-form" action="process_report.php" method="POST">
          <div class="form-group">
            <label for="reportName">Name</label>
            <input type="text" id="reportName" name="name" placeholder="Enter your full name" required>
          </div>
          <div class="form-group">
            <label for="reportEmail">Email</label>
            <input type="email" id="reportEmail" name="email" placeholder="Enter your email" required>
          </div>
          <div class="form-group">
            <label for="reportMessage">Message</label>
            <textarea id="reportMessage" name="message" placeholder="Describe your issue in detail..." required></textarea>
          </div>
          <div class="button-row">
            <button type="button" class="cancel-btn" onclick="closePopup('reportPopup')">Cancel</button>
            <button type="submit" class="submit-btn">Submit</button>
          </div>
        </form>
      </div>
    </div>

    <script>
      function openPopup(id) {
        document.getElementById(id).style.display = "flex";
      }

      function closePopup(id) {
        document.getElementById(id).style.display = "none";
      }

      window.onclick = function(event) {
        if (event.target.classList.contains('popup')) {
          event.target.style.display = "none";
        }
      }
    </script>
  </body>
</html>