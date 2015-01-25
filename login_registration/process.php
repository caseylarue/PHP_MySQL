<?php
	session_start();
	date_default_timezone_set("America/Los_Angeles");
	require('new_connection.php');

	if(isset($_POST['action']) && $_POST['action'] == 'register')
	{
		//call to function
		register_user($_POST);  //parameter

	}

	if(isset($_POST['action']) && $_POST['action'] == 'login')
	{
		login_user($_POST);	
	}
	else  //malicous attempt, navigation to process.php or someone is trying to log off
	{
		session_destroy();
		header('location: index.php');
		die();
	}


	/////////////////////////////////////////////////

	function register_user($post)  //parameter
	{
	///--------------------------begin validation checks
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

		if(empty($post['password']))
		{
			$_SESSION['errors'][] = "password field is required";
		}

		///--------------------------end of validation checks

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

	function login_user($post)
	{
		$query = "SELECT * FROM users WHERE users.password = '{$post['password']}' 
					AND users.email = '{$post['email']}'";
		// echo $query;
		// die();

		$user = fetch_all($query); // go and attempt to grab user with the above credentialss
		if(count($user) > 0)
		{
			$_SESSION['user_id'] = $user[0]['id'];
			$_SESSION['first_name'] = $user[0]['first_name'];
			$_SESSION['logged_in'] = TRUE;
			header('location: success.php');
			die();
		}	
		else
		{
			$_SESSION['errors'][] = "cannot find a user with those credentials";
			header('location: index.php');
			die();
		}
	}
	
?>
