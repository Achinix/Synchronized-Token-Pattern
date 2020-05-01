<?php
	session_start();
    require_once 'token.php';
	
	//check for loging status
	if(!($_SESSION['username']))
	{
		echo "<script>alert('Session does not created. Try Again');</script>";
		header('Location: login.php'); //redirect to login page
		exit();
	}
	else {
		//check current time.
		$now = time();

		//check curent time with the session duration
		if($now > $_SESSION['expire'])
		{
			session_destroy(); //destroy the session
			echo "<script>alert('Your session has expired!');</script>";
		}
		else
		{	
            echo "<script>alert('Login success');</script>";
		}
	}

	//check form validations
	if(isset($_POST['csrf_token']) && isset($_POST['useraccount']) && isset($_POST['phonenum']) && isset($_POST['account']) && isset($_POST['billamount']))
	{

	  $token = $_POST['csrf_token']; //assign variable for the token
			
	  //call check funtion
	  if(check($token))
	  {
		  echo "<script>alert('Paid the Bill Successfully');</script>";
	  }
	
	  else if(!check($token))
	  {
			echo "<script>alert('Invalid authentication');</script>";
	  }
	}


?>

<!DOCTYPE>
<html>
<head>
	<link rel="stylesheet" href= "//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" id="bootstrap-css">
	<link rel="stylesheet" type="text/css" href="stylesheet.css"> 
	<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
	<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
	
</head>

<body>
		<div class="header">
			<h2><a href="signout.php">Sign out</a></h2>
		</div>
	
	<h1>Pay Your Bill</h1>
	<form name="billForm" action="pay_bill.php" method="POST">
	<div class="column middle" style="background-color:black;text-align:center;opacity:0.9;height:600px; padding:50px">
		
		<label for="useraccount">User Account</label> <br/>
		<input type = "text" name="useraccount" value="" id="useraccount"> <br/> <br/>
		
		<label for="payee">Payee</label> <br/>
		<select name="payee">
			<option value="payee1">Mobitel</option>
			<option value="payee2">Dialog</option>
			<option value="payee3">Airtel</option>
			<option value="payee4">Hutch</option>
		</select>
		<br/> <br/>
		
		<label for="phonenum">Mobile Phone Number</label> <br/>
		<input type = "text" name="phonenum" value="" id="phonenum" required> <br/> <br/>
		
		<label for="account">From Account</label> <br/>
		<input type = "text" name="account" value="" id="account"> <br/> <br/>
		
		<label for="billamount">Bill Amount</label> <br/>
		<input type = "number" name="billamount" value="" id="billamount" placeholder="00.00" required> <br/> <br/>
		
		<!--pass token with the hidden field value--->
		<input type="hidden" id="csrf_token" name="csrf_token" value="">
		
		<button type="submit" name="submit">Pay now</button>

	</div>
	</form>
	

<div class="footer" style="text-align:left;background-color: black;opacity:0.9; margin-top:1px">
	<p style="text-align:center;">Web Security Project 01 - IT18201642</p>
</div>
	
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js">
</script>

<!--ajax call-->
<script>
	$(document).ready(function () {

          $.ajax({
              url: 'csrf_token.php',
              type: 'post',
              async: false,

              data: {

                  //pass login session to validate request with the server
                  'csrf_request': '<?php echo $_SESSION["username"] ?>'  
              },

              success: function (data) {
                    //set returned token to hidden field value
                  document.getElementById("csrf_token").value = data;

						$("#csrf_token").text(data);
              },

              error: function (xhr, ajaxOptions, thrownError) {
                  console.log("Error on Ajax call :: " + xhr.responseText);

              }

          });

      });

   </script>
 
</html>
