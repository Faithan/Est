<?php
require 'db_connect.php';
session_start();

$message = '';
$isSuccess = false;

// Check if manage_id is set and fetch user data
if (isset($_GET['manage_id'])) {
    $manage_id = intval($_GET['manage_id']);
    $manage_query = "SELECT * FROM user_tbl WHERE id = ?";
    if ($stmt = $con->prepare($manage_query)) {
        $stmt->bind_param('i', $manage_id);
        $stmt->execute();
        $manage_result = $stmt->get_result();
        if ($manage_result->num_rows > 0) {
            $manage_data = $manage_result->fetch_assoc();
        } else {
            $message = 'User not found.';
        }
        $stmt->close();
    } else {
        $message = 'Failed to prepare SQL statement for fetching user details.';
    }
} else {
    $message = 'User ID not specified.';
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['save'])) {
    $id = intval($_POST['id']);
    $full_name = $_POST['full_name'] ?? $manage_data['full_name'];
    $contact_number = $_POST['contact_number'] ?? $manage_data['contact_number'];
    $email = $_POST['email'] ?? $manage_data['email'];
    $gender = $_POST['gender'] ?? $manage_data['gender'];
    $birthdate = $_POST['birthdate'] ?? $manage_data['birthdate'];
    $address = $_POST['address'] ?? $manage_data['address'];
    $account_status = $_POST['account_status'] ?? $manage_data['account_status'];
    $password = $_POST['password'] ?? $manage_data['password'];

    $update_query = "UPDATE user_tbl SET full_name = ?, contact_number = ?, email = ?, gender = ?, birthdate = ?, address = ?, account_status = ?, password = ? WHERE id = ?";
    if ($stmt = $con->prepare($update_query)) {
        $stmt->bind_param('ssssssssi', $full_name, $contact_number, $email, $gender, $birthdate, $address, $account_status, $password, $id);
        if ($stmt->execute()) {
            $isSuccess = true;
            $message = 'User updated successfully!';
        } else {
            $message = 'Failed to update user. Error: ' . $stmt->error;
        }
        $stmt->close();
    } else {
        $message = 'Failed to prepare SQL statement for updating user.';
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include 'assets.php'; ?>
    <title>User Edit</title>
   
    <script src="javascripts/switch.js"></script>

    <link rel="stylesheet" type="text/css" href="css/main.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" type="text/css" href="css/dashboard.css?v=<?php echo time(); ?>">
    <link rel="shortcut icon" href="../system_images/Picture4.png" type="image/png">
</head>

<body>

    <main>
        <?php include 'sidenav.php'; ?>

        <section class="middle-container">
            <div class="header-container">
                <div class="title-head">
                    <label for=""><i class="fa-solid fa-user-gear"></i> User Settings</label>
                </div>

                <div class="title-head-right">
                    <div class="switch-mode">
                        <i class="fa-regular fa-moon" id="icon"></i>
                    </div>
                    <img src="../system_images/administrator.png" alt="" id="logoImg">
                </div>
            </div>

            <!-- dynamic content -->
            <div class="center-container">
                <form id="userForm" action="" method="post">
                    <div class="head-label-container">
                        <label>User Editing</label>
                    </div>

                    <!-- Form fields -->    
                    <div class="input-container">

                        <input type="hidden" name="id" value="<?php echo htmlspecialchars($manage_data['id'] ?? ''); ?>">

                        <div class="input-fields">
                            <label for="">Full Name:</label>
                            <input type="text" name="full_name" value="<?php echo htmlspecialchars($manage_data['full_name'] ?? ''); ?>" required>
                        </div>
                        <div class="input-fields">
                            <label for="">Contact Number:</label>
                            <input type="number" name="contact_number" value="<?php echo htmlspecialchars($manage_data['contact_number'] ?? ''); ?>" required>
                        </div>
                        <div class="input-fields">
                            <label for="">Email:</label>
                            <input type="email" name="email" value="<?php echo htmlspecialchars($manage_data['email'] ?? ''); ?>">
                        </div>
                        <div class="input-fields">
                            <label for="">Gender:</label>
                            <select name="gender">
                                <option selected disabled value="">Select a Gender</option>
                                <option value="male" <?php echo (isset($manage_data['gender']) && $manage_data['gender'] == 'male') ? 'selected' : ''; ?>>Male</option>
                                <option value="female" <?php echo (isset($manage_data['gender']) && $manage_data['gender'] == 'female') ? 'selected' : ''; ?>>Female</option>
                                <option value="others" <?php echo (isset($manage_data['gender']) && $manage_data['gender'] == 'others') ? 'selected' : ''; ?>>Others</option>
                            </select>
                        </div>
                        <div class="input-fields">
                            <label for="">Birthdate:</label>
                            <input type="date" name="birthdate" value="<?php echo htmlspecialchars($manage_data['birthdate'] ?? ''); ?>">
                        </div>
                        <div class="input-fields">
                            <label for="">Address:</label>
                            <input type="text" name="address" value="<?php echo htmlspecialchars($manage_data['address'] ?? ''); ?>">
                        </div>

                        <div class="input-fields">
                            <label for="">Status:</label>
                            <select name="account_status">
                                <option selected disabled value="">Select a Status</option>
                                <option value="active" <?php echo (isset($manage_data['account_status']) && $manage_data['account_status'] == 'active') ? 'selected' : ''; ?>>Active</option>
                                <option value="deleted" <?php echo (isset($manage_data['account_status']) && $manage_data['account_status'] == 'deleted') ? 'selected' : ''; ?>>Deleted</option>
                            </select>
                        </div>

                        <div class="input-fields">
                            <label for="">Password:</label>
                            <input type="text" name="password" value="<?php echo htmlspecialchars($manage_data['password'] ?? ''); ?>">
                        </div>

                    </div>

                    <div class="edituser-buttons-container">
                        <a class="back-btn" href="dashboardUserSettings.php">Back</a>
                        <button class="save-btn" type="submit" name="save">Save</button>
                    </div>
                </form>
            </div>
        </section>
    </main>

    <!-- SweetAlert integration -->
    <?php if (!empty($message)): ?>
        <script>
            Swal.fire({
                title: '<?php echo $isSuccess ? "Success!" : "Error!"; ?>',
                text: '<?php echo $message; ?>',
                icon: '<?php echo $isSuccess ? "success" : "error"; ?>',
                showConfirmButton: true
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = 'dashboardUserSettings.php'; // Redirect after confirmation
                }
            });
        </script>
    <?php endif; ?>

</body>

</html>
