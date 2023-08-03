<?php
// Include the 'connect.php' file that establishes the database connection
include 'connect.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Get the selected items and total from the AJAX request
    $selectedItems = json_decode($_POST["selectedItems"], true);
    $total = floatval($_POST["total"]);

    // Insert the selected items and total into the 'Order' table
    foreach ($selectedItems as $item) {
        $mealName = mysqli_real_escape_string($con, $item["mealName"]);
        $price = floatval($item["itemPrice"]);

        $sql = "INSERT INTO `Order` (meal_name, price) VALUES ('$mealName', $price)";
        mysqli_query($con, $sql);
    }

    // Optionally, you can send a response back to the JavaScript code
    echo "Order saved successfully!";
}
?>
