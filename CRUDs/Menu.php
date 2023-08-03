<?php
// Include the 'connect.php' file that establishes the database connection
include 'connect.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu</title>
    
    <link rel="stylesheet" href="coolNavBar.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <style>
        body {
            background-color: #f2f2f2;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .background-image {
            background-image: url('Cafeteria.jpg');
            background-size: cover;
            background-position: center;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        .navbar {
            background-color: #170d70;
            display: flex;
            align-items: center;
            height: 50px;
            padding: 0 400px;
        }

        .navbar a {
            color: #fff;
            text-decoration: none;
            padding: 10px 20px;
        }

        .navbar a:hover {
            background-color: #555;
        }

        h1 {
            text-align: center;
            font-size: 36px;
            color: white;
            margin-bottom: 30px;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .table th {
            background-color: #5c0f0f;
            color: #fff;
            padding: 12px;
            text-align: left;
        }

        .table td {
            padding: 10px;
        }

        .table tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .table tr:nth-child(odd) {
            background-color: #e8e8e8;
        }

        .table tr:hover {
            background-color: #ddd;
        }

        .cart {
            margin: 20px auto;
            padding: 20px;
            width: 80%;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        .cart h2 {
            font-size: 24px;
            color: #333;
            margin-bottom: 20px;
        }

        .cart ul {
            list-style: none;
            padding: 0;
        }

        .cart li {
            padding: 5px;
        }

        #totalPrice {
            font-weight: bold;
            color: #333;
            margin-top: 20px;
        }

        .coolbtn {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin-top: 20px;
            cursor: pointer;
            border-radius: 8px;
        }

        .coolbtn:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
<div class="background-image">
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
    <br>
   <h1 style="text-align:center;">Welcome To Kilimanjaro Please place your order.</h1>

    <table class="table">
        <thead>
            <tr>
                <th scope="col">Select</th>
                <th scope="col">Meal Name</th>
                <th scope="col">Price(Ksh)</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT * FROM `meals`";
            $result = mysqli_query($con, $sql);

            if ($result && mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    // Variables with the same names as database columns
                    $mealID = $row['MealID']; // MealID from database
                    $mealName = $row['meal_name']; // Meal Name from database
                    $price = $row['price']; // Price from database

                    // Display data in table rows with checkboxes for selection
                    echo '<tr>
                            <td><input type="checkbox" name="selectedMeal[]" value="' . $mealID . '"></td>
                            <td>' . $mealName . '</td>
                            <td>' . $price . '</td>
                          </tr>';
                }
            } else {
                echo "<tr><td colspan='3'>No meals found.</td></tr>";
            }
            ?>
        </tbody>
    </table>

    <section class="cart">
    <h2>Your Order/ Receipt</h2>
    <ul id="cartItems"></ul>
    <p id="totalPrice">Total Price: 0.00</p>
    <button class="coolbtn" onclick="submitOrder()">Submit Order</button> <!-- Add the submit button -->
</section>
<br>
<br>

    <!-- Add the JavaScript code here -->
</div>
    <script src="menu.js"></script>

</body>
</html>
