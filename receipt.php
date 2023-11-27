<?php

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  include 'partials/_dbconnect.php';
// Check if the form was submitted
if (isset($_POST['submit'])) {
  // Handle file upload
  $file = $_FILES['receipt'];
  $fileName = $file['name'];
  $fileTmpName = $file['tmp_name'];

  // Move the uploaded file to a directory on the server
  $uploadDirectory = "uploads/"; // Create this directory on your server
  $newFileName = uniqid('', true) . '_' . $fileName;
  $uploadPath = $uploadDirectory . $newFileName;

  if (move_uploaded_file($fileTmpName, $uploadPath)) {
      // Insert file information into the database
      $sql = "INSERT INTO receipts (file_name, file_path) VALUES (?, ?)";
      $stmt = $conn->prepare($sql);
      $stmt->bind_param("ss", $fileName, $uploadPath);

      if ($stmt->execute()) {
          echo "Receipt uploaded and stored successfully.";
      } else {
          echo "Error: Failed to store receipt in the database.";
      }
  } else {
      echo "Error: Failed to move the uploaded file.";
  }

}
?>