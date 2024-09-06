<?php
include('db_connect.php');
session_start();


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

    <?php
    include 'important.php'
        ?>

    <!-- current page css -->
    <link rel="stylesheet" href="landing_css/index.css?v=<?php echo time(); ?>">

    <title>Estregan Beach Resort</title>
</head>

<body>

    <!-- for header -->
    <?php include 'header.php' ?>

    <!-- home page -->
    <main class="main-home">
        <div class="wrapper-main">
            <div class="home-content">
                <div class="welcome-container">
                    <div class="wave-text">
                        <h2>Welcome to Estregan Beach Resort</h2>
                        <h2>Welcome to Estregan Beach Resort</h2>
                    </div>

                    <div class="intro-content">
                        <p>A place to Stay, A place to Enjoy, A place to Relax.
                            We openly welcome you to stay a moment, for the sea is just beyond the door.
                        </p>
                    </div>

                    <div class="container">
                        <button class="btn">LEARN MORE</button>

                    </div>

                    <script>
                        document.querySelector('.btn').addEventListener('click', function () {
                            document.getElementById('about-page').scrollIntoView({
                                behavior: 'smooth'
                            });
                        });

                    </script>

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


        <a href="reservationCottage.php" class="category-box">
            <div class="dark-overlay"></div>
            <h2>Cottages</h2>
        </a>
        <a href="reservationRoom.php" class="category-box">
            <div class="dark-overlay"></div>
            <h2>Rooms</h2>
        </a>
    </section>


    <!-- about page -->
    <section class="about-page" id="about-page">

        <div class="about-page-content">
            <div class="wrapper-main">
                <h1 for="">About Estregan </h1>

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