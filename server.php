<?php
session_start();

// initialise the variables
$name = "";
$email    = "";
$error = array(); 

// connection to the database
$db = mysqli_connect('localhost', 'root', '', 'registration');

// REGISTER USER
if (isset($_POST['reg_user'])) {
  // all input values that are receives
  $name = mysqli_real_escape_string($db, $_POST['name']);
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $password = mysqli_real_escape_string($db, $_POST['password']);
  $password1 = mysqli_real_escape_string($db, $_POST['password1']);

  // To ensure that the form is filled correctly
  if (empty($name)) { array_push($error, "Name required"); }
  if (empty($email)) { array_push($error, "Email required"); }
  if (empty($password)) { array_push($error, "Password required"); }
  if ($password != $password1) {
	array_push($error, "Two passwords did not match");
  }


  //  to avoid duplication of name and email
  $user_check_query = "SELECT * FROM users WHERE name='$name' OR email='$email' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);
  
  if ($user) { // if user exists
    if ($user['name'] === $name) {
      array_push($error, "name exists already");
    }

    if ($user['email'] === $email) {
      array_push($error, "email exists already");
    }
  }

  // If there are no error, Register User
  if (count($error) == 0) {
  	$password = md5($password); //password encryption
  	$query = "INSERT INTO users (name, email, password) 
  			  VALUES('$name', '$email', '$password')";
  	mysqli_query($db, $query);
  	$_SESSION['name'] = $name;
  	$_SESSION['success'] = "You are now logged in";
  	header('location: index.php');
  }
}

// LOGIN FOR THE USER
if (isset($_POST['login_user'])) {
    $name = mysqli_real_escape_string($db, $_POST['name']);
    $password = mysqli_real_escape_string($db, $_POST['password']);
  
    if (empty($name)) {
        array_push($error, "Name required");
    }
    if (empty($password)) {
        array_push($error, "Password required");
    }
  
    if (count($error) == 0) {
        $password = md5($password);
        $query = "SELECT * FROM users WHERE name='$name' AND password='$password'";
        $results = mysqli_query($db, $query);
        if (mysqli_num_rows($results) == 1) {
          $_SESSION['name'] = $name;
          $_SESSION['success'] = "logged in";
          header('location: index.php');
        }else {
            array_push($error, "Name or Password is wrong");
        }
    }
  }
  
  ?>