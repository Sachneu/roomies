<?php
$login= false;
$showError= false;
if ($_SERVER["REQUEST_METHOD"]=="POST"){

include 'partials/_dbconnect.php';

$username = $_POST["username"];

$password = $_POST["password"];



// $sql ="SELECT * from users WHERE username='$username' AND password= '$password'";
$sql ="SELECT * from users WHERE username='$username'";
$result =mysqli_query($conn,$sql);
$num= mysqli_num_rows($result);

if ($num==1){
    while($row=mysqli_fetch_assoc($result)){
        if (password_verify($password, $row['password'])){
            $login=true;
            session_start();
        
    $_SESSION['loggedin']=true;
    $_SESSION['username']=$username;
    header("location:welcome.php");
        }
        else{
            $showError = "Invalid credentials";
        }
    }
}
else{
    $showError = "Invalid credentials";
}
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login Page</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <style>
        .password-toggle {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
        }

        <>
    .password-toggle {
        position: absolute;
        right: 10px;
        top: 50%;
        transform: translateY(-50%);
        cursor: pointer;
    }
    @media (max-width: 768px) {
        .login-container {
            max-width: 100%;
            padding: 15px;
        }

        .form-group input[type="text"],
        .form-group input[type="password"],
        .form-group input[type="email"],
        .form-group select {
            width: 100%;
        }

        /* Additional styling for smaller screens */
        .remember-me {
            text-align: center;
            margin-top: 10px;
        }
    }
    /* Add error class for red border */
   
    .form-group input[type="text"],
.form-group input[type="password"],
.form-group input[type="email"],
.form-group select {
    width: 100%;
    padding: 10px;
    margin: 0;
    border: 1px solid #ccc;
    border-radius: 5px;
    transition: border 0.3s ease;
    box-sizing: border-box; /* Ensure consistent box sizing */
}

/* Add a red border for input fields when there's an error */
.form-group.error input[type="text"],
.form-group.error input[type="password"],
.form-group.error input[type="email"],
.form-group.error select {
    border: 1px solid red;
}
    </style>
</head>
<body>
    <?php require 'partials/_nav.php' ?>

    <?php
     
     $showError = false; // Initialize $showError to false
 
     if ($_SERVER["REQUEST_METHOD"] == "POST") {
         include 'partials/_dbconnect.php';
 
         $username = $_POST["username"];
         $password = $_POST["password"];
 
         $sql = "SELECT * FROM users WHERE username='$username'";
         $result = mysqli_query($conn, $sql);
         $num = mysqli_num_rows($result);
 
         if ($num == 1) {
             while ($row = mysqli_fetch_assoc($result)) {
                 if (password_verify($password, $row['password'])) {
                     // Successful login
                     // ...
                 } else {
                     // Incorrect password
                     $showError = true; // Set $showError to true
                 }
             }
         } else {
             // Incorrect username
             $showError = true; // Set $showError to true
         }
     }
     ?>
 
    
    
    <div class="login-container">
        
        <form action="/login2/login.php" method="post">
        <div class="form-group <?php if ($showError) echo 'error'; ?>">
    <input type="text" id="username" name="username" placeholder="Username" autocomplete="username" required>
        </div>

      <div class="form-group <?php if ($showError) echo 'error'; ?>">
    <input type="password" id="password" name="password" placeholder="Password" autocomplete="current-password" required>
</div>
            
            <div class="form-group">
                <label class="remember-me">
                    <input type="checkbox" name="remember"> Remember Me
                </label>
                <a href="reset-pw.php">Forget Password</a>
            </div>
            <div class="form-group">
                <button type="submit" class="login-button"> Login </button>
            </div>
        </form>
    </div>

    <script>
        function togglePasswordVisibility() {
            const passwordField = document.getElementById("password");
            const toggleButton = document.getElementById("togglePassword");

            if (passwordField.type === "password") {
                passwordField.type = "text";
                toggleButton.innerHTML = "👀";
            } else {
                passwordField.type = "password";
                toggleButton.innerHTML = "👁";
            }
        }

        // JavaScript function to open the popup with a message
       
    </script>
</body>
</html>

