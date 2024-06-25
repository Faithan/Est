<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- important additional css -->
    <script src="sweetalert/sweetalert.js"></script>

    <link href="fontawesome/css/fontawesome.css" rel="stylesheet" />
    <link href="fontawesome/css/brands.css" rel="stylesheet" />
    <link href="fontawesome/css/solid.css" rel="stylesheet" />

   
    <!-- reset css -->
    <link rel="stylesheet" type="text/css" href="landing_css/reset.css?v=<?php echo time(); ?>">
    <!-- important css -->
   
    <link rel="stylesheet" type="text/css" href="landing_css/header.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" type="text/css" href="landing_css/footer.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" type="text/css" href="landing_css/login.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" type="text/css" href="landing_css/main.css?v=<?php echo time(); ?>">
    <!-- current page css -->
    <link rel="stylesheet" href="landing_css/index.css?v=<?php echo time(); ?>">
    <link rel="shortcut icon" href="system_images/Picture4.png" type="image/png">
    <title>Sign In</title>
</head>

<body>

    <!-- for header -->
    <?php include 'header.php' ?>

    <!-- home page -->
    <main class="main-home">
        <div class="wrapper-main">
            <div class="home-content">
                <div>
                    <h1>Welcome to Estregan Beach Resort</h1>
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
        </div>

    </main>




    <!-- reservation page -->
    <section class="reservation-page">
        <div class="wrapper-main">
            <h1>Reservation</h1>

            <p>Welcome to the Reservation Section of Estregan Beach Resort! Experience convenience at your
                fingertips as
                you explore our seamless online booking system. Discover the perfect blend of comfort and luxury
                with
                our range of rooms and cottages. Whether you seek a tranquil retreat or an adventure-filled getaway,
                our
                reservation platform ensures a hassle-free booking experience. Embrace the beauty of Estregan Beach
                Resort and secure your dream accommodation with just a few clicks. Start planning your unforgettable
                vacation today!</p>

        </div>


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
        <div class="wrapper-main about-page-flex">
            <div class="about-page-content">

                <label for="">About Estregan </label>

                <hr>
                <p>Estregan Beach Resort provides the best quality of services applying top quality guest house
                    and conference facilities, in order to fulfill the best way in the relevant needs of every guest.
                    Provide our guests a unique experience, through which they connect with the best in our company,
                    and to offer top quality service to our entire guest and provided comfort abundance. Join us, and
                    experience the vacation of your dreams at Estregan Beach Resort.</p>
                <div class="image-holder"><img src="system_images/estregan.png" alt="Estregan Beach"></div>

            </div>

        </div>

    </section>




    <!-- footer -->
   <?php include 'footer.php' ?>




</body>



</html>