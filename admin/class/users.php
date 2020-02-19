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
	public $contest;
	public $student_performance;
	
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
		$this->conn->query($data);
		return true;
	}
	
	public function url($url)
	{ 
	   header("location:".$url);
	
	}
	
	public function signin($email,$pass)
	{ 
	  $query=$this->conn->query("select name,email,password from admin_signup where email='$email' and password='$pass'");
	  $d=$query->fetch_array(MYSQLI_ASSOC); //how on boolean ?? what function is this ?
	  $name=$d['name'];
	  if($query->num_rows>0)
	  {
		  $_SESSION['ad_email']=$email;
	      $_SESSION['ad_name']=$name;
		  echo $_SESSION['ad_name'];
		  return true;
	  }
	  
	  else
	  {
		  return false;
	  }
	  
	  
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
	  $query=$this->conn->query("select * from admin_signup where email='$email'");
	  $row=$query->fetch_array(MYSQLI_ASSOC); //how on boolean ?? what function is this ?
	  
	  if($query->num_rows>0)
	  {
		 $this->data[]=$row;
	  }
	  return $this->data;
	  
	 
		
	}
	
	
	public function student_performance()
	{
	  $query=$this->conn->query("select * from tot_performance");
	  $row=$query->fetch_array(MYSQLI_ASSOC); //how on boolean ?? what function is this ?
	  
	  if($query->num_rows>0)
	  {
		 $this->student_performance[]=$row;
	  }
	  return $this->student_performance;
	  
	 
		
	}
	
	
	
	
	public function ques_show( $ques)
	{    echo $ques;
		
		$query=$this->conn->query("select * from questions where cat_id='$ques'");
	  while($row=$query->fetch_array(MYSQLI_ASSOC)) //how on boolean ?? what function is this ?
	  
	 
	  {
		 $this->ques[]=$row;
	  }
	  return $this->ques;
	  
		
	}
	
	public function answer($data)
	{
		
	  //print_r($data);
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
	  
	  return $array;


		
	}
	
	public function add_quiz($rec)
	{
		
		$a=$this->conn->query($rec);
		//echo "inserted";
		//echo $a;
		return true;
	}
	
	
		public function contests()
	{
		$name=$_SESSION['ad_name'];
		$query=$this->conn->query("select * from create_contest where name='$name'");
	  while($row=$query->fetch_array(MYSQLI_ASSOC)) //how on boolean ?? what function is this ?
	  {
		 $this->contest[]=$row;
		 echo "hi";
	  }
	  return $this->contest;
		
				
	}
	
	
	
	
	
}

new users;


?>