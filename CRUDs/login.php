<?php
// Include the 'connect.php' file that establishes the database connection
include 'connect.php';

// Check if the form is submitted (the submit button is clicked)
if (isset($_POST['submit'])) {

    // Retrieve user input from the form
    $Nom = $_POST['name'];
    $Identification = $_POST['idNumber'];
    $UserEmail = $_POST['email'];
    $PassW = $_POST['password'];
    
    // Prepare the SQL query with placeholders
    $sql = "INSERT INTO `user` (Name, ID, Email, Password) VALUES (?, ?, ?, ?)";
    
    // Create a prepared statement
    $stmt = mysqli_prepare($con, $sql);
    
    if ($stmt) {
        // Bind the parameters to the statement
        mysqli_stmt_bind_param($stmt, "ssss", $Nom, $Identification, $UserEmail, $PassW);
    
        // Execute the statement
        if (mysqli_stmt_execute($stmt)) {
            echo "Data inserted successfully";
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
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>User Sign Up Form</title>
    <link rel="stylesheet" href="thecss.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"> <!-- Font Awesome link -->
    <link rel="stylesheet" href="laststyle.css">

</head>
<body>
<nav class="navbar horizontal-navbar ">
    <a href="TrueIndex.php" >Home</a>
        <a href="#">Contact</a>
        <a href="trueLogin.php">Login</a>
        <a href="login.php">Signup</a>
        <a href="userProfile.php" class="user-icon-link">
          USER
            <i class="fas fa-user"></i>
        </a>
    </nav>
    <div class="container">
        <h1>User Sign Up</h1>
        <form id="signupForm" method="post">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>

            <label for="idNumber">ID Number:</label>
            <input type="text" id="idNumber" name="idNumber" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>

            <button type="submit" name="submit">Sign Up</button>
        </form>
    </div>
</body>
</html>
