<?php
include 'db.php';
require ('session.php');
session_start();
$login= false;
function checkattempt($username,$conn){
    $max= 5;
    $lock_time= 3600;

    $ril= $conn->prepare("SELECT attempts, UNIX_TIMESTAMP(last_attempt) FROM attempts WHERE username = ?");
    $ril->bind_param("s",$username);
    $ril->execute();
    $result= $ril->get_result();
    if($result->num_rows === 1){
        $row = $result->fetch_assoc();
        $attempts = $row['attempts'];
        $lastAttemptTime = $row['last_attempt'];
        $currTime = time();

        if(($curr_time-$lastAttemptTime)<$lock_time && $attempt>=$max){
            return false;
        }elseif (($curr_time-$lastAttemptTime)>$lock_time){
            $resetril= $conn->prepare("UPDATE attempts SET attempts = 0, last_attempt = CURRENT_TIMESTAMP WHERE username= ?");//reset attempt count
            return true;
        }else{
            return true;//percobaan masih dalam batas dan melebihiwaktu
        }
    }else{
        return true; //g ad coba login
    }
}

function clean_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = clean_input($_POST['username']);
    $password = clean_input($_POST['password']);
    if(!checkattempt($username,$conn)){
        die("Too many failed attempts. Account has been locked.");
        exit();
    }

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
            $_SESSION['sess_token']= gen_sess_token($row['id'], $conn);
            $login= true;
            echo "Logged in successfully";
            header('Location:../index.php');
        } else {
            // Password is not valid
            echo "Incorrect password";
            echo "DB Hash: " . $row['password'] . "<br>";
            echo "Entered Hash: " . password_hash($password, PASSWORD_DEFAULT) . "<br>";
            $login= false;
        }
    } else {
        // Username does not exist
        echo "Incorrect username";
        $login= false;
    }
    if($login=== false){
        //update attempts
        $updateril=$conn->prepare("INSERT INTO attempts (username, attempts, last_attempt) VALUES (?, 1, CURRENT_TIMESTAMP) ON DUPLICATE KEY UPDATE attempts = attempts + 1, last_attempt = CURRENT_TIMESTAMP");
        $updateril->bind_param("s", $username);
        $updateril->execute();
    }
    $stmt->close();
    $conn->close();
}
?>