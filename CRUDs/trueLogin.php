<?php
// Start the PHP session to access session variables
session_start();

// Check if the form is submitted (the submit button is clicked)
if (isset($_POST['submit'])) {
    // Retrieve user input from the form
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Include the 'connect.php' file that establishes the database connection
    include 'connect.php';

    // Prepare the SQL query with placeholders to fetch the user details
    $sql = "SELECT * FROM `user` WHERE Name = ? AND Password = ?";
    $stmt = mysqli_prepare($con, $sql);

    if ($stmt) {
        // Bind the parameters to the statement
        mysqli_stmt_bind_param($stmt, "ss", $username, $password);

        // Execute the statement
        if (mysqli_stmt_execute($stmt)) {
            // Get the result
            $result = mysqli_stmt_get_result($stmt);

            // Fetch the user details from the result
            $userDetails = mysqli_fetch_assoc($result);

            // Check if a user with the given credentials exists
            if ($userDetails) {
                // Store the username in the session variable
                $_SESSION['username'] = $username;

                // Close the statement
                mysqli_stmt_close($stmt);

                // Redirect to the user profile page
                header("Location: userProfile.php");
                exit();
            } else {
                echo "Invalid username or password. Please try again.";
            }
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

    // Close the database connection
    mysqli_close($con);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>User Login</title>
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
    <h1>User Login</h1>
    <div id="loginForm">
        <form method="post">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>

            <button type="submit" name="submit">Login</button>
        </form>
    </div>
</div>
</body>
</html>
