<?php
include ('db_connect.php');
session_start();

$message = "";
$isSuccess = false;
if (isset($_POST['addroom'])) {
  $roomNumber = $_POST['room_number'];
  $roomType = $_POST['room_type'];
  $bedType = $_POST['bed_type'];
  $bedQuantity = $_POST['bed_quantity'];
  $noPersons = $_POST['no_persons'];
  $amenities = $_POST['amenities'];
  $price = $_POST['price'];
  $status = $_POST['status'];

  // Handle file upload
  $photo = $_FILES['photo'];
  $allowedExts = ['jpg', 'png', 'jpeg'];
  $fileExt = strtolower(pathinfo($photo['name'], PATHINFO_EXTENSION));
  $uploadDir = '../images/';

  // Generate a unique file name to prevent overwriting
  $uniqueFileName = uniqid('', true) . '.' . $fileExt;
  $fileDestination = $uploadDir . $uniqueFileName;

  if (in_array($fileExt, $allowedExts) && $photo['error'] === 0 && $photo['size'] < 10000000) {
    if (move_uploaded_file($photo['tmp_name'], $fileDestination)) {
      // Insert data into database
      $saveData = "INSERT INTO room_tbl (room_number, room_type, bed_type, bed_quantity, no_persons, amenities, price, status, photo) 
                       VALUES ('$roomNumber', '$roomType', '$bedType', '$bedQuantity', '$noPersons', '$amenities', '$price', '$status', '$fileDestination')";

      if (mysqli_query($con, $saveData)) {
        $message = "Saved Successfully!";
        $isSuccess = true;
      } else {
        $message = "Failed to save data!";
      }
    } else {
      $message = "Failed to move uploaded file!";
    }
  } else {
    $message = "Failed to upload file!";
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

  <script src="javascripts/logout.js" defer></script>
  <script src="javascripts/add_room.js" defer></script>

  <link rel="stylesheet" type="text/css" href="css/backbtn.css?v=<?php echo time(); ?>">

  <link rel="stylesheet" type="text/css" href="css/add_room.css?v=<?php echo time(); ?>">
  <link rel="shortcut icon" href="../system_images/Picture4.png" type="image/png">

  <title>Add Room</title>



  <script src="javascripts/inputColor.js" defer></script>

</head>

<body>



  <?php
  include 'header.php'
    ?>


  <div class="form-holder">


    <div>
      <form action="" method="POST" enctype="multipart/form-data" class="create-room-form">
        <div class="head-label">
          <label class="header_text">ADD ROOM</label><br>
        </div>





        <div class="line-a">

          <div class="input_field_holder">


            <label for="room_type">Room Number:</label><br>
            <input type="number" name="room_number" id="room_number" class="input_fields" onkeyup="changeColor(this)"
              required>
            <br>

            <label for="room_type">Room Type:</label><br>
            <select name="room_type" id="room_type" class="select_fields" onchange="changeColorSelect(this)" required>
              <option disabled selected value="">Choose an Option</option>
              <option value="Standard">Standard</option>
              <option value="Superior">Superior</option>
              <option value="Family">Family</option>
              <option value="Barkadahan">Barkadahan</option>
              <option value="Exclusive">Exclusive Suite</option>
            </select>
            <br>

            <label for="bed_type">Bed Type:</label><br>
            <select name="bed_type" id="bed_type" class="select_fields" onchange="changeColorSelect(this)" required>
              <option disabled selected value="">Choose an Option</option>
              <option value="Single bed">Single Bed</option>
              <option value="Double bed">Double Bed</option>
              <option value="Queen bed">Queen Bed</option>
              <option value="King bed">King Bed</option>
              <option value="California king bed">California King Bed</option>
              <option value="Sofa bed">Sofa Bed</option>
              <option value="Murphy bed">Murphy Bed</option>
              <option value="Bunk bed">Bunk Bed</option>
            </select>
            <br>

            <label for="room_type">Number of Bed:</label><br>
            <input type="number" name="bed_quantity" id="bed_quantity" class="input_fields" onkeyup="changeColor(this)"
              required><br>

            <label for="room_type">Number of Persons:</label><br>
            <input type="number" name="no_persons" id="no_persons" class="input_fields" onkeyup="changeColor(this)"
              required><br>

            <label for="room_type">Amenities:</label><br>
            <input type="text" name="amenities" id="amenities" class="input_fields" onkeyup="changeColor(this)"
              required><br>



            <label for="room_type">Good for 22 hours:</label><br>
            <input type="number" name="price" id="price" class="input_fields" onkeyup="changeColor(this)"
              placeholder="₱" required>
            <br>

            <label for="room_type">Status:</label><br>
            <select name="status" id="status" class="select_fields" onchange="changeColorSelect(this)" required>
              <option disabled selected value="">Choose an Option</option>
              <option value="Available">Available</option>
              <option value="Occupied">Occupied</option>
              <option value="Coming soon">Coming Soon</option>
              <option value="Under Management">Under Management</option>
              <option value="Unavailable">Unavailable</option>
            </select>
            <br>

            <div class="return-btn">
              <a href="rooms.php"><i class="fa-solid fa-arrow-right-from-bracket fa-flip-horizontal"></i>
                Return</a>
            </div>

          </div>


        </div>





















        <div class="line-b">
          <div class="center-label">
            <label for="room_type">Photo:</label><br>
          </div>

          <div class="center-label-image">
            <div class="image-holder" id="photo_preview"></div>
          </div>

          <div class="center-label">
            <input type="file" id="photo_input" name="photo" accept="image/*" required><br>
          </div>

          <div class="center-label">
            <button type="submit" name="addroom" class="button1"><i class="fa-solid fa-download"></i> Save</button>
          </div>
        </div>
      </form>

    </div>
  </div>


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





</body>

</html>