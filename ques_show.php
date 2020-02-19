<?php
include("class/users.php");
$ques= new users;
$cat= $_POST['cat'];
$ques->ques_show($cat);
$_SESSION['cat']=$cat;
//echo "<pre>";
//print_r($ques->ques);

?>


<script> 

         var v=<?php echo $_SESSION['theme']?>;     //IAM SO SMART
		 
          if(v=='1')
			  
			  {
				  
				  
				  document.body.style.backgroundImage='url("light_theme.jpg")';
				  
				  
			  }
            
    </script> 











<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="style.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>


<script type="text/javascript">

function timeout()
{
  
  var	minute=Math.floor(timeLeft/60);
  var sec=timeLeft%60;
  
  
  if(timeLeft<=0)
  {   //jquery
       clearTimeout(tm);
	  document.getElementById("form1").submit();
	  
  }
  else
	  
	  {
		  
		 document.getElementById("time").innerHTML=minute+":"+sec;
		 
		  
      }
	  
	  timeLeft--;
	  
	  var tm=setTimeout(function(){timeout()},1000);
	
}


</script>


</head>
<body onload="timeout()" class="bod"> <!--ALL HTML THINGS ARE ROW WISE !! -->

<div class="container">
<div class="col-sm-2"></div> 
<div class="col-sm-8">
  <h2 class="hi">Online quiz in Web Development 
  
  
  <script type="text/javascript">

   var timeLeft=2*60;  //inside head

    </script>
  
  
  
  <div id="time" style="float:right">Time hi<div></h2>
  
  
  
  
  
  
  <br>
  <br>
  
  <form id="form1" method="post" action="answer.php">
<?php

$i=1;
 foreach($ques->ques as $quest) {?>  
  <table class="table table-bordered">
    <thead>
      <tr class="danger">
        <th><?php echo "$i "; ?><?php echo $quest['ques'];?></th>
		
	
      </tr>
    </thead>
    <tbody>
	<?php if(isset($quest['option1'])) {?>
      <tr class="info">
        <td>1<input type="radio" value="0" name="<?php echo $quest['id']; ?>"  /><?php echo $quest['option1'];?></td>
        
      </tr>
	<?php } ?>
	<?php if(isset($quest['option2'])) {?>
	  <tr class="info">
        <td>2<input type="radio" value="1" name="<?php echo $quest['id']; ?>"  /><?php echo $quest['option2'];?></td>
		
		</tr>
		<?php } ?>
      <?php if(isset($quest['option3'])) {?>  
     
	  <tr class="info">
        <td>3<input type="radio" value="2" name="<?php echo $quest['id']; ?>"  /><?php echo $quest['option3'];?></td>
       
      </tr>
	  <?php } ?>
	  <?php if(isset($quest['option4'])) { //y are we doing this????>  
	  <tr class="info">
        <td>4<input type="radio" value="3" name="<?php echo $quest['id']; ?>"  /><?php echo $quest['option4'];?></td>
        
      </tr>
       <?php } ?> 
	   
	   <tr class="info">
        <td><input type="radio" style="display:none" checked="checked" value="Not Attempted" name="<?php echo $quest['id']; ?>"  /></td>
        
      </tr>
    </tbody>
  </table>
  
	<?php $i++; } ?>
	
	<center><input type="submit" value="Submit Quiz" class="btn btn-success"/></center>
	</form>
	</div> 
	<div class="col-sm-2"></div> 
	 
</div>

</body>
</html>
