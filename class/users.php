<?php
session_start();

class users{
	
	public $host="localhost";
	public $username="root";
	public $pass="";
	public $db_name="new_quiz";
	public $conn;
	public $data;
	public $cat;
	public $ques;
	public $cont;
	public $time_alloted;
	public $contest;
	//public $cdata;
	public $answer;
	public $quiz_info;
	public $performance;
	public $strength;
	public $weakness;
	public $stars;
	public $avg_score_per_sub;
	
	public function __construct()
	{
		$this->conn=new mysqli($this->host,$this->username,$this->pass,$this->db_name);
		if($this->conn->connect_errno)//new
		{  
		   die("data base connection failed".$this->conn->connect_errno);
		}                    //concatenate eh?
		
		
		
	}
	
	public function signup($data)
	{
		$query=$this->conn->query("select email from signup where email='$email'");
		$row=$query->fetch_array(MYSQLI_ASSOC);
		if($query->num_rows>0)
	  {
		
		  return false;
	  }
	  else{
		
		$this->conn->query($data);
		return true;
	  }
	}
	
	public function url($url)
	{ 
	   header("location:".$url);
	
	}
	
	public function signin($email,$pass)
	{ 
	  $query=$this->conn->query("select name,email,password from signup where email='$email' and password='$pass'");
	  $d=$query->fetch_array(MYSQLI_ASSOC); //how on boolean ?? what function is this ?
	  $name=$d['name'];
	  if($query->num_rows>0)
	  {
		  $_SESSION['email']=$email;
	      $_SESSION['name']=$name;
		  
		  //echo $_SESSION['name'];
		  return true;
	  }
	  
	  else
	  {
		  return false;
	  }
	  
	  
	}
	
	
	
	public function feed($data)
	{ 
	   $this->conn->query($data);
		return true;
	  
	  
	}
	
	
	public function cat_show()
	{
		$query=$this->conn->query("select * from category");
	  while($row=$query->fetch_array(MYSQLI_ASSOC)) //how on boolean ?? what function is this ?
	  {
		 $this->cat[]=$row;
		 //echo "hi";
	  }
	  return $this->cat;
		
	}
	
	
	public function users_profile($email)
	{
	  $query=$this->conn->query("select * from signup where email='$email'");
	  $row=$query->fetch_array(MYSQLI_ASSOC); //how on boolean ?? what function is this ?
	  
	  if($query->num_rows>0)
	  {
		 $this->data[]=$row;
	  }
	  return $this->data;
	  
	 
		
	}
	
	public function ques_show( $ques)
	{    //echo $ques;
		
		$query=$this->conn->query("select * from questions where cat_id='$ques'");
	  while($row=$query->fetch_array(MYSQLI_ASSOC)) //how on boolean ?? what function is this ?
	  
	 
	  {
		 $this->ques[]=$row;
	  }
	  return $this->ques;
	  
		
	}
	
	public function strength_weakness( $email)
	{    //echo $ques;
		
		$query=$this->conn->query("select distinct(cat_id) from track_performance where email='$email' and percentage >= 70");
	  while($row=$query->fetch_array(MYSQLI_ASSOC)) //how on boolean ?? what function is this ?
	  
	 
	  {
		 $this->strength[]=$row;
	  }
	  //return $this->ques;
	  
	  $query=$this->conn->query("select distinct(cat_id) from track_performance where email='$email' and percentage <= 60");
	  while($row=$query->fetch_array(MYSQLI_ASSOC)) //how on boolean ?? what function is this ?
	  
	 
	  {
		 $this->weakness[]=$row;
	  }
	  
	  $query=$this->conn->query("select count(*) from track_performance where email='$email' and stars_gained=1");
	  while($row=$query->fetch_array(MYSQLI_ASSOC)) //how on boolean ?? what function is this ?
	  
	 
	  {
		 $this->stars[]=$row;
	  }
	  //average score per subject
	  $query=$this->conn->query("select cat_id, avg(percentage) from track_performance where email='$email' group by cat_id ");
	  while($row=$query->fetch_array(MYSQLI_ASSOC)) //how on boolean ?? what function is this ?
	  
	 
	  {
		 $this->avg_score_per_sub[]=$row;
	  }
	  
		
	}
	
	public function answer($data)   //for contest it is taking default wrong answers. its null value is being taken like 0th option!
	{
		
	  //print_r($data);
	  
	  $_SESSION['no_quiz']=$_SESSION['no_quiz']+1;
	  $ans=implode("",$data);
	  $right=0;
	  $wrong=0;
	  $no_ans=0;
	  //$noans=0;         //just checking the data in the entire table !
	  		$query=$this->conn->query("select id,ans from questions where cat_id='".$_SESSION['cat']."'");  //??
	  while($quest=$query->fetch_array(MYSQLI_ASSOC)) //how on boolean ?? what function is this ?
	  
	                             
	  {                            //this the the name of the option.
		 if($quest['ans']==$_POST[$quest['id']]) //How is post working here??(basically it is there in the posted file also)
		 {
			$right++; 
			 
		 }
		 
		 elseif($_POST[$quest['id']]=="Not Attempted")
		 {
			 $no_ans++;
		 }
		 
		 else
		 
		 {
			 $wrong++;
		 }
		 
		 
		 
		 
		 
		 
	  }
	  $per=($right/($right+$wrong+$no_ans))*100;
	  $array=array();
	  $array['Right Answers']=$right;
	  $array['Not Attempted']=$no_ans;
      $array['Wrong Answers']=$wrong;
	  $array['per']=$per;
	  
	  //echo $_SESSION['tot_per'] ." ";
	  //echo ($_SESSION['no_quiz']-1) ." ";
	  //echo $per ." ";
	  //echo $_SESSION['no_quiz'] ." ";
	  $_SESSION['tot_per']=(($_SESSION['tot_per']*($_SESSION['no_quiz']-1))+$per)/$_SESSION['no_quiz'];
	  
	  //$newper=
	  $email=$_SESSION['email'];// we have to put session values into variables..then only sql query
	  $tot=$_SESSION['no_quiz'];
	  $p= $_SESSION['tot_per'];
	  
	  //ONLY UPDATION IS ENOUGH..CANT INSERT EVERY TIME
	  //see all spelling in query else it wont insert.   //here and is not working  (and avg_marks='$p')
	  $q="update tot_performance set total_quizs='$tot'  where email='$email'";
	  
	  if($this->conn->query($q))
	  {
		//echo "updated tot questions !";  
	  }
	  
	  else{
		  
		  //echo "NOT updated!";  
		  
	  }
	  //updation success
	  $q="update tot_performance set avg_marks='$p' where email='$email'";
	  if($this->conn->query($q))
	  {
		//echo "updated avg marks !";  
	  }
	  
	  else{
		  
		  //echo "NOT updated!";  
		  
	  }
	  
	  
	  //echo $tot ."new percent is"  ;
	  
	  //echo $p;
	  echo $email;
	 $percent=$per;
	 $stars=0;
	 if($percent>=70)
	 {
		 $stars=1;
		 $_SESSION['no_stars']=$_SESSION['no_stars']+1;
	 }
	$cat_id=$_SESSION['cat'];
	$q="insert into track_performance values('','$email','$cat_id','$percent','$stars')";
	if($this->conn->query($q))
	  {
		//echo "inserted  in track performance !";  
	  }
	  
	  else{
		  
		  //echo "NOT updated! track performance";  
		  
	  }
	  
	  
	  
	  
	  
	  
	  
	  return $array;


		
	}
	
	
	public function get_quiz_info($email)
	{
	  $query=$this->conn->query("select * from tot_performance where email='$email'");
	  $row=$query->fetch_array(MYSQLI_ASSOC); //how on boolean ?? what function is this ?
	  
	  if($query->num_rows>0)
	  {
		 $this->quiz_info[]=$row;
	  }
	  
	  //print_r($this->quiz_info);
	  return $this->quiz_info;
	  
	 
		
	}
	
	public function get_performance($email)
	{
		
		$query=$this->conn->query("select * from track_performance where email='$email'");
		 while($row=$query->fetch_array(MYSQLI_ASSOC))//how on boolean ?? what function is this ?
	  
	  {
	  
		 $this->performance[]=$row;
		 
	  }
	  
	  
	  //print_r($this->performance);
	  return $this->performance;
		
	  
		
	}
	
	
	
	
	
	
	public function correct_answer($data) //iam afraid everything is serial :)
	{
		
	  //print_r($data);
	  //echo "inside users correct ans";
	  $ans=implode("",$data);
	  $right=0;
	  $wrong=0;
	  $no_ans=0;
	  $i=1;
	  $ra;
	  $ya;
	  $correct_array=array();
	  //$noans=0;         //just checking the data in the entire table !
	  		$query=$this->conn->query("select id,ans from questions where cat_id='".$_SESSION['cat']."'");  //??
	  while($quest=$query->fetch_array(MYSQLI_ASSOC)) //how on boolean ?? what function is this ?
	  
	                             
	  {                            //this the the name of the option.
		 if($quest['ans']==$data[$quest['id']]) //How is post working here??(basically it is there in the posted file also)
		 {
			$ya= $data[$quest['id']]+1;
			$ra= $quest['ans']+1;
			$correct_array[$i]=nl2br("your answer is correct: ".$ra."\n you scored +1");
			
			 
		 }
		 
		 elseif($data[$quest['id']]=="Not Attempted")
		 {
			 //$ra= $data[$quest['id']]+1;
			// $ya= $data[$quest['id']]+1;
			$ra= $quest['ans']+1;
			 $correct_array[$i]=nl2br("you have not attempted this question, the correct answer is: ".$ra."\n you scored +0");
		 }
		 
		 else
		 
		 {
			 $ya= $data[$quest['id']]+1;  //for contest..null value it is taking as 0 !!
			$ra= $quest['ans']+1;
			 $correct_array[$i]=nl2br("your answer ".$ya." is incorrect, the correct answer is: ".$ra."\n you scored +0");
			 
		 }
		 
		 $i+=1;
		 
		 
		 
		 
		 
		 
	  }
      //echo "trying to print correct array";
	  //print_r($correct_array);
	  return $correct_array;


		
	}
	
	public function add_quiz($rec)
	{
		
		$a=$this->conn->query($rec);
		//echo "inserted";
		//echo $a;
		return true;
	}
	
	
	public function contest_student()
	{
		$name=$_SESSION['name'];
		$query=$this->conn->query("select * from create_contest");
	  while($row=$query->fetch_array(MYSQLI_ASSOC)) //how on boolean ?? what function is this ?
	  {
		 $this->contest[]=$row;
		 //echo "hi";
	  }
	  return $this->contest;
		
				
	}
	
	
		public function con_show($con_id)
	{    //echo $con_id;
	    
		$query1=$this->conn->query("select * from create_contest where id='$con_id'");
		$row1=$query1->fetch_array(MYSQLI_ASSOC);
		$cat_id=$row1['cat_id'];
		$no_of_ques=$row1['no_of_ques'];
		$random=$row1['random'];
		$time_alloted=$row1['time'];
		//echo $time_alloted;
		//print_r($row1);
		
		$i=$no_of_ques;
		 
		$query=$this->conn->query("select * from questions where cat_id='$cat_id'");
	  while($i>0) //how on boolean ?? what function is this ?
	  
	 
	  {
		 $row=$query->fetch_array(MYSQLI_ASSOC);   //first i questions only
		 $this->cont[]=$row;
		 $i-=1;
	  }
	  return $this->cont;
	  
		
	}
	
	
	
	
	
}

new users;


?>