<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !=true ){
header("location:login.php");
exit;
}



?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <style>
        .container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            margin: 10px;
        }

        .block {
            flex-basis: calc(33.33% - 10px); /* Three columns with some spacing */
            margin-bottom: 10px;
        }

        .block h2 {
            background-color: #fff; 
            color:#027b3c;
            padding: 10px;
            align-items: center;
            border-radius: 0.35em;
            border: 1px solid #848c94;
        }

        .block h2:hover{
            background-color: #027b3c; /* UNT green */
            color: #fff;
            padding: 10px;
            align-items: center;
            border-radius: 0.35em;
            border: 1px solid #1d5da5;
        }

        .block a {
            text-decoration: none;
            color: #00853E; /* UNT green */
        }

        .block p {
            background-color: #eee;
            padding: 10px;
        }

        .grocery-list {
            list-style: none;
            padding: 0;
        }

        .grocery-list li {
            margin: 5px 0;
        }

        input[type="text"] {
            width: 100%;
        }

        .block {
        text-align: center;
    }
    

    .block i {
        font-size: 36px; /* Adjust the size as needed */
        margin: 50px auto; /* Center the icon horizontally */
        display: block;
    }
    @media (max-width: 768px) {
    .block {
        flex-basis: 100%; /* Full width on small screens */
    }
}

    </style>
</head>
<body>
<?php require 'partials/_nav2.php' ?>
    
    <div class="container">
        <a href="announcements.php">
        <div class="block">
            <h2><i class="fas fa-bullhorn"></i> Announcements</h2>
</a>
        </div>

        <a href="grocerylist.php">
        <div class="block">
            <h2><i class="fas fa-shopping-cart"></i>   Grocery List</h2>
</a>
  </div>

  <a href="choremanagement.php">
        <div class="block">
            <h2> <i class="fas fa-tasks"> </i> Chore Management</h2>
            </a>
        </div>

    </div>

    <div class="container">
    <a href="splitbills.php">
        <div class="block">
            <h2><i class="fas fa-money-bill"></i>    Split Bills</h2>
</a>
        </div>

        <div class="block">
        <a href="uploadreceipt.php">
            <h2><i class="fas fa-upload"></i>Upload Receipts</h2>
</a>
        </div>
        <a href="userprofile.php">
        <div class="block">
            <h2><i class="fas fa-user"></i>User Profile</h2>
</a>
        </div>
    </div>
    
</body>
</html>
