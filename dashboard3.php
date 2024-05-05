<?php 
include('dbconnect.php');
session_start();

if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true){
    header('Location: login.php');
    exit();
}

$username = $_SESSION['email'];

$query= "SELECT fname FROM registration_tbl WHERE email='$username'";
$result = mysqli_query($con, $query);

if (mysqli_num_rows($result) > 0)  {
    $row = mysqli_fetch_assoc($result);
    $first_name = $row['fname'];
} else {
    $error_message = "There was an error fetching your data.";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name ="viewport" content="width=device-width,
    initial-scale=1.0">
    <title>Estregan Beach Resort</title>
    <link rel="stylesheet" href="style3.css?=<?php echo time(); ?>">
</head>

<header class="header">
    <a href="#" class="Estregan Beach Resort">Dashboard</a>

    <nav class="navbar">
        <a href="#">Rooms</a>
        <a href="#">Cottages</a>
        <a href="#">Reservation</a>
        <a href="#">Contact</a>    
        <a href="login.php" class="login-btn">Account</a><br>
  
    </nav>

</header>
<body>

<div class="dashboard-container">
        <form class="dashboard-form">
        <h1>Hello, <?php echo $first_name; ?>!</h1>
        <p> This is your dashboard.</p>
        <?php
        if (isset($error_message)){
            echo "<p style='color:red;'>$error_message</p>";
        }
        ?>

        <div>
        <a class="Logout" href="logout.php" class="logout">Log out</a>
        </div>

        </form>
    </div>

</body>
</html>