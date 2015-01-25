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
		$query_messages = "SELECT * FROM messages ORDER BY created_at DESC";
		$messages = fetch_all($query_messages);
// need to get the name from the users table as well
		foreach ($messages as $message)
		{
			echo "<h3> {$message['message']} </h3>";
		}
		// die();
?>

		<div class="message">
			<h5>MICHAEL CHOI - January 23, 2013</h5>
			<p>Lorem ipsum dolor sit amet, no possit alterum platonem nam. Vix ne facer putent timeam, et debet probatus eos. Vim eu civibus lobortis concludaturque, ad eam similique consequuntur, an mel eirmod intellegat. Fuisset albucius aliquando an nam. Ius falli eirmod te, quod elitr expetenda ei cum. Usu ut porro novum. Ne mei quidam doctus reformidans, viris possim abhorreant te vel.</p>
		</div>
		<div class="comment">
			<h4>Comment</h4>
			<h3>BILL CLINTON - January 23, 2013</h5>
			<p>Lorem ipsum dolor sit amet, no possit alterum platonem nam. Vix ne facer putent timeam, et debet probatus eos. Vim eu civibus lobortis concludaturque, ad eam similique consequuntur, an mel eirmod intellegat. Fuisset albucius aliquando an nam. Ius falli eirmod te, quod elitr expetenda ei cum. Usu ut porro novum. Ne mei quidam doctus reformidans, viris possim abhorreant te vel.</p>
		</div>	
		<form class='comment_post' action='process.php'  method='post'>
			<input type='hidden' name='action' value='comment_post'>
			<textarea rows="10" cols="100"></textarea>
			<input type='submit' value='Post a Comment'>
		</form>
		<div class="message">
			<h5>GEORGE FORMAN- January 21, 2013</h5>
			<p>Lorem ipsum dolor sit amet, no possit alterum platonem nam. Vix ne facer putent timeam, et debet probatus eos. Vim eu civibus lobortis concludaturque, ad eam similique consequuntur, an mel eirmod intellegat. Fuisset albucius aliquando an nam. Ius falli eirmod te, quod elitr expetenda ei cum. Usu ut porro novum. Ne mei quidam doctus reformidans, viris possim abhorreant te vel.</p>
		</div>
		<form class='comment_post' action='process.php'  method='post'>
			<input type='hidden' name='action' value='comment_post'>
			<textarea rows="10" cols="100"></textarea>
			<input type='submit' value='Post a Comment'>
		</form>
	</div>
</body>
</html>

	