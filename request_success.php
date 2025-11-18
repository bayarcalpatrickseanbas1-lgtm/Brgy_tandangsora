<?php 
include('session_check.php');

if(!isset($_GET['reference'])) {
    header("Location: residents-dashboard-page.php");
    exit();
}

$reference = htmlspecialchars($_GET['reference']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Request Submitted | Barangay Tandang Sora</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
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
            justify-content: center;
            align-items: center;
            padding: 20px;
        }
        .success-container {
            background: white;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
            padding: 60px 40px;
            max-width: 600px;
            text-align: center;
        }
        .success-icon {
            font-size: 80px;
            color: #22c55e;
            margin-bottom: 20px;
            animation: scaleIn 0.6s ease;
        }
        .success-container h1 {
            color: #01497c;
            font-size: 28px;
            margin-bottom: 15px;
            font-weight: 800;
        }
        .success-container p {
            color: #555;
            font-size: 16px;
            line-height: 1.6;
            margin-bottom: 20px;
        }
        .reference-box {
            background: #f0f7ff;
            border: 2px solid #01497c;
            border-radius: 12px;
            padding: 20px;
            margin: 30px 0;
            text-align: center;
        }
        .reference-label {
            color: #666;
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 8px;
        }
        .reference-number {
            color: #01497c;
            font-size: 32px;
            font-weight: 800;
            font-family: "Courier New", monospace;
            letter-spacing: 2px;
        }
        .action-buttons {
            display: flex;
            gap: 15px;
            justify-content: center;
            margin-top: 30px;
        }
        .btn {
            padding: 12px 30px;
            border-radius: 8px;
            border: none;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            text-decoration: none;
            display: inline-block;
            font-size: 15px;
        }
        .btn-primary {
            background: #01497c;
            color: white;
        }
        .btn-primary:hover {
            background: #013a63;
            transform: translateY(-2px);
        }
        .btn-secondary {
            background: #e0e0e0;
            color: #333;
        }
        .btn-secondary:hover {
            background: #d0d0d0;
            transform: translateY(-2px);
        }
        .info-section {
            background: #fffacd;
            border-left: 4px solid #ffc107;
            padding: 15px;
            border-radius: 8px;
            margin-top: 25px;
            text-align: left;
        }
        .info-section h3 {
            color: #856404;
            font-size: 16px;
            margin-bottom: 10px;
        }
        .info-section p {
            color: #856404;
            font-size: 14px;
            margin-bottom: 8px;
        }
        @keyframes scaleIn {
            from {
                transform: scale(0.8);
                opacity: 0;
            }
            to {
                transform: scale(1);
                opacity: 1;
            }
        }
    </style>
</head>
<body>
    <div class="success-container">
        <div class="success-icon">
            <i class="fa-solid fa-circle-check"></i>
        </div>
        
        <h1>Request Successfully Submitted!</h1>
        
        <p>Your barangay document request has been received and is now being processed. You can track the status of your request using your reference number below.</p>
        
        <div class="reference-box">
            <div class="reference-label">Your Reference Number</div>
            <div class="reference-number"><?php echo $reference; ?></div>
        </div>

        <div class="info-section">
            <h3><i class="fa-solid fa-info-circle"></i> Important Information</h3>
            <p><strong>• Save your reference number:</strong> You'll need this to track your request status</p>
            <p><strong>• Processing time:</strong> Requests are typically processed within 3-5 business days</p>
            <p><strong>• Notification:</strong> You will be notified via email once your document is ready for pickup</p>
            <p><strong>• Pickup location:</strong> Barangay Tandang Sora Hall</p>
        </div>
        
        <div class="action-buttons">
            <a href="track.php" class="btn btn-primary">
                <i class="fa-solid fa-location-arrow"></i> Track Request
            </a>
            <a href="residents-dashboard-page.php" class="btn btn-secondary">
                <i class="fa-solid fa-home"></i> Back to Dashboard
            </a>
        </div>
    </div>
</body>
</html>