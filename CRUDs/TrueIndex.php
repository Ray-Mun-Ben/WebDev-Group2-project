<!DOCTYPE html>
<html>
<head>
    <title>Stacked Navigation Bars with Carousel</title>
  
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <!-- Internal styles -->
    <style>
        body {
            background-color: #f2f2f2;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            position: relative;
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
        }

        .mine a:hover {
        background-color: #1f0404;

        }

        .carousel img {
            height: 630px; /* Adjust the height as needed */
            object-fit: cover;
        }

        /* Positioning for the carousel */
        .carousel {
            position: absolute;
            left: 290px;
            top: 50px;
            right: 20px;
            width: 600px;
            
        }
    </style>

    <!-- JavaScript to apply the "show" class when the page loads -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.querySelector(".horizontal-navbar").classList.add("show");
            document.querySelector(".vertical-navbar").classList.add("show");
        });
    </script>
</head>
<body>
<nav class="navbar horizontal-navbar">
    <a href="TrueIndex.php">Home</a>
    <a href="#">Contact</a>
    <a href="trueLogin.php">Login</a>
    <a href="login.php">Signup</a>
    <a href="userProfile.php" class="user-icon-link">
        USER
        <i class="fas fa-user"></i>
    </a>
</nav>
<nav class="navbar vertical-navbar mine">
    <p style=" font-family: Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif;">CHOOSE A CAFETERIA TO ORDER FROM</p>
    <a href="Menu.php">Kilimanjaro</a>
    <a href="#">Springs of Olive</a>
    <a href="#">Hangout</a>
    <a href="#">Strathmore Cafeteria</a>
</nav>

<!-- Carousel at the bottom right corner -->
<div class="carousel slide" data-ride="carousel" data-interval="3000">
    <!-- Indicators -->
    <ul class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
        <li data-target="#myCarousel" data-slide-to="1"></li>
        <li data-target="#myCarousel" data-slide-to="2"></li>
    </ul>

    <!-- Slides -->
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="doughnut.jpg" alt="Image 1">
        </div>
        <div class="carousel-item">
            <img src="sam.jpg" alt="Image 2">
        </div>
        <div class="carousel-item">
            <img src="mas1.jpg" alt="Image 3">
        </div>
    </div>

    <!-- Controls -->
    <a class="carousel-control-prev" href="#myCarousel" data-slide="prev">
        <span class="carousel-control-prev-icon"></span>
    </a>
    <a class="carousel-control-next" href="#myCarousel" data-slide="next">
        <span class="carousel-control-next-icon"></span>
    </a>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
