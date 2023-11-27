<!DOCTYPE html>
<html>
<head>
    <title>View Receipts</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
        }

        .receipts-list {
            list-style-type: none;
            padding: 0;
        }

        .receipt-item {
            display: flex;
            align-items: center;
            background-color: #f9f9f9;
            padding: 10px;
            margin: 5px 0;
            border-radius: 5px;
        }

        .receipt-item a {
            text-decoration: none;
            color: #007BFF;
            margin-right: 10px;
        }
    </style>
</head>
<body>
<?php require 'partials/_nav2.php' ?>
    <div class="container">
        <h1>View Receipts</h1>
        <ul class="receipts-list" id="receiptsList">
            <?php
            // Include your database connection code
            include 'partials/_dbconnect.php';

            // Fetch receipts from your database
            $sql = "SELECT * FROM receipts";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '<li class="receipt-item">';
                    echo '<a href="' . $row["file_path"] . '">' . $row["file_name"] . '</a>';
                    echo '</li>';
                }
            } else {
                echo '<p>No receipts available.</p>';
            }

            // Close the database connection
            $conn->close();
            ?>
        </ul>
    </div>
</body>
</html>
