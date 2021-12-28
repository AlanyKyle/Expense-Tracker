<?php include('server.php') ?>
<!DOCTYPE html>
<html>
<head>
  <title>Expense Tracker</title>
  <link rel="stylesheet" type="text/css" href="./css/style.css">
</head>
<body>
  <div class="login">
  	<h2>Login</h2>
  </div>
	 
  <form method="post" action="login.php">
  	<?php include('errors.php'); ?>
  	<div class="details">
  		<label>Name</label>
  		<input type="text" name="name" >
  	</div>
  	<div class="details">
  		<label>Password</label>
  		<input type="password" name="password">
  	</div>
  	<div class="details">
  		<button type="submit" class="btn" name="login_user">Login</button>
  	</div>
  	<p>
  		Not yet a member? <a href="register.php">Register</a>
  	</p>
  </form>
</body>
</html>