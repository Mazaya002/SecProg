
<?php 
    require('scripts/register.php');
 ?>
 <!DOCTYPE html>
 <html>
    <head>
        <title>AiMClab Member</title>
        <link rel="icon" href="/media/favicon_io/favicon-32x32.png" type="image/x-icon"/>
        <link rel="stylesheet" href="./styles/regis-styles.css">
    </head>

    <body>
        <div class="nav">
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
        <div class="card">
            <form method="post" action="./scripts/register.php">
                <input type="text" name="username" placeholder="Username" required>
                <input type="password" name="password" placeholder="Password" required>
                <input type="email" name="email" placeholder="Email" required>
                <div class="buttons">
                    <button type="submit" class="login-button">Register</button>
                </div>
            </form>
        </div>
    </body>
</html>
