<?php 
    require('scripts/csrf.php');
    $csrftoken = generate_token();
    if ( $_SESSION['loggedin'] !== TRUE){
        header('Location: ./login.php');
    }
 ?>

<!DOCTYPE html>
<html>
    <head>
        <title>AiMClab Store</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css">
        <link rel="stylesheet" href="./assets/store.css">
        <link rel="icon" href="/assets/favicon/favicon.ico" type="image/x-icon">
    </head>
    <body>
        <div class="navbar">
            <a href="./index.php#homepage" class="logo">
                <img src="/assets/img/logo.png">
            </a>
            <a href="./index.php#homepage">Home</a>
            <a href="./store.php">Store</a>
            <a href="./index.php#leaderboard">Leaderboard</a>
            <a href="./index.php#about">About</a>
            <a href="./register.php" class="register">reg</a>
            <a href="./login.php" class="login">login</a>
        </div>
        <div class="homepage" id="homepage">
            <div class="home-content">
                <h1>Welcome to</h1>
                <h1>AiMClab Store</h1>
                <p>Gear Up in the Real World, Conquer the Virtual World</p>
            </div>
        </div>

    
        <div class="rectext">
            <h2 >Recommended Today</h2>
            <p>Browse Our Reccomended Product For Today</p>
        </div>
        <div class="recommended-today">
            <?php
               require('scripts/storec.php');
            ?>
        </div>
        

        

        <!-- footer -->
        <div class="footer">
            <div class="address">
                <h3>Address</h3>
                <p>Jl. HaCeIh Lab 123</p>
            </div>
            <div class="contact">
                <h3>Contact</h3>
                <p>Email: support@aimclab.ai</p>
                <p>Phone: +62 81234567890</p>
            </div>
            <div class="product">
                <h3>Product</h3>
                <p>
                    <a href="#license"><li>AiMClab Lite</li></a>
                    <a href="#license"><li>AiMClab</li></a>
                    <a href="#license"><li>AiMClab Plus</li></a>
                    <a href="#license"><li>AiMClab Pro</li></a>
                </p>
            </div>
        </div>
        <script src="/assets/script/swags.js"></script>
    </body>
</html>