<?php

	$servername = "sql300.byethost7.com";
	$username = "b7_15612799";
	$password = "0hk2nsxg";
	$dbname = "b7_15612799_inforshop";

	/*$servername = "127.0.0.1";
	$username = "root";
	$password = "123456";
	$dbname = "inforshop";
	$port = "3306";*/

	$mysqli = new mysqli($servername, $username, $password, $dbname, $port);
	mysqli_set_charset($mysqli, "utf8");

	if(!$mysqli)
	{
		echo $mysqli->error;
	}

	if ($mysqli->connect_errno) 
	{
	    echo "Failed to connect to MySQL: (".$mysqli->connect_errno.") " . $mysqli->connect_error;
	}


?>