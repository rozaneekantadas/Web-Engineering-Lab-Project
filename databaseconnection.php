<?php

$serverName = "localhost";
$userName = "root";
$password = "";
$databaseName = "webproject01";

$conn = mysqli_connect($serverName, $userName, $password, $databaseName);

if ($conn) {
	//connect
}
else{
	echo "Failed. Error: ".mysqli_connect_error();
}

?>