<?php

	session_start();
	
	if (isset($_SESSION['user'])) {
        session_unset();
        header("Location: signin.php");
        exit;
	} else if(isset($_SESSION['user'])!="") {
        header("Location: signin.php");
	}
	
	