<?php

	session_start();
	date_default_timezone_set("America/Los_Angeles");
	include('new_connection.php');

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

	$query = "SELECT * FROM users";
	$users = fetch_all($query);

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
<?php
		foreach ($users as $user)
		{
			echo "<h3> {$user['first_name']} {$user['created_at']} </h3>";
		}
?>

</body>
</html>