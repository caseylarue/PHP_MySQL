<?php
session_start();
date_default_timezone_set("America/Los_Angeles");

include('new_connection.php');



if( (isset($_POST['action'])) && $_POST['action'] == 'register')
{
	$errors = array();


	if(!isset($_POST['email']))
	{
		$errors['email'] = "you left out your email address";
	}
	elseif(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))
	{
		$errors['email'] = "your email address is bad";
	}
	else
	{
		$_SESSION['email'] = $_POST['email'];
		$email = $_POST['email'];
	}
	

	// check to see if name contains number
	if(empty($_POST['first_name']) )
	{
		$errors['first_name'] = "You have not entered you first name";
	}
	elseif(is_numeric($_POST['first_name']) )
	{
		$errors['first_name'] = "Your first name contains a number";
	}
	else
	{
		// $_SESSION['first_name'] = $_POST['first_name'];
		$first_name = $_POST['first_name'];
	}


	if(empty($_POST['last_name']) )
	{
		$errors['last_name'] = "You have not entered your first name";
	}
	elseif(is_numeric($_POST['last_name']) )
	{
		$errors['last_name'] = "Your first name contains a number";
	}
	else
	{
		// $_SESSION['last_name'] = $_POST['last_name'];
		$last_name = $_POST['last_name'];
	}


		// check to see if password is more than 6 characters
	if(empty($_POST['password']))
	{
		$errors['password'] = "You have not entered your password";	
	}
	elseif( strlen($_POST['password']) < 7)
	{
		$errors['password'] = "Your password must be at least 7 characters";
	}
	elseif($_POST['password'] != $_POST['confirm_password'])
	{
		$errors['password'] = "Your passwords do not match";
	}
	else
	{
		// $_SESSION['password'] = $_POST['password'];
		$password = $_POST['password'];
	}


	if(!isset($_POST['birth_date']))
	{
		$errors['password'] = "You have not input a birthday";
	}


	if($_FILES['profile_picture']['error'] > 0)
	{
		$errors['profile_picture'] = "You have not uploaded a picture";
	}



	if(count($errors) > 0) 
		{
			$_SESSION['errors']= $errors; 
			header('Location: registration.php');
			die();
		}
	else
		{
			$_SESSION['success'] = "Congrats you are awesome!";
			$date = date("m/d/y h:i:s");
			$new_person_query = "INSERT INTO users (first_name, last_name, email, created_at) VALUES ('$first_name', '$last_name', '$email', '$date')";
			run_mysql_query($new_person_query);
			header('Location: registration_success.php');
			die();
			// echo $new_person_query;  // to test the query
			// die();

			// $query = "SELECT * FROM users WHERE first_name = 'Larry'";
			// $person = fetch_record($query);
		}

}

?>