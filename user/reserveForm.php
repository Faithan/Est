<?php
include ('../db_connect.php');
session_start();




$manage_data = ['room_type' => '', 'no_persons' => '', 'amenities' => '', 'price' => '', 'photo' => ''];


if (isset($_GET['manage_id'])) {
    $manage_id = $_GET['manage_id'];
    $manage_query = "SELECT * FROM room_tbl WHERE id = $manage_id";
    $manage_result = mysqli_query($con, $manage_query);
    $manage_data = mysqli_fetch_assoc($manage_result);
}



//when form is submitted
if (isset($_POST['submit'])) {
    $fname = $_POST['first_name'];
    $lname = $_POST['last_name'];
    $address = $_POST['address'];
    $phone_number = $_POST['phone_number'];
    $email = $_POST['email'];
    $date_of_arrival = $_POST['date_of_arrival'];
    $time_of_arrival = $_POST['time_of_arrival'];
    $room_type = $_POST['room_type'];
    $number_of_person = $_POST['number_of_person'];
    $amenities = $_POST['amenities'];
    $rate_per_hour = $_POST['rate_per_hour'];
    $special_request = $_POST['special_request'];
    $room_photo = $manage_data['photo'];
    $savedata = "INSERT INTO reserve_room_tbl  VALUES ('','pending','$fname','$lname','$address ',' $phone_number',' $email','$date_of_arrival',' $time_of_arrival','$room_type', '$number_of_person', '$amenities', ' $rate_per_hour', '$special_request', '$room_photo','','','','','' )";  
    if (mysqli_query($con,  $savedata)) {
        echo "<script> alert('data accepted succesfully')</script>";
    } else {
        echo "Error:" . $sql . "<br>" . mysqli_error($con);
    }
}

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../system_images/Picture4.png" type="image/png">
    <link rel="stylesheet" type="text/css" href="reserveRoom.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" type="text/css" href="reserveForm.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" type="text/css" href="header.css?v=<?php echo time(); ?>">
    <title>Room Reservation</title>
    <script src="reserveRoom.js" defer></script>
    <script src="scroll.js" defer></script>
    <script src="inputColor.js" defer></script>
</head>

<body>
    <div class="nav-container">
        <nav class="navbar">
            <img src="../system_images/Picture1.png" class="logo1">
            <a class="logoLabel">Estregan Beach Resort</a>
            <ul>
                <li><a>Home</a></li>
                <li><a>About</a></li>
                <li class="dropdown">
                    <a href="#" class="reservation">Reservation</a>
                    <div class="dropdown-content">
                        <a href="#">Cottages</a>
                        <a href="#">Rooms</a>
                <li><a>Contact</a></li>

            </ul>
            <button>Sign up</button>
        </nav>
        <div>

            <div class="real-container">

                <div class="background-design1"></div>

                <div class="background-design2"></div>

                <div class="for-footer"> @Estregan_Beach_Resort_2024 </div>

               
                <div class="reserveForm-display" id="reserveForm-display">
             
                    <div class="reserveForm-container">
              
                        <div class="reserveForm-container1">
                      
                            <div class="image-container">
                                <img name="photo" src="<?php echo $manage_data['photo']; ?>" alt="">
                            </div>
                            
                        </div>

                    
                        <form action="" method="post"class="reserveForm-container2">
                    
                            <label class="bold-text">Reservation Form</label><br>
                
                          
                            <label>Full Name</label><br>

                           
                            <input class="input2" name="first_name" onkeyup="changeColor(this)" placeholder="First Name"
                                required>
                                
                            <input class="input2" name="last_name" onkeyup="changeColor(this)" placeholder="Last Name"
                                required><br>
                         

                            <label>Address</label><br>
                            <input name="address" onkeyup="changeColor(this)" placeholder="Ex: Maranding, Lala, Lanao Del Norte"
                                required><br>

                            <label>Phone Number</label><br>
                            <input type="number" name="phone_number" onkeyup="changeColor(this)" placeholder="Ex: 09123456789" required><br>

                            <label>Email</label><br>
                            <input class="input4" name="email" onkeyup="changeColor(this)" placeholder="Ex: Name@gmail.com" required><br>

                            <label>Date of Arrival</label><br>
                            <input class="input4" type="date" name="date_of_arrival" onkeyup="changeColor(this)" required><br>

                            <label>Time of Arrival</label><br>
                            <input type="time" name="time_of_arrival" onkeyup="changeColor(this)" required>


                            <label class="bold-text">Room Details</label><br>

                            <label>Room Type</label><br>
                            <input class="input3" name="room_type" onkeyup="changeColor(this)"
                                value="<?php echo $manage_data['room_type']; ?>" readonly><br>

                            <label>Number of Persons:</label><br>
                            <input class="input3" name="number_of_person" onkeyup="changeColor(this)"
                                value="<?php echo $manage_data['no_persons']; ?>" readonly><br>

                            <label>Amenities</label><br>
                            <input class="input3" name="amenities" onkeyup="changeColor(this)"
                                value="<?php echo $manage_data['amenities']; ?>" readonly><br>

                            <label>Rate Per Hour</label><br>
                            <input class="input3" name="rate_per_hour" onkeyup="changeColor(this)"
                                value="<?php echo $manage_data['price']; ?>" readonly><br>

                            <label>Do you have any special request?</label><br>
                            <textarea name="special_request" onkeyup="changeColor(this)"></textarea><br>

                            <div class="button-container2">
                                <button class="submit-btn" name="submit" type="submit" >Submit</button>

                                <a href="reserveRoom.php" class="cancel-btn">Cancel</a>
                            </div>
                            </form>
                       
                  

                    </div>
                   
                </div>
                
            </div>
</body>

</html>