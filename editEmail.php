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
    <script src="landing_js/wavingtext.js" defer></script>
    <script src="landing_js/mobileMenu.js" defer></script>
    <script src="landing_js/scroll.js" defer></script>

    <!-- important additional css -->
    <?php
    include 'important.php'
        ?>

    <!-- current page css -->
    <link rel="stylesheet" href="landing_css/editEmail.css?v=<?php echo time(); ?>">
    <link rel="shortcut icon" href="system_images/Picture4.png" type="image/png">
    <title>Edit Email</title>

</head>

<body>



    <!-- for header -->
    <?php include 'header.php' ?>


    <!-- home page -->
    <main class="profile-main">
        <div class="wrapper-main profile-main-flex">

            <div class="personal-info-container">
                <div class="header-label">
                    <h1>Edit Email</h1>

                </div>

                <div class="personal-info">
                    <div class="info">
                        <p><i class="fa-solid fa-envelope"></i> Email</p>
                        <div class="info-content">
                            <p><?php echo $email; ?></p>
                        </div>
                    </div>

                </div>

                <div class="new-personal-info">
                    <form method="post" action="update_email.php" id="updateEmailForm">
                        <div class="new-info">
                            <label for="new-email">Enter New Email:</label>
                            <input type="email" name="new-email" id="new-email" required>
                            <label for="password">Enter Password:</label>
                            <input type="password" name="password" id="password" required>
                        </div>

                        <div class="button-container">
                            <button type="submit" id="save"><i class="fa-solid fa-floppy-disk"></i> Save</button>
                            <button type="button" id="cancel"
                                onclick="window.location.href='profile.php';">Cancel</button>
                        </div>
                    </form>
                </div>






                <script>
                    // JavaScript
                    document.getElementById('updateEmailForm').addEventListener('submit', function (event) {
                        event.preventDefault(); // Prevent the default form submission

                        const formData = new FormData(this);

                        fetch('update_email.php', {
                            method: 'POST',
                            body: formData
                        })
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    Swal.fire({
                                        title: 'Success!',
                                        text: data.message,
                                        icon: 'success',
                                        confirmButtonText: 'OK'
                                    }).then(() => {
                                        window.location.href = 'profile.php';
                                    });
                                } else {
                                    Swal.fire({
                                        title: 'Error!',
                                        text: data.message,
                                        icon: 'error',
                                        confirmButtonText: 'OK'
                                    });
                                }
                            })
                            .catch(error => {
                                console.error('Error:', error);
                                Swal.fire({
                                    title: 'Error!',
                                    text: 'An unexpected error occurred.',
                                    icon: 'error',
                                    confirmButtonText: 'OK'
                                });
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