<?php 
    require('scripts/csrf.php');
    require('scripts/session.php');
    if ( $_SESSION['loggedin'] !== TRUE){
        header('Location: ./admin_login.php');
    }else{

        validate_session($conn, $_SESSION['id'],$_SESSION['sess_token'] );
    }
 ?>
<!DOCTYPE html>
<html>
<head>
    <title>Upload Data</title>
</head>
<body>
    <form action="logout.php" method="post">    
        <button type="submit" name="logout">Logout</button>
    </form>
    <h2>Upload Data</h2>
    <form action="./scripts/admin.php" method="post" enctype="multipart/form-data">
        <label for="name">Title:</label>
        <input type="text" id="name" name="name"><br><br>

        <label for="image">Image:</label>
        <input type="file" id="image" name="image"><br><br>

        <label for="price">Price:</label>
        <input type="number" id="price" name="price"><br><br>

        <label for="rating">Rating:</label>
        <input type="number" id="rating" name="rating"><br><br>

        <button type="submit" name="submit">submit</button>
    </form>
    <h2>View & Delete data</h2>
    <table border="1">
        <tr>
            <th>Title</th>
            <th>Image</th>
            <th>Price [$]</th>
            <th>Rating</th>
            <th>Action</th>
        </tr>
        <?php
        // Include database connection file
        require('scripts/db.php');

        // Fetch data from database
        $query = $conn->prepare("SELECT title, image, price, rating FROM store"); // Replace 'your_table' with your actual table name
        $query->execute();
        $result = $query->get_result();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                ?>
                <tr>
                    <td><?php echo $row['title']; ?></td>
                    <td><?php echo $row['image']; ?></td>
                    <td><?php echo $row['price']; ?></td>
                    <td><?php echo $row['rating']; ?></td>
                    <td>
                     <form action="./scripts/admin.php" method="post">
                        <input type="hidden" name="delete_title" value="<?php echo $row['title']; ?>">
                        <button type="submit" name="delete_row">Delete</button>
                    </form>
                    </td>
                </tr>
                <?php
            }
        } else {
            echo "<tr><td colspan='3'>No data found</td></tr>";
        }
        ?>
    </table>
</body>
</html>
