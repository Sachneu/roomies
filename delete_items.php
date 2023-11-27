<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    include 'partials/_dbconnect.php';

    // Check if the 'itemsToDelete' key exists in the POST data
    if (isset($_POST['itemsToDelete'])) {
        $itemsToDelete = json_decode($_POST['itemsToDelete'], true);

        if (is_array($itemsToDelete) && !empty($itemsToDelete)) {
            // Sanitize and validate item numbers to prevent SQL injection
            $itemNumbers = implode(',', array_map('intval', $itemsToDelete));

            // Use prepared statements to prevent SQL injection
            $sql = "DELETE FROM grocery WHERE `item-number` IN ($itemNumbers)";
            $stmt = $conn->prepare($sql);

            if ($stmt->execute()) {
                $response = ["success" => true, "message" => "Items deleted successfully."];
            } else {
                $response = ["success" => false, "message" => "Failed to delete items: " . $conn->error];
            }
        } else {
            $response = ["success" => false, "message" => "No items selected for deletion."];
        }
    } else {
        $response = ["success" => false, "message" => "Invalid request. No 'itemsToDelete' in the POST data."];
    }

    header('Content-Type: application/json');
    echo json_encode($response);
} else {
    $response = ["success" => false, "message" => "Invalid request."];
    header('Content-Type: application/json');
    echo json_encode($response);
}

?>
