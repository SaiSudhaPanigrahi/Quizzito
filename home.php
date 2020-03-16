<!--cant understand the bootstrap now..sorry -->
<?php
error_reporting(E_ERROR | E_PARSE);
include("class/users.php");
$email=$_SESSION['email'];
//echo $email;

//$_SESSION['no_quiz']=0;
//$_SESSION['tot_per']=0;
$profile=new users;
$profile->users_profile($email);
$profile->cat_show();
//print_r($profile->data); 
$name= $_SESSION['name'];
$profile->contest_student(); 
$profile->get_quiz_info($email);
$profile->get_performance($email);
$profile->strength_weakness($email);
//$profile->cat_show(); no need..already there 



/*$nq=$profile->quiz_info['total_quizs'];
echo $nq;


undefined index total_quizs is comming.. for loop is neccessary
*/


foreach($profile->quiz_info as $prof)

{$nq=$prof['total_quizs'];
$_SESSION['no_quiz']=$nq;
echo $nq; 
$tp=$prof['avg_marks'];
$_SESSION['tot_per']=$tp;
echo $tp;} 

          //directly using the variable as it is returned !! 
                                     //without the return statement also it will work i think. Try and see later

echo $_SESSION['email'];
//echo $_SESSION[''];
echo $_SESSION['no_quiz']
//echo $name;
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


<script> 

          
            function changeColor(color) { 
			
                document.body.style.backgroundImage='url("light_theme.jpg")';
				
            } 
              
            function gfg_Run() { 
                changeColor('yellow');
				<?php $_SESSION['theme']='1' ?>
                
            }          
        </script> 

<div class="container">
  <h2 class="hi">Welcome to quizzito <?php echo $name;?>! Take your online quiz now</h2>
  <ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#home" class="hi">HOME</a></li>
    <li><a data-toggle="tab" href="#menu1" class="hi">PROFILE</a></li>
    <li><a data-toggle="tab" href="#menu2" class="hi">CONTEST</a></li> <!--wts dis-->
	<li><a data-toggle="tab" href="#menu3" class="hi">TRACK PERFORMANCE</a></li>
    <li style="float:right"><a href="index.php" class="hi">LOGOUT</a></li><!--lol genius-->
  </ul>

  <div class="tab-content">
    <div id="home" class="tab-pane fade in active">
	<br>
	<br>
	<br>
	<br>
     <?php if(isset($_GET['run_f']) && $_GET['run_f']=="success") {echo "<center><mark>YOUR FEEDBACK HAS BEEN NOTED!</mark></center>";}   ?>
<br>	 
    <center><button type="button" class="btn btn-success" data-toggle="tab" href="#select">Start Quiz Now !</button></center>
	
	<br>
	<br>
      
	  <div class="col-sm-4"></div>
	  <div class="col-sm-4">
      <div id="select" class="tab-pane fade">
	  
	 
	 
	  <form method="post" action="ques_show.php">
	
	
			  <select class="form-control" id="" name="cat">
			  
			  <?php
	  
	                 //$profile->cat_show();  //its already being called once bruh.
	  
	                  foreach($profile->cat as $category) //its all public
	                  {?>
					  <option value="<?php echo $category['id'];?>"><?php echo $category["cat_name"];?></option> <!--dat 2 is comming due to this i think -->  
					 <?php }
					  
	  
	                  ?> 

			  </select>
			  <br>
			  <center><input type="submit" value="submit" class="btn btn-success"/></center>
			  </form>
			  
			  

		
		
	</div>
	<br>
	
				  <center><button type="button" class="btn btn-primary" onclick = "gfg_Run()">  
            Click here to change to light theme !
        </button></center>
	</div>
	
	
	
	
	
	
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
	
	foreach($profile->data as $prof)
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
  
  <?php if(isset($_GET['run']) && $_GET['run']=="success_delete") {echo "<mark>YOUR ACCOUNT HAS BEEN DELETED!</mark>";}   ?>	  
<div class="col-sm-6">
<form role="form" method="post" action="delete.php" >
								
				<div class="form-group">
				  <label for="pwd" style="color:white">Delete Account ? (Type 'yes' below)</label>
				  <input type="text" class="form-control" name="d" placeholder="Enter Response">
				</div>
	  <center><input type="submit" value="delete account" class="btn btn-danger"/></center>
	  
	  </form>
	</div>  
  
   
    </div>
	
	
	
	
	
	
	
	
	
	
	<div id="menu3" class="tab-pane fade">
      
	  
	  
    	<div class="col-sm-12">
	
	<h3 style="color:black"><b>Category number information:</b></h3>
	
	</div>
	
	
	<table class="table" >
    <thead>
      <tr class="danger">
        <th>CATEGORY ID</th>
        <th>CATEGORY NAME</th>
      </tr>
    </thead>
    <tbody>
	
	

	
	<?php
	/* $cat[]=$row; is not working here for some reason
	$cat[];
	
	//IF YOU WANT TO KEEP TRACK OF SOMETHING, MAKE TABLES IN DATA BASE !
	$query=$this->conn->query("select * from category");
	  while($row=$query->fetch_array(MYSQLI_ASSOC)) //how on boolean ?? what function is this ?
	  {
		 $cat[]=$row;
		 //echo "hi";
	  }
	  
	*/
	foreach($profile->cat as $contest)
	{ ?>
	
	<tr class="danger">
	
	<form method="post" action="contest_show.php">
	  <td><?php echo $contest['id'];?></td>
	  <td><?php echo $contest['cat_name'];?></td>

	 	  </form>
	  
      </tr>

    </tbody>
	

	
	
	
	<?php } ?>
  </table>
  

	
	<h3 style="color:black"><b>Track your performance:</b></h3>
	
	
  
  
  
	
	<table class="table" >
    <thead>
      <tr class="danger">
        <th>QUIZ ID</th>
        <th>EMAIL</th>
		<th>CATEGORY ID</th>
		<th>PERCENT</th>
		<th>STARS GAINED</th>
		
		
		
      </tr>
    </thead>
    <tbody>
	
	

	
	<?php
	
	//IF YOU WANT TO KEEP TRACK OF SOMETHING, MAKE TABLES IN DATA BASE !
	
	foreach($profile->performance as $contest)
	{ ?>
	
	<tr class="danger">
	
	<form method="post" action="contest_show.php">
	  <td><?php echo $contest['id'];?></td>
	  <td><?php echo $contest['email'];?></td>
	  <td><?php echo $contest['cat_id'];?></td>
	  <td><?php echo $contest['percentage'];?></td>
	  <td><?php echo $contest['stars_gained'];?></td>
	  
	  </form>
	  
      </tr>

    </tbody>
	

	
	
	
	<?php } ?>
	
	
  </table>
  
  	    <table class="table" >
    <thead>
      <tr class="danger">
        <th>AREAS OF STRENGTH (category id)</th>
	</thead>
    <tbody>
		<?php
		foreach($profile->strength as $prof)
	{ ?>
	
	<tr class="danger">
	  <td><?php echo $prof['cat_id'];?></td>
	  
	 </tr>

    </tbody>
	

	
	
	
	<?php } ?>
	  </table>
	  
	  
	  <table class="table" >
    <thead>
      <tr class="danger">
        <th>AREAS OF WEAKNESS (category id)</th>
	</thead>
    <tbody>
		<?php
		foreach($profile->weakness as $prof)
	{ ?>
	
	<tr class="danger">
	  <td><?php echo $prof['cat_id'];?></td>
	  
	 </tr>

    </tbody>
	

	
	
	
	<?php } ?>
	  </table>
	  
	  
	  <table class="table" >
    <thead>
      <tr class="danger">
        <th>TOTAL NUMBER OF STARS</th>
	</thead>
    <tbody>
		<?php
		foreach($profile->stars as $prof)
	{ ?>
	
	<tr class="danger">
	  <td><?php echo $prof['count(*)'];?></td>
	  
	 </tr>

    </tbody>
	
	<?php 
     if($prof['count(*)']>= 5)
	 {
		 echo "<center><mark> CONGRATS ,YOU ARE PROMOTED TO ADMIN. YOU CAN LOGIN NOW AS AN ADMIN! </mark></center>";
	 }
	 
	 
  ?>
	

	
	
	
	<?php } ?>
	  </table>
	  
	  <table class="table" >
    <thead>
      <tr class="danger">
        <th>AVERAGE SCORE PER SUBJECT</th>
		<th>SUBJECT CODE</th>
	</thead>
    <tbody>
		<?php
		foreach($profile->avg_score_per_sub as $prof)
	{ ?>
	
	<tr class="danger">
	  <td><?php echo $prof['avg(percentage)'];?></td>
	  <td><?php echo $prof['cat_id'];?></td>
	  
	 </tr>

    </tbody>
	

	
	
	
	<?php } ?>
	  </table>
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
 
    <tbody>
	<?php
	
	foreach($profile->data as $prof)
	{ ?>
	
	<tr class="danger">
	  
	  <td><img src="img/<?php echo $prof['img'];  ?>" alt="" width="225px" height="250px" /></td>
	  
	  
	  
	  
      </tr>

    </tbody>
	

	
	
	
	<?php } ?>
  </table>
	  
  
  
   
    </div>
	
	
		<div id="menu2" class="tab-pane fade">
      
	  
	  
    	<div class="col-sm-12">
	
	<h3 style="color:black"><b>Currently running contests are:</b></h3>
	
	</div>
	
	<table class="table" >
    <thead>
      <tr class="danger">
        <th>CONTEST ID</th>
        <th>CATEGORY ID</th>
		<th>NO OF QUESTIONS</th>
		<th>RANDOM</th>
		<th>TIME LIMIT(MIN)</th>
		<th>TEST LINK</th>
		
		
      </tr>
    </thead>
    <tbody>
	
	

	
	<?php
	
	//IF YOU WANT TO KEEP TRACK OF SOMETHING, MAKE TABLES IN DATA BASE !
	
	foreach($profile->contest as $contest)
	{ ?>
	
	<tr class="danger">
	
	<form method="post" action="contest_show.php">
	  <td><?php echo $contest['id'];?></td>
	  <td><?php echo $contest['cat_id'];?></td>
	  <td><?php echo $contest['no_of_ques'];?></td>
	  <td><?php echo $contest['random'];?></td>
	  <td><?php echo $contest['time'];?></td>
	  <input type="hidden" name="con_id" value="<?php echo $contest['id'];?>">  <!--again genius -->
	  <input type="hidden" name="time" value="<?php echo $contest['time'];?>"> 
	  <td><input type="submit" value="Take the quiz" class="btn btn-success"/></td>
	  </form>
	  
      </tr>

    </tbody>
	

	
	
	
	<?php } ?>
  </table>
	  
  
  
   
    </div>
	
	
	
	
	
    <div id="menu4" class="tab-pane fade">
	
      <?php
	  {$profile->url("index.php");
	  }	  
?>
   
    </div>
    <div id="menu3" class="tab-pane fade">
      <h3>Menu 3</h3>
     
    </div>
  </div>
</div>

</body>
</html>

