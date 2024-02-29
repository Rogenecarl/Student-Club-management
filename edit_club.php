<!-- edit_club.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- ... your existing head content ... -->
</head>
<body>

<?php
include("db.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['editClub'])) {
    $clubID = $_POST['clubID'];

    // Handle image upload logic
    if (isset($_FILES['newClubLogo']) && $_FILES['newClubLogo']['error'] === UPLOAD_ERR_OK) {
        $targetDir = "uploads/";
        $targetFile = $targetDir . basename($_FILES["newClubLogo"]["name"]);
        move_uploaded_file($_FILES["newClubLogo"]["tmp_name"], $targetFile);

        // Update ClubLogo in the database
        $updateLogoQuery = "UPDATE clubs SET ClubLogo = '$targetFile' WHERE ClubID = $clubID";
        mysqli_query($conn, $updateLogoQuery);
    }

    // Handle ClubName update logic
    if (isset($_POST['newClubName'])) {
        $newClubName = $_POST['newClubName'];
        $updateNameQuery = "UPDATE clubs SET ClubName = '$newClubName' WHERE ClubID = $clubID";
        mysqli_query($conn, $updateNameQuery);
    }

    // Redirect back to the clubs page after editing
    header('Location: clubs.php');
    exit();
}

// Fetch the club details
if (isset($_GET['clubID'])) {
    $clubID = $_GET['clubID'];
    $fetchClubQuery = "SELECT * FROM clubs WHERE ClubID = $clubID";
    $clubResult = mysqli_query($conn, $fetchClubQuery);
    $club = mysqli_fetch_assoc($clubResult);
} else {
    // If clubID is not provided, redirect to the clubs page
    header('Location: clubs.php');
    exit();
}
?>

<h2>Edit Club</h2>
<form method="post" enctype="multipart/form-data">
    <input type="hidden" name="clubID" value="<?php echo $club['ClubID']; ?>">
    
    <label for="newClubLogo">New Club Logo:</label>
    <input type="file" name="newClubLogo" accept="image/*"><br>
    
    <label for="newClubName">New Club Name:</label>
    <input type="text" name="newClubName" value="<?php echo $club['ClubName']; ?>"><br>
    
    <button type="submit" name="editClub">Save Changes</button>
</form>

</body>
</html>

<?php
// Close the database connection
if (isset($conn)) {
    mysqli_close($conn);
}
?>
