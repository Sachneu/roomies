<!DOCTYPE html>
<html>
<head>
    
    <title>Reset Password</title>
    <!-- Add your CSS styling here -->
    <style>
        /* Add your CSS styles for the reset password page here */
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
        }
        .reset-container {
            background-color: #fff;
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .form-group {
            margin-bottom: 20px;
        }
        label {
            display: block;
            font-weight: bold;
        }
        input[type="email"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .reset-button {
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            cursor: pointer;
        }
    </style>
</head>
<body>
<?php require 'partials/_nav2.php' ?>
<?php
// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include 'partials/_dbconnect.php';

    $email = $_POST["email"];

    // Check if the email exists in your database
    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {
        // Generate a unique token and store it in the database
        $token = bin2hex(random_bytes(32)); // Generate a random token
        $expiration = date("Y-m-d H:i:s", strtotime("+1 hour")); // Set an expiration time

        $updateTokenSql = "UPDATE users SET reset_token='$token', reset_expiration='$expiration' WHERE email='$email'";
        mysqli_query($conn, $updateTokenSql);

        // Send an email with a link containing the token
        $resetLink = "http://localhost/login2/reset_pw.php?token=$token";
        $to = $email;
        $subject = "Password Reset Link";
        $message = "Click the following link to reset your password: $resetLink";
        $headers = "From: your-email@example.com";
        
        mail($to, $subject, $message, $headers);
        
        echo "Check your email for a password reset link.";
    } else {
        echo "Email not found in our database.";
    }
}
?>
    <div class="reset-container">
        <h2>Reset Password</h2>
        <form action="reset-password-process.php" method="post">
            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <button type="submit" class="reset-button">Reset Password</button>
            </div>
        </form>
    </div>
</body>
</html>
