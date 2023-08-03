<?php
// Include the 'connect.php' file that establishes the database connection
include 'connect.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User List</title>
    <link rel="stylesheet" href="coolNavBar.css">
    <style>
        /* Additional styling for the main heading */
        h1 {
            text-align: center;
            margin-top: 20px;
            font-family: Arial, sans-serif;
            color: #333;
        }

        /* Styling for the container */
        .container {
            text-align: center;
            margin-top: 20px;
        }

        /* Styling for the "Add User" button */
        .coolbtn {
            background-color: #170d70;
            color: #fff;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            border-radius: 8px;
            transition: background-color 0.3s;
            text-decoration: none;
        }

        .coolbtn a {
            color: #fff;
            text-decoration: none;
        }

        .coolbtn:hover {
            background-color: #070b3b;
        }

        /* Styling for the table */
        .table {
            width: 80%;
            margin: 20px auto;
            background-color: #f2f2f2;
            border-collapse: collapse;
        }

        /* Styling for table headings */
        .table th {
            background-color: #170d70;
            color: #fff;
            padding: 12px;
            text-align: left;
            font-weight: bold;
        }

        /* Styling for table cells */
        .table td {
            padding: 10px;
            border-bottom: 1px solid #ddd;
        }

        /* Styling for even table rows */
        .table tr:nth-child(even) {
            background-color: #e8e8e8;
        }

        /* Styling for odd table rows */
        .table tr:nth-child(odd) {
            background-color: #f2f2f2;
        }

        /* Styling for table row hover effect */
        .table tr:hover {
            background-color: #ddd;
        }

        /* Styling for the "Update" and "Delete" buttons */
        .coolbutton1, .coolbutton2 {
            background-color: #911e24;
            color: #fff;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
            border-radius: 4px;
            transition: background-color 0.3s;
            text-decoration: none;
            margin: 2px;
        }

        .coolbutton1 a, .coolbutton2 a {
            color: #fff;
            text-decoration: none;
        }

        .coolbutton1:hover, .coolbutton2:hover {
            background-color: #092747;
        }
    </style>
</head>
<body>
<nav class="navbar horizontal-navbar">
    <a href="adminView.php">Home</a>
    <a href="#" class="user-icon-link">
        ADMIN
        <i class="fas fa-user"></i>
    </a>
</nav>
<h1>ADMIN's USER CONTROL PANEL</h1>
<div class="container">
    <button class="coolbtn"><a href="login.php">Add User</a></button>
</div>

<table class="table">
    <thead>
        <tr>
            <th scope="col">AutoID</th>
            <th scope="col">Name</th>
            <th scope="col">ID</th>
            <th scope="col">Email</th>
            <th scope="col">Password</th>
            <th scope="col">Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $sql = "SELECT * FROM `user`";
        $result = mysqli_query($con, $sql);

        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                // Variables with the same names as database columns
                $Auto = $row['AutoID']; // AutoID from database
                $Names = $row['Name'];     // Name from database
                $IDs = $row['ID'];         // ID from database
                $Emails = $row['Email'];   // Email from database
                $Passwords = $row['Password']; // Password from database

                // Display data in table rows
                echo '<tr>
                        <th scope="row">'.$Auto.'</th>
                        <td>'.$Names.'</td>
                        <td>'.$IDs.'</td>
                        <td>'.$Emails.'</td>
                        <td>'.$Passwords.'</td>
                        <td>
                            <button class="coolbutton1"><a href="update.php?updateid=' . $Auto . '">Update</a></button>
                            <button class="coolbutton2"><a href="delete.php?deleteid=' . $Auto . '">Delete</a></button>
                        </td>
                      </tr>';
            }
        } 
        ?>
    </tbody>
</table>
</body>
</html>
