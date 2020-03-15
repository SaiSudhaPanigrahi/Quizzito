<?php

error_reporting(E_ERROR | E_WARNING | E_PARSE); //for contest it was showing notices on line 137 because users class is always there and variables are not passed.
include("class/users.php");
$ans= new users;
//print_r($_POST);
$_SESSION['answer']=$_POST; //ohk lol
//print_r ($_SESSION['answer']);
$answer=$ans->answer($_POST);
//echo $_SESSION['theme']; //Only if i echo here it is working....maybe script is running before the php !!


//echo "hi";
$c_answer=$ans->correct_answer($_SESSION['answer']); //ohk lol
//print_r ($c_answer);

?>


<script> 

         var v=<?php echo $_SESSION['theme']?>;     //IAM SO SMART
		 
          if(v=='1')
			  
			  {
				  
				  
				  document.body.style.backgroundImage='url("light_theme.jpg")';
				  
				  
			  }
            
    </script> 

<!DOCTYPE HTML>
<html lang="en-US">
<head>
   <meta charset="UTF-8">
   <title>Your Results</title>
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	 <link rel="stylesheet" href="style.css">
  
  </head>
 <body class="bod">
 
 <!--<center><h2> Number of questions answered right :<?php echo $answer['Right Answers']; ?></h2>
 <h2> Number of questions not answered :<?php echo $answer['Not Attempted']; ?></h2>
 <h2> Number of questions answered incorrectly :<?php echo $answer['Wrong Answers']; ?></h2>
 <br>
 <br>
 <h2> Your over all Percentage is :<b><u><?php echo " ".$answer['per']; ?>%</b></u></h2>
 -->
 <?php
 $name=$_SESSION['name'];
 //echo $name;
 $tot=$answer['Right Answers']+ $answer['Not Attempted']+$answer['Wrong Answers'];
 $attempt=$tot-$answer['Not Attempted']; 
 $attempt=$tot-$answer['Not Attempted'];
//echo $tot;
//echo $attempt; 
 ?>
 
 <div class="container">
 <div  class ="col-sm-2"></div>
 <div  class ="col-sm-8">
  <center><h2 class="hi" style="color:blue" ><b><u>Your results are here !! <?php echo $name ?></b></u></h2></center>
  <br>
  <br>
  <table class="table table-bordered">
    <thead>
      <tr class="danger">
        <th><b>Total Number of Questions</b></th>
        <th><?php echo $tot ?> </th>
      </tr>
    </thead>
    <tbody>
      <tr class="danger">
        <td><b>Number of Questions attempted</b></td>
        <td><?php echo $attempt ?> </td>
      </tr>
      <tr class="danger">
        <td><b>Number of questions answered right</b></td>
        <td><?php echo $answer['Right Answers']; ?></td>
      </tr>
	  <tr class="danger">
        <td><b>Number of questions not answered</b></td>
        <td><?php echo $answer['Not Attempted']; ?></td>
      </tr>
	  <tr class="danger">
        <td><b>Number of questions answered incorrectly</b></td>
        <td><?php echo $answer['Wrong Answers']; ?></td>
      </tr class="danger">
	  <tr class="danger">
        <td><b>Your over all Percentage is</b> </td>
        <td><b><u><?php echo " ".$answer['per']; ?>%</b></u></td>
      </tr>

    </tbody>
  </table>
  
  </div>
  <div  class ="col-sm-2"></div>
  
  </div>
  
   <div class="container">
  <div  class ="col-sm-2"></div>
  <div  class ="col-sm-8">
  
  <?php 
     if($answer['per']>= 90)
	 {
		 echo "<center><mark>CONGRATS YOU ARE AN EXPERT IN THIS AREA! </mark></center>";
	 }
	 
	 else if ($answer['per']>= 70 and $answer['per']< 90 )
	 {
		 echo "<mark>YOU DID GREAT, PRACTICE A BIT MORE TO UPSCALE YOUR SKILLS !</mark>";
	 }
	 
	 else{
		 
		 echo "<mark>REVISE YOUR CONCEPTS TO SCORE EVEN BETTAR !</mark>";
	 }


  ?>
  </div>
    <div  class ="col-sm-2"></div>
	
	</div>
  
  

<div  class ="col-sm-2"></div>
<div class="col-sm-8">
	  <div class="panel panel-danger">
	    <div class="panel-heading"><center><h4 class="hi">DETAILED PERFORMANCE REPORT !</h4></center></div>
		<div class="panel-body">
		
		
				<form role="form" method="post" action="correct_ans.php" ">
				<div class="form-group">
				  
				</div>
				
		
		
		
				
				<center><button type="submit" class="btn btn-success">Answers</button></center>
			  </form>
	  </div>
</div>
	
<div  class ="col-sm-2"></div>


	
	




<div class="col-sm-8">
	  <div class="panel panel-danger">
	    <div class="panel-heading"><center><h4 class="hi">FEEDBACK FORM</h4></center></div>
		<div class="panel-body">
		
		<?php if(isset($_GET['run']) && $_GET['run']=="success") {echo "<mark>YOUR FEEDBACK WAS RECORDED !</mark>";}   ?>
				<form role="form" method="post" action="feedback.php" enctype="multipart/form-data">
				<div class="form-group">
				  
				<center><textarea rows="6" cols="50" name="comment">Please give us a feedback of your experience !...</textarea></center>
				</div>
				
				
				
				<center><h4 class="hi"><b>Give us five stars if you enjoy our application !</b></h4>
				<br>
				
				<div>
				<input type="radio" value="1" name="rating" />
				<input type="radio" value="2" name="rating" />
				<input type="radio" value="3" name="rating" />
				<input type="radio" value="4" name="rating" />
				<input type="radio" value="5" name="rating" />
				<br>
				<p>1  2  3  4  5</p>
				
				
				</div>
				</center>
				
				<center><button type="submit" class="btn btn-success">Submit</button></center>
			  </form>
	  </div>
	  </div>
	</div>
<div class ="col-sm-2"></div>
</div>



 
 
 
 
 
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
 </center>
 </body>
 </html>