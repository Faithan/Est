<?php
// Include your database connection
include('db_connect.php');
session_start();

if (isset($_GET['manage_id'])) {
    $manage_id = $_GET['manage_id'];
    $manage_query = "SELECT * FROM cottage_tbl WHERE cottage_id = $manage_id";
    $manage_result = mysqli_query($con, $manage_query);
    $manage_data = mysqli_fetch_assoc($manage_result);
}


// Retrieve the user ID of the logged-in user from the session if the user is logged in
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id']; // Assuming you store the user ID in the session
}


// Check if the form was submitted via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Get the data from the form submission
    $user_id = $_SESSION['user_id'];  // Assuming session has user_id stored
    $fname = $_POST['first_name'];
    $mname = $_POST['middle_name'];
    $lname = $_POST['last_name'];
    $address = $_POST['address'];
    $phone_number = $_POST['phone_number'];
    $email = $_POST['email'];
    $date_of_arrival = $_POST['date_of_arrival'];
    $time = $_POST['time'];
    $price = $_POST['price'];
    $cottage_number = $_POST['cottage_number'];
    $cottage_type = $_POST['cottage_type'];
    $number_of_person = $_POST['number_of_person'];
    $special_request = $_POST['special_request'];
    $cottage_photo = $manage_data['photo'];// Assuming you have a method to manage or upload cottage photos

    // Insert the reservation data into the database
    $savedata = "INSERT INTO reserve_cottage_tbl (
        user_id, reserve_status, reserve_type, first_name, middle_name, last_name, reserve_address, phone_number, email, 
        date_of_arrival, time, price, cottage_number, cottage_type, number_of_person, special_request, cottage_photo
    ) VALUES (
        '$user_id', 'pending', 'online', '$fname', '$mname', '$lname', '$address', '$phone_number', '$email', 
        '$date_of_arrival', '$time', '$price', '$cottage_number', '$cottage_type', '$number_of_person', '$special_request', '$cottage_photo'
    )";

    // Execute the query
    $query = mysqli_query($con, $savedata);

    // Check if the insertion was successful
    if ($query) {
        $message = "Reservation Sent Successfully! Please wait for confirmation.";
        $isSuccess = true;
    } else {
        $message = "Form Submission Failed!";
        $isSuccess = false;
    }

    // Redirect with the success or error message
    if ($isSuccess) {
        echo "<script>alert('$message'); window.location.href = 'reservationCottage.php';</script>";
    } else {
        echo "<script>alert('$message'); window.location.href = 'reservationFormCottage.php';</script>";
    }
}
?>
