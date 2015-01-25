<?php
	session_start();
	date_default_timezone_set("America/Los_Angeles");
	require('new_connection.php');
?>


<html>
<head>
	<title>Welcome to the Wall</title>
	<style type="text/css">
		#container {
			margin: 0px auto;
			width: 970px;
			height: 600px;
			background-color: #EEE8AA;
			padding-left: 50px;
			padding-top: 30px;
		}
		h1, h2, h3, h4 {
			text-align: center;
		}
		form {
			margin-left: 400px;
		}
		form input  {
			margin: 5px;
		}
	</style>
</head>
<body>
<?php
	if(isset($_SESSION['errors']))
	{
		foreach ($_SESSION['errors'] as $error)
		{
			echo "<p class='error'>{$error} </p>";
		}
		unset($_SESSION['errors']);
	}

	if(isset($_SESSION['success_message']))
	{
		echo "<p class='success'> {$_SESSION['success_message']} </p>";
		unset($_SESSION['success_message']);
	}
?>
	<div id="container">
		<h1>Welcome to the Wall</h1>
		<h2>A Coding Dojo Message Board</h2>
		<h3>Please login below to continue</h3>
		<h2>Register</h2>
		<form action='process.php' method='post'>
			<input type='hidden' name='action' value='register'>
			First Name: <input type='text' name='first_name'><br>
			Last Name: <input type='text' name='last_name'><br>
			Email: <input type='text' name='email'><br>
			Password: <input type='password' name='password'><br>
			Confirm Password: <input type='password' name='confirm_password'><br>
			<input type='submit' value='register'>
		</form>
		<h2>Login</h2>
		<form action='process.php' method='post'>
			<input type='hidden' name='action' value='login'>
			Email: <input type='text'name='email'><br>
			Password: <input type='password'name='password'><br>
			<input type='submit' value='register'>
		</form>
	</div>	
</body>
</html>