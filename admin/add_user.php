<?php
require 'db_connect.php';
session_start();



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
        $savedata = "INSERT INTO user_tbl (id ,full_name, contact_number, email, password, gender, birthdate, address,  date_created, account_status) 
                     VALUES ('','$full_name', '$contact_number', '$email', '$password','','','', '$current_date_time','active')";
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
    <?php include 'assets.php'; ?>
    <title>User Edit</title>

    <script src="javascripts/switch.js"></script>

    <link rel="stylesheet" type="text/css" href="css/main.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" type="text/css" href="css/dashboard.css?v=<?php echo time(); ?>">
    <link rel="shortcut icon" href="../system_images/Picture4.png" type="image/png">
</head>

<body>

    <main>
        <?php include 'sidenav.php'; ?>

        <section class="middle-container">
            <div class="header-container">
                <div class="title-head">
                    <label for=""><i class="fa-solid fa-user-gear"></i> User Settings</label>
                </div>

                <div class="title-head-right">
                    <div class="switch-mode">
                        <i class="fa-regular fa-moon" id="icon"></i>
                    </div>
                    <img src="../system_images/administrator.png" alt="" id="logoImg">
                </div>
            </div>

            <!-- dynamic content -->
            <div class="center-container">
                <form method="post" action="" class="login-container" onsubmit="return validateForm()">


                    <div class="logo-container">
                        <img class="picture2" src="../system_images/Picture4.png" alt="">
                        <hr>

                    </div>

                    <div>
                        <h2>Add an User Account✨</h2>
                        <p> Please enter the user details.</p>
                    </div>

                    <label for="">Name</label>

                    <div class="input-container">

                        <input type="text" name="full_name" id="full_name" placeholder="Enter your full name">
                    </div>

                    <label for="">Contact Number</label>

                    <div class="input-container">

                        <input type="number" name="contact_number" id="contact_number"
                            placeholder="Enter your contact number">
                    </div>

                    <label for="">Email</label>

                    <div class="input-container">

                        <input type="email" name="email" id="email" placeholder="Enter your email">
                    </div>


                    <label for="">Password</label>
                    <div class="input-container">

                        <input type="password" name="password" id="password" placeholder="Enter your password">
                    </div>

                    <?php
                    if (isset($error_message)) {
                        echo "<p class='error-msg' style='color:red;'>$error_message</p>";
                    }
                    ?>

                    <button name="signup" class="btn-grad">Add User</button>

                </form>
            </div>
        </section>
    </main>

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

    <!-- SweetAlert integration -->
    <?php if (!empty($message)): ?>
        <script>
            Swal.fire({
                title: '<?php echo $isSuccess ? "Success!" : "Error!"; ?>',
                text: '<?php echo $message; ?>',
                icon: '<?php echo $isSuccess ? "success" : "error"; ?>',
                showConfirmButton: true
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = 'dashboardUserSettings.php'; // Redirect after confirmation
                }
            });
        </script>
    <?php endif; ?>

</body>

</html>






<style>
    .login-container {
        margin: 10px 0 0 0;
        height: fit-content;
        padding: 10px;
        background-color: var(--first-color);
        display: flex;
        flex-direction: column;
    }



    .login-container .logo-container {
        display: flex;
        justify-content: center;
        align-items: center;

    }

    .login-container .logo-container hr {
        border: 1px solid var(--seventh-color3);
        width: 90%;
        height: 1px;

    }

    .login-container .logo-container img {
        height: 10rem;
        width: 10rem;
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
    }

  
    .input-container input {
        width: 100%;
        /* Space for the icon */
        height: 40px;
        box-sizing: border-box;
        border: 1px solid #ccc;
        border-radius: 5px;
        font-size: 1.4rem;
        color: var(--seventh-color);
        background-color: var(--seventh-color3);
    }

    .input-container input[name="full_name"] {
        text-transform: capitalize;
    }

    .input-icon-email {
        color: var(--seventh-color);
        font-size: 20px;
        position: absolute;
        left: 10px;
        top: 45%;
        transform: translateY(-50%);
    }

    .input-icon-password {
        color: var(--seventh-color);
        font-size: 20px;
        position: absolute;
        left: 5px;
        top: 45%;
        transform: translateY(-50%);
    }

    .input-icon-name {
        color: var(--seventh-color);
        font-size: 20px;
        position: absolute;
        left: 5px;
        top: 45%;
        transform: translateY(-50%);
    }



    .input-icon-phone {
        color: var(--seventh-color);
        font-size: 20px;
        position: absolute;
        left: 10px;
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
</style>