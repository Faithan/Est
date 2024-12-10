<?php
session_start();

// Destroy the session and clear cookies
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
    session_unset();
    session_destroy();
    setcookie(session_name(), '', time() - 3600, '/'); // Clear session cookie
}

header("Location: login.php");

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