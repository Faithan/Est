<?php 
include('dbconnect.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - Beach Resort</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
        }

        .header {
            background-color: coral;
            color: white;
            padding: 1px 0;
            text-align: center;
        }

        .main-content {
            max-width: 700px;
            margin: 20px auto;
            background: white;
            padding: 20px;
            box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.1);
            border-radius: 8px;
        }

        .main-content h1, .main-content h2 {
            color: #333;
        }

        .contact-info {
            margin-bottom: 20px;
        }

        .contact-info p {
            margin-bottom: 5px;
        }

        .contact-form {
            display: flex;
            flex-direction: column;
        }

        .form-field {
            margin-bottom: 20px;
        }

        .form-field label {
            display: block;
            margin-bottom: 5px;
        }

        .form-field input, .form-field textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .form-field input[type="submit"] {
            background-color: coral;
            color: white;
            cursor: pointer;
            border: none;
        }

        .form-field input[type="submit"]:hover {
            background-color: orange;
        }

        .footer {
            text-align: center;
            padding: 10px 0;
            background-color: #333;
            color: white;
        }

        .Pik {
            position  : absolute;
            width: 100x;
            height: 100px;
            float: right;
            left: 68%;
        }
    </style>
</head>
<body>

    <div class="header">
        <h1>Estregan Beach Resort - Contact Us</h1>
    </div>

    <div class="main-content">
    <img src="Estre.png" class="Pik">
        <h2>Get in Touch</h2>
        <div class="contact-info">
            <p>Phone: 0977-804-3668</p>
            <p>Email: info@beachresort.com</p>
            <p>Address: Estregan beach resort, 9215 Pikalawag SND, LDN.</p>
        </div>

        <h2>Contact Form</h2>
        <form action="/submit_form" method="post" class="contact-form">
            <div class="form-field">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" required>
            </div>

            <div class="form-field">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>

            <div class="form-field">
                <label for="message">Message:</label>
                <textarea id="message" name="message" rows="5" required></textarea>
            </div>

            <div class="form-field">
                <input type="submit" value="Submit">
            </div>
        </form>
    </div>

    <div class="footer">
        &copy; 2023 Estregan Beach Resort. All rights reserved.
    </div>

</body>
</html>
