<?php
$showAlert= false;
$showError= false;
if ($_SERVER["REQUEST_METHOD"]=="POST"){

include 'partials/_dbconnect.php';

$username = $_POST["username"];
$email = $_POST["email"];
$password = $_POST["password"];
$repassword = $_POST["repassword"];
//$exists=false;

$existSql="SELECT * FROM `users` WHERE username='$username' OR email='$email'"; 

$result=mysqli_query($conn, $existSql);
$numExistRows= mysqli_num_rows ($result);
if ($numExistRows > 0){
   // $exists=true;
   $showError = " Username/email already exists";
}
else{
   // exists = false;
if(($password == $repassword)) {
    $hash = password_hash($password, PASSWORD_DEFAULT);
$sql ="INSERT INTO `users` (  `email`, `username`, `password`, `date`) VALUES ( '$email','$username', '$hash', current_timestamp())";

$result= mysqli_query($conn, $sql);
if ($result){
    $showAlert= true;
  }
}
else{
    $showError = "Passwords do not match ";
}
}
}
?>



<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Signup Page</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<?php require 'partials/_nav3.php' ?>
<?php 
if($showAlert){
echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Success</strong> Your Account is successfully created and you can login.
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div> ';
}
if($showError){
    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
      <strong>Error!!</strong> '. $showError.'
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div> ';
    }
?>
    <div class="login-container">
        <h2 class="wroom"> Welcome Roomies!!</h2>
        <form action="/login2/signup.php" method="post">

           

            <div class="form-group">
             
              <input type="email" id="email" name="email" placeholder="Email" required>
          </div>

            <div class="form-group">
                
                <input type="text" maxlength="11" id="username" name="username" placeholder="Username" required>
            </div>

            <div class="form-group">
                
                <input type="password" maxlength="23" id="password" name="password" placeholder="Password" required>
            </div>

            <div class="form-group">
              
              <input type="password" maxlength="23" id="repassword" name="repassword" placeholder="Re-enter Password" required>
              <small id="emailHelp" class="form-text"> Make sure to type Same Password </small>
          </div>

           
          <div class="form-group" >
                <button type="submit" class="login-button" > Sign Up </button>
                </div>
        </form>
    </div>
</body>
</html>
