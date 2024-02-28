<?php
include("db.php");

if (isset($_POST['submit']) && isset($_FILES['clubPicture']) && isset($_POST['clubSelect'])) {
    $errors = array();
    $file_name = $_FILES['clubPicture']['name'];
    $file_size = $_FILES['clubPicture']['size'];
    $file_tmp = $_FILES['clubPicture']['tmp_name'];
    $file_type = $_FILES['clubPicture']['type'];
    $file_ext = strtolower(end(explode('.', $file_name)));
    
    $extensions = array("jpeg", "jpg", "png");
    
    if (!in_array($file_ext, $extensions)) {
        $errors[] = "Extension not allowed, please choose a JPEG or PNG file.";
    }
    
    if ($file_size > 2097152) {
        $errors[] = 'File size must be less than 2 MB';
    }
    
    if (empty($errors)) {
        $selectedClubID = $_POST['clubSelect'];
        $uploadPath = "uploads/club" . $selectedClubID . "_" . basename($file_name);
        
        move_uploaded_file($file_tmp, $uploadPath);
        
        // Store the path in the database (Assuming you have a column named 'ClubPicture' in your 'clubs' table)
        $updateSql = "UPDATE clubs SET ClubPicture = '$uploadPath' WHERE ClubID = $selectedClubID";
        if ($conn->query($updateSql) === TRUE) {
            echo "Picture uploaded successfully.";
        } else {
            echo "Error updating record: " . $conn->error;
        }
    } else {
        print_r($errors);
    }
}

// Close the database connection
if (isset($conn)) {
    mysqli_close($conn);
}
?>
