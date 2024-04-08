<?php 
// include('dbconnect.php');
// session_start();

// if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
//     header('Location: index.php');
//     exit();
// }

// if(isset($_POST['login'])) {
//     $email= $_POST['email'];
//     $password = $_POST['password'];

//     $login_query = "SELECT * FROM registration_tbl WHERE email='$email' AND password='$password' ";
//     $result = mysqli_query($con, $login_query);

//     if (mysqli_num_rows($result) == 1) {
//         $_SESSION['loggedin'] = true;
//         $_SESSION['email'] = $email;
//         header('Location: index.php');
//         exit();
//     } else {
//         $error_message = "Invalid username or password;";
//     }
// }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="login1.css?v=<?php echo time(); ?>">
    <title>Login</title>
</head>
<body>
        <div class="container">
        <form class="background-container"></form>
        <form class="login-form" method="post">
        <label class="welcome">Welcome <br> to <br>Estregan Beach Resort </label><br>
        <img src="images/Picture4.png" class="picture1">    
        <img src="images/Picture5.png" class="picture3">    
        <div class="input">
        <label class="">Email Address:</label><br> 
        <input class="" type="email" name="email" placeholder="" required><br>
        <label class=""> Password:</label><br>
        <input class="" type="password" name="password" placeholder="" required><br><br>
        </div>
        <button type="submit" name="login" value="Login" class="signin-btn">Sign in</button>
        <?php 
        if (isset($error_message)) {
            echo "<p style='color:red;'>$error_message</p>";
        }
        ?>
        </form> 
        <form class="login-signup" method="post">

         <img src="images/signupPicture.png" class="picture2">
        <div>
        <label class="newhere-lbl">New Here?</label><br> 
        <label class="signin-lbl">Sign up and discover more with<br> affordable and amazing offer
        </label><br> 
        </div>
        <a href="registration.php" class="register-btn">Sign up</a><br>

        </form>
    </div>
    
</body>
</html>