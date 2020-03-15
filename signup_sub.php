<?php
//$n = $_POST["n"];     //GO TO EACH PAGE(HTML) AND DO SOMETHING(PHP)  ALL FUNCTIONS ARE KEPT IN A SEPARATE FILE SO THEY CAN BE RESUSED.
                        //SESSION(ONLY KNOWLEDGE ABT THE USER) HAS TO START IN ALL PAGES..BECAUSE PAGES ARE INDIPENDENT(NEW FRESH PAGES)
						//OF EACH OTHER. SO PUT THAT ALSO IN THE SEPARATE FILE. BECAUSE All the pages are fresh..we have to create new objects in each page and
						//then use the functions freshly.
						//TOP TO DOWN EXECUTION LIKE ANY HTML FILE.
//$n = $_POST; Bettar use extract else error: array to string conversion.
include("class/users.php");
$register= new users;
extract($_POST);//  directly use variables instead of writting post everywhere !!;


$img_name=$_FILES['img']['name'];
$tmp_name=$_FILES['img']['tmp_name'];
move_uploaded_file($tmp_name,"img/".$img_name);


//echo $n;
$query="insert into signup values('','$n','$e','$p','$img_name')";


if($register->signup($query))
{
	$register->url("index.php?run=success"); //what ??
}

else{
	
	$register->url("index.php?run=exists");
	
}






?>