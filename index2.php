<?php 

$include 'dbinfo.php';

if ($_SERVER["REQUEST_METHOD"] == "POST")
  {

    $myusername = $conn -> real_escape_string($_POST['username']);
    $mypassword = $conn -> real_escape_string($_POST['password']);
     
    $sql = "SELECT username, password FROM login_details WHERE username = '$myusername' AND password = '$mypassword'";
    if($result = $conn -> query($sql))
    {    
	   
	    if(mysqli_num_rows($result)==1)
		{
		 
				 $ipaddress = $_SERVER['REMOTE_ADDR']; 
				 $sql2 = "INSERT INTO logins(username, ip_address) VALUES ('$myusername', '$ipaddress')";
				 if($conn->query($sql2))
				{
					session_start(); 
					$_SESSION['username'] = $myusername; 
					header('Location: homePage.php');
				 }
			
			else 
			{
				echo "There has been an error logging you in"; 
			}
		}

    }
    else 
    {
	    echo "wrong username or password"; 
	  }
    }
  
?>
