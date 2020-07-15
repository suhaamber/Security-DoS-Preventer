<?php 

$servername = "localhost";
$username = "proj_user3";
$password = "user99";
$dbname = "proj_user";

$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error)
  {
    die ("Connection failed: ".$conn->connect_error);
  }
echo "successfully connected";
if ($_SERVER["REQUEST_METHOD"] == "POST")
  {

    $myusername = $conn -> real_escape_string($_POST['username']);
    $mypassword = $conn -> real_escape_string($_POST['password']);
     
    $sql = "SELECT username, password FROM login_details WHERE username = '$myusername'";
    $result = $conn -> query($sql);
    if(mysqli_num_rows>0)
    {
	    while($row = mysqli_fetch_array($result))
	    {
		    if(password_verify($password, $row["password"]))
			{
				 $ipaddress = $_SERVER['REMOTE_ADDR']; 
				 $sql2 = "INSERT INTO logins(username, ip_address) VALUES ('$myusername', '$ipaddress')";
				 if($conn->query($sql2))
				{
					session_start(); 
					$_SESSION['username'] = $myusername; 
					header('Location: homePage.php');
				 }
			}
			else 
			{
				echo "There has been an error logging you in"; 
			}
 	    }
    }
    else
      {
	echo "Your Login Name or Password is invalid";
      }
  }
?>
