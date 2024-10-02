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


<!-- chart js -->
<script src="chartjs/chart.js"></script>
<script src="chartjs/moment.js"></script>
<script src="chartjs/adapter_moment.js"></script>

<!-- header css -->
<link rel="stylesheet" type="text/css" href="css/header.css?v=<?php echo time(); ?>">

<!-- css and js jquery -->
<script src="../jquery/jquery-3.6.0.min.js"></script>
<script src="../jquery/jquery-ui.min.js"></script>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
