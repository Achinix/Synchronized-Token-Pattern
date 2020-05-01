<?php

   session_start();   
   //check whether request is set or not
   if (isset($_POST['csrf_request']))
	{
		//check whether the passed session is same as the request
		if ($_POST['csrf_request'] == $_SESSION["username"])
		{
   			echo $_SESSION['csrf_token'];

   		} 
   		else	
   		{
   			echo "null";
   		}

   	}  

?>