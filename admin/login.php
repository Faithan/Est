<?php
require 'db_connect.php';
session_start();

// Redirect to dashboard if already logged in as admin
if (isset($_SESSION['admin'])) {
    header("Location: dashboard.php");
    exit();
}

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Admin login
    $query = "SELECT * FROM admin_tbl WHERE username = ? AND password = ?";
    $stmt = $con->prepare($query);
    $stmt->bind_param('ss', $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $_SESSION['admin'] = $username;
        header("Location: dashboard.php");
        exit();
    } else {
        $error_message = "Invalid admin username or password.";
    }
}
?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>

    <!-- fontawesome -->
    <link href="../fontawesome/css/fontawesome.css" rel="stylesheet" />
    <link href="../fontawesome/css/brands.css" rel="stylesheet" />
    <link href="../fontawesome/css/solid.css" rel="stylesheet" />



    <!-- sweetalert -->
    <script src="../sweetalert/sweetalert.js"></script>


    <!-- header css -->
    <link rel="stylesheet" type="text/css" href="css/header.css?v=<?php echo time(); ?>">

    <link rel="stylesheet" type="text/css" href="css/main.css?v=<?php echo time(); ?>">
    <link rel="shortcut icon" href="../system_images/Picture4.png" type="image/png">
</head>

<body>
    <section>
        <div class="wave wave1"></div>
        <div class="wave wave2"></div>
        <div class="wave wave3"></div>
        <div class="wave wave4"></div>
    </section>

    <!-- login page -->
    <main class="main-login">
        <form method="post" action="" class="login-container">
            <div class="logo-container">
                <img class="picture2" src="../system_images/Picture4.png" alt="">
                <hr>
            </div>

            <div>
                <h2>Log in as Admin✨</h2>
                <p>Username and password required for admin access. 🌊</p>
            </div>

            <label for="username">Username</label>
            <div class="input-container">
                <span class="input-icon-name">&#128100;</span>
                <input type="text" name="username" id="username" placeholder="Enter your username" required>
            </div>

            <label for="password">Password</label>
            <div class="input-container">
                <span class="input-icon2">&#128274;</span>
                <input type="password" name="password" placeholder="Enter your password" required>
            </div>

            <?php if (isset($error_message)) { ?>
                <p class="error-msg" style="color:red;"><?php echo $error_message; ?></p>
            <?php } ?>

            <button name="login" class="btn-grad">Log in</button>
        </form>
    </main>
</body>

</html>






<style>
    * {
        margin: 0;
        padding: 0;
    }




    /* wave */
    section {
        position: relative;
        width: 100%;
        height: 100vh;
        background-color: var(--eight-color);
        overflow: hidden
    }

    section .wave {
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 100px;
        background: url(../system_images/wave.png);
        background-size: 1000px 100px;
    }

    section .wave.wave1 {
        animation: animate 30s linear infinite;
        z-index: 1000;
        opacity: 1;
        animation-delay: 0s;
        bottom: -5px;
    }

    @keyframes animate {
        0% {
            background-position-x: 0;
        }

        100% {
            background-position-x: 1000px;
        }
    }


    section .wave.wave2 {
        animation: animate2 15s linear infinite;
        z-index: 999;
        opacity: .5;
        animation-delay: -5s;
        bottom: 10px;
    }

    @keyframes animate2 {
        0% {
            background-position-x: 0;
        }

        100% {
            background-position-x: -1000px;
        }
    }


    section .wave.wave3 {
        animation: animate3 20s linear infinite;
        z-index: 998;
        opacity: .2;
        animation-delay: -2s;
        bottom: 20px;
    }

    @keyframes animate3 {
        0% {
            background-position-x: 0;
        }

        100% {
            background-position-x: -1000px;
        }
    }

    section .wave.wave4 {
        animation: animate4 10s linear infinite;
        z-index: 997;
        opacity: .1;
        animation-delay: -1s;
        bottom: 30px;
    }

    @keyframes animate4 {
        0% {
            background-position-x: 0;
        }

        100% {
            background-position-x: -1000px;
        }
    }


    /* end */










    body {
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .main-login {
        width: 400px;
        background: linear-gradient(180deg, #fcc89b 30%, #942900 70%, #001535 100%);
        display: flex;
        justify-content: center;
        align-items: center;
        margin-bottom: 150px;
        position: absolute;
        border-radius: 5px;
    }

    .login-container {
        width: 100%;
        padding: 20px;
        background-color: var(--first-color);
        display: flex;
        flex-direction: column;
        gap: 1rem;
        border-radius: 5px;
    }



    .login-container .logo-container {
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: row;
    }

    .login-container .logo-container hr {
        border: 1px solid var(--seventh-color3);
        width: 90%;
        height: 1px;

    }

    .login-container .logo-container img {
        height: 8rem;
        width: 8rem;
    }







    .login-container h2 {
        font-size: 2rem;
        font-weight: bold;
        color: var(--seventh-color);
    }

    .login-container p {
        font-size: 1.3rem;
        color: var(--seventh-color4);
    }

    .login-container label {
        font-size: 1.4rem;
        font-weight: bold;
        color: var(--seventh-color);
    }


    /* input container */


    .input-container {
        position: relative;
        width: 100%;
    }

    .input-container input {
        padding-left: 40px;
        /* Space for the icon */
        width: 100%;
        height: 40px;
        box-sizing: border-box;
        border: 1px solid #ccc;
        border-radius: 5px;
        font-size: 1.4rem;
        color: var(--seventh-color);
        background-color: var(--seventh-color3);
    }

    .input-icon {
        color: var(--seventh-color);
        font-size: 20px;
        position: absolute;
        left: 10px;
        top: 45%;
        transform: translateY(-50%);
    }

    .input-icon2 {
        color: var(--seventh-color);
        font-size: 20px;
        position: absolute;
        left: 5px;
        top: 45%;
        transform: translateY(-50%);
    }


    /* end */



    .btn-grad {
        background-image: linear-gradient(to right, #2b5876 0%, #4e4376 51%, #2b5876 100%);
        margin-top: 20px;
        padding: 15px 0;
        text-align: center;
        text-transform: uppercase;
        transition: 0.5s;
        background-size: 200% auto;
        color: white;
        box-shadow: 0 0 1px #eee;
        border-radius: 5px;
        display: block;
        width: 100%;

    }

    .btn-grad:hover {
        background-position: right center;
        /* change the direction of the change here */
        color: #fff;
        text-decoration: none;
    }

    .signup-btn {
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        margin-top: 25vh;
        font-size: 1.3rem;
        gap: 5px;
        padding-bottom: 5vh;
    }


    .signup-btn a {
        font-weight: bold;
        color: var(--seventh-color);
    }


    .input-icon-name {
        color: var(--seventh-color);
        font-size: 20px;
        position: absolute;
        left: 5px;
        top: 45%;
        transform: translateY(-50%);
    }
</style>