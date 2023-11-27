<!DOCTYPE html>
<html>
<head>
    <title>Split Bills</title>
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

        .bill-details {
            list-style-type: none;
            padding: 0;
        }

        .bill-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #f9f9f9;
            padding: 10px;
            margin: 5px 0;
            border-radius: 5px;
        }

        .buyer-info {
            font-style: italic;
        }

        .total-amount {
            font-weight: bold;
        }

        .split-button {
            background-color: #007BFF;
            color: #fff;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
        }

        .split-result {
            margin-top: 10px;
        }

        /* Modal styles */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
        }

        .modal-content {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .close-button {
            position: absolute;
            top: 10px;
            right: 10px;
            cursor: pointer;
        }
    </style>
</head>
<body>
<?php require 'partials/_nav2.php' ?>
    <div class="container">
        <h1>Split Bills</h1>
        <ul class="bill-details">
            <li class="bill-item">
                <span>Buyer: John</span>
                <span>Amount: $50.00</span>
            </li>
            <li class="bill-item">
                <span>Buyer: Sarah</span>
                <span>Amount: $30.00</span>
            </li>
            <li class="bill-item">
                <span>Buyer: Mike</span>
                <span>Amount: $70.00</span>
            </li>
        </ul>

        <button class="split-button" id="splitButton">Split Bills</button>

        <div class="split-result" id="splitResult">
            <!-- Split results will be displayed here -->
        </div>

        <button class="split-button" id="addBillButton">Add Bill</button>
    </div>

    <!-- Modal for adding bills -->
    <div id="addBillModal" class="modal">
        <div class="modal-content">
            <span class="close-button" id="closeAddBillModal">&times;</span>
            <h2>Add a Bill</h2>
            <label for="buyerName">Buyer Name:</label>
            <input type="text" id="buyerName">
            <br>
            <label for="billAmount">Bill Amount:</label>
            <input type="text" id="billAmount">
            <br>
            <button id="addBill">Add</button>
        </div>
    </div>

    <script>
        const splitButton = document.getElementById('splitButton');
        const splitResult = document.getElementById('splitResult');
        const addBillButton = document.getElementById('addBillButton');
        const addBillModal = document.getElementById('addBillModal');
        const closeAddBillModal = document.getElementById('closeAddBillModal');
        const addBill = document.getElementById('addBill');

        addBillButton.addEventListener('click', () => {
            addBillModal.style.display = 'block';
        });

        closeAddBillModal.addEventListener('click', () => {
            addBillModal.style.display = 'none';
        });

        addBill.addEventListener('click', () => {
            // Your JavaScript logic for adding a bill goes here
            // You should capture the buyer's name and bill amount
            // and update the bill details

            // For this example, we'll just close the modal
            addBillModal.style.display = 'none';
        });

        splitButton.addEventListener('click', () => {
            // Your JavaScript logic for splitting bills goes here
            // You should calculate and display how much each person owes

            // For this example, we simulate the results:
            const results = [
                { name: 'John', amountOwed: 10.00 },
                { name: 'Sarah', amountOwed: 10.00 },
                { name: 'Mike', amountOwed: 10.00 }
            ];

            // Display the results
            splitResult.innerHTML = `<h3>Split Results:</h3>`;
            results.forEach(result => {
                splitResult.innerHTML += `<p>${result.name} owes: $${result.amountOwed.toFixed(2)}</p>`;
            });
        });
    </script>
</body>
</html>
