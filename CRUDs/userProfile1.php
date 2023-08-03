<?php
// Start the PHP session to access session variables
session_start();

// Check if the user is logged in, if not, redirect to login page
if (!isset($_SESSION['username'])) {
    header("Location: trueLogin.php");
    exit();
}

// Retrieve the user's name from the session variable
$username = $_SESSION['username'];

// Include the 'connect.php' file that establishes the database connection
include 'connect.php';

// Prepare the SQL query with placeholders to fetch the user details
$sql = "SELECT * FROM `user` WHERE Name = ?";
$stmt = mysqli_prepare($con, $sql);

if ($stmt) {
    // Bind the parameter to the statement
    mysqli_stmt_bind_param($stmt, "s", $username);

    // Execute the statement
    if (mysqli_stmt_execute($stmt)) {
        // Get the result
        $result = mysqli_stmt_get_result($stmt);

        // Fetch the user details from the result
        $userDetails = mysqli_fetch_assoc($result);
    } else {
        // In case of an error, display the MySQL error message
        die(mysqli_error($con));
    }

    // Close the statement
    mysqli_stmt_close($stmt);
} else {
    // In case of an error, display the MySQL error message
    die(mysqli_error($con));
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>User Profile</title>
    <link rel="stylesheet" href="thecss.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"> <!-- Font Awesome link -->
    <link rel="stylesheet" href="laststyle.css">
</head>
<body>
<nav class="navbar horizontal-navbar">
    <a href="TrueIndex.php">Home</a>
    <a href="#">Contact</a>
    <a href="trueLogin.php">Login</a>
    <a href="login.php">Signup</a>
    <a href="#" class="user-icon-link">
        USER
        <i class="fas fa-user"></i>
    </a>
</nav>
<div class="container">
    <h1>User Profile</h1>
    <div>
        <p><strong>Name:</strong> <?php echo $userDetails['Name']; ?></p>
        <p><strong>ID Number:</strong> <?php echo $userDetails['ID']; ?></p>
        <p><strong>Email:</strong> <?php echo $userDetails['Email']; ?></p>
    </div>
</div>
</body>
</html>
