<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <script src="sweetalert/sweetalert.js"></script>

    <link href="fontawesome/css/fontawesome.css" rel="stylesheet" />
    <link href="fontawesome/css/brands.css" rel="stylesheet" />
    <link href="fontawesome/css/solid.css" rel="stylesheet" />

    <link rel="shortcut icon" href="system_images/Picture4.png" type="image/png">

    <link rel="stylesheet" type="text/css" href="landing_css/reset.css?v=<?php echo time(); ?>">

    <link rel="stylesheet" type="text/css" href="landing_css/header.css?v=<?php echo time(); ?>">


    <link rel="stylesheet" type="text/css" href="landing_css/login.css?v=<?php echo time(); ?>">

    <link rel="stylesheet" href="landing_css/index.css?v=<?php echo time(); ?>">

    <title>Sign In</title>
</head>

<body>

    <!-- for header -->
    <?php include 'header.php' ?>

    <!-- home page -->
    <main class="main-home">
        <div class="home-content">
            <div>
                <h1>RESERVE FOR COTTAGES</h1>
                <p>A place to Stay, A place to Enjoy, A place to Relax.
                    We openly welcome you to stay a moment, for the sea is just beyond the door.
                </p>

                <button class="learn-more">
                    <span class="circle" aria-hidden="true">
                        <span class="icon arrow"></span>
                    </span>
                    <span class="button-text">Learn More</span>
                </button>

            </div>
        </div>
    </main>


    <div class="separator"></div>


    <!-- reservation page -->
    <section class="reservation-page">

        <h1>RESERVATION</h1>

        <a href="#" class="category-box">
            <div class="dark-overlay"></div>
            <h2>Cottages</h2>
        </a>
        <a href="#" class="category-box">
            <div class="dark-overlay"></div>
            <h2>Rooms</h2>
        </a>
    </section>


    <!-- about page -->
    <section class="about-page">
        <div class="about-page-content">
            <div class="header-text"><label for="">ABOUT ESTREGAN</label></div>
            <hr>
            <p>Estregan Beach Resort provides the best quality of services applying top quality guest house
                and conference facilities, in order to fulfill the best way in the relevant needs of every guest.
                Provide our guests a unique experience, through which they connect with the best in our company,
                and to offer top quality service to our entire guest and provided comfort abundance. Join us, and
                experience the vacation of your dreams at Estregan Beach Resort.</p>
            <div class="image-holder"><img src="system_images/estregan.png" alt="Estregan Beach"></div>
            <h4>LOCATION ADDRESS</h4>
            <h5>Address: Estregan beach resort, 9215 Pikalawag SND, Lanao Del Norte.<h5>
                    <h5>Phone: 0977-804-3668<h5>
                            <h5>Email: info@estreganbeachresort.com<h5>
        </div>

    </section>







</body>



</html>