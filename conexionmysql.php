<?php

	DEFINE('DB_USERNAME', 'root');
	DEFINE('DB_PASSWORD', 'Mjhs93');
	DEFINE('DB_HOST', 'localhost');
	DEFINE('DB_NAME', 'Asignacionuno');

	$conn = @mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME)
	OR die('Could not connect to Database' . mysqli_connect_error());

?>