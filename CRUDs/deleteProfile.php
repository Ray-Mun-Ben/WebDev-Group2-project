<?php
// Start the PHP session to access session variables
session_start();

// Check if the user is logged in, if not, redirect to login page
if (!isset($_SESSION['username'])) {
    header("Location: trueLogin.php");
    exit();
}

// Include the 'connect.php' file that establishes the database connection
include 'connect.php';

// Check if the form is submitted (the delete button is clicked)
if (isset($_POST['submit'])) {
    // Retrieve user input from the form
    $autoID = $_POST['autoID'];

    // Prepare the SQL query with placeholders to delete the user record
    $sql = "DELETE FROM `user` WHERE AutoID = ?";
    $stmt = mysqli_prepare($con, $sql);

    if ($stmt) {
        // Bind the parameter to the statement
        mysqli_stmt_bind_param($stmt, "i", $autoID);

        // Execute the statement
        if (mysqli_stmt_execute($stmt)) {
            // Data deleted successfully, unset user session variable
            unset($_SESSION['userDetails']);

            // Close the statement
            mysqli_stmt_close($stmt);

            // Redirect back to userProfile.php
            header("Location: userProfile.php");
            exit();
        } else {
            // In case of an error, display the MySQL error message
            die(mysqli_error($con));
        }
    } else {
        // In case of an error, display the MySQL error message
        die(mysqli_error($con));
    }
}

// Retrieve the user's name from the session variable
$username = $_SESSION['username'];

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
    <title>Delete Profile</title>
    <link rel="stylesheet" href="thecss.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"> <!-- Font Awesome link -->
    <link rel="stylesheet" href="laststyle.css">

    <style>
        /* Styles for the container, form, and buttons go here (same as before) */
        /* ... */
    </style>
</head>
<body>
    <nav class="navbar horizontal-navbar">
        <!-- Navbar links go here (same as before) -->
        <!-- ... -->
    </nav>
    <div class="container">
        <h1>Continue?</h1>
        <?php if (!empty($userDetails)) { ?>
            <form id="deleteForm" method="post">
                <input type="hidden" name="autoID" value="<?php echo $userDetails['AutoID']; ?>">
                <p><strong>Name:</strong> <?php echo $userDetails['Name']; ?></p>
                <p><strong>ID Number:</strong> <?php echo $userDetails['ID']; ?></p>
                <p><strong>Email:</strong> <?php echo $userDetails['Email']; ?></p>
                <p><strong>Password:</strong> <?php echo $userDetails['Password']; ?></p>
                <button type="submit" name="submit">Delete</button>
            </form>
        <?php } else { ?>
            
        <?php } ?>
    </div>
</body>
</html>
