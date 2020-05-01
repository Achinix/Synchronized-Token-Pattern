<?php
	session_start(); //start the session
    require_once 'token.php';
	
	setcookie("username", "admin", time() + 3600);
	
	//check form validations
    if(isset($_POST['username'])) {
        $uname = $_POST['username'];
    }

    if(isset($_POST['password'])) {
        $pass = $_POST['password'];
    }

    if(isset($_POST['submit'])){
        if($uname == "admin"){
            if($pass == "admin"){

            	//set the session
                $_SESSION['username'] = $_POST['username'] .$_POST['password'];

                //set the expire session
				$_SESSION['expire'] = time() + 60 ;
				
				header('Location: pay_bill.php');
				
				//generate the token and assigning to avariable
				 $csrf_token = generate_token();
				 
				 //set the cookie
				 setcookie("token",$csrf_token);
			}
			else
			{
				echo "<script>alert('Invalid Credentials!');</script>";
			}
		}
	}
?>

<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="stylesheet.css"> 
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
</head>

<body>

	<h1>User Login</h1>
	<form name="logingForm"  method="POST">
	<div style="background-color:black;text-align:center; opacity:0.9;height:300px; padding:50px; border-radius:10px;">
		
		<label for="username"> Username </label><br>
		<input type = "text" name="username" value="" id="username"> <br/> <br/>
		
		<label for="password"> Password </label> <br/>
		<input type="password" name="password" value="" id="password"> <br/> <br/>
		
		<button type="submit" name="submit">Submit</button>
	</div>
	</form>
	
<div class="footer" style="text-align:center;opacity:0.9;margin-top:100px">
		<p>Username = admin & Password = admin<br/></p>

</div>

<div class="footer" style="text-align:left;background-color: black;opacity:0.9; margin-top:1px">
	<p style="text-align:center;">Web Security Project 01 - IT18201642</p>
</div>


</body>

</html>