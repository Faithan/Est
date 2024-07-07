<?php
include ('db_connect.php');
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
                    <a href=""><i class="fa-solid fa-user-pen"></i> Edit</a>
                </div>

                <div class="personal-info">
                    <div class="info"><p><i class="fa-solid fa-envelope"></i> Email</p> <p><?php echo $email; ?></p></div>
                    <div class="info"><p><i class="fa-solid fa-phone"></i> Phone Number</p> <p><?php echo $contact_number; ?></p></div>
                    <div class="info"><p><i class="fa-solid fa-venus-mars"></i> Gender</p> <p><?php echo $gender; ?></p></div>
                    <div class="info"><p><i class="fa-solid fa-cake-candles"></i> Birthdate</p> <p><?php echo $birthdate; ?></p></div>
                    <div class="info"><p><i class="fa-solid fa-map-location-dot"></i> Address</p> <p><?php echo $address; ?></p></div>
                </div>

                <div class="header-label">
                    <h1>Account Control</h1>
                </div>

                <div class="personal-info">
                    <a ><p><i class="fa-solid fa-trash-can"></i> Delete Account?</p></a>
                   
                </div>

            </div>
        </div>
    </main>







    <!-- footer -->
    <?php include 'footer.php' ?>




</body>



</html>