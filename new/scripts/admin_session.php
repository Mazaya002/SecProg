<?php
    include 'db.php';
    function gen_sess_token($id, $conn){//generate session token
        $token =sha1(uniqid());
        $_SESSION['session_token'] = $token;
        $uid= $id;
        $sess= $conn->prepare("INSERT INTO admin_sessions (admin_id, session_token) VALUES (?, ?) ON DUPLICATE KEY UPDATE session_token = ?");
        $sess->bind_param("iss",$uid, $token, $token);
        $sess->execute();
        $sess->close();
        return $token;
    }

    function validate_session($conn, $id, $sessionToken){
        $val_sess=$conn->prepare("SELECT session_token FROM admin_sessions WHERE admin_id = ?");
        $val_sess->bind_param("i", $id);
        $val_sess->execute();
        $result = $val_sess->get_result();
        if ($result->num_rows === 1) {
            $row = $result->fetch_assoc();
            $dbToken = $row['session_token'];
    
            if ($sessionToken !== $dbToken) {
                // session g sama log out
                $_SESSION = array();
                session_destroy();
                header("Location: login.php");
                exit;
            }
        } else {
            //ga ada token log out juga 
            $_SESSION = array();
            session_destroy();
            header("Location: login.php");
            exit;
        }
        $val_sess->close();
    }
?>