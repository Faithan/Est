<?php
include ('db_connect.php');
session_start();

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    header('Location: login.php'); // Redirect to a common dashboard
    exit();
}


if (!$con) {
    die("connection failed;" . mysqli_connect_error());
}



// for user

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $login_query = "SELECT * FROM user_tbl WHERE email='$email' AND password='$password' ";

    $result = mysqli_query($con, $login_query);



    if (mysqli_num_rows($result) == 1) {
        $_SESSION['loggedin'] = true;
        $_SESSION['email'] = $email;
        header('Location:user/index.php');
        exit();

    } else {
        $error_message = "Invalid username or password;";
    }

}


// for admin


if (isset($_POST['login'])) {
    $adminemail = $_POST['email'];
    $adminpassword = $_POST['password'];

    $login_query = "SELECT * FROM admin_tbl WHERE email='$adminemail' AND password='$adminpassword' ";
    $result = mysqli_query($con, $login_query);

    if (mysqli_num_rows($result) == 1) {
        $_SESSION['loggedin'] = true;
        $_SESSION['email'] = $adminemail;
        header('Location:admin/reservation.php');
        exit();
    } else {
        $error_message = "Invalid username or password;";
    }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign in</title>

    <link href="fontawesome/css/fontawesome.css" rel="stylesheet" />
    <link href="fontawesome/css/brands.css" rel="stylesheet" />
    <link href="fontawesome/css/solid.css" rel="stylesheet" />

    <link rel="shortcut icon" href="system_images/Picture4.png" type="image/png">
    <link rel="stylesheet" type="text/css" href="header.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="login.css?v=<?php echo time(); ?>">
    <script src="user/javascripts/inputColor.js" defer></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>

<body>

    <!-- for nav -->
    <div class="nav-container">
        <nav class="navbar">
            <img src="system_images/Picture1.png" class="logo1">
            <a class="logoLabel">Estregan Beach Resort</a>
            <ul>
                <li><a onclick="confirm('You have to log in first!')">Home</a></li>
                <li><a href="user/view_about.php">About</a></li>
                <li class="dropdown">
                    <a href="user/view_rooms.php" class="reservation">Reservation <i class="fa-solid fa-caret-down"></i></a>
                    <div class="dropdown-content">
                        <a onclick="confirm('You have to log in first!')">Cottages</a>
                        <a href="user/view_rooms.php">Rooms</a>

                <li><a href="user/view_contact.php">Contact</a></li>

            </ul>
            <a class="logout-btn" href="registration.php"><i class="fa-solid fa-right-to-bracket"></i> Sign up</a>
        </nav>
    </div>



    <!-- for body -->
    <div class="container">
        <form method="post" action="" class="leftcontent">

            <img class="picture1" src="system_images/picture5.png" alt="">
            <img class="picture2" src="system_images/Picture4.png" alt="">
            <div class="center-content">
                <div>
                    <div class="welcome"><label for="">Welcome</label></div>
                    <div class="to"><label for="">To</label></div>
                    <div class="est"><label for="">Estregan Resort Beach</label></div>


                    <div class="email-lbl"><label for="">Email Address:</label></div>
                    <div class="email-input"><input type="text" name="email" onkeyup="changeColor(this)"></div>
                    <div class="password-lbl"><label for="">Password:</label></div>
                    <div class="password-input"><input type="password" name="password" onkeyup="changeColor(this)">
                    </div>
                    <?php
                    if (isset($error_message)) {
                        echo "<p class='error-msg' style='color:red;'>$error_message</p>";
                    }
                    ?>
                    <div class="sign-btn"><button name="login">Log in</button></div>
                </div>
            </div>
        </form>



        <div class="rightcontent">
            <div class="new-here"><label for="">New Here?</label></div>
            <div class="greetings">
                <label for="">Sign up and discover more with<br>
                    affordable and amazing offer</label>
            </div>
            <div class="signup-btn"><a href="registration.php">Sign Up</a></div>
        </div>

    </div>




</body>
</html>