<?php
include 'db_connect.php';

$response = ['success' => false, 'message' => ''];

if (isset($_FILES['photo']) && isset($_POST['id'])) {
    $id = intval($_POST['id']);
    $photo = $_FILES['photo'];

    // Validate photo
    if ($photo['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $photo['tmp_name'];
        $fileName = $photo['name'];
        $fileSize = $photo['size'];
        $fileType = $photo['type'];
        $fileNameCmps = explode(".", $fileName);
        $fileExtension = strtolower(end($fileNameCmps));

        // Validate file type and size
        $allowedExts = ['jpg', 'jpeg', 'png', 'gif'];
        if (in_array($fileExtension, $allowedExts) && $fileSize <= 2000000) { // Limit to 2MB
            $newFileName = md5(time() . $fileName) . '.' . $fileExtension;
            $uploadFileDir = '../images/';
            $destPath = $uploadFileDir . $newFileName;

            if (move_uploaded_file($fileTmpPath, $destPath)) {
                // Update the database with the new photo path
                $updateQuery = "UPDATE room_tbl SET photo = ? WHERE id = ?";
                if ($stmt = $con->prepare($updateQuery)) {
                    $stmt->bind_param('si', $destPath, $id);
                    if ($stmt->execute()) {
                        $response['success'] = true;
                        $response['message'] = 'Photo updated successfully.';
                    } else {
                        $response['message'] = 'Database update failed.';
                    }
                    $stmt->close();
                } else {
                    $response['message'] = 'Failed to prepare SQL statement.';
                }
            } else {
                $response['message'] = 'Failed to move uploaded file.';
            }
        } else {
            $response['message'] = 'Invalid file type or size.';
        }
    } else {
        $response['message'] = 'Error in file upload.';
    }
} else {
    $response['message'] = 'Photo or ID not provided.';
}

echo json_encode($response);
?>
