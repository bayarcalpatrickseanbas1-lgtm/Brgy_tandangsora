<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <title>Login | Barangay Tandang Sora</title>
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
    }

    .wrapper {
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px);
        border-radius: 15px;
        padding: 40px 30px;
        width: 90%;
        max-width: 350px;
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
    input[type=password] {
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
    input[type=password]::placeholder {
        color: rgba(255, 255, 255, 0.7);
    }

    input[type=text]:focus,
    input[type=password]:focus {
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
        margin-top: 10px;
    }

    input[type=submit]:hover {
        background-color: #7a5ab3;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
    }

    .signup-link {
        text-align: center;
        margin-top: 15px;
        font-size: 14px;
    }

    .signup-link a {
        color: #fff;
        text-decoration: none;
        font-weight: 700;
        transition: color 0.3s;
    }

    .signup-link a:hover {
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
        <h1>Login</h1>

        <?php
        if(isset($_GET['error'])) {
            echo '<div class="error">Invalid username or password</div>';
        }
        ?>

        <form action="process_login.php" method="POST">
            <div class="label">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" placeholder="Enter your username" required>
            </div>
            <div class="label">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Enter your password" required>
            </div>
            <input type="submit" value="Login">
        </form>

        <p class="signup-link">Don't have an account? <a href="signup.php">Sign up here</a></p>
    </div>
</body>
</html>