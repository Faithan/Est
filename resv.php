<?php 
include('dbconnect.php');
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Room and Rates</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            display: flex;
            flex-direction: row;
            justify-content: space-between;
        }
        .left-section {
            width: 60%;
        }
        .right-section {
            width: 35%;
            padding-left: 5%;
        }
        h1 {
            font-size: 24px;
            margin-bottom: 20px;
        }
        .room {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }
        .room img {
            width: 120px;
            height: 80px;
            margin-right: 20px;
        }
        .room-details {
            margin-right: 20px;
        }
        .room-details p {
            margin: 5px 0;
        }
        .date-range, .book-room, .login {
            margin-bottom: 20px;
        }
        .book-room, .login {
            background-color: #f5f5f5;
            padding: 20px;
            border-radius: 5px;
        }
        .book-room h2, .login h2 {
            font-size: 18px;
            margin-bottom: 15px;
        }
        input[type="text"], input[type="password"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        button {
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            background-color: #333;
            color: #fff;
        }
        .time {
            text-align: right;
            font-size: 16px;
            font-weight: bold;
        }
    </style>
</head>
<body>

<div class="left-section">
    <h1>Room and Rates</h1>

    <div class="date-range">
        <label>From:</label>
        <input type="text" placeholder="From:">
        <label>To:</label>
        <input type="text" placeholder="To:">
    </div>

    <!-- Repeat for each room -->
    <div class="room">
        <img src="path_to_image.jpg" alt="Room Image">
        <div class="room-details">
            <p>Room Type: Family size</p>
            <p>Max Adults: 4</p>
            <p>Max Children: 0</p>
            <p>Rate per Night: P 1800</p>
            <button>Book Now!</button>
        </div>
    </div>
    <!-- End repeat -->

</div>

<div class="right-section">
    <div class="book-room">
        <h2>Book a Room</h2>
        <input type="text" placeholder="Check In">
        <input type="text" placeholder="Check Out">
        <button>Check Availability</button>
    </div>

    <div class="login">
        <h2>Login</h2>
        <input type="text" placeholder="Email">
        <input type="password" placeholder="Password">
        <button>Sign in</button>
    </div>

    <div class="time">
        3:00:37 P.M.
    </div>
</div>

</body>
</html>
