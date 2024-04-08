<?php
include ('db_connect.php');
session_start();
?>





<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="header.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" type="text/css" href="checkinForm.css?v=<?php echo time(); ?>">
    <link rel="shortcut icon" href="../system_images/Picture4.png" type="image/png">
    <title>Check In Form</title>
</head>

<body>

    <div>
        <nav class="navbar">
            <img src="../system_images/Picture1.png" class="logo1">
            <a class="logoLabel">Estregan Beach Resort</a>
            <ul>
                <li><a>Home</a></li>
                <li><a>Reservations</a></li>
                <li class="dropdown">
                    <a href="#" class="reservation">Rooms/Cottages</a>
                    <div class="dropdown-content">
                        <a href="#">Cottages</a>
                        <a href="#">Rooms</a>
                <li class="dropdown">
                    <a href="#" class="reservation">Add Reservation</a>
                    <div class="dropdown-content">
                        <a href="#">Add Cottages</a>
                        <a href="#">Add Rooms</a>

            </ul>
            <button>Log out</button>
        </nav>
    </div>

    <div class="container">
        <div class="container2">
            <div class="header-label">
                <label for="">RESERVATION</label>
            </div>


            <form class="form-container">

                <div class="info-container">
                    <div class="header-label2">
                        <label>RESERVATION INFO</label>
                    </div>
                    <div>
                        <div class="line">
                            <div>
                                <label>First Name</label><br>
                                <input>
                            </div>
                            <div>
                                <label>Last Name</label><br>
                                <input>
                            </div>
                            <div>
                                <label>Address</label><br>
                                <input>
                            </div>
                        </div>
                        <div class="line">
                            <div>
                                <label>Phone Number</label><br>
                                <input>
                            </div>
                            <div>
                                <label>Email</label><br>
                                <input>
                            </div>
                            <div>
                                <label>Date of Arrival</label><br>
                                <input>
                            </div>
                        </div>
                        <div class="line">
                            <div>
                                <label>Time of Arrival</label><br>
                                <input>
                            </div>
                            <div>
                                <label>Email</label><br>
                                <input>
                            </div>
                            <div>
                                <label>Date of Arrival</label><br>
                                <input>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="image-container">

                </div>

                <div class="button-container">

                </div>
            </form>
        </div>

        <script src=""></script>
</body>

</html>