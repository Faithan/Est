<?php
require 'db_connect.php';
session_start();

// Fetch admin details
$admin_id = $_SESSION['admin_id'];

// Fetch admin details
$query = "SELECT `admin_id`, `admin_type`, `first_name`, `last_name`, `username`, `password` FROM `admin_tbl` WHERE `admin_id` = ?";
$stmt = $con->prepare($query);
$stmt->bind_param('i', $admin_id);  // Use 'i' for integer binding
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $admin = $result->fetch_assoc();
} else {
    // Handle error if admin not found
    echo "Admin not found.";
    exit();
}

$updateSuccess = false; // Initialize success flag

// Update admin details on form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Update query
    $update_query = "UPDATE `admin_tbl` SET `first_name` = ?, `last_name` = ?, `username` = ?, `password` = ? WHERE `admin_id` = ?";
    $update_stmt = $con->prepare($update_query);
    $update_stmt->bind_param('ssssi', $first_name, $last_name, $username, $password, $admin_id);

    if ($update_stmt->execute()) {
        $_SESSION['updateSuccess'] = true; // Store success flag in session
        header("Location: " . $_SERVER['PHP_SELF']); // Reload the page after update
        exit(); // Ensure the script stops executing after redirect
    } else {
        // Error: show SweetAlert
        echo "<script>
            Swal.fire({
                title: 'Error!',
                text: 'There was an issue updating the admin details.',
                icon: 'error',
                confirmButtonText: 'OK',
                background: '#f3f4f6',
                color: '#3b3f43',
                confirmButtonColor: '#d33'
            });
        </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include 'assets.php'; ?>
    <title>Admin Settings</title>
    <script src="javascripts/switch.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
                    <label for=""><i class="fa-solid fa-user-tie"></i> Admin Settings</label>
                </div>

                <?php include 'icon-container.php'; ?>
            </div>

            <!-- Dynamic Content -->
            <div class="center-container">
                <form method="POST" id="adminUpdateForm">
                    <h2>Update Admin Details</h2>
                    <div class="form-group">
                        <label for="first_name">First Name:</label>
                        <input type="text" name="first_name" id="first_name" value="<?php echo $admin['first_name']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="last_name">Last Name:</label>
                        <input type="text" name="last_name" id="last_name" value="<?php echo $admin['last_name']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="username">Username:</label>
                        <input type="text" name="username" id="username" value="<?php echo $admin['username']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password:</label>
                        <input type="password" name="password" id="password" value="<?php echo $admin['password']; ?>" required>
                    </div>
                    <div class="form-group">
                        <button type="button" onclick="confirmUpdate()">Update Details</button>
                    </div>
                </form>
            </div>
        </section>
    </main>

    <script>
        // Show success message if the update was successful
        <?php if (isset($_SESSION['updateSuccess']) && $_SESSION['updateSuccess']): ?>
            Swal.fire({
                title: 'Update Successful!', // Main header
                text: 'Admin details have been updated successfully.', // Subheader/message
                icon: 'success',
                confirmButtonText: 'OK',
                background: '#f3f4f6',
                color: '#3b3f43',
                confirmButtonColor: '#3085d6'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Clear session variable after success and reload page
                    <?php unset($_SESSION['updateSuccess']); ?>
                    window.location.reload();
                }
            });
        <?php endif; ?>

        function confirmUpdate() {
            Swal.fire({
                title: 'Are you sure?',
                text: 'Do you want to update the admin details?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, update!',
                cancelButtonText: 'Cancel',
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Submit the form if confirmed
                    document.getElementById("adminUpdateForm").submit();
                }
            });
        }
    </script>
</body>

</html>


<style>
    /* Center Container Styles */
    .center-container {
        background-color: var(--first-color);
        display: flex;
        justify-content: center;
        align-items: center;
    }

    /* Heading inside center-container */
    .center-container h2 {
        font-size: 2.4rem;
        margin-bottom: 20px;
        color: var(--seventh-color);
    }

    /* Form group for labels and inputs */
    .center-container .form-group {
        margin-bottom: 20px;
    }

    /* Label styles */
    .center-container label {
        display: block;
        font-size: 1.6rem;
        color: var(--seventh-color);
        margin-bottom: 8px;
    }

    /* Input fields */
    .center-container input {
        width: 200px;
        padding: 12px;
        font-size: 14px;
        border-radius: 6px;
        border: 1px solid #ccc;
        background-color: var(--first-color2);
        transition: all 0.3s ease;
        color: var(--seventh-color);
    }

    /* Focused input fields */
    .center-container input:focus {
        border-color: #3085d6;
        outline: none;
    }

    /* Button Styles */
    .center-container button {
        padding: 12px 20px;
        font-size: 16px;
        background-color: #3085d6;
        color: white;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    /* Button Hover */
    .center-container button:hover {
        background-color: #2670b6;
    }

    /* Button Active */
    .center-container button:active {
        background-color: #1c5a93;
    }

    /* Responsive adjustments for center-container */
    @media (max-width: 768px) {
        .center-container {
            padding: 20px;
        }

        .center-container .form-group input {
            font-size: 14px;
            padding: 10px;
        }
    }
</style>