<?php 

$servername = "localhost";
$username = "proj_user3";
$password = "user99";
$dbname = "proj_user";

// Create connection
 $conn = new mysqli($servername, $username, $password, $dbname);

 // Check connection
 if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
  }

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
