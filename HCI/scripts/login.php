<?php
include 'db.php';

session_start();
$login= false;
function checkattempt($username){
    $max= 5;
    $lock_time= 3600;
    if(isset($_SESSION['login_attempt'][$username])){
        $attempt= $_SESSION['login_attempt'][$username]['attempt'];
        $time= $_SESSION['login_attempt'][$username]['time'];
        $curr_time= time();

        if(($curr_time-$time)<$lock_time && $attempt>=$max){
            return false;
        }elseif (($curr_time-$time)>$lock_time){
            unset ($_SESSION['login_attempt'][$username]);//reset attempt count
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
    if(!checkattempt($username)){
        echo "account locked"
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
            $login= true;
            echo "Logged in successfully";
        } else {
            // Password is not valid
            echo "Incorrect password";
            echo "DB Hash: " . $row['password'] . "<br>";
            echo "Entered Hash: " . password_hash($password, PASSWORD_DEFAULT) . "<br>";
            $login= false
        }
    } else {
        // Username does not exist
        echo "Incorrect username";
        $login= false;
    }
    if($login=== false){
        if (isset($_SESSION['login_attempt'][$username])){
            $_SESSION['login_attempt'][$username]=[
                'attempt'=>1
                'time'=>time()
            ];
        }else{
            $_SESSION['login_attempt'][$username]['attempt']++;
        }
    }
    $stmt->close();
    $conn->close();
}
?>