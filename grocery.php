<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    include 'partials/_dbconnect.php';

    $item_name = $_POST["item_name"]; // Use the correct POST parameter name

    if (!empty($item_name)) {
        // Save the item to the 'grocery' table
        $sql = "INSERT INTO grocery (`item-name`) VALUES (?)"; // Use backticks to specify the column name
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $item_name);

        if ($stmt->execute()) {
            $response = ["success" => true, "message" => "Item added successfully."];
        } else {
            $response = ["success" => false, "message" => "Failed to add item."];
        }
    } else {
        $response = ["success" => false, "message" => "Item cannot be empty."];
    }

    header('Content-Type: application/json'); // Set the response content type to JSON
    echo json_encode($response); // Return the JSON response
} else {
    $response = ["success" => false, "message" => "Invalid request."];
    header('Content-Type: application/json'); // Set the response content type to JSON
    echo json_encode($response); // Return the JSON response
}
?>
