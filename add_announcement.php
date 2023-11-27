<?php
include 'partials/_dbconnect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $announcementText = $_POST['announcement_text'];

    $sql = "INSERT INTO announcements (announcementtext, author) VALUES (?, 'Anonymous')";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $announcementText);

    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => $stmt->error]);
    }

    $stmt->close();
    $conn->close();
}
?>
