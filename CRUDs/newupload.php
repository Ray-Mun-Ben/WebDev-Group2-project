<?php
// Include the 'connect.php' file that establishes the database connection
include 'connect.php';

// Check if the form is submitted (the upload button is clicked)
if (isset($_POST['upload'])) {
    // Retrieve user input from the form
    $mealName = $_POST['mealName'];
    $price = $_POST['price'];

    // Prepare the SQL query with placeholders to insert the new meal data
    $sql = "INSERT INTO `meals` (meal_name, price) VALUES (?, ?)";
    $stmt = mysqli_prepare($con, $sql);

    if ($stmt) {
        // Bind the parameters to the statement
        mysqli_stmt_bind_param($stmt, "ss", $mealName, $price);

        // Execute the statement
        if (mysqli_stmt_execute($stmt)) {
            // Data inserted successfully, redirect back to menu.php
            header("Location: upload.php");
            exit();
        } else {
            // In case of an error, display the MySQL error message
            die(mysqli_error($con));
        }

        // No need to close the statement here since the script will redirect
    } else {
        // In case of an error, display the MySQL error message
        die(mysqli_error($con));
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Meal</title>
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
    <h1>Upload Meal</h1>
    <form method="post">
        <label for="mealName">Meal Name:</label>
        <input type="text" id="mealName" name="mealName" required>

        <label for="price">Price(Ksh):</label>
        <input type="number" id="price" name="price" required>

        <button type="submit" name="upload">Upload Meal</button>
    </form>
</div>
</body>
</html>
