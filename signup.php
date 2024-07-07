<?php
include ('db_connect.php');
session_start();

// Check if the user is already logged in
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
    header('Location: index.php');
    exit();
}


$message = "";
$isSuccess = false;

if (isset($_POST['signup'])) {
    $full_name = $_POST['full_name'];
    $contact_number = $_POST['contact_number'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $current_date_time = date('Y-m-d'); // Get the current date and time

    // Check if the email already exists in the database
    $check_email_query = "SELECT * FROM user_tbl WHERE email='$email'";
    $check_result = mysqli_query($con, $check_email_query);

    if (mysqli_num_rows($check_result) > 0) {
        $message = "Email is already taken";
        $isSuccess = false;
    } else {
        // Email is unique, proceed with registration
        $savedata = "INSERT INTO user_tbl (id ,full_name, contact_number, email, password, gender, birthdate, address,  date_created) 
                     VALUES ('','$full_name', '$contact_number', '$email', '$password','','','', '$current_date_time')";
        $query = mysqli_query($con, $savedata);

        if ($query) {
            $message = "Registered Successfully!";
            $isSuccess = true;
        } else {
            $message = "Form Submission Failed!";
            $isSuccess = false;
        }
    }

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
    <?php
    include 'important.php'
        ?>

    <!-- current page css -->
    <link rel="stylesheet" href="landing_css/signup.css?v=<?php echo time(); ?>">
    <link rel="shortcut icon" href="system_images/Picture4.png" type="image/png">
    <title>Sign up</title>
</head>

<body>

    <!-- sweetalert success -->
    <?php if (!empty($message)): ?>
        <script>
            Swal.fire({
                title: '<?php echo $isSuccess ? "Success!" : "Error!"; ?>',
                text: '<?php echo $message; ?>',
                icon: '<?php echo $isSuccess ? "success" : "error"; ?>'
            });
        </script>
    <?php endif; ?>


    <!-- for header -->
    <?php include 'header.php' ?>


    <div class="alignment-container">

        <!-- login page -->

        <main class="main-login">

            <form method="post" action="" class="login-container" onsubmit="return validateForm()">


                <div class="logo-container">
                    <img class="picture2" src="system_images/Picture4.png" alt="">
                    <hr>

                </div>

                <div>
                    <h2>Create an account✨</h2>
                    <p>Welcome! Please enter your details.</p>
                </div>

                <label for="">Name</label>

                <div class="input-container">
                    <span class="input-icon-name">&#128100;</span>
                    <input type="text" name="full_name" id="full_name"  placeholder="Enter your full name">
                </div>

                <label for="">Contact Number</label>

                <div class="input-container">
                    <span class="input-icon-phone">&phone;</span>
                    <input type="number" name="contact_number" id="contact_number" placeholder="Enter your contact number">
                </div>

                <label for="">Email</label>

                <div class="input-container">
                    <span class="input-icon-email">&#9993;</span>
                    <input type="email" name="email" id="email" placeholder="Enter your email">
                </div>


                <label for="">Password</label>
                <div class="input-container">
                    <span class="input-icon-password">&#128274;</span>
                    <input type="password" name="password" id="password" placeholder="Enter your password">
                </div>

                <?php
                if (isset($error_message)) {
                    echo "<p class='error-msg' style='color:red;'>$error_message</p>";
                }
                ?>

                <button name="signup" class="btn-grad">Sign up</button>

                <div class="signup-btn">
                    <p>Already have an account?</p>
                    <a href="login.php">Log in</a>
                </div>

            </form>
        </main>

    </div>

    <!-- footer -->
    <?php
    include 'footer.php'
        ?>


    <script>
        function validateForm() {
            let fullName = document.getElementById('full_name').value;
            let contactNumber = document.getElementById('contact_number').value;
            let email = document.getElementById('email').value;
            let password = document.getElementById('password').value;

            if (fullName === '' || contactNumber === '' || email === '' || password === '') {
                Swal.fire({
                    icon: 'error',
                    title: 'Validation Error',
                    text: 'All fields are required'
                });
                return false;
            }

            return true;
        }
    </script>


</body>



</html>