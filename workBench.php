<?php

error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);  
ini_set('display_errors' , 1);
include ("functions.php");
include ( "account.php") ;
$db = mysqli_connect($hostname,$username, $password ,$project);
if (mysqli_connect_errno())
  {
	  echo "Failed to connect to MySQL: " . mysqli_connect_error();
	  exit();
  }
print "<br>Hello! You have successfully connected to MySQL.<br><br>";
mysqli_select_db( $db, $project ); 

//GET THE INPUT FROM THE WEB SERVER & ECHO TO BROWSER
$choice = getdata("choice"); //from html
$project_ID = getdata("project_ID"); 
$number = getdata("number"); 
$description = getdata("description");
$status = getdata("status");
$nprice = getdata("price");

//display information
if ($choice == "show"){
	show($project_ID, &$output); 
}

if ($choice == "add"){
	add($project_ID, $name, $description, $status, $price, &$output); 
}

if ($choice == "update"){
	update($project_ID, &$output); 
}

// CLOSE DATABASE CONNECTION AND TERMINATE
print "<br><br>Bye!<br>" ;
//mysqli_free_result($t);
mysqli_close($db);
exit ( "<br>Interaction completed.<br><br>"  ) ;

?>