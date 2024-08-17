<?php
session_start();
if (isset($_POST['authenticated'])) {
    $_SESSION['authenticated'] = $_POST['authenticated'] === 'true';
}
?>
