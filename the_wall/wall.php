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

		.msg_post {
			border: 1px solid gray;
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


		.comment_post textarea {
			background-color: #FFF8DC;
		}		

	</style>
</head>
<body>
	<div id="container">
		<div id="nav">
			<h3>Coding Dojo Wall</h3>
			<h4>Welcome, <?= $_SESSION['first_name'] ?></h4>
			<a href="index.php">
<?php
			session_destroy();
?>
			Log off</a>
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
			$_SESSION['msg_id'] = $message['msg_id'];
			$msg_id = intval($message['msg_id']);

			$first_name = $message['first_name'];
			$last_name = $message['last_name'];
			$created_at = $message['created_at'];
			$message = $message['message'];
?>
			<div class='msg_post'>
				<p>Message by:<?= "$first_name" .' '. "$last_name".' '."$created_at" ?></p>
				<p><?= "$message" ?></p>
				<p><?= $_SESSION['msg_id'] ?></p>
			</div>	

			<form class='comment_post' action='process.php'  method='post'>
			<input type='hidden' name='action' value='comment_post'>
			<input type='hidden' name='msg_id' value='<?= $_SESSION['msg_id'] ?> '>
			<textarea rows='5'  cols='100' name='comment' name=> </textarea>
			<input type='submit' value='Post a Comment'>
			</form>
<?php
			
			$query_comments = "SELECT comments.comment, comments.created_at as comment_date, users.first_name, users.last_name, comments.messages_id
			FROM comments
			JOIN users ON users.id = comments.users_id
			ORDER BY comments.created_at DESC";
			$comments = fetch_all($query_comments);

			foreach($comments as $comment)

			{
				if(intval($comment['messages_id']) == $msg_id)
				{
					echo "hey we got a match!";
				}

			}

			
				// echo "<pre>";
				// var_dump($comment);
				// echo "</pre>";

			

			// echo "<pre>";
			// var_dump($comments);
			// echo "</pre>";

			// echo "<p> Comment:  </p>";
			// echo "<p> {$comments['first_name']} {$comments['last_name']} {$comments['comment_date']}</p>";
			// echo "<p> {$comments['comment']} </p>";
		}
?>

	</div>
</body>
</html>

	