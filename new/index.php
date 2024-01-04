<?php 
    require('scripts/csrf.php');
    require('scripts/session.php');
    if ( $_SESSION['loggedin'] !== TRUE){
        header('Location: ./login.php');
    }else{

        validate_session($conn, $_SESSION['id'],$_SESSION['sess_token'] );
    }
 ?>
<!DOCTYPE html>
<html>
    <head>
        <title>AiMClab Home</title>
        <link rel="stylesheet" href="assets/styles.css">
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
        <!-- Homepage below this -->
        <div class="homepage" id="homepage">
            <div class="home-content">
                <h1>Welcome to AiMClab</h1>
                <p>AiMClab: Where gaming meets artificial intelligence.</p>
                <button class="join" onclick="window.location.href='/route/members.html'">Join Us</button>
                <button class="download" onclick="alert('Downloading Trial Version')">Downloads</button>
            </div>
        </div>
        <!-- Leaderboard below this -->
        <div class="leaderboard" id="leaderboard">
            <div class="ldbtext">
                <h2>Leaderboard</h2>
            </div>
            <div class="ldbcontent">
                <div class="leaderboard-graph">
                    <img src="assets/img/Top Performance Graph.png">
                </div>
                <div class="leaderboard-table">
                    <table>
                        <thead>
                            <tr>
                                <th>Rank</th>
                                <th>Gamertag</th>
                                <th>Points</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Player1</td>
                                <td>10000</td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Player2</td>
                                <td>9000</td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>Player3</td>
                                <td>8000</td>
                            </tr>
                            <tr>
                                <td>4</td>
                                <td>Player4</td>
                                <td>7000</td>
                            </tr>
                            <tr>
                                <td>5</td>
                                <td>Player5</td>
                                <td>6000</td>
                            </tr>
                            <tr>
                                <td>6</td>
                                <td>Player6</td>
                                <td>5000</td>
                            </tr>
                            <tr>
                                <td>7</td>
                                <td>Player7</td>
                                <td>4000</td>
                            </tr>
                            <tr>
                                <td>8</td>
                                <td>Player8</td>
                                <td>3000</td>
                            </tr>
                            <tr>
                                <td>9</td>
                                <td>Player9</td>
                                <td>2000</td>
                            </tr>
                            <tr>
                                <td>10</td>
                                <td>Player10</td>
                                <td>1000</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- About below this -->
        <div class="about" id="about">
            <div class="container">
                <h2 class="title">About Us</h2>
                <p class="content">
                    At AiMClab, we're passionate about one thing: revolutionizing the gaming experience. We believe that every gamer deserves access to the tools and resources they need to reach their full potential. That's why we've developed a cutting-edge gaming platform that combines artificial intelligence, data science, and advanced analytics to help you improve your skills, optimize your performance, and conquer your competition.
                </p>
                <h2 class="title">Our Mission</h2>
                <p class="content">
                    Our mission is to empower gamers of all levels to unlock their full potential and achieve peak performance. We do this by:
                    <ul class="content">
                        <li>
                            Developing innovative AI-powered tools and technologies that analyze your gameplay and provide personalized feedback and recommendations.
                        </li>
                        <li>
                            Creating a data-driven platform that provides actionable insights to help you understand your strengths and weaknesses.
                        </li>
                        <li>
                            Building a supportive community where gamers can connect, share knowledge, and learn from each other.
                        </li>
                    </ul>
                </p>
                <h2 class="title">Why Choose AiMClab</h2>
                <p class="content">
                    We believe that AiMClab is the ultimate solution for gamers who are serious about improving their skills and performance. Here are just a few reasons why you should choose AiMClab:
                    <ul class="content">
                        <li>
                            Personalized AI coaching: Our AI coaches will analyze your gameplay and provide you with personalized feedback and recommendations that are tailored to your specific needs.
                        </li>
                        <li>
                            Advanced data analytics: Our platform provides you with a wealth of data about your gameplay, which you can use to identify areas for improvement.
                        </li>
                        <li>
                            Customizable training drills: We offer a variety of customizable training drills that you can use to improve your skills and reflexes.
                        </li>
                        <li>
                            Competitive community: Our community of gamers is passionate about improving their skills and achieving their goals.
                        </li>
                        <li>
                            Proven results: Our platform has helped players of all levels improve their skills and achieve success in competitive gaming.
                        </li>
                    </ul>
                </p>
            </div>
        </div>
        <!-- Footer below this -->
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
                    <a href="/route/store.html#license"><li>AiMClab Lite</li></a>
                    <a href="/route/store.html#license"><li>AiMClab</li></a>
                    <a href="/route/store.html#license"><li>AiMClab Plus</li></a>
                    <a href="/route/store.html#license"><li>AiMClab Pro</li></a>
                </p>
            </div>
        </div>
    </body>
</html>