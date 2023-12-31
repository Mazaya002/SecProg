<?php
    session_start();
    //generate new token
    function generate_token(){
        $token =sha1(uniqid());
        if(!isset($_SESSION['csrf_token'])){
            $_SESSION['csrf_token']= $token;
        }
        return $token;
    }

    //validate token
    function verifycsrftoken($csrf){
        if (isset($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $csrf)) {//resistant to timing attack
            return true; // Token is valid
        }
        return false; // Token is invalid or not set
    }
?>