<?php
	
	$hostname 	= "localhost";//"sql208.epizy.com";	
	$username 	= "root";
	$password 	= "";//"rJcDDdl0ksW3N";
	$dbname 	= "vikram_personal_website";//"epiz_24558617_lipsdb";

	$con = new mysqli($hostname,$username,$password,$dbname);

	if ($con -> connect_errno) {
		echo "Failed to connect to MySQL: " . $con -> connect_error;
		exit();
	} 
?>