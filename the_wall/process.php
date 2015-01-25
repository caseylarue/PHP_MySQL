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

	///--------Register user begin validation checks

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
			$query = "INSERT INTO users (first_name, last_name, password, email, created_at, updated_at)
						VALUES ('{$post['first_name']}', '{$post['last_name']}', '{$post['password']}', '{$post['email']}', NOW(), NOW())";

			run_mysql_query($query);
			$_SESSION['success_message'] = 'User successfully created!';
			header('location: index.php');
			die();	
		}

	}

	///--------login user begin validation checks

	function login_user($post_login)
	{
	
		// validation checks to see if email and pw is legit
		

		// compare the email entered to the db 

		// if there is an email match, query the db to be sure that the password is a match

		$query_login = "SELECT * FROM users WHERE email = '{$post_login['email']}' ";
		$person = fetch_record($query_login);

		$password = $person['password'];
		// echo $_POST['password'];

		if( $password == $post_login['password'])
		{
			$_SESSION['first_name'] = $person['first_name'];
			$_SESSION['last_name'] = $person['last_name'];
			header('location: wall.php');
			die();
		}
		else
		{
			header('location: index.php');
			die();
		}
		

	}
?>