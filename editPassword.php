<?php
include('db_connect.php');
session_start();

// Check if the user is logged in and has accessed this page properly
if (!isset($_SESSION['user_id']) || !isset($_SESSION['authenticated']) || $_SESSION['authenticated'] !== true) {
    // Redirect to the profile page or show an error
    header('Location: profile.php');
    exit();
}

$user_id = $_SESSION['user_id'];
$gender = 'N/A';
$birthdate = 'N/A';
$address = 'N/A';
$password = 'N/A'; // Initialize the password variable

// Query the database to retrieve the profile information based on the user ID
$query = "SELECT * FROM user_tbl WHERE id = $user_id";
$result = mysqli_query($con, $query);

if ($result) {
    $row = mysqli_fetch_assoc($result);
    if ($row) {
        $full_name = $row['full_name'];
        $contact_number = $row['contact_number'];
        $email = $row['email'];
        $date_created = $row['date_created'];
        $gender = $row['gender'];
        $birthdate = $row['birthdate'];
        $address = $row['address'];
        $password = $row['password']; // Retrieve the password
    }
} else {
    echo "Query failed.";
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
    <?php include 'important.php'; ?>

    <!-- current page css -->
    <link rel="stylesheet" href="landing_css/editPassword.css?v=<?php echo time(); ?>">
    <link rel="shortcut icon" href="system_images/Picture4.png" type="image/png">
    <title>Edit Password</title>
</head>

<body>

    <!-- for header -->
    <?php include 'header.php'; ?>

    <!-- home page -->
    <main class="profile-main">
        <div class="wrapper-main profile-main-flex">
            <div class="personal-info-container">
                <div class="header-label">
                    <h1>Edit Password</h1>
                </div>

                <div class="personal-info">
                    <div class="info">
                        <p><i class="fa-solid fa-lock"></i> Password</p>
                        <div class="info-content">
                            <p><?php echo $password; ?></p> <!-- Masked password display -->
                        </div>
                    </div>
                </div>

                <div class="new-personal-info">
                    <form method="post" action="update_password.php" id="updatePasswordForm">
                        <div class="new-info">
                            <label for="current-password">Enter Current Password:</label>
                            <input type="password" name="current-password" id="current-password" required>
                            <label for="new-password">Enter New Password:</label>
                            <input type="password" name="new-password" id="new-password" required>
                            <label for="confirm-new-password">Confirm New Password:</label>
                            <input type="password" name="confirm-new-password" id="confirm-new-password" required>
                        </div>

                        <div class="button-container">
                            <button type="submit" id="save"><i class="fa-solid fa-floppy-disk"></i> Save</button>
                            <button type="button" id="cancel"
                                onclick="window.location.href='profile.php';">Cancel</button>
                        </div>
                    </form>

                </div>

                <script>
                    document.getElementById('updatePasswordForm').addEventListener('submit', function (event) {
                        event.preventDefault(); // Prevent the default form submission

                        const formData = new FormData(this);

                        fetch('update_password.php', {
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
    <?php include 'footer.php'; ?>

</body>

</html>