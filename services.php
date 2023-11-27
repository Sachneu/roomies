<!DOCTYPE html>
<html>
<head>
    <title>Our Services</title>
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

        .service-list {
            list-style-type: none;
            padding: 0;
        }

        .service-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #f9f9f9;
            padding: 10px;
            margin: 5px 0;
            border-radius: 5px;
        }

        .service-description {
            flex: 1;
        }
    </style>
</head>
<body>
<?php require 'partials/_nav2.php' ?>
    <div class="container">
        <h1>Our Services</h1>
        <ul class="service-list">
            <li class="service-item">
                <span class="service-description">
                    <strong>Announce Posting:</strong> Our Announce Posting service allows you to communicate important announcements and messages within your living space or community. Whether it's event updates, notices, or general information, you can easily share and view announcements to stay informed and connected with your fellow residents.
                </span>
            </li>
            <li class="service-item">
                <span class="service-description">
                    <strong>Grocery List Management:</strong> Simplify your grocery shopping experience with our Grocery List Management service. Collaboratively create and manage grocery lists shared among roommates or community members. You can add, edit, and mark items as purchased, ensuring you never forget a crucial ingredient.
                </span>
            </li>
            <li class "service-item">
                <span class="service-description">
                    <strong>Chore Management:</strong> Chore Management streamlines household and apartment upkeep. Assign and track chores, and keep your living space clean and organized. Easily delegate tasks, mark them as completed, and maintain a fair and equitable distribution of responsibilities.
                </span>
            </li>
            <li class="service-item">
                <span class="service-description">
                    <strong>Split Bills:</strong> Splitting bills has never been easier. With our Split Bills service, you can evenly distribute expenses among roommates or cohabitants. Input bill information, assign payments, and effortlessly calculate each person's share, promoting transparency and fairness.
                </span>
            </li>
            <li class="service-item">
                <span class="service-description">
                    <strong>Upload Receipts:</strong> Our Upload Receipts feature simplifies expense tracking. Snap a picture of your receipts or upload digital copies, making it simple to store and manage your financial records. Easily associate receipts with specific expenses and bills for enhanced financial organization and accountability.
                </span>
            </li>
        </ul>
    </div>
</body>
</html>
