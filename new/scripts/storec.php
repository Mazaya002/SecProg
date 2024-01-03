<?php
    include 'db.php';
    $load= $conn->prepare('SELECT image, title, price, rating FROM store');
    $load->execute();
    $result= $load->get_result();
    if($result->num_rows>0){
        while ($row= $result->fetch_assoc()){
            echo "<div class='card'>";
            echo "<img src='" . htmlspecialchars($row["image"]) . "' alt='" . htmlspecialchars($row["title"]) . "'>";
            echo "<h3>" . htmlspecialchars($row["title"]) . "</h3>";
            echo "<p>Price: $" . htmlspecialchars($row["price"]) . "</p>";
            
            // display star based on rating val
            $stars = $row["rating"];
            echo "<div class='stars'>";
            for ($i = 0; $i < $stars; $i++) {
                echo "<i class='fa fa-star'></i>"; //load rating star
            }
            echo "</div>";
            
            echo "<button id='addToCart'>Add to Cart</button>";
            echo "</div>";
        }
    } else {
        echo "<h1>nothing to see here atm. Will add smtg in the future</h1>";
    }
    $load->close();
    $conn->close();
?>