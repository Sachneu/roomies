<!DOCTYPE html>
<html>
<head>
    <title>Grocery List</title>
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

        .grocery-list {
            list-style-type: none;
            padding: 0;
        }

        .grocery-item {
            display: flex;
            align-items: center;
            background-color: #f9f9f9;
            padding: 10px;
            margin: 5px 0;
            border-radius: 5px;
        }

        .grocery-item input[type="checkbox"] {
            margin-right: 10px;
        }

        .add-item {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }
       
    .button-container {
        display: flex;
        gap: 10px; /* Adjust the gap value as needed for spacing */
    }

    #container-wrapper {
    max-width: 100%;
  }

  /* Adjust container width and spacing for larger screens */
  .container {
    max-width: 600px;
    margin: 0 auto;
    padding: 20px;
  }

  /* Add responsiveness to the buttons */
  .button-container {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
  }

  .button-container {
        display: flex;
        gap: 10px; /* Adjust the gap value as needed for spacing */
    }

    .green-button, .red-button {
        flex: 1;
        padding: 10px; /* Adjust the padding value as needed for button size */
        text-align: center;
        border: none;
        cursor: pointer;
        transition: background-color 0.3s, color 0.3s;

    }
    .red-button:hover{
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
  /* Media query for small screens (adjust breakpoints as needed) */
  @media (max-width: 600px) {
    .container {
      padding: 10px;
    }
    .button-container {
      gap: 5px;
    }
  }
        .add-item input[type="text"] {
            width: 70%;
            padding: 5px;
        }

       
    </style>
</head>
<body>
<?php require 'partials/_nav2.php' ?>
<div id="container-wrapper">
<div class="container">
    <h1>Grocery List</h1>
    <ul class="grocery-list">
        <?php
        // Include your database connection code
        include 'partials/_dbconnect.php';

        // Fetch items from the 'grocery' table
        $sql = "SELECT * FROM grocery";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '<li class="grocery-item">';
                echo '<input type="checkbox" data-item-number="' . htmlspecialchars($row["item-number"]) . '">';
                echo htmlspecialchars($row["item-name"]);
                echo '</li>';
            }
        } else {
            echo '<p>No items in the grocery list.</p>';
        }

        // Close the database connection
        $conn->close();
        ?>
    </ul>

    <div class="add-item">
        <input type="text" id="new-item" name="new-item" placeholder="Add a new item">
        <div class="button-container">
        <button id="add-item-button" class="green-button">Add Item</button>
        <button id="delete-item-button" class="red-button">Delete Item</button>
    </div>
    </div>
    

</div>
</div>
<script>
document.getElementById('add-item-button').addEventListener('click', async () => {
    const newItem = document.getElementById('new-item').value;

    try {
        const response = await fetch('grocery.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: `item_name=${encodeURIComponent(newItem)}`, // Correct the parameter name to "item_name"
        });

        if (response.ok) {
            const data = await response.json(); // Parse the response as JSON
            if (data.success) {
                // Reload the page to show the updated list (you can use AJAX to update the list without reloading)
                window.location.reload();
            } else {
                console.error(data.message);
            }
        } else {
            console.error('Failed to add item.');
        }
    } catch (error) {
        console.error('Error:', error);
    }
});
document.getElementById('delete-item-button').addEventListener('click', async () => {
    // Find all checkboxes that are checked
    const checkedCheckboxes = document.querySelectorAll('input[type="checkbox"]:checked');
const itemsToDelete = Array.from(checkedCheckboxes).map(checkbox => checkbox.getAttribute('data-item-number'));

// Send an AJAX request to your server to delete the selected items
try {
    const response = await fetch('delete_items.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: `itemsToDelete=${JSON.stringify(itemsToDelete)}`,
    });

    if (response.ok) {
        const data = await response.json();
        if (data.success) {
            // Reload the page or update the list to reflect the changes
            window.location.reload();
        } else {
            console.error(data.message);
        }
    } else {
        console.error('Failed to delete items.');
    }
} catch (error) {
    console.error('Error:', error);
}

});


</script>

</body>
</html>
