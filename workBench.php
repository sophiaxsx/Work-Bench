<?php

error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);  
ini_set('display_errors' , 1);
include ("functions.php") ;
include ( "account.php") ;
$db = mysqli_connect($hostname, $username, $password ,$project);

connect(); 

//GET THE INPUT FROM THE WEB SERVER & ECHO TO BROWSER
$choice = getdata("choice"); //from html
$project_ID = getdata("project_ID"); 
$name = getdata("name"); 
$description = getdata("description");
$status = getdata("status");
$price = getdata("price");

//display information
if ($choice == "show"){
	echo "<br>";	
	global $db;
	global $project_ID;
	$output = " ";

	$s   =  "select * from projects where project_ID = 'project_ID'";
	($t = mysqli_query( $db,  $s ) ) or die( mysqli_error($db) );
	$num = mysqli_num_rows($t);
	$output = "<br>There were $num projects retrieved.<br><br>";
	
	while($r = mysqli_fetch_array($t,MYSQLI_ASSOC)){
		$project_ID = $r["project_ID"];
		$name = $r[ "name" ];
		$description = $r["description"];
		$status = $r[ "status" ];
		$date = $r[ "date" ];
		$price = $r[ "price" ];

		$output .= "Project Name: $name<br>";
		$output .= "Description: $description<br>";
		$output .= "Status: $status<br>";
		$output .= "Date and time: $date<br>";
		$output .= "Price: $price<br><br>";
	};
	echo $output; //display project information
	echo "<br>"; 
	return $output; 
}

if ($choice == "add"){
	echo "<br>";
	//add project to database
	global $db;
	$output = "";
	
	//insert project into projects table
	$s = "INSERT into projects VALUES ('$project_ID', '$name', '$description', '$status', NOW(), '$price')"; 
	($t = mysqli_query( $db,  $s ) ) or die( mysqli_error($db) );
	
	//display in browser
	$x = "select * from projects where project_ID = '$project_ID'";
	($y = mysqli_query( $db,  $x ) ) or die( mysqli_error($db) );	
	while ( $r = mysqli_fetch_array($y,MYSQLI_ASSOC) ){
		$project_ID = $r["project_ID"];
		$name = $r[ "name" ];
		$description = $r["description"];
		$status = $r[ "status" ];
		$date = $r[ "date" ];
		$price = $r[ "price" ];

		$output .= "Project Name: $name<br>";
		$output .= "Description: $description<br>";
		$output .= "Status: $status<br>";
		$output .= "Date and time: $date<br>";
		$output .= "Price: $price<br><br>";
	};
	echo $output;
	echo "<br><br>";
	return $output;
}

// CLOSE DATABASE CONNECTION AND TERMINATE
print "<br><br>Bye!<br>" ;
//mysqli_free_result($t);
mysqli_close($db);
exit ( "<br>Interaction completed.<br><br>"  ) ;

?>
