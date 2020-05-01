<?php

    //implemention of generating token
    function generate_token()
	{
       return $_SESSION['csrf_token'] = base64_encode(openssl_random_pseudo_bytes(32));

    }
    //implementation of validattion of the token
	function check($token)
	{
		if(isset($_SESSION['csrf_token']) && $token === $_SESSION['csrf_token'])
		{
            unset($_SESSION['csrf_token']);    
            return true;
        }
    
        else
		{

            return false;
        }

	}

?>