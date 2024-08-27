<?php
session_start();

// Check if the user is logged in and log them out
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
    // Unset user-specific session variables
    unset($_SESSION['loggedin']);
    unset($_SESSION['email']);
    session_write_close(); // Close the session without destroying other sessions

    header("Location: login.php");
    exit();
}

// You may also want to handle admin logout separately in another script
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logged Out</title>
    <script src="sweetalert/sweetalert.js"></script>
   
    <style>
    body{
            background-color: var(--first-color);
        }
    </style>
</head>
<body>
    <script>
        Swal.fire({
            title: 'Logged Out',
            text: 'You have been logged out successfully!',
            icon: 'success'
        }).then(function() {
            window.location.href = 'login.php';
        });
    </script>
</body>
</html>