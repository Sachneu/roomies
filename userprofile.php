<!DOCTYPE html>
<html>
<head>
    <title>User Profile</title>
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

        .user-profile {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .user-info {
            margin: 10px 0;
        }

        .edit-button {
            background-color: #007BFF;
            color: #fff;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
        }

        .edit-form {
            display: none;
        }

        .apartment-mates {
            margin-top: 20px;
        }
    </style>
</head>
<body>
<?php require 'partials/_nav2.php' ?>
    <div class="container">
        <h1>User Profile</h1>
        <div class="user-profile">
            <div class="user-info">
                <label for="userName">Name:</label>
                <span id="userName">John Doe</span>
            </div>
            <div class="user-info">
                <label for="apartmentNumber">Apartment Number:</label>
                <span id="apartmentNumber">A-123</span>
            </div>
            <div class="user-info">
                <label for="email">Email:</label>
                <span id="email">john@example.com</span>
            </div>
            <button class="edit-button" id="editButton">Edit Profile</button>
            <form class="edit-form" id="editForm">
                <div class="user-info">
                    <label for="newName">Name:</label>
                    <input type="text" id="newName">
                </div>
                <div class="user-info">
                    <label for="newApartmentNumber">Apartment Number:</label>
                    <input type="text" id="newApartmentNumber">
                </div>
                <div class="user-info">
                    <label for="newEmail">Email:</label>
                    <input type="email" id="newEmail">
                </div>
                <button id="saveButton">Save Changes</button>
            </form>
            
            <div class="apartment-mates">
                <label for="matesList">Apartment Mates:</label>
                <ul id="matesList">
                    <li>Apartment Mate 1</li>
                    <li>Apartment Mate 2</li>
                    <li>Apartment Mate 3</li>
                </ul>
            </div>
        </div>
    </div>

    <script>
        const editButton = document.getElementById('editButton');
        const editForm = document.getElementById('editForm');
        const saveButton = document.getElementById('saveButton');

        editButton.addEventListener('click', () => {
            // Show the edit form and hide the user info
            editForm.style.display = 'block';
            document.querySelectorAll('.user-info').forEach(info => info.style.display = 'none');
        });

        saveButton.addEventListener('click', () => {
            // Save the edited information and update the user profile
            const newName = document.getElementById('newName').value;
            const newApartmentNumber = document.getElementById('newApartmentNumber').value;
            const newEmail = document.getElementById('newEmail').value;

            document.getElementById('userName').textContent = newName;
            document.getElementById('apartmentNumber').textContent = newApartmentNumber;
            document.getElementById('email').textContent = newEmail;

            // Hide the edit form and show the updated user info
            editForm.style display = 'none';
            document.querySelectorAll('.user-info').forEach(info => info.style.display = 'block');
        });
    </script>
</body>
</html>
