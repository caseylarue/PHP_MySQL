<?php
	include('new_connection.php');
	// $new_person_query = "INSERT INTO customer (first_name, last_name, created_at, updated_at) VALUES ('Casey', 'Jones', NOW(), NOW())";
	// echo $new_person_query;  // to test the query
	// die();
	// run_mysql_query($new_person_query);
	$query = "SELECT * FROM customer WHERE first_name = 'Joe'";
	$person = fetch_record($query);
?>

<html>
<head>
	<title></title>
</head>
<body>
	<?php
		// var_dump($person);
		echo "{$person['first_name']}";
	?>
</body>
</html>