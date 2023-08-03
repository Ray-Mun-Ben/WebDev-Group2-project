<?php
// Include the 'connect.php' file that establishes the database connection
include 'connect.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Stacked Navigation Bars</title>
    <link rel="stylesheet" href="coolNavBar.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha384-vhE7cgJzjeH04p8p8t5LJETu/cpgQd9QodxiL0rRQ9yYI0+UnfKCwBCSN2P4VlFp" crossorigin="anonymous">

    <style>
  


.button1 {
    background-color: #35ee3f;
}

.coolbutton2 {
    background-color: #d43333;
}

.coolbutton1:hover {
    background-color: #0c4d24;
}

.coolbutton2:hover {
    background-color: #550d0d;
}
        body {
            background-color: #f2f2f2;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .navbar {
            background-color: #170d70;
            display: flex;
            align-items: center;
            height: 50px;
            padding: 0 5px;
            transition: transform 0.5s;
        }

        .navbar a {
            color: #fff;
            text-decoration: none;
            padding: 10px 20px;
        }

        .navbar a:hover {
            background-color: #070b3b;
        }

        .horizontal-navbar {
            justify-content: flex-end;
            transform: translateY(-50px);
        }

        .vertical-navbar {
            background-color: #5c0f0f;
            flex-direction: column;
            position: fixed;
            left: 0;
            height: 90vh;
            width: 20%;
            padding-top: 50px;
            transition: transform 0.5s;
            transform: translateX(-100%);
        }

        .vertical-navbar.show {
            transform: translateX(0);
        }

        .horizontal-navbar.show {
            transform: translateY(0);
        }

        .mine p {
            font-size: 24px;
            color: #fff;
            padding: 10px 20px;
            text-align: center;
            margin: 0;
        }

        .mine a {
            display: block;
            color: #fff;
            text-decoration: none;
            padding: 10px 20px;
            text-align: center;
            font-size: 18px;
            font-weight: bold;
        }

        .mine a:hover {
            background-color: #1f0404;
            border-radius: 5px;
        }

        .coolbtn {
            background-color: #170d70;
            color: #fff;
            border: none;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 18px;
            margin: 4px 2px;
            cursor: pointer;
            border-radius: 8px;
            transition: background-color 0.3s;
        }

        .coolbtn:hover {
            background-color: #070b3b;
        }

        div button {
            background-color: #170d70;
            color: #fff;
            border: none;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 18px;
            margin: 4px 2px;
            cursor: pointer;
            border-radius: 8px;
            transition: background-color 0.3s;
        }

        div button:hover {
            background-color: #070b3b;
        }
        p{
            font-size: 18px;
            font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
        }
        .navbar .toggle-btn {
            margin-right: auto;
            margin-left: 10px;
        }
    </style>
</head>
<body>
    <nav class="navbar horizontal-navbar">
        <button id="toggleVerticalNavbar" class="coolbtn toggle-btn">Toggle Menu</button>
        <a href="adminView.php">Home</a>
        <a href="#" class="user-icon-link">
            ADMIN
            <i class="fas fa-user"></i>
        </a>
    </nav>
    <nav class="navbar vertical-navbar mine">
        <p style="font-family: Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif;">UPDATE CAFETERIA MENU</p>
        <a href="upload.php">Kilimanjaro</a>
        <a href="#">Springs of Olive</a>
        <a href="#">Hangout</a>
        <a href="#">Strathmore Cafeteria</a>
    </nav>
    <h1 style="text-align:center;">KILIMANJARO MENU</h1>
    <div class="container">
        <button class="coolbtn" style=" margin-left: 500px;"><a href="newupload.php">Upload Meal</a></button>
    </div>

    <table class="table" style="">
        <thead>
            <tr>
                <th scope="col">MealID</th>
                <th scope="col">Meal Name</th>
                <th scope="col">Price</th>
                <th scope="col">Actions</th>
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

                    // Display data in table rows with update and delete buttons
                    echo '<tr>
                            <th scope="row">' . $mealID . '</th>
                            <td>' . $mealName . '</td>
                            <td>' . $price . '</td>
                            <td>
                                <button class="coolbutton1"><a href="update_meal.php?meal_id=' . $mealID . '">Update</a></button>
                                <button class="coolbutton2"><a href="delete_meal.php?meal_id=' . $mealID . '">Delete</a></button>
                            </td>
                          </tr>';
                }
            } else {
                echo "<tr><td colspan='4'>No meals found.</td></tr>";
            }
            ?>
        </table>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const horizontalNavbar = document.querySelector("nav.horizontal-navbar");
        const verticalNavbar = document.querySelector("nav.vertical-navbar");
        const toggleButton = document.getElementById("toggleVerticalNavbar");

        // Initially show both navbars
        horizontalNavbar.classList.add("show");
        verticalNavbar.classList.add("show");

        // Toggle the vertical navbar visibility when the button is clicked
        toggleButton.addEventListener("click", function() {
            verticalNavbar.classList.toggle("show");
        });
    });
</script>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>