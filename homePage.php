<?php
session_start(); 
if(empty($_SESSION['username']))
{
	header('Location: ../index.php');
}
?>

<html lang = "en" > 
	<head > 
	<meta charset = "utf-8" > 
	<meta name = "viewport" content = "width=device-width, initial-scale=1, shrink-to-fit=no" > 
	<title > Home Page </title > 
	<link rel = "stylesheet" href = "https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity = "sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin = "anonymous" > 
	<link rel = "stylesheet" href = "index.css" type = "text/css" > 
	</head > 
	<body > 
		<nav class = "navbar navbar-light bg-light" > 
			<span class = "navbar-brand mb-0 h1" > Security DoS Preventer </span > 
			<a href = "logout.php" class = "btn btn-outline-secondary my-2 my-sm-0" > Log out </a > 
		</nav > 
		<div class = "container-fluid" > 
			<p > Details of the last five logins into the system:</p>

			<?php include 'phpcode.php';?>

			<p> Details of last 10 visitors to the website </p>

			<?php include 'phpcode2.php';?>
		</div > 
	</body > 
</html >
