<?php
include('db_connect.php');
session_start();

$gender = 'N/A';
$birthdate = 'N/A';
$address = 'N/A';

// Retrieve the user ID of the logged-in user from the session if the user is logged in
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id']; // Assuming you store the user ID in the session

    // Query the database to retrieve the profile information based on the user ID
    $query = "SELECT * FROM user_tbl WHERE id = $user_id";

    // Execute the query
    $result = mysqli_query($con, $query); // Assuming $con is your database connection

    // Check if the query was successfully executed
    if ($result) {
        $row = mysqli_fetch_assoc($result);

        // Display the retrieved information
        if ($row) {
            $full_name = $row['full_name'];
            $contact_number = $row['contact_number'];
            $email = $row['email'];
            $date_created = $row['date_created'];
            $gender = $row['gender'];
            $birthdate = $row['birthdate'];
            $address = $row['address'];
            $password = $row['password'];

        }
    } else {
        echo "Query failed.";
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


    <!-- important additional css -->
    <?php
    include 'important.php'
        ?>

    <!-- current page css -->
    <link rel="stylesheet" href="landing_css/profile.css?v=<?php echo time(); ?>">
    <link rel="shortcut icon" href="system_images/Picture4.png" type="image/png">
    <title>Profile</title>

</head>

<body>



    <!-- for header -->
    <?php include 'header.php' ?>


    <!-- home page -->
    <main class="profile-main">
        <div class="wrapper-main profile-main-flex">
            <div class="profile-icon">
                <img src="system_images/profile-user.png" alt="">

                <!-- profile name -->
                <h1><?php echo $full_name; ?></h1>
                <!-- profile created time -->
                <p>Active since - <?php echo $date_created; ?></p>
            </div>

            <div class="personal-info-container">
                <div class="header-label">
                    <h1>Personal information</h1>

                </div>

                <div class="personal-info">
                    <div class="info">
                        <p><i class="fa-solid fa-envelope"></i> Email</p>
                        <div class="info-content">
                            <p><?php echo $email; ?></p><a href="editEmail.php"><i
                                    class="fa-solid fa-pen-to-square"></i></a>
                        </div>
                    </div>
                    <div class="info">
                        <p><i class="fa-solid fa-phone"></i> Phone Number</p>
                        <div class="info-content">
                            <p><?php echo $contact_number; ?></p><a href="editContactNumber.php"><i
                                    class="fa-solid fa-pen-to-square"></i></a>
                        </div>
                    </div>
                    <div class="info">
                        <p><i class="fa-solid fa-venus-mars"></i> Gender</p>
                        <div class="info-content">
                            <p><?php echo $gender; ?></p><a href="editGender.php"><i
                                    class="fa-solid fa-pen-to-square"></i></a>
                        </div>
                    </div>
                    <div class="info">
                        <p><i class="fa-solid fa-cake-candles"></i> Birthdate</p>
                        <div class="info-content">
                            <p><?php echo $birthdate; ?></p><a href="editBirthdate.php"><i
                                    class="fa-solid fa-pen-to-square"></i></a>
                        </div>
                    </div>
                    <div class="info">
                        <p><i class="fa-solid fa-map-marker-alt"></i> Address</p>
                        <div class="info-content">
                            <p><?php echo $address; ?></p><a href="editAddress.php"><i
                                    class="fa-solid fa-pen-to-square"></i></a>
                        </div>
                    </div>
                </div>


                <div class="header-label">
                    <h1>Password And Security</h1>
                </div>


                <div class="personal-info">
                    <div class="info">
                        <p><i class="fa-solid fa-lock"></i> Password</p>
                        <div class="info-content">
                            <p><?php echo str_repeat('•', strlen($password)); ?></p>
                            <a href="#" id="editPasswordLink"><i class="fa-solid fa-pen-to-square"></i></a>
                        </div>
                    </div>
                </div>

                <script>
                    document.getElementById('editPasswordLink').addEventListener('click', function (event) {
                        event.preventDefault();

                        Swal.fire({
                            title: 'Enter your password',
                            input: 'password',
                            inputPlaceholder: 'Enter your password',
                            showCancelButton: true,
                            confirmButtonText: 'Proceed',
                            preConfirm: (password) => {
                                return fetch('validate_password.php', {
                                    method: 'POST',
                                    headers: {
                                        'Content-Type': 'application/x-www-form-urlencoded'
                                    },
                                    body: 'password=' + encodeURIComponent(password)
                                })
                                    .then(response => {
                                        if (!response.ok) {
                                            throw new Error(response.statusText);
                                        }
                                        return response.json();
                                    })
                                    .then(data => {
                                        if (!data.success) {
                                            Swal.showValidationMessage(data.message || 'Incorrect password');
                                            return false;
                                        }
                                        return true;
                                    })
                                    .catch(error => {
                                        console.error('Error:', error);
                                        Swal.showValidationMessage('An unexpected error occurred: ' + error.message);
                                    });
                            }
                        }).then((result) => {
                            if (result.isConfirmed) {
                                // Set a session variable to indicate the user has been authenticated
                                fetch('set_authenticated.php', {
                                    method: 'POST',
                                    headers: {
                                        'Content-Type': 'application/x-www-form-urlencoded'
                                    },
                                    body: 'authenticated=true'
                                }).then(() => {
                                    window.location.href = 'editPassword.php';
                                });
                            }
                        });
                    });

                </script>

                <div class="header-label">
                    <h1>Account Control</h1>
                </div>

                <div class="personal-info">
                    <a id="deleteAccountLink" href="javascript:void(0);">
                        <p><i class="fa-solid fa-trash-can"></i> Delete Account?</p>
                    </a>

                </div>





                <script>
                    document.getElementById('deleteAccountLink').addEventListener('click', function () {
                        Swal.fire({
                            title: 'Are you sure?',
                            text: "This action will permanently delete your account!",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Yes, delete it!'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                // Show a prompt to enter password
                                Swal.fire({
                                    title: 'Enter your password',
                                    input: 'password',
                                    inputLabel: 'Your password',
                                    inputPlaceholder: 'Enter your password',
                                    inputAttributes: {
                                        autocapitalize: 'off'
                                    },
                                    showCancelButton: true,
                                    confirmButtonText: 'Submit',
                                    cancelButtonText: 'Cancel',
                                    inputValidator: (value) => {
                                        if (!value) {
                                            return 'You need to enter your password!';
                                        }
                                    }
                                }).then((passwordResult) => {
                                    if (passwordResult.isConfirmed) {
                                        const password = passwordResult.value;

                                        // Send the password to the server for verification
                                        fetch('delete_account.php', {
                                            method: 'POST',
                                            headers: {
                                                'Content-Type': 'application/json'
                                            },
                                            body: JSON.stringify({ password: password })
                                        })
                                            .then(response => response.json())
                                            .then(data => {
                                                if (data.success) {
                                                    Swal.fire(
                                                        'Deleted!',
                                                        'Your account has been deleted.',
                                                        'success'
                                                    ).then(() => {
                                                        window.location.href = 'logout.php'; // Redirect or handle post-delete action
                                                    });
                                                } else {
                                                    Swal.fire(
                                                        'Error!',
                                                        'Incorrect password. Please try again.',
                                                        'error'
                                                    );
                                                }
                                            })
                                            .catch(error => {
                                                console.error('Error:', error);
                                                Swal.fire(
                                                    'Error!',
                                                    'An unexpected error occurred.',
                                                    'error'
                                                );
                                            });
                                    }
                                });
                            }
                        });
                    });
                </script>


            </div>
        </div>
    </main>







    <!-- footer -->
    <?php include 'footer.php' ?>




</body>



</html>