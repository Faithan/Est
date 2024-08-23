<?php 
include('dbconnect.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservation Form</title>
    <link rel="stylesheet" href="style4.css">

</head>
<body>

    <div class="reservation-form-container">
        <div class="form-header">
            <h2>Room and Cottage Reservation</h2>
        </div>
        <form action="/submit_reservation" method="post">
            <div class="form-field">
                <label for="guestName">Full Name:</label>
                <input type="text" id="guestName" name="guestName" required>
            </div>

            <div class="form-field">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>

            <div class="form-field">
                <label for="phone">Phone Number:</label>
                <input type="tel" id="phone" name="phone" required>
            </div>

            <div class="form-field">
                <label for="reservationDate">Reservation Date:</label>
                <input type="date" id="reservationDate" name="reservationDate" required>
            </div>

            <div class="form-field">
                <label for="numGuests">Number of Guests:</label>
                <input type="number" id="numGuests" name="numGuests" min="1" required>
            </div>

            <div class="form-field">
                <label for="accommodationType">Accommodation Type:</label>
                <select id="accommodationType" name="accommodationType" required>
                    <option value="">--Please choose an option--</option>
                    <option value="room">Room</option>
                    <option value="cottage">Cottage</option>
                </select>
            </div>

            <div class="form-field">
                <label for="specialRequests">Special Requests:</label>
                <textarea id="specialRequests" name="specialRequests" rows="4"></textarea>
            </div>

            <div class="form-field">
                <input type="submit" value="Submit Reservation">
            </div>
        </form>
    </div>

</body>
</html>


