<?php 
  session_start(); 

  if (!isset($_SESSION['name'])) {
  	$_SESSION['msg'] = "You must log in first";
  	header('location: login.php');
  }
  if (isset($_GET['logout'])) {
  	session_destroy();
  	unset($_SESSION['name']);
  	header("location: login.php");
  }
?>
<?php include('db.php') ?>
<!DOCTYPE html>
<html>
	<head>
	<title>Home</title>
	<link rel="stylesheet" type="text/css" href="./css/style1.css">
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta http-equiv="X-UA-Compatible" content="ie=edge" />
	<link rel="stylesheet" href="css\style.css" />
	<title>Expense Tracker</title>     
	</head>
   
    <body>

        <div class = "background">

        <div class = "tracker">
            <p>Welcome <strong><?php echo $_SESSION['name']; ?></strong></p>
            <h3>Your Current Balance is: </h3>
            <h1 id = "current_balance">Rs0.00</h1>

        <div class = "inc-exp-tracker">
            <div>
            <h5>INCOME</h5>
            <p id = "inflow" class = "inflow1">+Rs0.00</p>
            </div>
            <div>
            <h5>EXPENSE</h5>
            <p id = "outflow" class = "outflow1">-Rs0.00</p>
            </div>
        </div>       

        <h4>HISTORY</h4>  
        <ul id = "lists" class = "lists">
        <li class="minus"></ul>

        <h4>New transaction</h4>
        <form action="dp.php" method="post" id="form">
            <div class = "form1">
            <label for = "text">Category: </label>
            <input type = "text" id="text" name = "text" placeholder="Enter Category..." />
            </div>
            <div class = "form1">
            <label for = "amount">
                Amount: <br />
                NEGATIVE(-) FOR EXPENSE,<br /> POSITIVE(+) FOR INCOME.</label>

            <input type="number" id="amount" name = "amount" placeholder="Enter Amount..." />
            </div> 
            <div class = "form1">
                <label for = "date">Date: </label>
                <input type = "date" id = "date" name = "date">
            </div>
            <button type = "submit" class = "button" name = "new_tran"> Add Transaction </button>
        </form>
        </div>
        <script src="/js/validation.js"></script>

    <!-- logged in user information -->
    <?php  if (isset($_SESSION['name'])) : ?>
    	<p> <a href="index.php?logout='1'" style="color: red;">logout</a> </p>
    <?php endif 
    ?>

		
	</body>
</html>