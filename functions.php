<?php

function show($project_ID, &$output) { //&$output is a 2-way variable
	echo "<br>";
	
	global $db;
	global $project_ID;
	//global $number;
	$output = "";

	$s   =  "select * from projects where project_ID = '$project_ID'";
	$output .= "<br>SQL statement is: $s<br>";  // .= appends message
	($t = mysqli_query( $db,  $s ) ) or die( mysqli_error($db) );
	$num = mysqli_num_rows($t);
	$output = "<br>There was $num rows retrieved.<br><br>";

	//return $number of projects -- orderby/limit
	$s   =  "select * from projects where project_ID = '$project_ID'";
	$output .= "<br>SQL statement is: $s<br>";  // .= appends message
	($t = mysqli_query( $db,  $s ) ) or die( mysqli_error($db) );
	$num = mysqli_num_rows($t);
	$output = "<br>There was $num row retrieved.<br><br>";
	
	while($r = mysqli_fetch_array($t,MYSQLI_ASSOC)){
		$name = $r["name"];
		$description = $r[ "description" ];
		$status = $r["status"];
		$date = $r[ "date" ];
		$price = $r[ "price" ];
		
		$output .= "Project Name: $name<br>";
		$output .= "Description: $description<br>";
		$output .= "Status: $status<br>";
		$output .= "Date and time: $date<br>";
		$output .= "Price: $price<br><br>";
	};
	echo $output; //display project information
	//return $output;
	echo "<br>";
}

function getdata($name){
	global $db;
	if (isset ($_GET [$name])){
		$temp = $_GET[$name];
		$temp = trim($temp);
		$temp = mysqli_real_escape_string($db, $temp);
		//echo "<br>$name: $temp<br>";
		return $temp;
	}
}

function add($project_ID, $name, $description, $status, $price, &$output){
	echo "<br>";
	//add project to database
	global $db;
	$output = "";
	
	if ($price <0){ //check if amount is positive value
		echo "Please input a positive value. <br>";
		return;
	}
		
	//insert project into projects table
	$s = "INSERT into projects VALUES ('$project_ID', '$name', '$description', '$status', NOW(), '$price')"; 
	echo "<br> SQL statement is: $s<br>";
	($t = mysqli_query( $db,  $s ) ) or die( mysqli_error($db) );
	
	//display in browser
	$x = "select * from projects where project_ID = '$project_ID'";
	($y = mysqli_query( $db,  $x ) ) or die( mysqli_error($db) );	
	while ( $q = mysqli_fetch_array($y,MYSQLI_ASSOC) ){
		$name = $q[ "name" ];
		$description = $q[ "description" ];
		$date = $q[ "date" ];
		$status = $q[ "status" ];
		$price = $q[ "price" ];
		
		$output .= "Project Name: $name<br>";
		$output .= "Description: $description<br>";
		$output .= "Date and time: $date<br>";
		$output .= "Status: $status<br>";
		$output .= "Price: $price<br>";
	};
	echo $output;
	
	echo "<br><br>";
}

function update($project_ID, $status, &$output){
	echo "<br>";
	global $db;
	$output = "";
		
	//update projects table
	$s = "update projects set status = '$status', date = NOW() where project_ID = '$project_ID'"; //set columnX = expr(columns, variables);
	echo "<br> SQL statement is: $s<br>";
	($t = mysqli_query( $db,  $s ) ) or die( mysqli_error($db) );

	//display in browser
	$x = "select * from projects where project_ID = '$project_ID'";
	($y = mysqli_query( $db,  $x ) ) or die( mysqli_error($db) );	
	while ( $q = mysqli_fetch_array($y,MYSQLI_ASSOC) ){
		$name = $q[ "name" ];
		$description = $q[ "description" ];
		$date = $q[ "date" ];
		$status = $q[ "status" ];
		$price = $q[ "price" ];
		
		$output .= "Project Name: $name<br>";
		$output .= "Description: $description<br>";
		$output .= "Date and time: $date<br>";
		$output .= "Status: $status<br>";
		$output .= "Price: $price<br>";
	};
	echo $output;
	
	echo "<br><br>";
}

?>