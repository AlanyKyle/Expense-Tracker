<?php include('server.php') ?>
<!DOCTYPE html>
<html>
<head>
  <title>Expense Tracker RegistrationL</title>
  <link rel="stylesheet" type="text/css" href="./css/style.css">
</head>
<body>
  <div class="login">
  	<h2>Register</h2>
  </div>
	
  <form method="post" action="register.php">
  	<?php include('errors.php'); ?>
  	<div class="details">
  	  <label>Name</label>
  	  <input type="text" name="name" value="<?php echo $name; ?>">
  	</div>
  	<div class="details">
  	  <label>Email</label>
  	  <input type="email" name="email" value="<?php echo $email; ?>">
  	</div>
  	<div class="details">
  	  <label>Password</label>
  	  <input type="password" name="password">
  	</div>
  	<div class="details">
  	  <label>Confirm password</label>
  	  <input type="password" name="password1">
  	</div>
  	<div class="details">
  	  <button type="submit" class="btn" name="reg_user">Register</button>
  	</div>
  	<p>
  		Already a member? <a href="login.php">Sign in</a>
  	</p>
  </form>
</body>
</html>