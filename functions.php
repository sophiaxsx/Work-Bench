<?php

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

function connect (){
	global $db;
	global $project;
	if (mysqli_connect_errno())
	  {
		  echo "Failed to connect to MySQL: " . mysqli_connect_error();
		  exit();
	  }
	//print "<br>Successfully connected to MySQL with connect Function.<br>";
	mysqli_select_db( $db, $project );
}

?>
