<!--cant understand the bootstrap now..sorry -->  <!--//INSIDE PHP TAG ONLY PHP STATEMENTS !! -->
<?php
include("class/users.php");
$ad_email=$_SESSION['ad_email'];  //PHAAH GENIUS
$ad_name=$_SESSION['ad_name'];
//echo $ad_email;
//echo $ad_name;
$admin_profile=new users;
$admin_profile->users_profile($ad_email);// no need to save the returened values..we can directly use it uh?
$admin_profile->contests();
$admin_profile->cat_show();
$admin_profile->student_performance();
//print_r($admin_profile->data);
//print_r($admin_profile->contest); 
//print_r($admin_profile->cat);           //?

//print_r($admin_profile->student_performance);

echo $ad_name;

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Home page</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="style.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body class="bod">

<div class="container">
  <h2 class="hi">Welcome to quizzito, Admin <?php echo $ad_name;?></h2>
  <ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#home" class="hi">HOME</a></li>
    <li><a data-toggle="tab" href="#menu1" class="hi">PROFILE</a></li>
    <li><a data-toggle="tab" href="#menu2" class="hi">STUDENT PERFORMANCE</a></li> <!--wts dis-->
    <li style="float:right"><a data-toggle="tab" href="#menu3 " class="hi">LOGOUT</a></li>
  </ul>

  <div class="tab-content">
    <div id="home" class="tab-pane fade in active">
	<br>
	<br>
	<br>
	<br>
      
    <center><button type="button" class="btn btn-success" data-toggle="tab" href="#select">Create a new contest !</button></center>
	
	<br>
	<br>
      
	  <div class="col-sm-4"></div>
	  <div class="col-sm-4">
      <div id="select" class="tab-pane fade">
	  
	  
	 
	  <form method="post" action="add_quiz.php">
	
	
			  <select class="form-control" id="" name="cat">
			  
			  <?php
	  
	                 //$profile->cat_show();  //its already being called once bruh.
	  
	                  foreach($admin_profile->cat as $category) //its all public
	                  {?>
					  <option value="<?php echo $category['id'];?>"><?php echo $category["cat_name"];?></option> <!--dat 2 is comming due to this i think -->  
					 <?php }
					  
	  
	                  ?> 

			  </select>
			  <br>
			  
			  <div class="form-group">
				  <label for="email" style="color:white">Number of questions:</label>
				  <input type="text" class="form-control" name='e' id="email" placeholder="Enter number of questions">
				</div>
				<div class="form-group">
				  <label for="pwd" style="color:white">Randomized quiz or not ?:</label>
				  <input type="text" class="form-control" name='p' id="pwd" placeholder="Enter Y/N">
				</div>
				
								<div class="form-group">
				  <label for="pwd" style="color:white">Time Limit( In minutes):</label>
				  <input type="text" class="form-control" name='t' id="pwd" placeholder="Enter time limit">
				</div>
			  
			  <center><input type="submit" value="submit" class="btn btn-success"/></center>
			  </form>
	</div>
	</div>
	
	<div class="col-sm-12">
	
	<h3 style="color:white">Already running contests for <?php echo $ad_name;?> are:</h3>
	
	</div>
	
	<table class="table" >
    <thead>
      <tr class="danger">
        <th>CONTEST ID</th>
        <th>CATEGORY ID</th>
		<th>NO OF QUESTIONS</th>
		<th>RANDOM</th>
		<th>TIME LIMIT(MIN)</th>
		
      </tr>
    </thead>
    <tbody>
	
	

	
	<?php
	
	foreach($admin_profile->contest as $contest)
	{ ?>
	
	<tr class="danger">
	  <td><?php echo $contest['id'];?></td>
	  <td><?php echo $contest['cat_id'];?></td>
	  <td><?php echo $contest['no_of_ques'];?></td>
	  <td><?php echo $contest['random'];?></td>
	  <td><?php echo $contest['time'];?></td>

	  
      </tr>

    </tbody>
	

	
	
	
	<?php } ?>
  </table>
	</div>
	<div class="col-sm-4"></div>
    <div id="menu1" class="tab-pane fade">
      
	  
	  
	    <table class="table" >
    <thead>
      <tr class="danger">
        <th>ID</th>
        <th>NAME</th>
		<th>EMAIL</th>
		<th>PROFILE PICTURE</th>
      </tr>
    </thead>
    <tbody>
	<?php
	foreach($admin_profile->data as $prof)
	{ ?>
	
	<tr class="danger">
	  <td><?php echo $prof['id'];?></td>
	  <td><?php echo $prof['name'];?></td>
	  <td><?php echo $prof['email'];?></td>
	  <td><img src="img/<?php echo $prof['img'];  ?>" alt="" width="225px" height="250px" /></td>
	  
	  
	  
	  
      </tr>

    </tbody>
	

	
	
	
	<?php } ?>
  </table>

<?php if(isset($_GET['run']) && $_GET['run']=="success_pic") {echo "<mark>YOUR PROFILE PICTURE HAS BEEN RESET!</mark>";}   ?>	
  <div class="col-sm-6">
  <form role="form" method="post" action="change_pic2.php" enctype="multipart/form-data">

                 <div class="form-group">
								  <label for="pwd" style="color:white">Upload your image</label>
								  <input type="file" class="form-control" id="file" name="img" >
								</div>
	  <center><input type="submit" value="change profile picture" class="btn btn-success"/></center>
	  
	  </form>
</div>
	  
<?php if(isset($_GET['run']) && $_GET['run']=="success") {echo "<mark>YOUR PASSWORD HAS BEEN RESET!</mark>";}   ?>	

 <div class="col-sm-6">  
<form role="form" method="post" action="reset_pwd.php" >
								
				<div class="form-group">
				  <label for="pwd" style="color:white">Reset Password:</label>
				  <input type="password" class="form-control" name="p" placeholder="Enter New password">
				</div>
	  <center><input type="submit" value="reset password" class="btn btn-success"/></center>
	  
	  </form>
	  
</div>
	  
  
  
   
    </div>
	
	
	
	
	
	
	
    <div id="menu2" class="tab-pane fade">
     
	 
	  <table class="table" >
    <thead>
      <tr class="danger">
        <th>NAME</th>
        <th>EMAIL</th>
		<th>TOTAL NUMBER OF QUIZES ATTENDED</th>
		<th>AVERAGE MARKS</th>
      </tr>
    </thead>
    <tbody>
	<?php
	foreach($admin_profile->student_performance as $prof)
	{ ?>
	
	<tr class="danger">
	  <td><?php echo $prof['name'];?></td>
	  <td><?php echo $prof['email'];?></td>
	  <td><?php echo $prof['total_quizs'];?></td>
	  <td><?php echo $prof['avg_marks'] .'%';?></td>
	  
	  
	  
	  
	  
      </tr>

    </tbody>
	

	
	
	
	<?php } ?>
  </table>


	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
   
    </div>
    <div id="menu3" class="tab-pane fade">
      <h3>Menu 3</h3>
     
    </div>
  </div>
</div>

</body>
</html>

