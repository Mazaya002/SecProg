<?php 
    require('scripts/admin_login.php');
    require('scripts/csrf.php');
//skip generate token, not workey
 ?>
<html>
    <head>
        <title>AiMClab Member</title>
        <link rel="icon" href="/media/favicon_io/favicon-32x32.png" type="image/x-icon"/>
        <link rel="stylesheet" href="./styles/regis-styles.css">
    </head>

    <body>
        <div class="card">
            <form method="post" action="./scripts/login.php">
                
                <input type="text" name="username" placeholder="Username" required>
                <input type="password" name="password" placeholder="Password" required>
                <div class="buttons">
                    <button type="submit" class="login-button">Login</button>
                </div>
            </form>

        </div>
    </body>
</html>