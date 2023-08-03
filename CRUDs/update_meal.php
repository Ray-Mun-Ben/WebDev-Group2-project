<?php
// Include the 'connect.php' file that establishes the database connection
include 'connect.php';

// Check if the form is submitted (the update button is clicked)
if (isset($_POST['update'])) {
    // Retrieve user input from the form
    $mealID = $_POST['meal_id'];
    $mealName = $_POST['meal_name'];
    $price = $_POST['price'];

    // Original SQL query (without prepared statements - not recommended for production)
    $sql = "UPDATE `meals` SET meal_name='$mealName', price='$price' WHERE MealID=$mealID";

    // Execute the SQL query using mysqli_query
    $result = mysqli_query($con, $sql);

    // Check if the query was successful
    if ($result) {
        echo "Meal updated successfully";
    } else {
        // In case of an error, display the MySQL error message
        die(mysqli_error($con));
    }
}

// Check if the meal_id is provided in the URL
if (isset($_GET['meal_id'])) {
    $mealID = $_GET['meal_id'];

    // Fetch the meal details from the database
    $sql = "SELECT * FROM `meals` WHERE MealID=$mealID";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_assoc($result);

    // If the meal with the specified ID is found, display the update form
    if ($row) {
        $mealName = $row['meal_name'];
        $price = $row['price'];
    } else {
        echo "Meal not found";
        exit;
    }
} else {
    // Redirect back to the table if meal_id is not provided in the URL
    header('location: upload.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Meal</title>
    <link rel="stylesheet" href="cssForUser.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <h1>Update Meal</h1>
        <form id="updateForm" method="post">
            <input type="hidden" name="meal_id" value="<?php echo $mealID; ?>">

            <label for="meal_name">Meal Name:</label>
            <input type="text" id="meal_name" name="meal_name" required value="<?php echo $mealName; ?>">

            <label for="price">Price:</label>
            <input type="number" id="price" name="price" required value="<?php echo $price; ?>">

            <button type="submit" name="update">Update</button>
        </form>
    </div>
</body>
</
