<?php 
include('dbconnect.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About - Beach Resort</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
            color: #333;
        }

        .header {
            background-color: coral;
            color: white;
            padding: 1px 0;
            text-align: center;
        }

        .main-content {
            max-width: 800px;
            margin: 20px auto;
            background: white;
            padding: 20px;
            box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.1);
            border-radius: 8px;
        }

        .main-content h1 {
            color: #333;
            margin-bottom: 20px;
        }

        .main-content p {
            line-height: 1.6;
            margin-bottom: 20px;
        }

        .image-section {
            text-align: center;
            margin: 20px 0;
        }

        .image-section img {
            max-width: 50%; /* Responsive image */
            height: auto;
            border-radius: 8px; 
        }

        .footer {
            text-align: center;
            padding: 10px 0;
            background-color: #333;
            color: white;
        }
    </style>
</head>
<body>

    <div class="header">
        <h1>Welcome to Estregan Beach Resort</h1>
    </div>

    <div class="main-content">
        <h1>About Estregan</h1>
        <p>Estregan Beach Resort  provides the best quality of services applying top quality guest house and conference facilities, in order to fulfill the best way in the relevant needs of every guest.</p>

        <div class="image-section">
            <img src="Pis.jpg" alt="Beach view of the resort">
        </div>

        <p>Provide our guests a unique experience, through which they connect with the best in our company, and to offer top quality service to our entire guest and provided comfort abundance.</p>

        <p>Join us, and experience the vacation of your dreams at Estregan Beach Resort.</p>
    </div>

    <div class="footer">
        &copy; 2023 Estregan Beach Resort. All rights reserved.
    </div>

</body>
</html>