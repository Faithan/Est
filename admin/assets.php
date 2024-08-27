
<?php


if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

// Admin-specific content goes here
?>

<!-- fontawesome -->
<link href="../fontawesome/css/fontawesome.css" rel="stylesheet" />
<link href="../fontawesome/css/brands.css" rel="stylesheet" />
<link href="../fontawesome/css/solid.css" rel="stylesheet" />



<!-- sweetalert -->
<script src="../sweetalert/sweetalert.js"></script>


<!-- header css -->
<link rel="stylesheet" type="text/css" href="css/header.css?v=<?php echo time(); ?>">


