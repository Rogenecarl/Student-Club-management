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
    <style>
        body {
            background-color: #f8f8f8;
        }

        .container {
            margin-top: 1px;
            background-color: white;
            padding: 20px;
            border-radius: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            color: #3498db; /* Header color */
        }

        #clubsTable {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        #clubsTable th, #clubsTable td {
            padding: 10px;
            text-align: center;
            border-bottom: 2px solid #ddd;
        }

        #clubsTable th {
            background-color: #3498db; /* Header background color */
            color: white;
        }

        #clubsTable tbody tr:nth-child(odd) {
            background-color: #f2f2f2;
        }

        #clubsTable tbody tr:hover {
            background-color: #cce5ff;
        }

        .custom-dropdown {
            width: 120px;
            padding: 1px;
            align-items: center;
            justify-content: center;
            border-radius: 7px;
            background-color: #3498db;
            color: white;
            margin: 0 auto;
        }

        .custom-dropdown select {
            width: 100%;
            padding: 8px;
            border: none;
            border-radius: 3px;
            background-color: #3498db;
            color: white;
        }

        .add-clubs-btn {
            background-color: #2ecc71;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 20px;
        }
    </style>
</head>
<body>

    <!-- SIDEBAR -->
    <section class="header">
        <div class="logo">
            <i class="ri-menu-line icon icon-0 menu"></i>
            <h2>Med<span>Ex</span></h2>
        </div>
        <div class="search--notification--profile">
            <div class="search">
                <input type="text" placeholder="Search Scdule..">
                <button><i class="ri-search-2-line"></i></button>
            </div>
            <div class="notification--profile">
                <div class="picon lock">
                    <i class="ri-lock-line"></i>
                </div>
                <div class="picon bell">
                    <i class="ri-notification-2-line"></i>
                </div>
                <div class="picon chat">
                    <i class="ri-wechat-2-line"></i>
                </div>
                <div class="picon profile">
                    <img src="assets/images/profile.jpg" alt="">
                </div>
            </div>
        </div>
    </section>
    <section class="main">
        <div class="sidebar">
            <ul class="sidebar--items">
                <li>
                    <a href="#" id="active--link">
                        <span class="icon icon-1"><i class="ri-layout-grid-line"></i></span>
                        <span class="sidebar--item">Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <span class="icon icon-2"><i class="ri-calendar-2-line"></i></span>
                        <span class="sidebar--item">Schedule</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <span class="icon icon-3"><i class="ri-user-2-line"></i></span>
                        <span class="sidebar--item" style="white-space: nowrap;">Reliable Doctor</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <span class="icon icon-4"><i class="ri-user-line"></i></span>
                        <span class="sidebar--item">Patients</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <span class="icon icon-5"><i class="ri-line-chart-line"></i></span>
                        <span class="sidebar--item">Activity</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <span class="icon icon-6"><i class="ri-customer-service-line"></i></span>
                        <span class="sidebar--item">Support</span>
                    </a>
                </li>
            </ul>
            <ul class="sidebar--bottom-items">
                <li>
                    <a href="#">
                        <span class="icon icon-7"><i class="ri-settings-3-line"></i></span>
                        <span class="sidebar--item">Settings</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <span class="icon icon-8"><i class="ri-logout-box-r-line"></i></span>
                        <span class="sidebar--item">Logout</span>
                    </a>
                </li>
            </ul>
        </div>s
    </section>

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


    <script src="main.js"></script>
</body>
</html>
