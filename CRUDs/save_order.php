<?php
// Include the 'connect.php' file that establishes the database connection
include 'connect.php';

// Check if the request is a POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the data from the request
    $data = json_decode(file_get_contents('php://input'), true);

    // Extract the selected items from the data
    $selectedItems = $data['selectedItems'];

    // Calculate the total price of the order
    $totalPrice = 0;
    foreach ($selectedItems as $mealID) {
        // Assuming you have a table called `meals` where the price can be fetched based on MealID
        $stmtSelect = $con->prepare("SELECT price FROM `meals` WHERE MealID = ?");
        $stmtSelect->bind_param("i", $mealID);
        $stmtSelect->execute();
        $stmtSelect->bind_result($price);

        // Fetch the result and add the price to the total price
        while ($stmtSelect->fetch()) {
            $totalPrice += $price;
        }
        $stmtSelect->close();
    }

    // Prepare the SQL statement to insert the order into the "customerorder" table
    $stmtInsert = $con->prepare("INSERT INTO `customerorder` (meal_name, price, quantity, total_price) VALUES (?, ?, ?, ?)");

    // Bind parameters and execute the statement for each selected item
    foreach ($selectedItems as $mealID) {
        // Assuming you have a table called `meals` where the meal_name and price can be fetched based on MealID
        $stmtSelect = $con->prepare("SELECT meal_name, price FROM `meals` WHERE MealID = ?");
        $stmtSelect->bind_param("i", $mealID);
        $stmtSelect->execute();
        $stmtSelect->bind_result($mealName, $price);

        // Fetch the result and insert it into the "customerorder" table
        while ($stmtSelect->fetch()) {
            // Set quantity to 1 for now, you can update this based on your implementation
            $quantity = 1;

            // Create a new prepared statement instance for each iteration
            $stmtInsert = $con->prepare("INSERT INTO `customerorder` (meal_name, price, quantity, total_price) VALUES (?, ?, ?, ?)");
            $stmtInsert->bind_param("sdid", $mealName, $price, $quantity, $totalPrice);
            $stmtInsert->execute();
            $stmtInsert->close();
        }
        $stmtSelect->close();
    }

    // Return a response indicating success
    http_response_code(200);
    echo "Order submitted successfully!";
} else {
    // Return a response indicating bad request
    http_response_code(400);
    echo "Bad Request";
}
?>
