<?php
include("db.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Styles.css">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
    <title>Dashboard</title>
</head>
<body>

    <!-- SIDEBAR -->
    <section id="sidebar">
        <a href="#" class="brand">
            <i class='bx bxs-dashboard'></i>
            <span class="text">Club management</span>
        </a>
        <ul class="side-menu top">
            <li class="active">
                <a href="index.php">
                    <i class='bx bxs-dashboard' ></i>
                    <span class="text">Club List</span>
                </a>
            </li>
            <li>
                <a href="clubmembers.php">
                    <i class='bx bxs-dashboard' ></i>
                    <span class="text">Club Members</span>
                </a>
            </li>
            <li>
                <a href="clubofficials.php">
                    <i class='bx bxs-dashboard' ></i>
                    <span class="text">Club Officers</span>
                </a>
            </li>
            <li>
                <a href="addmembers.php">
                    <i class='bx bxs-dashboard' ></i>
                    <span class="text">Add club member</span>
                </a>
            </li>
            <li>
                <a href="removemem.php">
                    <i class='bx bxs-dashboard' ></i>
                    <span class="text">Remove club member</span>
                </a>
            </li>
        </ul>
        <ul class="side-menu">
            <li>
                <a href="#">
                    <i class='bx bxs-cog' ></i>
                    <span class="text">Settings</span>
                </a>
            </li>
            <li>
                <a href="#" class="logout">
                    <i class='bx bxs-log-out-circle' ></i>
                    <span class="text">Logout</span>
                </a>
            </li>
        </ul>
    </section>
    <!-- SIDEBAR -->


    <!-- CONTENT -->

    <section id="content">
        <!-- NAVBAR -->
        <nav>
            <i class='bx bx-menu' ></i>
            <form action="#">
                <div class="form-input">
                    <input type="search" placeholder="Search...">
                    <button type="submit" class="search-btn"><i class='bx bx-search' ></i></button>
                </div>
            </form>
            <input type="checkbox" id="switch-mode" hidden>
            <label for="switch-mode" class="switch-mode"></label>
        </nav>
        <!-- NAVBAR -->

        <!-- MAIN -->
        <main>
        <div class="container">
        <h2 style="text-align: center; color: #3498db;">Clubs List</h2>
        <table id="clubsTable" class="table table-striped table-bordered" style="width: 100%">
            <thead>
                <tr>
                    <th>Club Logo</th>
                    <th>Club Name</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
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
                }

                $query = "SELECT * FROM clubs";
                $result = mysqli_query($conn, $query);

                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo '<tr>
                            <td>
                                <img src="' . $row["ClubLogo"] . '" alt="Club Logo" style="max-width: 50px; max-height: 50px;">
                            </td>
                            <td>' . $row["ClubName"] . '</td>
                            <td>
                                <div class="custom-dropdown">
                                    <select name="status">
                                        <option value="0" ' . ($row["Status"] == 0 ? "selected" : "") . '>Not Accredited</option>
                                        <option value="1" ' . ($row["Status"] == 1 ? "selected" : "") . '>Accredited</option>
                                    </select>
                                </div>
                            </td>
                            <td>
                                <form method="post" action="edit_club.php" style="display: inline;">
                                    <input type="hidden" name="clubID" value="' . $row['ClubID'] . '">
                                    <button class="btn btn-warning btn-sm" type="submit" name="editClub">
                                        <i class="glyphicon glyphicon-pencil"></i> Edit
                                    </button>
                                </form>
                                <form method="post" style="display: inline;">
                                    <input type="hidden" name="clubID" value="' . $row['ClubID'] . '">
                                    <button class="btn btn-danger btn-sm" type="submit" name="deleteClub">
                                        <i class="glyphicon glyphicon-trash"></i> Delete
                                    </button>
                                </form>
                            </td>
                        </tr>';
                    }

                    echo "</table>";

                    // Add Clubs Button
                    echo '<button class="add-clubs-btn" onclick="location.href=\'add_clubs.php\';">Add Clubs</button>';
                } else {
                    echo "No clubs found.";
                }

                mysqli_close($conn);
                ?>
            </tbody>
        </table>
    </div>
    <script>
        $(document).ready(function () {
            $('#clubsTable').DataTable();
        });
    </script>
    </main>
        <!-- MAIN -->
    </section>
    <!-- CONTENT -->


    <script src="script.js"></script>
</body>
</html>
