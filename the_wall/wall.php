<?php
	session_start();
	date_default_timezone_set("America/Los_Angeles");
	require('new_connection.php');
?>

<html>
<head>
	<title>The Wall</title>
	<style type="text/css">
		#container {
			height: 1200px;
			width: 970px;
			background-color: #AFEEEE;
			margin: 0px auto;
		}

		h1 {
			margin-left: 30px;
		}
		#nav {
			border: 1px solid black;
			width: 970px;
			height: 80px;
		}

		div#nav h3, h4, a {
			display: inline-block;
			vertical-align: top;
		}

		div#nav h3 {
			margin-left: 30px;
		}

		div#nav h4 {
			margin-left: 200px;
		}

		div#nav a {
			margin-left: 200px;
			margin-top: 20px;
		}

		#post, .comment_post {
			margin-top: 40px;
			margin-left: 100px;
		}

		.message{
			border: 1px ridge gray;
			width: 750px;
			height: 130px;
			margin: 20px 0px 20px 120px;
		}

		.message p {
			font-size: 12px;
			padding-left: 10px;
		}

		.comment {
			border: 1px ridge gray;
			width: 750px;
			height: 130px;
			margin: 20px 0px 20px 120px;
			background-color: #FDF5E6;
			font-size: 12px;
		}

		.comment h4 {
			margin: 5px;
			font-size: 20px;
		}

		.comment p {
			font-size: 12px;
			padding-left: 10px;
		}

	</style>
</head>
<body>
	<div id="container">
		<div id="nav">
			<h3>Coding Dojo Wall</h3>
			<h4>Welcome, <?= $_SESSION['first_name'] ?></h4>
			<a href="#">Log off</a>
		</div>
		<h1>Type your message here..</h1>
		<form id='post' action='process.php'  method='post'>
			<input type='hidden' name='action' value='msg_post'>
			<textarea rows="10" cols="100" name='message'></textarea>
			<input type='submit' value='post a message'>
		</form>
		
		<!-- Pull from the db....messages -->
<?php
		$query_messages = "SELECT messages.message, messages.created_at, messages.id as msg_id, users.first_name, users.last_name, users.id FROM messages LEFT JOIN users ON messages.users_id = users.id ORDER BY messages.created_at DESC";
		$messages = fetch_all($query_messages);
// need to get the name from the users table as well
		foreach ($messages as $message)
		{	
			// $msg_id = $message['msg_id'];
			$_SESSION['msg_id'] = $message['msg_id'];
			$msg_id = $_SESSION['msg_id'];

			$first_name = $message['first_name'];
			$last_name = $message['last_name'];
			$created_at = $message['created_at'];
			$message = $message['message'];


			echo "<h3> $first_name  $created_at </h3>";
			echo "<h3> $message </h3>";
			echo $_SESSION['msg_id'] ;
?>

			<form class='comment_post' action='process.php'  method='post'>
			<input type='hidden' name='action' value='comment_post'>
			<textarea rows='10'  cols='100' name='comment'> </textarea>
			<input type='submit' value='Post a Comment'>
			</form>
<?php
		}
?>


	</div>
</body>
</html>

	