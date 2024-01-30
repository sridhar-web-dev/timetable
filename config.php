<?php
	$host = "localhost";
    $username = "root";
    $password = "";
    $db_name = "school";

	$con = mysqli_connect($host,$username,$password,$db_name);

	if(!$con)
	{
		echo "Database Not Connected";
	}
?>