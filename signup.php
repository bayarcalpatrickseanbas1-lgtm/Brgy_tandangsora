<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <title>Sign Up | Barangay Tandang Sora</title>
</head>
<style>
    * {
        padding: 0;
        margin: 0;
        box-sizing: border-box;
    }

    body {
        color: white;
        font-family: Montserrat;
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(135deg, #69698f, #986cf4);
        padding: 20px;
    }

    .wrapper {
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px);
        border-radius: 15px;
        padding: 40px 30px;
        width: 90%;
        max-width: 400px;
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.2);
    }

    .wrapper h1 {
        text-align: center;
        font-size: 28px;
        margin-bottom: 25px;
        font-weight: 700;
    }

    .label {
        margin-bottom: 15px;
    }

    label {
        display: block;
        margin-bottom: 5px;
        font-weight: 600;
        font-size: 14px;
    }

    input[type=text],
    input[type=email],
    input[type=password],
    input[type=date] {
        width: 100%;
        padding: 10px 12px;
        border: 1px solid rgba(255, 255, 255, 0.3);
        border-radius: 8px;
        background: rgba(255, 255, 255, 0.2);
        color: white;
        font-size: 14px;
        transition: all 0.3s;
    }

    input[type=text]::placeholder,
    input[type=email]::placeholder,
    input[type=password]::placeholder {
        color: rgba(255, 255, 255, 0.7);
    }

    input[type=text]:focus,
    input[type=email]:focus,
    input[type=password]:focus,
    input[type=date]:focus {
        outline: none;
        background: rgba(255, 255, 255, 0.3);
        border-color: white;
    }

    input[type=submit] {
        width: 100%;
        padding: 12px 20px;
        border-radius: 8px;
        background-color: #986cf4;
        color: white;
        border: none;
        font-weight: 600;
        font-size: 15px;
        cursor: pointer;
        transition: all 0.3s;
        margin-top: 15px;
    }

    input[type=submit]:hover {
        background-color: #7a5ab3;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
    }

    .login-link {
        text-align: center;
        margin-top: 15px;
        font-size: 14px;
    }

    .login-link a {
        color: #fff;
        text-decoration: none;
        font-weight: 700;
        transition: color 0.3s;
    }

    .login-link a:hover {
        color: #d6d0ff;
        text-decoration: underline;
    }

    .error {
        background: rgba(220, 53, 69, 0.8);
        color: white;
        padding: 12px;
        border-radius: 8px;
        margin-bottom: 15px;
        font-size: 14px;
        text-align: center;
    }
</style>
<body>
    <div class="wrapper">
        <h1>Sign Up</h1>

        <?php
        if(isset($_GET['error'])) {
            $error = $_GET['error'];
            if($error == 'username_exists') {
                echo '<div class="error">Username already exists</div>';
            } elseif($error == 'passwords_mismatch') {
                echo '<div class="error">Passwords do not match</div>';
            } elseif($error == 'all_fields') {
                echo '<div class="error">Please fill all fields</div>';
            } elseif($error == 'db_error') {
                echo '<div class="error">Database error. Please try again.</div>';
            }
        }
        ?>

        <form action="process_signup.php" method="POST">
            <div class="label">
                <label for="firstname">First Name</label>
                <input type="text" id="firstname" name="FirstName" placeholder="Enter first name" required>
            </div>
            <div class="label">
                <label for="surname">Surname</label>
                <input type="text" id="surname" name="Surname" placeholder="Enter surname" required>
            </div>
            <div class="label">
                <label for="address">Address</label>
                <input type="text" id="address" name="Address" placeholder="Enter address" required>
            </div>
            <div class="label">
                <label for="birthday">Birthday</label>
                <input type="date" id="birthday" name="Birthday" required>
            </div>
            <div class="label">
                <label for="contact">Contact Number</label>
                <input type="text" id="contact" name="ContactNumber" placeholder="Enter contact number" required>
            </div>
            <div class="label">
                <label for="email">Email</label>
                <input type="email" id="email" name="Email" placeholder="Enter email" required>
            </div>
            <div class="label">
                <label for="username">Username</label>
                <input type="text" id="username" name="Username" placeholder="Enter username" required>
            </div>
            <div class="label">
                <label for="password">Password</label>
                <input type="password" id="password" name="Password" placeholder="Enter password" required>
            </div>
            <div class="label">
                <label for="confirm_password">Confirm Password</label>
                <input type="password" id="confirm_password" name="ConfirmPassword" placeholder="Confirm password" required>
            </div>
            <input type="submit" value="Sign Up">
        </form>

        <p class="login-link">Already have an account? <a href="login.php">Log in here</a></p>
    </div>
</body>
</html>