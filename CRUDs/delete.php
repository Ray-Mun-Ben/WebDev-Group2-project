<?php
// Include the 'connect.php' file that establishes the database connection
include 'connect.php';

if (isset($_GET['deleteid'])) {
    $AutoID = $_GET['deleteid'];

    // Prepare the SQL query with a parameterized query
    $sql = "DELETE FROM `user` WHERE AutoID = ?";

    // Create a prepared statement
    $stmt = mysqli_prepare($con, $sql);

    if ($stmt) {
        // Bind the parameter to the statement
        mysqli_stmt_bind_param($stmt, "i", $AutoID);

        // Execute the statement
        if (mysqli_stmt_execute($stmt)) {
            echo "Deletion was successful";
            // You may consider using JavaScript to show an alert or redirect to the user list page here.
            // For example: echo '<script>alert("Deletion was successful"); window.location.href = "user.php";</script>';
            header('location:user.php');
            exit(); // Ensure the script stops executing after redirecting
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
