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
	
	public function __construct()
	{
		$this->conn=new mysqli($this->host,$this->username,$this->pass,$this->db_name);
		if($this->conn->connect_errno)//new
		{  
		   die("data base connection failed".$this->conn->connect_errno);
		}                    //concatenate eh?
		
		
		
	}

	
	public function url($url)
	{ 
	   header("location:".$url);
	
	}

	
	
	
	public function feed($data)
	{ 
	   $this->conn->query($data);
		return true;
	  
	  
	}
	
}

//include("class/users.php");
$feedback= new users;
extract($_POST);                 //using 2 post variables.. one for checking ans is also there in users..so will duplicate
echo $comment;
echo $rating;

$query="insert into feedback values('','$comment','$rating')"; //cant do here itself..each time we have to connect to database
                                                               //so classes has to be used

if($feedback->feed($query))
{
	$feedback->url("home.php?run_f=success"); 
	
}



?>