<?php

$message = "";
$isSuccess = false;

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    // Perform your database operations here
    // If successful:
    if ($name) { // Replace this condition with your actual success condition
        $message = "Registered Successfully!";
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
    <title>Test Form</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <form method="post" action="">
        <label for="name">Name:</label><br>
        <input type="text" id="name" name="name" required><br>
        <input type="submit" name="submit" value="Submit">
    </form>

    <?php if (!empty($successMessage)) : ?>
    <script>
        Swal.fire({
            title: 'Success!',
            text: '<?php echo $successMessage; ?>',
            icon: 'success'
        });
    </script>
    <?php endif; ?>
</body>
</html>