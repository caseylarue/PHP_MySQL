<?php
	session_start();
	date_default_timezone_set("America/Los_Angeles");
	require('new_connection.php');

	$query_messages_comments = "SELECT 
		messages.message, messages.created_at as msg_date, messages.id as msg_id, 
		users.first_name, users.last_name, users.id as user_id, 
		comments.comment, comments.created_at as comment_date, comments.id as comment_id , comments.messages_id
		FROM messages 
		LEFT JOIN users ON messages.users_id = users.id 
		LEFT JOIN comments ON users.id = comments.users_id
		ORDER BY messages.id DESC";

		$messages = fetch_all($query_messages_comments);

		echo "<pre>";
		var_dump($messages);
		echo "</pre>";
?>