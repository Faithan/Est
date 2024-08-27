<?php
session_start();

if (isset($_SESSION['admin'])) {
    // Unset admin session variables
    unset($_SESSION['admin']);
    header("Location:login.php");
    exit();
}

if (isset($_SESSION['user'])) {
    // Unset user session variables
    unset($_SESSION['user']);
    header("Location: user_login.php");
    exit();
}
?>