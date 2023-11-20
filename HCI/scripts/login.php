<?php
include 'db.php';

session_start();

function clean_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = clean_input($_POST['username']);
    $password = clean_input($_POST['password']);

    // Prepare a statement to prevent SQL Injection
    $stmt = $conn->prepare("SELECT id, username, password FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            // Password is correct, start a new session
            session_regenerate_id();
            $_SESSION['loggedin'] = TRUE;
            $_SESSION['username'] = $row['username'];
            $_SESSION['id'] = $row['id'];
            

            echo "Logged in successfully";
        } else {
            // Password is not valid
            echo "Incorrect password";
            echo "DB Hash: " . $row['password'] . "<br>";
            echo "Entered Hash: " . password_hash($password, PASSWORD_DEFAULT) . "<br>";
        }
    } else {
        // Username does not exist
        echo "Incorrect username";
    }

    $stmt->close();
    $conn->close();
}
?>