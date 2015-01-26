<?php
	session_start();
	date_default_timezone_set("America/Los_Angeles");
	require('new_connection.php');

	if( isset($_POST['action']) && $_POST['action'] == 'register')
	{
		register_user($_POST);
	}

	if( isset($_POST['action']) && $_POST['action'] == 'login')
	{
		login_user($_POST);
	}

	if ( isset($_POST['action']) && $_POST['action'] == 'log_out')
	 {
		session_destroy();
		header('location: index.php');
		die();
	}

///------------------------------------------------------
///--------Register user begin validation checks
///------------------------------------------------------

	function register_user($post)
	{
		$_SESSION['errors'] = array();



		if(empty($post['first_name']))
		{
			$_SESSION['errors'][] = "first name cannot be blank";

		}

		if(empty($post['last_name']))
		{
			$_SESSION['errors'][] = "last name cannot be blank";
		}

		if(!filter_var($post['email'], FILTER_VALIDATE_EMAIL))
		{
			$_SESSION['errors'][] = "please validate email address";

		}

		if($post['password'] !== $post['confirm_password']) 
		{
			$_SESSION['errors'][] = "passwords must match";
		}

		if(count($_SESSION['errors']) > 0)
		{
			header('location: index.php');
			die();
		}
		else
		{
			// attempt to get secure login
			// function insert_new_user($first_name, $last_name, $email, $password)
			// {
			// 	$date = date("Y-m-d H:i:s");
			// 	$esc_first_name = escape_this_string($first_name);
			// 	$esc_last_name = escape_this_string($last_name);
			// 	$esc_email = escape_this_string($email);
			// 	$esc_password = escape_this_string($password);			
			// 	$query = "INSERT INTO users (first_name, last_name, email, password, created_at, updated_at)
			// 			VALUES ('{$esc_first_name}', '{$esc_last_name}', '{$esc_email}', '{$esc_password}', '$date', '$date')";
			// 	echo $query;
			// 	run_mysql_query($query);
			// }
			// insert_new_user($post['first_name'], $post['last_name'], $post['email'], $post['password']);


			$query = "INSERT INTO users (first_name, last_name, password, email, created_at, updated_at)
						VALUES ('{$post['first_name']}', '{$post['last_name']}', '{$post['password']}', '{$post['email']}', NOW(), NOW())";

			run_mysql_query($query);
			$query_registration = "SELECT * FROM users WHERE email = '{$post['email']}' ";
			$person = fetch_record($query_registration);
			$_SESSION['first_name'] = $person['first_name'];
			$_SESSION['last_name'] = $person['last_name'];
			$_SESSION['id'] = $person['id'];
			header('location: wall.php');
			die();
		}

	}

///------------------------------------------------------
///--------login user begin validation checks
///------------------------------------------------------

	function login_user($post_login)
	{
	
		$_SESSION['errors'] = array();

		if(empty($post_login['email']))
		{
			$_SESSION['errors'][] = "you left your email blank";
		}

		if(empty($post_login['password']))
		{
			$_SESSION['errors'][] = "you left your password blank";
		}

		if(!filter_var($post_login['email'], FILTER_VALIDATE_EMAIL))
		{
			$_SESSION['errors'][] = "please validate email address";
		}

		if(count($_SESSION['errors']) > 0)
		{
			header('location: index.php');
			die();
		}
		else
		{
			$query_login = "SELECT * FROM users WHERE email = '{$post_login['email']}' ";
			$person = fetch_record($query_login);

			$password = $person['password'];

			if( $password == $post_login['password'])
			{
				$_SESSION['first_name'] = $person['first_name'];
				$_SESSION['last_name'] = $person['last_name'];
				$_SESSION['id'] = $person['id'];
				header('location: wall.php');
				die();
			}
			else
			{
				$_SESSION['errors'][] = "sorry this is an invalid email or password";
				header('location: index.php');
				die();
			}	
		}
	}

///------------------------------------------------------
///--------Handle a Messages posted by users
///------------------------------------------------------	

	if( isset($_POST['action']) && $_POST['action'] == 'msg_post')
	{	
		$message = $_POST['message'];
		$id = $_SESSION['id'];
		$new_person_query = "INSERT INTO messages (users_id, message, created_at, updated_at) VALUES ('$id', '$message', NOW(), NOW())";
		run_mysql_query($new_person_query); 
		header('location: wall.php');
		die();
	}

///------------------------------------------------------
///--------Handle a posts by users
///------------------------------------------------------	


	if( isset($_POST['action']) && $_POST['action'] == 'comment_post')
	{			
		$id = $_SESSION['id'];  
		$msg_id = $_POST['msg_id'];
		$comment = $_POST['comment'];  
		$new_comment_query = "INSERT INTO comments (users_id, messages_id, comment, created_at, updated_at) VALUES ('$id', '$msg_id', '$comment', NOW(), NOW())";
		run_mysql_query($new_comment_query); 
		header('location: wall.php');
		die();
	}

///------------------------------------------------------
///--------Delete message by users
///------------------------------------------------------	

	if( isset($_POST['action']) && $_POST['action'] == 'delete_msg')
	{		
	    $msg_id = $_POST['msg_id'];
		$del_msg_query = "DELETE FROM `the_wall`.`messages` WHERE `id`='$msg_id'";
		echo $del_msg_query;
		// run_mysql_query($del_msg_query); 
		// header('location: wall.php');
		// die();
	}


?>