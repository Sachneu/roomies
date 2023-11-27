<!DOCTYPE html>
<html>
<head>
    <title>Upload Receipt</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .container {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            background: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
        }

        .form-group {
            margin: 20px 0;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        .custom-file-input {
            display: none;
        }

        .custom-file-label {
            background: #007BFF;
            color: #fff;
            border: none;
            padding: 10px;
            cursor: pointer;
            text-align: center;
            display: inline-block;
            width: 100%;
        }

        .custom-file-label .fa {
            margin-right: 10px;
        }

        button {
            background: #007BFF;
            color: #fff;
            border: none;
            padding: 10px;
            cursor: pointer;
        }
    </style>
</head>
<body>
<?php require 'partials/_nav2.php' ?>
<div class="container">
    <h1>Upload Receipt</h1>
    <div class="form-group">
        <label for="receipt">Choose a receipt:</label>
        <label class="custom-file-label" for="receipt">
            <i class="fa fa-upload"></i> Select File
        </label>
        <input type="file" id="receipt" class="custom-file-input" accept=".pdf, .jpg, .jpeg, .png" />
    </div>
    <button id="uploadButton">Upload Receipt</button>
    <button id="viewReceiptsButton">View Receipts</button>

</div>

<div class="receipts-container" id="allReceiptsContainer"></div>


    <script>
 const uploadButton = document.getElementById('uploadButton');
const receiptInput = document.getElementById('receipt');
const allReceiptsContainer = document.getElementById('allReceiptsContainer');

// Function to fetch and display all receipts
function fetchAllReceipts() {
    fetch('fetch_receipts.php')
        .then(response => response.json())
        .then(receipts => {
            receipts.forEach(receipt => {
                // Create a link to the receipt
                const receiptLink = document.createElement('a');
                receiptLink.href = receipt.file_path;
                receiptLink.textContent = `View Receipt - Added on ${receipt.added_on} by ${receipt.added_by}`;
                receiptLink.target = '_blank'; // Open the link in a new tab

                // Append the link to the allReceiptsContainer
                allReceiptsContainer.appendChild(receiptLink);
            });
        })
        .catch(error => {
            console.error('Error:', error);
        });
}

// Call the fetchAllReceipts function to display all receipts
fetchAllReceipts();

receiptInput.addEventListener('change', () => {
    const file = receiptInput.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            const fileContent = e.target.result;

            // Display the file content in a preview area
            const filePreview = document.createElement('div');
            filePreview.textContent = `Selected File: ${file.name}`;
            allReceiptsContainer.innerHTML = ''; // Clear previous previews
            allReceiptsContainer.appendChild(filePreview);
        };
        reader.readAsDataURL(file);
    }
});

uploadButton.addEventListener('click', () => {
    const file = receiptInput.files[0];
    if (file) {
        const formData = new FormData();
        formData.append('receipt', file);

        fetch('upload.php', {
            method: 'POST',
            body: formData,
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Receipt uploaded and stored successfully.');

                // Fetch and display all receipts again, including the newly added one
                allReceiptsContainer.innerHTML = '';
                fetchAllReceipts();
            } else {
                alert('Error: ' + data.message);
            }
        })
        .catch(error => {
            alert('Error: ' + error.message);
        });
    } else {
        alert('Please choose a file to upload.');
    }
});
const viewReceiptsButton = document.getElementById('viewReceiptsButton');

viewReceiptsButton.addEventListener('click', () => {
    window.location.href = 'view_receipts.php'; // Change to the correct path
});






    </script>
</body>
</html>
