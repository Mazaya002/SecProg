<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  //input sanitaztion
  function sanitize($input){
    $input= trim($input);
    $input= stripslashes($input);
    $input= htmlspecialchars($data, ENT_QUOTES);
    return $input;
  }

  $username = sanitize($_POST['username']);
  $password = sanitize($_POST['password']);
  $email = sanitize($_POST['email']);

  //validasi input 
  if(empty($username)|| empty($email)||empty($password)){
    echo "Cannot be empty";
  } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)){
    echo "Invalid email format"
  } elseif(strlen($password)<6){
    echo "password must be >=8 charas long"
  }else{
      // Check if username or email already exists
  $check_query = "SELECT id FROM users WHERE username = ? OR email = ?";
  $stc=$conn->prepare($check_query);
  $stc->bind_param("ss",$username,$email);
  $stc->execute();
  $check_result = $stc->get_result();
  
  if ($check_result->num_rows > 0) {
    echo "Username or Email already exists";
  } else {
    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Query to insert new user
    $insert_query = "INSERT INTO users (username, password, email) VALUES (?, ?, ?)";
    $sti=$conn->prepare($insert_query);
    $sti->bind_param ("sss",$username,$hashed_password,$email);
    $success = $sti->execute();

     if ($success) {
      echo "Registration successful";
      } else {
        echo "Error: " . $sti->error;
      }
    }


  }

  $conn->close();
}
?>