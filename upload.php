<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Include your database connection code
    include 'partials/_dbconnect.php';

    // Check if a file was uploaded
    if (isset($_FILES['receipt'])) {
        $file = $_FILES['receipt'];
        $fileName = $file['name'];
        $fileTmpName = $file['tmp_name'];

        // Move the uploaded file to a directory on the server
        $uploadDirectory = "uploads/"; // Ensure this directory exists on your server
        $newFileName = uniqid('', true) . '_' . $fileName;
        $uploadPath = $uploadDirectory . $newFileName;

        if (move_uploaded_file($fileTmpName, $uploadPath)) {
            // Insert file information into the database
            $sql = "INSERT INTO receipts (file_name, file_path) VALUES (?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ss", $fileName, $uploadPath);

            if ($stmt->execute()) {
                $response = [
                    "success" => true,
                    "message" => "Receipt uploaded and stored successfully.",
                    "file_url" => $uploadPath  // Include the file URL in the response
                ];
            } else {
                $response = ["success" => false, "message" => "Failed to store receipt in the database."];
            }
        } else {
            $response = ["success" => false, "message" => "Failed to move the uploaded file."];
        }
    } else {
        $response = ["success" => false, "message" => "No file was uploaded."];
    }

    header('Content-Type: application/json');
    echo json_encode($response);
} else {
    $response = ["success" => false, "message" => "Invalid request."];
    header('Content-Type: application/json');
    echo json_encode($response);
}
?>
