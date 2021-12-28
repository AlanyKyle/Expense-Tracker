<?php

// initialise the variables
$name = "";
$income = "";
$expense    = "";
$date    = "";
$error = array(); 

// connection to the database
$db = mysqli_connect('localhost', 'root', '', 'registration');

// 
if (isset($_POST['new_tran'])) {
  // all input values that are receives
  $income = mysqli_real_escape_string($db, $_POST['income']);
  $expense = mysqli_real_escape_string($db, $_POST['expense']);
  $date = mysqli_real_escape_string($db, $_POST['date']);


  // To ensure that the form is filled correctly
  if (empty($income)) { array_push($error, "income required"); }
  if (empty($expense)) { array_push($error, "expense required"); }
  if (empty($date)) { array_push($error, "date required"); }
  }


  $user_check_query = "SELECT * FROM users WHERE name='$name' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);
  
  if ($user) {
    if ($user['name'] === $name) {
      $query = "INSERT INTO users (income, expense, date)
  			  VALUES('$income', '$expense', '$date')";
          $_SESSION['success'] = "Done!";
    }
  }

?>

