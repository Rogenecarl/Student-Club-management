<?php
include("db.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<!-- Boxicons -->
	<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
	<!-- My CSS -->
	<link rel="stylesheet" href="style.css">
	<title>student club management</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap.min.js"></script>
    <link rel="icon" href="https://codingbirdsonline.com/wp-content/uploads/2019/12/cropped-coding-birds-favicon-2-1-192x192.png" type="image/x-icon">
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
		
    </style>
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
		<<main>
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
								<form method="post" action="edit_club.php">
									<input type="hidden" name="clubID" value="' . $row['ClubID'] . '">
									<button class="edit-btn" type="submit" name="editClub">Edit</button>
								</form>
								<form method="post">
									<input type="hidden" name="clubID" value="' . $row['ClubID'] . '">
									<button class="delete-btn" type="submit" name="deleteClub">Delete</button>
								</form>
							</td>
						</tr>';
					
							}

							echo "</table>";
} else {
    echo "No clubs found.";
}

mysqli_close($conn);
?>
                </tbody>
            </table>
        </div>
        <script>
            $(document).ready(function() {
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

<?php
// Close the database connection
if (isset($conn)) {
    mysqli_close($conn);
}
?>