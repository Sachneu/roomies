<!DOCTYPE html>
<html lang="en">
<head>
    <title>Announcement List</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
        }

        .announcement-list {
            list-style-type: none;
            padding: 0;
        }

        .announcement-item {
            display: flex;
            align-items: center;
            background-color: #f9f9f9;
            padding: 10px;
            margin: 5px 0;
            border-radius: 5px;
        }

        .announcement-item input[type="checkbox"] {
            margin-right: 10px;
        }

        .add-announcement {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }

        .add-announcement input[type="text"] {
            width: 70%;
            padding: 5px;
        }

        .button-container {
            display: flex;
            gap: 10px;
        }

        .green-button, .red-button {
            flex: 1;
            padding: 10px;
            text-align: center;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s, color 0.3s;
        }

        .red-button:hover {
            background-color: darkred;
        }

        .green-button {
            background-color: green;
            color: #fff;
            margin-left: 10px;
        }

        .red-button {
            background-color: red;
            color: #fff;
        }
    </style>
</head>
<body>
    <?php require 'partials/_nav2.php'; ?>
    <div id="container-wrapper">
        <div class="container">
            <h1>Announcement List</h1>
            <ul class="announcement-list">
                <?php
                include 'partials/_dbconnect.php';

                $sql = "SELECT * FROM announcements";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo '<li class="announcement-item">';
                        echo '<input type="checkbox" data-announcement-id="' . htmlspecialchars($row["id"]) . '">';
                        //echo '<strong>Author:</strong> ' . htmlspecialchars($row["author"]) . ' ';
                        echo ' ' . htmlspecialchars($row["announcementtext"]);
                        echo '</li>';
                    }
                } else {
                    echo '<p>No announcements available.</p>';
                }

                $conn->close();
                ?>
            </ul>

            <div class="add-announcement">
                <input type="text" id="new-announcement" name="new-announcement" placeholder="Add a new announcement">
                
                <div class="button-container">
                    <button id="add-announcement-button" class="green-button">Add Announcement</button>
                    <button id="delete-announcement-button" class="red-button">Delete Announcement</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('add-announcement-button').addEventListener('click', async () => {
            const newAnnouncement = document.getElementById('new-announcement').value;

            try {
                const response = await fetch('add_announcement.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: `announcement_text=${encodeURIComponent(newAnnouncement)}`,
                });

                if (response.ok) {
                    const data = await response.json();
                    if (data.success) {
                        window.location.reload();
                    } else {
                        console.error(data.message);
                    }
                } else {
                    console.error('Failed to add announcement.');
                }
            } catch (error) {
                console.error('Error:', error);
            }
        });

        document.getElementById('delete-announcement-button').addEventListener('click', async () => {
            const checkedCheckboxes = document.querySelectorAll('input[type="checkbox"]:checked');
            const announcementsToDelete = Array.from(checkedCheckboxes).map(checkbox => checkbox.getAttribute('data-announcement-id'));

            try {
                const response = await fetch('delete_announcements.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: `announcementsToDelete=${JSON.stringify(announcementsToDelete)}`,
                });

                if (response.ok) {
                    const data = await response.json();
                    if (data.success) {
                        window.location.reload();
                    } else {
                        console.error(data.message);
                    }
                } else {
                    console.error('Failed to delete announcements.');
                }
            } catch (error) {
                console.error('Error:', error);
            }
        });

      
        
    </script>
</body>
</html>
