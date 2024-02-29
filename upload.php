<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clubs Table</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .edit-btn, .delete-btn {
            background-color: #4CAF50;
            color: white;
            padding: 5px 10px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }
        .delete-btn {
            background-color: #f44336;
        }
    </style>
</head>
<body>

<?php
// Your database connection code here
include("db.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['deleteClub'])) {
    $clubID = $_POST['clubID'];

    $checkQuery = "SELECT * FROM clubofficers WHERE ClubID = $clubID";
        $checkResult = mysqli_query($conn, $checkQuery);

        if (mysqli_num_rows($checkResult) > 0) {
            // If there are associated records, delete them first
            $deleteOfficersQuery = "DELETE FROM clubofficers WHERE ClubID = $clubID";
            mysqli_query($conn, $deleteOfficersQuery);
        }

        // Now, you can safely delete the club record
        $deleteQuery = "DELETE FROM clubs WHERE ClubID = $clubID";
        mysqli_query($conn, $deleteQuery);

        // Redirect back to the page after deletion
        header('Location: ' . $_SERVER['PHP_SELF']);
        exit();
    // Handle deletion logic
}

$query = "SELECT * FROM clubs";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) > 0) {
    echo "<table>";
    echo "<tr><th>Club Logo</th><th>Club Name</th><th>Club Status</th><th>Action</th></tr>";

    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td><img src='{$row['ClubLogo']}' alt='Club Logo' style='max-width: 50px; max-height: 50px;'></td>";
        echo "<td>{$row['ClubName']}</td>";
        echo "<td>";
        echo "<select name='status'>";
        echo "<option value='0' " . ($row['Status'] == 0 ? 'selected' : '') . ">Not Accredited</option>";
        echo "<option value='1' " . ($row['Status'] == 1 ? 'selected' : '') . ">Accredited</option>";
        echo "</select>";
        echo "</td>";
        echo "<td>";
        echo "<form method='post' action='edit_club.php'>";
        echo "<input type='hidden' name='clubID' value='{$row['ClubID']}'>";
        echo "<button class='edit-btn' type='submit' name='editClub'>Edit</button>";
        echo "</form>";
        echo "<form method='post'>";
        echo "<input type='hidden' name='clubID' value='{$row['ClubID']}'>";
        echo "<button class='delete-btn' type='submit' name='deleteClub'>Delete</button>";
        echo "</form>";
        echo "</td>";
        echo "</tr>";
    }

    echo "</table>";
} else {
    echo "No clubs found.";
}

mysqli_close($conn);
?>

</body>
</html>

<?php
// Close the database connection
if (isset($conn)) {
    mysqli_close($conn);
}
?>