<?php

	// this will avoid mysql_connect() deprecation error.
	//error_reporting( ~E_DEPRECATED & ~E_NOTICE );
	
	define('DBHOST', 'localhost');
	define('DBUSER', 'root');
	define('DBPASS', '12345678');
	define('DBNAME', 'projekt');
	
	$conn = new mysqli(DBHOST,DBUSER,DBPASS,DBNAME);
	
	if ( !$conn ) {
		die("Connection failed : " . mysqli_error());
	}
