<?php
// include ('dbconnect.php');

// if (!$con){
//     die ("connection failed;" . mysqli_connect_error());
// }
// ?>

// <?php

// $edit_data = ['id' => '', 'fname' => '', 'mname'=>'', 'lname'=>'',  'contact'=>'' , 'email'=>'', 'password'=>''];
//     if (isset($_POST['submit'])){
//         $fname=$_POST['fname'];
//         $mname=$_POST['mname'];
//         $lname=$_POST['lname'];
//         $contact=$_POST['contact'];
//         $email=$_POST['email'];
//         $password=$_POST['password'];       
//         $savedata="INSERT INTO registration_tbl VALUES ('','$fname','$mname','$lname','$contact','$email','$password')";
//         if (mysqli_query($con,$savedata)){
//             echo "<div class = 'record' >New Record Added!</div>";

//             header("Location: login1.php");
//         } 
//         else{
//             echo "Error:" . "<br>" . mysqli_error($con);
//          }
//     }

// //handle delete
//     if(isset($_GET['delete_id'])){
//         $delete_id = $_GET['delete_id'];
//         $delete_query = "DELETE FROM registration_tbl WHERE id = $delete_id";
//         if (mysqli_query($con, $delete_query)) {
//             echo "Record Deleted Suceessfully";
//             header("Location: registration.php");
//             exit();
//         }
//         else {
//         echo "Error deleting record: " . mysqli_error($con); 
//         }
//     }
// //handele edit
//     if (isset($_GET['edit_id'])){
//         $edit_id = $_GET['edit_id'];
//         $edit_query = "SELECT * FROM registration_tbl WHERE id = $edit_id";
//         $edit_result = mysqli_query($con, $edit_query);
//         $edit_data = mysqli_fetch_assoc($edit_result);
//     }

//     if (isset($_POST['update'])) {
//         $fname=$_POST['fname'];
//         $mname=$_POST['mname'];
//         $lname=$_POST['lname'];
//         $contact=$_POST['contact'];
//         $email=$_POST['email'];
//         $password=$_POST['password']; 
//         $update_query = "UPDATE registration_tbl SET fname='$fname', mname='$mname', lname='$lname', contact='$contact', email='$email', password='$password' WHERE id='$id'";
//         if (mysqli_query($con, $update_query)){
//             echo "Record updated successfully";
//             header ("Location: registration.php");
//             exit();
           
//         }else{
//             echo "error updating record". mysqli_error($con);
//         }
//     }
    ?>
    
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="login1.css?v=<?php echo time(); ?>">
    <title>Registration</title>
</head>

<body>

<div class="signin-container">
    <form method="post" action="" class="registration-form">

    <img src="images/Picture4.png" class="picture4"> 
    </header>
<div class="rf">
    <h1>Registration Form</h1>
</div>
        <input type="hidden" name="id" value="<?php echo $edit_data['id']; ?>">
        <input class="regis-input" type="text" name="fname" placeholder="First Name" required value="<?php echo $edit_data['fname']; ?>"><br><br>
        <input class="regis-input" type="text" name="mname" placeholder="Middle Name" required value="<?php echo $edit_data['mname']; ?>"><br><br>
        <input class="regis-input" type="text" name="lname" placeholder="Last Name" required value="<?php echo $edit_data['lname']; ?>"><br><br>
        <input class="regis-input" type="text" name="contact" placeholder="Contact Number" required value="<?php echo $edit_data['contact']; ?>"><br><br>
        <input class="regis-input" type="email" name="email" placeholder="Email" required value="<?php echo $edit_data['email']; ?>"><br><br>
        <input class="regis-input" type="password" name="password" placeholder="Password" required value="<?php echo $edit_data['password']; ?>"><br><br>


        <?php if ($edit_data['id'] == ''): ?>
        <button type="submit" name="submit" value="Submit" class="submit">Submit</button>
        <?php else: ?>
        <button type="submit" name="update" value="update" class="submit">Update</button>
        <?php endif; ?> <br><br><br>
        <label class="alr-login">Already have an account?<a href="login1.php" class="submit-login">Log in</a></label><br>
        
    </form>    
</div>
<br>




</body>
</html>