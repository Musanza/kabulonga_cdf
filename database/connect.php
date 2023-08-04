<?php

$db_host = "localhost";
$db_name = "kabulonga_cdf_db";
$db_user = "root";
$db_pass = "";
$u_name ="";
$u_email ="";
$u_phone ="";
$mysqli = new mysqli ($db_host, $db_user, $db_pass, $db_name);

if ($mysqli->connect_error) {
	printf("Connection failed: %s\n", $mysqli->connect_error);
	exit();
}
?>