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

// Check if the form is submitted (the update button is clicked)
if (isset($_POST['submit'])) {
    // Retrieve user input from the form
    $autoID = $_POST['autoID'];
    $Nom = $_POST['name'];
    $Identification = $_POST['idNumber'];
    $UserEmail = $_POST['email'];
    $PassW = $_POST['password'];

    // Prepare the SQL query with placeholders to update the user details
    $sql = "UPDATE `user` SET Name = ?, ID = ?, Email = ?, Password = ? WHERE AutoID = ?";
    $stmt = mysqli_prepare($con, $sql);

    if ($stmt) {
        // Bind the parameters to the statement
        mysqli_stmt_bind_param($stmt, "ssssi", $Nom, $Identification, $UserEmail, $PassW, $autoID);

        // Execute the statement
        if (mysqli_stmt_execute($stmt)) {
            // Data updated successfully, update the session variables
            $_SESSION['username'] = $Nom; // Update the username in the session
            $_SESSION['userDetails'] = [
                'AutoID' => $autoID,
                'Name' => $Nom,
                'ID' => $Identification,
                'Email' => $UserEmail,
                'Password' => $PassW
            ];

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

// Check if the user details are stored in the session
if (isset($_SESSION['userDetails'])) {
    $userDetails = $_SESSION['userDetails'];
} else {
    // If not, fetch the user details from the database
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

            // Check if user details were found
            if (!$userDetails) {
                die("User data not found.");
            } else {
                // Store the user details in the session for future use
                $_SESSION['userDetails'] = $userDetails;
            }
        } else {
            // In case of an error, display the MySQL error message
            die(mysqli_error($con));
        }
    } else {
        // In case of an error, display the MySQL error message
        die(mysqli_error($con));
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Profile</title>
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
        <h1>Update Profile</h1>
        <?php if (!empty($userDetails)) { ?>
            <form id="updateForm" method="post">
                <input type="hidden" name="autoID" value="<?php echo $userDetails['AutoID']; ?>">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" value="<?php echo $userDetails['Name']; ?>" required>

                <label for="idNumber">ID Number:</label>
                <input type="text" id="idNumber" name="idNumber" value="<?php echo $userDetails['ID']; ?>" required>

                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="<?php echo $userDetails['Email']; ?>" required>

                <label for="password">Password:</label>
                <input type="password" id="password" name="password" value="<?php echo $userDetails['Password']; ?>" required>

                <button type="submit" name="submit">Update</button>
            </form>
        <?php } else { ?>
            <p>User data not found.</p>
        <?php } ?>
    </div>
</body>
</html>
