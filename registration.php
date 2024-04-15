<?php
include ('db_connect.php');
session_start();

if (!$con) {
    die("connection failed;" . mysqli_connect_error());
}


if (isset($_POST['submit'])) {
    $fname = $_POST['first_name'];
    $mname = $_POST['middle_name'];
    $lname = $_POST['last_name'];
    $contact = $_POST['contact_number'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $savedata = "INSERT INTO user_tbl VALUES ('','$fname','$mname','$lname','$contact','$email','$password')";
    if (mysqli_query($con, $savedata)) {
        echo "<script> alert('Signed Up Successfully!')</script>";
    } else {
        echo "Error:" . "<br>" . mysqli_error($con);
    }
}

?>






<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <link rel="shortcut icon" href="system_images/Picture4.png" type="image/png">
    <link rel="stylesheet" type="text/css" href="header.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="registration.css?v=<?php echo time(); ?>">
    <script src="user/javascripts/inputColor.js" defer></script>
</head>

<body>

    <!-- for nav -->
    <div class="nav-container">
        <nav class="navbar">
            <img src="system_images/Picture1.png" class="logo1">
            <a class="logoLabel">Estregan Beach Resort</a>
            <ul>
                <li><a onclick="confirm('You have to log in first!')">Home</a></li>
                <li><a onclick="confirm('You have to log in first!')">About</a></li>
                <li class="dropdown">
                    <a href="user/view_rooms.php" class="reservation">Reservation</a>
                    <div class="dropdown-content">
                        <a onclick="confirm('You have to log in first!')">Cottages</a>
                        <a href="user/view_rooms.php">Rooms</a>
                <li><a onclick="confirm('You have to log in first!')">Contact</a></li>

            </ul>
            <a class="logout-btn" href="login.php">Log in</a>
        </nav>
    </div>



    <!-- for body -->
    <div class="container">
        <form method="post" action="" class="leftcontent">

            <div class="registration-lbl"><label for="">Registration</label></div>

            <div class="input1"><input type="text" name="first_name" placeholder="First Name"
                    onkeyup="changeColor(this)" required></div>

            <div class="input1"><input type="text" name="middle_name" placeholder="Middle Name"
                    onkeyup="changeColor(this)" required></div>

            <div class="input1"><input type="text" name="last_name" placeholder="Last Name" onkeyup="changeColor(this)" required>
            </div>

            <div class="input1"><input type="number" name="contact_number" placeholder="Contact Number"
                    onkeyup="changeColor(this)" required></div>

            <div class="input1"><input type="email" name="email" placeholder="Email" onkeyup="changeColor(this)" required></div>

            <div class="input1"><input type="password" name="password" placeholder="Password"
                    onkeyup="changeColor(this)" required></div>

            <div class="submit-btn"><button name="submit">Submit</button></div>
        </form>



        <div class="rightcontent">
            <div class="new-here"><label for="">Already Have an account?</label></div>
            <div class="greetings">
                <label for="">Sign in and discover more with<br>
                    affordable and amazing offer</label>
            </div>
            <div class="signup-btn"><a href="login.php">Sign in</a></div>
        </div>

    </div>



    </script>
</body>

</html>