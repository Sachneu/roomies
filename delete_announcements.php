<?php
include 'partials/_dbconnect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $announcementsToDelete = json_decode($_POST['announcementsToDelete'], true);

    if (!empty($announcementsToDelete)) {
        // Use a loop to delete each announcement by its ID
        foreach ($announcementsToDelete as $announcementId) {
            $sql = "DELETE FROM announcements WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $announcementId);
            $stmt->execute();
            $stmt->close();
        }

        // Send JSON response indicating success
        header('Content-Type: application/json');
        echo json_encode(['success' => true]);
    } else {
        // Send JSON response indicating failure (no announcements to delete)
        header('Content-Type: application/json');
        echo json_encode(['success' => false, 'message' => 'No announcements selected for deletion.']);
    }
} else {
    // Send JSON response indicating failure
    header('Content-Type: application/json');
    echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
}

$conn->close();
?>
