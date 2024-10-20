<?php
include('db_connect.php');
session_start();


$user_id = ''; // Initialize user_id


if (isset($_GET['manage_id'])) {
    $manage_id = $_GET['manage_id'];
    $manage_query = "SELECT * FROM reserve_cottage_tbl WHERE reserve_id = $manage_id";
    $manage_result = mysqli_query($con, $manage_query);
    $manage_data = mysqli_fetch_assoc($manage_result);
}

// Retrieve the user ID of the logged-in user from the session if the user is logged in
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id']; // Assuming you store the user ID in the session
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

    <script src="landing_js/mobileMenu.js" defer></script>
    <script src="landing_js/inputColor.js" defer></script>


    <!-- important additional css -->
    <?php
    include 'important.php'
    ?>

    <!-- current page css -->
    <link rel="stylesheet" href="landing_css/viewReservationCottage.css?v=<?php echo time(); ?>">

    <link rel="shortcut icon" href="system_images/Picture4.png" type="image/png">
    <title>View Reservation</title>

</head>

<body>
    <!-- sweetalert -->
    <?php if (!empty($message)): ?>
        <script>
            Swal.fire({
                title: '<?php echo $isSuccess ? "Success!" : "Error!"; ?>',
                text: '<?php echo $message; ?>',
                icon: '<?php echo $isSuccess ? "success" : "error"; ?>'
            });
        </script>
    <?php endif; ?>




    <!-- for cancel button -->
    <script>
        function confirmCancel() {
            Swal.fire({
                title: 'Cancel Confirmation',
                text: 'Are you sure you want to cancel this reservation?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, Cancel',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    cancelItem();
                }
            });
        }

        function cancelItem() {
            var id = document.querySelector('input[name="reserve_id"]').value;
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'cancel_reservationCottage.php', true);
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        Swal.fire({
                            title: 'Cancelled Successfully',
                            text: 'The reservation has been cancelled.',
                            icon: 'success'
                        }).then(() => {
                            window.location.href = 'myReservationCottage.php'; // Replace with your desired page after deletion
                        });
                    } else {
                        Swal.fire({
                            title: 'Cancellation Error',
                            text: 'Failed to cancel this reservation.',
                            icon: 'error'
                        });
                    }
                }
            };
            xhr.send('reserve_id=' + id);
        }
    </script>

    <!-- for header -->
    <?php include 'header.php' ?>




    <main>

        <div class="image-container">

            <?php
            $photo = str_replace('../', '', $manage_data['cottage_photo']);
            ?>
            <img name="photo" src="<?php echo $photo; ?>" alt="">
        </div>


        <form action="" method="post" class="reserveForm-contents">
            <input type="hidden" name="reserve_id" id="" value="<?php echo $manage_data['reserve_id']; ?>">

            <label class="bold-text">Reservation Status</label>

            <?php
            // Check if the status is 'cancelled' or 'rejected'
            $status = strtolower($manage_data['reserve_status']);
            $status_class = ($status === 'cancelled' || $status === 'rejected') ? 'status-error' : '';
            ?>

            <input class="fixed-value-input <?php echo $status_class; ?>" name="status"
                value="<?php echo $manage_data['reserve_status']; ?>" readonly>





            <p id="note">
                This section displays the status of your reservation, including pending, checked in, extended, checked
                out, rejected, or cancelled.
            </p>


            <label class="bold-text">Customer Details</label>


            <label>Full Name</label>


            <input class="fixed-value-input" name="first_name" onkeyup="changeColor(this)" placeholder="First Name"
                value="<?php echo $manage_data['first_name']; ?>" readonly>

            <input class="fixed-value-input" name="middle_name" onkeyup="changeColor(this)" placeholder="Middle Name"
                value="<?php echo $manage_data['middle_name']; ?>" readonly>


            <input class="fixed-value-input" name="last_name" onkeyup="changeColor(this)" placeholder="Last Name"
                value="<?php echo $manage_data['last_name']; ?>" readonly>


            <label>Address</label>
            <input class="fixed-value-input" name="reserve_address" onkeyup="changeColor(this)"
                placeholder="Ex: Maranding, Lala, Lanao Del Norte" value="<?php echo $manage_data['reserve_address']; ?>"
                readonly>

            <label>Phone Number</label>
            <input class="fixed-value-input" type="number" name="phone_number" onkeyup="changeColor(this)"
                placeholder="Ex: 09123456789" value="<?php echo $manage_data['phone_number']; ?>" readonly>

            <label>Email (optional)</label>
            <input class="fixed-value-input" class="input4" name="email" onkeyup="changeColor(this)"
                placeholder="Ex: Name@gmail.com" value="<?php echo $manage_data['email']; ?>" readonly>

            <label>Arrival Date</label>
            <input class="fixed-value-input" type="date" name="date_of_arrival" onkeyup="changeColor(this)"
                value="<?php echo $manage_data['date_of_arrival']; ?>" readonly>

            <label>Time </label>

            <input class="fixed-value-input" type="text" name="time" onkeyup="changeColor(this)"
                value="<?php echo $manage_data["time"] ?>" required readonly>
            <p id="comment"> (fixed)</p>

            <label class="bold-text">Room Details</label>

            <label>Cottage Number</label>
            <input class="fixed-value-input" name="room_number" onkeyup="changeColor(this)"
                value="<?php echo $manage_data['cottage_number']; ?>" readonly>

            <label>Room Type</label>
            <input class="fixed-value-input" name="cottage_type" onkeyup="changeColor(this)"
                value="<?php echo $manage_data['cottage_type']; ?>" readonly>


            <label>Number of Persons:</label>
            <input class="fixed-value-input" name="number_of_person" onkeyup="changeColor(this)"
                value="<?php echo $manage_data['number_of_person']; ?>" readonly>



            <label>Price (₱)</label>
            <input class="fixed-value-input" name="price" onkeyup="changeColor(this)"
                value="<?php echo $manage_data['price']; ?>" readonly>

            <p id="comment">(fixed)</p>

            <label>Special Request</label>
            <textarea class="fixed-value-textarea" name="special_request" onkeyup="changeColor(this)"
                readonly></textarea>

            <p id="note">
                <b>Note:</b>
                Once you have submitted your reservation, please await confirmation. During the review of your
                submitted data, we will be in contact with you.
            </p>


            <div class="reservationForm-buttons">
                <?php
                // Assuming $manage_data['status'] contains 'pending' as the value
                $status = $manage_data['reserve_status'];

                // Check if the $status variable is set and is equal to 'pending'
                if (isset($status) && strtolower($status) === 'pending') {
                    // Display the first anchor tag if the status is 'pending'
                    echo '<a class="cancel-btn" name="cancel" onclick="confirmCancel()">Cancel Reservation</a>';
                }
                ?>

                <a href="myReservationCottage.php" class="back-btn">Back</a>
            </div>



            <?php
            // Assuming you have already connected to your database via db_connect.php
            require('db_connect.php');

            // Fetch the gcash details from the database (assuming id = 1)
            $gcash_number = "";
            $gcash_photo = "";

            $sql = "SELECT gcash_number, gcash_photo FROM gcash_tbl WHERE id = 1";
            $result = $con->query($sql);

            if ($result && $result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $gcash_number = $row['gcash_number'];
                $gcash_photo = $row['gcash_photo'];
            }
            ?>

            <label class="bold-text">Reservation Payment Section</label>

            <label for="">Gcash Account Number:</label>
            <p id="gcashNumber" style="margin-bottom:20px; font-size:1.5rem;"><i class="fa-solid fa-phone"></i> <?php echo !empty($gcash_number) ? $gcash_number : 'No Gcash Number Set'; ?></p>

            <label class="bold-text">OR</label>

            <label for=""><i class="fa-solid fa-money-bill"></i> Scan QR Code</label>
            <!-- Displaying Gcash photo and number based on the database -->
            <img id="gcashImage" src="<?php echo !empty($gcash_photo) ? 'admin/' . $gcash_photo : 'default-image.jpg'; ?>" alt="Gcash Photo" style="margin-bottom: 50px; cursor:pointer; " onclick="viewFullScreen(this)">


        </form>


        <form id="reference-form" action="update_reference_cottage.php" method="post" class="reserveForm-contents">
            <input type="hidden" name="reserve_id" value="<?php echo $manage_data['reserve_id']; ?>">
            <label for="reference_number">Reference Number:</label>
            <input type="number" name="reference_number" id="reference_number" style="background-color:<?php echo ($manage_data['reserve_status'] === 'pending') ? '' : 'var(--after-input)'; ?>;" value="<?php echo $manage_data['reference_number']; ?>" required <?php echo ($manage_data['reserve_status'] === 'pending') ? '' : 'readonly'; ?>>
            <button id="reference-submit" type="submit" style="color:var(--seventh-color); border: 1px solid var(--seventh-color3); padding: 10px; background-color:var(--sixth-color); font-size:1.5rem; font-weight:bold; border-radius: 5px; display:<?php echo ($manage_data['reserve_status'] === 'pending') ? '' : 'none'; ?>;">Submit</button>
        </form>


        <script>
            document.getElementById('reference-form').addEventListener('submit', function(e) {
                e.preventDefault(); // Prevent the default form submission

                const formData = new FormData(this);

                fetch(this.action, {
                        method: 'POST',
                        body: formData,
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Updated!',
                                text: data.message,
                                confirmButtonText: 'OK',
                                confirmButtonColor: '#3085d6',
                            }).then(() => {
                                // Optionally reload the page or update the UI
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error!',
                                text: data.message,
                                confirmButtonText: 'OK',
                                confirmButtonColor: '#d33',
                            });
                        }
                    })
                    .catch(error => {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops!',
                            text: 'Something went wrong. Please try again.',
                            confirmButtonText: 'OK',
                            confirmButtonColor: '#d33',
                        });
                    });
            });
        </script>



    </main>





    <!-- footer -->
    <?php include 'footer.php' ?>




</body>



</html>




<!-- Full-screen Modal -->
<div id="fullScreenModal" class="modal">
    <span class="close" onclick="closeFullScreen()">&times;</span>
    <img class="modal-content" id="fullImage">
    <a id="downloadLink" href="#" download>
        <button><i class="fa-solid fa-download"></i> Download</button>
    </a>
</div>


<style>
    /* Style for the modal */
    .modal {
        display: none;
        position: fixed;
        z-index: 1000;
        padding-top: 100px;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgba(0, 0, 0, 0.9);
    }

    .modal-content {
        margin: auto;
        display: block;
        width: 80%;
        max-width: 700px;
    }

    .close {
        position: absolute;
        top: 15px;
        right: 35px;
        color: #fff;
        font-size: 40px;
        font-weight: bold;
        cursor: pointer;
    }

    /* Add animation to zoom image */
    .modal-content {
        animation-name: zoom;
        animation-duration: 0.6s;
    }

    @keyframes zoom {
        from {
            transform: scale(0)
        }

        to {
            transform: scale(1)
        }
    }

    /* Download button styling */
    #downloadLink button {
        position: absolute;
        top: 20px;
        right: 70px;
        padding: 12px 24px;

        color: white;
        border: none;
        cursor: pointer;
        font-size: 1.5rem;
        border-radius: 6px;
        display: flex;
        align-items: center;
        gap: 8px;
        transition: background-color 0.3s ease;
    }

    #downloadLink button:hover {
        background-color: var(--seventh-color3);
    }

    #downloadLink button i {
        font-size: 20px;
    }
</style>

<script>
    // Function to view the image in full screen
    function viewFullScreen(imgElement) {
        var modal = document.getElementById("fullScreenModal");
        var fullImage = document.getElementById("fullImage");
        var downloadLink = document.getElementById("downloadLink");

        modal.style.display = "block"; // Show the modal
        fullImage.src = imgElement.src; // Set the modal image to the clicked image

        // Set the download link for the image
        downloadLink.href = imgElement.src;
    }

    // Function to close the full-screen modal
    function closeFullScreen() {
        var modal = document.getElementById("fullScreenModal");
        modal.style.display = "none"; // Hide the modal
    }
</script>