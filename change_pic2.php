<?php

include("class/users.php");
$register= new users;
extract($_POST);//  directly use variables instead of writting post everywhere !!;
$email=$_SESSION['email'];

$img_name=$_FILES['img']['name'];
$tmp_name=$_FILES['img']['tmp_name'];
move_uploaded_file($tmp_name,"img/".$img_name);


//echo $n;
//$query="insert into signup values('','$n','$e','$p','$img_name')";

$query="update signup set img='$img_name' where email='$email'";




if($register->signup($query))
{
	$register->url("home.php?run=success_pic"); //what ??
}

//$register->url("home.php?run=success"); //what ??










?>