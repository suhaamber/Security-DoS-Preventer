<?php 

include 'dbinfo.php';

$username = mysqli_real_escape_string($conn, $_POST["username"]);  
$password = mysqli_real_escape_string($conn, $_POST["password"]);
$fname = mysqli_real_escape_string($conn, $_POST["fname"]); 
$email_id = mysqli_real_escape_string($conn, $_POST["email_id"]); 

$sql = "INSERT INTO login_details VALUES ('$username','$password','$fname', '$email_id')"; 

if (!$conn->query($sql))
{    
	die('Error: ' . $conn->error);
}

 
$conn->close(); 
header("Location: index.php");
die();

?>
