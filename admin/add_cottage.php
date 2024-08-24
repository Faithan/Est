<?php
include ('db_connect.php');
session_start();

// if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
//   header('Location:../login.php');
//   exit();
// }

$message = "";
$isSuccess = false;


if (isset($_POST['addcottage'])) {

  $cottageNumber = $_POST['cottage_number'];
  $cottageType = $_POST['cottage_type'];
  $noPersons = $_POST['number_of_person'];
  $dayPrice = $_POST['day_price'];
  $nightPrice = $_POST['night_price'];
  $cottageStatus = $_POST['cottage_status'];
 
  $photo = $_FILES['cottage_photo'];

  $filename = $_FILES['cottage_photo']['name'];
  $filetempname = $_FILES['cottage_photo']['tmp_name'];
  $filsize = $_FILES['cottage_photo']['size'];
  $fileerror = $_FILES['cottage_photo']['error'];
  $filetype = $_FILES['cottage_photo']['type'];

  $fileext = explode('.', $filename);
  $filetrueext = strtolower(end($fileext));
  $array = ['jpg', 'png', 'jpeg'];


  if (in_array($filetrueext, $array)) {
    if ($fileerror === 0) {
      if ($filsize < 10000000) {
        $filenewname = $filename;
        $filedestination = '../images/' . $filenewname;
        if ($filename) {
          move_uploaded_file($filetempname, $filedestination);
        }


        $savedata = "INSERT INTO cottage_tbl  VALUES ('', '$cottageStatus','$cottageNumber', '$cottageType', '$noPersons', '$dayPrice', '$nightPrice', '$filedestination')";

        $query = (mysqli_query($con, $savedata));

        if ($query) {
          $message = "Saved Successfully!";
          $isSuccess = true;

        } else {
          $message = "Failed!";
          $isSuccess = false;

        }
      } else {
        $message = "Failed!";
        $isSuccess = false;
      }
    }
  } else {
    $message = "Failed!";
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

  <script src="javascripts/logout.js" defer></script>
  <script src="javascripts/add_room.js" defer></script>

  <link rel="stylesheet" type="text/css" href="css/backbtn.css?v=<?php echo time(); ?>">

  <link rel="stylesheet" type="text/css" href="css/add_cottage.css?v=<?php echo time(); ?>">
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
          <label class="header_text">ADD COTTAGE</label><br>
        </div>





        <div class="line-a">

          <div class="input_field_holder">


            <label>Cottage Number:</label><br>
            <input type="number" name="cottage_number"  class="input_fields" onkeyup="changeColor(this)"
              required>
            <br>

            <label>Cottage Type:</label><br>
            <select name="cottage_type" id="room_type" class="select_fields" onchange="changeColorSelect(this)" required>
              <option disabled selected value="">Choose an Option</option>
              <option value="Standard">Standard</option>
              <option value="Superior">Superior</option>
              <option value="Family">Family</option>
              <option value="Barkadahan">Barkadahan</option>
              <option value="Exclusive Suite">Exclusive Suite</option>
            </select>
            <br>

         

            <label >Number of Person:</label><br>
            <input type="number" name="number_of_person" id="bed_quantity" class="input_fields" onkeyup="changeColor(this)"
              required><br>

              
            <label >Day Price (₱):</label><br>
            <input type="number" name="day_price" id="price" class="input_fields" onkeyup="changeColor(this)"
              required>
            <br>


            <label >Night Price (₱):</label><br>
            <input type="number" name="night_price" id="price" class="input_fields" onkeyup="changeColor(this)"
               required>
            <br>


            <label >Cottage Status:</label><br>
            <select name="cottage_status" id="status" class="select_fields" onchange="changeColorSelect(this)" required>
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
            <label for="room_type">Cottage Photo:</label><br>
          </div>

          <div class="center-label-image">
            <div class="image-holder" id="photo_preview"></div>
          </div>

          <div class="center-label">
            <input type="file" id="photo_input" name="cottage_photo" accept="image/*" required><br>
          </div>

          <div class="center-label">
            <button type="submit" name="addcottage" class="button1"><i class="fa-solid fa-download"></i> Save</button>
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