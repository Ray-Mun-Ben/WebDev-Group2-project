<?php
// Include the 'connect.php' file that establishes the database connection
include 'connect.php';

// Check if the 'meal_id' is set in the URL
if (isset($_GET['meal_id'])) {
    // Get the 'meal_id' from the URL
    $mealID = $_GET['meal_id'];

    // Prepare the SQL query to delete the meal with the given 'meal_id'
    $sql = "DELETE FROM `meals` WHERE MealID = $mealID";

    // Execute the SQL query using mysqli_query
    $result = mysqli_query($con, $sql);

    // Check if the query was successful
    if ($result) {
        // Meal deleted successfully
        // Redirect to upload.php after deletion
        header('Location: upload.php');
        exit(); // Make sure to exit after redirection
    } else {
        echo "Error deleting meal: " . mysqli_error($con);
    }
}
?>
