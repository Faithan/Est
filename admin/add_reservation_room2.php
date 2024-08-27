<?php
include('db_connect.php');
session_start();

if (isset($_GET['manage_id'])) {
    $manage_id = $_GET['manage_id'];
    $manage_query = "SELECT * FROM room_tbl WHERE id = $manage_id";
    $manage_result = mysqli_query($con, $manage_query);
    $manage_data = mysqli_fetch_assoc($manage_result);
}


//when form is submitted
if (isset($_POST['submit'])) {
    $fname = $_POST['first_name'];
    $mname = $_POST['middle_name'];
    $lname = $_POST['last_name'];
    $address = $_POST['address'];
    $phone_number = $_POST['phone_number'];
    $email = $_POST['email'];
    $date_of_arrival = $_POST['date_of_arrival'];
    $time = $_POST['time'];
    $room_number = $_POST['room_number'];
    $room_type = $_POST['room_type'];
    $bed_type = $_POST['bed_type'];
    $bed_quantity = $_POST['bed_quantity'];
    $number_of_person = $_POST['number_of_person'];
    $amenities = $_POST['amenities'];
    $price = $_POST['price'];
    $special_request = $_POST['special_request'];
    $photo = $manage_data['photo'];
    $savedata = "INSERT INTO reserve_room_tbl  VALUES (
    '',
    'n/a', 
    'pending',
    'walk-in',
    '$fname',
    '$mname',
    '$lname',
    '$address',
    '$phone_number',
    '$email',
    '$date_of_arrival',
    '$time',
    '$room_number',
    '$room_type',
    '$bed_type',
    '$bed_quantity',
    '$number_of_person',
    '$amenities',
    '$price',
    '$special_request',
    '$photo',
    '',
    '',
    '',
    '',
    '',
    '',
    '',
    '',
    '')";

    $query = (mysqli_query($con, $savedata));




    if ($query) { // Replace this condition with your actual success condition
        $message = "Reservation Sent Successfully! please wait for confirmation";
        $isSuccess = true;
    } else {
        $message = "Form Submission Failed!";
        $isSuccess = false;
    }

}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- important files -->
    <?php
    include 'assets.php'
        ?>


    <title>Walk-in Room Reservation</title>

    <script src="javascripts/add_room.js" defer></script>

    <link rel="stylesheet" type="text/css" href="css/main.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" type="text/css" href="css/sidenav2.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" type="text/css" href="css/walkInReservation.css?v=<?php echo time(); ?>">
    <link rel="shortcut icon" href="../system_images/Picture4.png" type="image/png">

</head>

<body>

    <main>

        <section class="side-nav">
            <div class="menu-container">
                <div class="logo-container">
                    <img src="../system_images/suntree.png" alt="">
                    <label for="">Estregan Beach Resort</label>
                </div>

                <div class="menu">

                    <div class="item"><a href="add_reservation_room.php"><i class="fa-regular fa-circle-left"></i>
                            Return</a>
                    </div>



                </div>


            </div>

            <div class="logout-container">
                <a><i class="fa-solid fa-right-from-bracket fa-flip-horizontal"></i> Log out</a>
            </div>


        </section>

        <section class="middle-container">

            <div class="header-container">
                <div class="title-head">

                    <label for=""><i class="fa-solid fa-gear"></i> Walk-in Room Reservation</label>
                </div>

                <div class="title-head-right">
                    <div class="switch-mode">
                        <i class="fa-regular fa-moon" id="icon"></i>
                    </div>



                    <!-- switchmode -->
                    <script>
                        document.addEventListener('DOMContentLoaded', function () {
                            // Check localStorage for dark mode status
                            const darkMode = localStorage.getItem('darkMode') === 'enabled';
                            const body = document.body;
                            const icon = document.getElementById('icon');
                            const logoImg = document.getElementById('logoImg');

                            // If dark mode is enabled, apply the relevant classes
                            if (darkMode) {
                                body.classList.add('dark-mode');
                                if (icon) {
                                    icon.classList.remove('fa-moon');
                                    icon.classList.add('fa-sun');
                                }
                                if (logoImg) {
                                    logoImg.classList.add('invert-color');
                                }
                            }

                            // Add event listener to toggle dark mode
                            if (icon) {
                                icon.addEventListener('click', function () {
                                    body.classList.toggle('dark-mode');

                                    if (body.classList.contains('dark-mode')) {
                                        icon.classList.remove('fa-moon');
                                        icon.classList.add('fa-sun');
                                        if (logoImg) {
                                            logoImg.classList.add('invert-color');
                                        }
                                        localStorage.setItem('darkMode', 'enabled');
                                    } else {
                                        icon.classList.remove('fa-sun');
                                        icon.classList.add('fa-moon');
                                        if (logoImg) {
                                            logoImg.classList.remove('invert-color');
                                        }
                                        localStorage.removeItem('darkMode');
                                    }
                                });
                            }
                        });
                    </script>


                    <img src="../system_images/administrator.png" alt="" id="logoImg">
                </div>
            </div>











            <!-- dynamic content -->

            <div class="center-container">


























                <form action="" method="POST" enctype="multipart/form-data" class="create-room-form">
                    <div class="head-label">
                        <label> ADD RESERVATION</label>
                    </div>


                    <div class="input-fields-container">

                        <div class="adding-photo-container">
       
                                <img name="photo" src="<?php echo htmlspecialchars($manage_data['photo']); ?>" alt="">
   
                        </div>

                        <div class="input-fields">
                            <label for="room_type">First Name:</label>
                            <input type="text" name="first_name" id="first_name" class="input_fields" required>
                        </div>



                        <div class="input-fields">
                            <label for="room_type">Middle Name:</label>
                            <input type="text" name="middle_name" id="middle_name" class="input_fields" required>
                        </div>


                        <div class="input-fields">
                            <label for="room_type">Last Name:</label>
                            <input type="text" name="last_name" id="last_name" class="input_fields" required>
                        </div>

                        <div class="input-fields">
                            <label for="room_type">Adress:</label>
                            <input type="text" name="address" id="address" class="input_fields" required>
                        </div>

                        <div class="input-fields">
                            <label for="room_type">Phone Number:</label>
                            <input type="number" name="phone_number" id="phone_number" class="input_fields" required>
                        </div>

                        <div class="input-fields">
                            <label for="room_type">Email (optional):</label>
                            <input type="text" name="email" id="email" class="input_fields">
                        </div>

                        <div class="input-fields">
                            <label for="room_type">Arrival Date:</label>
                            <input type="date" name="date_of_arrival" id="date_of_arrival" class="input_fields"
                                required>
                        </div>

                        <div class="input-fields">
                            <label for="room_type">Check-in Time:</label>
                            <input type="time" name="time" id="time" class="input_fields" required>
                        </div>



                        <div class="input-fields">
                            <label for="">Room Number:</label>
                            <input type="text" id="roomNumber" name="room_number" class="input_fields_fixed"
                                value="<?php echo htmlspecialchars($manage_data['room_number']); ?>" readonly>
                        </div>


                        <div class="input-fields">
                            <label for="">Room Type:</label>
                            <input type="text" id="room_type" name="room_type" class="input_fields_fixed"
                                value="<?php echo htmlspecialchars($manage_data['room_type']); ?>" readonly>
                        </div>

                        <div class="input-fields">
                            <label for="">Bed Type:</label>
                            <input type="text" id="bed_type" name="bed_type" class="input_fields_fixed"
                                value="<?php echo htmlspecialchars($manage_data['bed_type']); ?>" readonly>
                        </div>


                        <div class="input-fields">
                            <label for="">Number of Bed:</label>
                            <input type="number" id="bed_quantity" name="bed_quantity" class="input_fields_fixed"
                                value="<?php echo htmlspecialchars($manage_data['bed_quantity']); ?>" readonly>
                        </div>

                        <div class="input-fields">
                            <label for="">Number of Persons:</label>
                            <input type="number" id="number_of_person" name="number_of_person"
                                class="input_fields_fixed"
                                value="<?php echo htmlspecialchars($manage_data['no_persons']); ?>" readonly>
                        </div>


                        <div class="input-fields">
                            <label for="">Amenities:</label>
                            <input type="text" id="amenities" name="amenities" class="input_fields_fixed"
                                value="<?php echo htmlspecialchars($manage_data['amenities']); ?>" readonly>
                        </div>

                        <div class="input-fields">
                            <label for="">Price:</label>
                            <input type="number" id="price" name="price" class="input_fields_fixed"
                                value="<?php echo htmlspecialchars($manage_data['price']); ?>" readonly>
                        </div>
                        <div class="input-fields">
                            <label>Do you have any special request?</label>
                            <textarea name="special_request"></textarea>
                        </div>



                    </div>


                    <div class="button-container2">
                        <button type="submit" name="submit" class="button1"><i class="fa-solid fa-calendar-check"></i>
                            Book</button>
                    </div>



                </form>





                <!-- for save -->
                <?php if (!empty($message)): ?>
                    <script>
                        Swal.fire({
                            title: '<?php echo $isSuccess ? "Success!" : "Error!"; ?>',
                            text: '<?php echo $message; ?>',
                            icon: '<?php echo $isSuccess ? "success" : "error"; ?>',
                            showConfirmButton: true
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = window.location.href;
                            }
                        });
                    </script>
                <?php endif; ?>





            </div>















        </section>

    </main>



</body>

</html>