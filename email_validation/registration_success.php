<?php

	session_start();

	if(isset($_SESSION['success'])) 
	{
		echo "you have successfully registered";
		// unset($_SESSION['success']);
	}
	else
	{
		header('location: registration.php');
		die();
	}


?>

<html>
<head>
	<title>Registration Success</title>
	<style type="text/css">
		#email {
			border: 1px solid black;
			background-color: green;
			width: 300px;
			height: 100px;
		}
	</style>
</head>
<body>
	<div id="email">
		<p>The email address you entered <?= $_SESSION['email'] ?> is a valid email address. </p>
	</div>
	<div id="email_log">
		<p> <?= $_SESSION['email'] ?> </p>
	</div>
</body>
</html>