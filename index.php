<!DOCTYPE html>
<html lang="en">
<head>
  <title>Signin and Signup</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="style.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

</head>
<body class="bod">

<br>
<br>

<div class="container">
<div class="row">
    <div class="col-sm-12">


		  <div class="panel panel-info">
			  <div class="panel-heading"><b><h4>QUIZZITO</b></h4></div>
		  </div>
		  <br>
		  <br>
    </div>
</div>
</div>


 
<div class="container">
<div class="row">
	<div class="col-sm-6">
	<br>
    <br>
	  <div class="panel panel-danger">
	    <div class="panel-heading"><h4>LOGIN FORM</h4></div>
		<div class="panel-body">
		
		<?php 
		    require_once "config.php";

	if (isset($_SESSION['access_token'])) {
		header('Location: index.php');
		exit();
	}

	$loginURL = $gClient->createAuthUrl();
	
	
		if(isset($_GET['run']) && $_GET['run']=="failed")
		{
			echo "<mark>YOUR EMAIL OR PASSWORD IS NOT CORRECT !</mark>";
		}
		 if(isset($_GET['run']) && $_GET['run']=="success_d") {echo "<mark>YOUR ACCOUNT HAS BEEN DELETED!</mark>";}  	 


		?>
				<form action="signin_sub.php", method="post">
				<div class="form-group">
				  <label for="email">Email:</label>
				  <input type="email" class="form-control" name='e' id="email" placeholder="Enter email">
				</div>
				<div class="form-group">
				  <label for="pwd">Password:</label>
				  <input type="password" class="form-control" name='p' id="pwd" placeholder="Enter password" pattern=".{8,}" title="length of password has to be atleast 8" required>
				</div>
				
				
				
				<button type="submit" class="btn btn-default">Submit</button>
				<input type="button" onclick="window.location = '<?php echo $loginURL ?>';" value="Log In With Google" class="btn btn-danger">
			  </form>
	  </div>
	  </div>
	</div>
	
	
	
	<div class="col-sm-6">
	  <div class="panel panel-danger">
	    <div class="panel-heading"><h4>SIGN UP FORM</h4></div>
		<div class="panel-body">
		
		<?php if(isset($_GET['run']) && $_GET['run']=="success")
			{echo "<mark>YOUR REGISTRATION WAS SUCCESSFUL !</mark>";}
		
		else if(isset($_GET['run']) && $_GET['run']=="exists")
		{
			echo "<mark>USER ALREADY EXISTS !</mark>";
		}

		?>
				<form role="form" method="post" action="signup_sub.php" enctype="multipart/form-data">
				<div class="form-group">
				  <label for="name">Name:</label>
				  <input type="text" class="form-control" name="n" id="name" placeholder="Enter name" required>
				</div>
				<div class="form-group">
				  <label for="email">Email:</label>
				  <input type="email" class="form-control" name="e" id="email" placeholder="Enter email" required>
				</div>
				<div class="form-group">
				  <label for="pwd">Password:</label>
				  <input type="password" class="form-control" name="p" id="pwd" placeholder="Enter password" pattern=".{8,}" title="length of password has to be atleast 8" required>
				</div>
				
				<div class="form-group">
								  <label for="pwd">Upload your image</label>
								  <input type="file" class="form-control" id="file" name="img" >
								</div>
				
				<button type="submit" class="btn btn-default">Submit</button>
			  </form>
	  </div>
	  </div>
	</div>
</div>
</div>
</body>
</html>
