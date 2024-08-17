<?php
include('db_connect.php');
session_start();

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if the user is already logged in
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
    header('Location: index.php');
    exit();
}

// For user login
if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Prepare a statement to prevent SQL injection
    $stmt = $con->prepare("SELECT * FROM user_tbl WHERE email = ? AND password = ?");
    $stmt->bind_param("ss", $email, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();

        // Check account status
        if ($user['account_status'] == 'active') {
            $_SESSION['loggedin'] = true;
            $_SESSION['email'] = $email;
            header('Location: index.php');
            exit();
        } else {
            $error_message = "Your account is not active.";
        }
    } else {
        $error_message = "Invalid email or password.";
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- reset css -->
    <link rel="stylesheet" type="text/css" href="landing_css/reset.css?v=<?php echo time(); ?>">

    <!-- javascript -->
    <script src="landing_js/wavingtext.js" defer></script>
    <script src="landing_js/mobileMenu.js" defer></script>

    <!-- important additional css -->
    <?php include 'important.php'; ?>

    <!-- current page css -->
    <link rel="stylesheet" href="landing_css/login.css?v=<?php echo time(); ?>">
    <link rel="shortcut icon" href="system_images/Picture4.png" type="image/png">
    <title>Login</title>
</head>

<body>

    <!-- for header -->
    <?php include 'header.php'; ?>

    <div class="alignment-container">

        <!-- login page -->
        <main class="main-login">
            <form method="post" action="" class="login-container">

                <div class="logo-container">
                    <img class="picture2" src="system_images/Picture4.png" alt="">
                    <hr>
                </div>

                <div>
                    <h2>Log in to your account✨</h2>
                    <p>Welcome to Estregan Beach Resort! 🌊</p>
                </div>

                <label for="">Email</label>
                <div class="input-container">
                    <span class="input-icon">&#9993;</span>
                    <input type="email" name="email" placeholder="Enter your email">
                </div>

                <label for="">Password</label>
                <div class="input-container">
                    <span class="input-icon2">&#128274;</span>
                    <input type="password" name="password" placeholder="Enter your password">
                </div>

                <?php
                if (isset($error_message)) {
                    echo "<p class='error-msg' style='color:red;'>$error_message</p>";
                }
                ?>

                <button name="login" class="btn-grad">Log in</button>

                <div class="signup-btn">
                    <p>Don't have an account?</p>
                    <a href="signup.php">Sign up</a>
                </div>

            </form>
        </main>

    </div>

    <!-- footer -->
    <?php include 'footer.php'; ?>

</body>

</html>
