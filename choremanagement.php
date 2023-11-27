<!DOCTYPE html>
<html>
<head>
    <title>Chore Management</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
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

        .chore-list {
            list-style-type: none;
            padding: 0;
        }

        .chore-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #f9f9f9;
            padding: 10px;
            margin: 5px 0;
            border-radius: 5px;
        }

        .chore-description {
            flex: 1;
        }

        .completed-section {
            margin-top: 20px;
            border-top: 1px solid #ddd;
            padding-top: 10px;
        }

        .completed-chore {
            display: flex;
            align-items: center;
        }

        .completed-chore-description {
            flex: 1;
        }

        .checkmark {
            display: none;
            color: green;
            font-size: 24px;
            animation: checkmarkAnimation 2s ease-in-out;
        }

        @keyframes checkmarkAnimation {
            0% {
                transform: scale(0.7);
                opacity: 0;
            }
            50% {
                transform: scale(1.2);
                opacity: 1;
            }
            100% {
                transform: scale(1);
                opacity: 1;
            }
        }

        /* Fireworks animation */
        .fireworks {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 9999;
            pointer-events: none;
            opacity: 0;
        }

        .firework {
            position: absolute;
            width: 8px;
            height: 8px;
            background: #f00;
            border-radius: 50%;
            transform: scale(0);
            animation: fireworksAnimation 3s ease-out infinite;
        }

        @keyframes fireworksAnimation {
            0% {
                transform: scale(0);
                opacity: 1;
                background: #f00;
            }
            100% {
                transform: scale(1);
                opacity: 0;
                background: transparent;
            }
        }
    </style>
</head>
<body>
<?php require 'partials/_nav2.php' ?>
    <div class="container">
        <h1>Chore Management</h1>
        <ul class="chore-list" id="choreList">
            <!-- Existing chores -->
            <li class="chore-item">
                <span class="chore-description">Clean the kitchen</span>
                <button class="mark-completed" onclick="markCompleted(this)">Mark Completed</button>
            </li>
            <li class="chore-item">
                <span class="chore-description">Vacuum the living room</span>
                <button class="mark-completed" onclick="markCompleted(this)">Mark Completed</button>
            </li>
        </ul>

        <div class="completed-section" id="completedSection">
            <h2>Completed Chores</h2>
            <ul id="completedChores">
                <!-- Completed chores will be displayed here -->
            </ul>
            <div class="checkmark" id="checkmark">&#10003;</div>
        </div>

        <h2>Add a New Chore</h2>
        <input type="text" id="newChore" placeholder="Chore Description">
        <button onclick="addNewChore()">Add Chore</button>

        <div class="fireworks" id="fireworks"></div>
    </div>

    <script>
        function markCompleted(button) {
            const choreItem = button.parentNode;
            const choreDescription = choreItem.querySelector('.chore-description');

            // Clone the completed chore item and add it to the "Completed Chores" list
            const completedChoresList = document.getElementById('completedChores');
            const completedChoreItem = document.createElement('li');
            completedChoreItem.className = 'completed-chore';

            const completedChoreDescription = document.createElement('span');
            completedChoreDescription.className = 'completed-chore-description';
            completedChoreDescription.textContent = choreDescription.textContent;

            completedChoreItem.appendChild(completedChoreDescription);

            completedChoresList.appendChild(completedChoreItem);

            // Remove the chore from the original list
            choreItem.remove();

            // Check if all chores are completed
            checkAllChoresCompleted();
        }

        function checkAllChoresCompleted() {
            const choreList = document.getElementById('choreList');
            const completedChoresList = document.getElementById('completedChores');
            const checkmark = document.getElementById('checkmark');

            if (choreList.children.length === 0) {
                checkmark.style.display = 'inline';

                // Trigger the fireworks animation
                triggerFireworksAnimation();
            }
        }

        function triggerFireworksAnimation() {
            const fireworks = document.getElementById('fireworks');
            fireworks.style.opacity = '1';

            for (let i = 0; i < 100; i++) {
                const firework = document.createElement('div');
                firework.className = 'firework';
                firework.style.top = `${Math.random() * 100}%`;
                firework.style.left = `${Math.random() * 100}%`;
                fireworks.appendChild(firework);
            }

            setTimeout(() => {
                fireworks.style.opacity = '0';
                fireworks.innerHTML = ''; // Remove the fireworks elements
            }, 5000); // Adjust the duration as needed
        }

        function addNewChore() {
            const newChoreDescription = document.getElementById('newChore').value;

            if (newChoreDescription.trim() !== '') {
                const choreList = document.getElementById('choreList');
                const newChoreItem = document.createElement('li');
                newChoreItem.className = 'chore-item';

                const choreDescription = document.createElement('span');
                choreDescription.className = 'chore-description';
                choreDescription.textContent = newChoreDescription;

                const markCompletedButton = document.createElement('button');
                markCompletedButton.className = 'mark-completed';
                markCompletedButton.textContent = 'Mark Completed';
                markCompletedButton.addEventListener('click', () => markCompleted(markCompletedButton));

                newChoreItem.appendChild(choreDescription);
                newChoreItem.appendChild(markCompletedButton);

                choreList.appendChild(newChoreItem);

                // Clear input field
                document.getElementById('newChore').value = '';
            }
        }
    </script>
</body>
</html>
