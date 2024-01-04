<?php 
    require('scripts/login.php');
    require('scripts/csrf.php');
    $csrftoken = generate_token();
 ?>
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
            <form method="post" action="./scripts/login.php">
                <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($csrfToken, ENT_QUOTES); ?>">
                <input type="text" name="username" placeholder="Username" required>
                <input type="password" name="password" placeholder="Password" required>
                <div class="buttons">
                    <button type="submit" class="login-button">Login</button>
                </div>
            </form>
            <h1>not member yet ? <a href="./register.php">sign up</a></h1>
        </div>
    </body>
</html>