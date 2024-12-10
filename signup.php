<?php
include('db_connect.php');
session_start();

// Check if the user is already logged in
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
    header('Location: index.php');
    exit();
}

$message = "";
$isSuccess = false;

if (isset($_POST['signup'])) {
    $full_name = trim($_POST['full_name']);
    $contact_number = trim($_POST['contact_number']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password']; // Capture confirm password
    $current_date_time = date('Y-m-d'); // Current date

    // Validate inputs
    if (empty($full_name) || empty($contact_number) || empty($email) || empty($password) || empty($confirm_password)) {
        $message = "All fields are required.";
        $isSuccess = false;
    } elseif ($password !== $confirm_password) {
        $message = "Passwords do not match.";
        $isSuccess = false;
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message = "Invalid email format.";
        $isSuccess = false;
    } else {
        // Check if the email already exists
        $check_email_query = "SELECT * FROM user_tbl WHERE email='$email'";
        $check_result = mysqli_query($con, $check_email_query);

        if (mysqli_num_rows($check_result) > 0) {
            $message = "Email is already taken.";
            $isSuccess = false;
        } else {
            // No password hashing; store plain text password
            $plain_password = $password;

            // Insert the user into the database
            $savedata = "INSERT INTO user_tbl (id, full_name, contact_number, email, password, gender, birthdate, address, date_created, account_status) 
                         VALUES ('','$full_name', '$contact_number', '$email', '$plain_password','','','', '$current_date_time','active')";
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
    <link rel="stylesheet" href="landing_css/signup.css?v=<?php echo time(); ?>">
    <link rel="shortcut icon" href="system_images/Picture4.png" type="image/png">
    <title>Sign up</title>
</head>

<body>

    <!-- SweetAlert -->
    <?php if (!empty($message)): ?>
        <script>
            Swal.fire({
                title: '<?php echo $isSuccess ? "Success!" : "Error!"; ?>',
                html: '<?php echo $isSuccess ? "<h2>Welcome to the platform!</h2><p>Please log in to continue.</p>" : "<p>" . $message . "</p>"; ?>',
                icon: '<?php echo $isSuccess ? "success" : "error"; ?>',
                confirmButtonText: 'Okay',
                allowOutsideClick: false,
                allowEscapeKey: false
            }).then((result) => {
                if (result.isConfirmed && <?php echo $isSuccess ? 'true' : 'false'; ?>) {
                    // Redirect to login.php if the signup was successful
                    window.location.href = "login.php";
                }
            });
        </script>
    <?php endif; ?>



    <!-- Header -->
    <?php include 'header.php'; ?>

    <div class="alignment-container">

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

                <label for="full_name">Name</label>
                <div class="input-container">
                    <span class="input-icon-name">&#128100;</span>
                    <input type="text" name="full_name" id="full_name" placeholder="Enter your full name">
                </div>

                <label for="contact_number">Contact Number</label>
                <div class="input-container">
                    <span class="input-icon-phone">&phone;</span>
                    <input type="number" name="contact_number" id="contact_number" placeholder="Enter your contact number">
                </div>

                <label for="email">Email</label>
                <div class="input-container">
                    <span class="input-icon-email">&#9993;</span>
                    <input type="email" name="email" id="email" placeholder="Enter your email">
                </div>

                <label for="password">Password</label>
                <div class="input-container">
                    <span class="input-icon-password">&#128274;</span>
                    <input type="password" name="password" id="password" placeholder="Enter your password">
                </div>

                <label for="confirm_password">Confirm Password</label>
                <div class="input-container">
                    <span class="input-icon-password">&#128274;</span>
                    <input type="password" name="confirm_password" id="confirm_password" placeholder="Confirm your password">
                </div>

                <?php if (isset($error_message)): ?>
                    <p class="error-msg" style="color:red;"><?php echo $error_message; ?></p>
                <?php endif; ?>

                <button name="signup" class="btn-grad">Sign up</button>

                <div class="signup-btn">
                    <p>Already have an account?</p>
                    <a href="login.php">Log in</a>
                </div>
            </form>
        </main>
    </div>

    <!-- Footer -->
    <?php include 'footer.php'; ?>

    <!-- JavaScript Validation -->
    <script>
        function validateForm() {
            let fullName = document.getElementById('full_name').value;
            let contactNumber = document.getElementById('contact_number').value;
            let email = document.getElementById('email').value;
            let password = document.getElementById('password').value;
            let confirmPassword = document.getElementById('confirm_password').value;

            if (fullName === '' || contactNumber === '' || email === '' || password === '' || confirmPassword === '') {
                Swal.fire({
                    icon: 'error',
                    title: 'Validation Error',
                    text: 'All fields are required'
                });
                return false;
            }

            if (password !== confirmPassword) {
                Swal.fire({
                    icon: 'error',
                    title: 'Validation Error',
                    text: 'Passwords do not match'
                });
                return false;
            }

            return true;
        }
    </script>
</body>

</html>