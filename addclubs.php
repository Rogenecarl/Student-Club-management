<?php
// Include database connection file
include("db.php");

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $clubName = $_POST['clubName'];
    $status = $_POST['status'];

    // Handle file upload for club picture
    $targetDir = "uploads/";
    $targetFile = $targetDir . basename($_FILES["clubPicture"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    // Check if the file is an image
    $check = getimagesize($_FILES["clubPicture"]["tmp_name"]);
    if ($check !== false) {
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }

    // Check if file already exists
    if (file_exists($targetFile)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }

    // Check file size (you can adjust the size as needed)
    if ($_FILES["clubPicture"]["size"] > 500000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // Allow only certain file formats (you can adjust as needed)
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    } else {
        // If everything is ok, try to upload file
        if (move_uploaded_file($_FILES["clubPicture"]["tmp_name"], $targetFile)) {
            // File uploaded successfully, now insert data into database
            $sql = "INSERT INTO clubs (ClubPicture, ClubName, Status) VALUES ('$targetFile', '$clubName', '$status')";
            if ($conn->query($sql) === TRUE) {
                echo "Club added successfully.";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }

    // Close database connection
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Club</title>
</head>
<body>
    <h2>Add Club</h2>
    <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post" enctype="multipart/form-data">
        <label for="clubName">Club Name:</label>
        <input type="text" name="clubName" required><br>

        <label for="clubPicture">Club Picture:</label>
        <input type="file" name="clubPicture" accept="image/*" required><br>

        <label for="status">Status:</label>
        <input type="text" name="status" required><br>

        <input type="submit" value="Add Club">
    </form>
</body>
</html>
