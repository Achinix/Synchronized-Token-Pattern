<?php
	session_start();
	
	session_destroy(); //destroy the session
	
	header("Location: login.php"); //redirect to login page

?>