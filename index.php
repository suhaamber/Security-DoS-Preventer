<?php 
$servername = "localhost";
$username = "proj_user3";
$password = "user99";
$dbname = "proj_user";

$conn = new mysqli ($servername, $username, $password, $dbname);


if ($conn->connect_error)
  {
    die ("Connection failed: ".$conn->connect_error);
  }

$ipaddress = $_SERVER['REMOTE_ADDR']; 

$sql = "INSERT INTO visitors(ip_address) VALUES ('$ipaddress')"; 

if(!$conn->query($sql))
{
	echo "error detecting ip address".$conn->error; 
}


	$ipaddress = $_SERVER['REMOTE_ADDR'];
	$sql2 = "SELECT timestamp FROM visitors WHERE ip_address='$ipaddress' ORDER BY timestamp DESC LIMIT 5";
	if($result = $conn->query($sql2))
	{
		if(mysqli_num_rows($result)>0)
		{
			$count = 0;
			while($row = mysqli_fetch_row($result))		
			{
				$time =$row[0];
			       	$sql3 = "SELECT TIMESTAMPDIFF(MINUTE,'$time', CURRENT_TIMESTAMP())";
				if($timediff = $conn->query($sql3))
				{
					$timed1 = mysqli_fetch_row($timediff);
					$timed = $timed1[0];
					 	
					if($timed<'5')
					{
						$count = $count + 1;  
					}
				}
				else
				{
					echo $conn->error; 
				}
			}
			if($count>=5)
			{
				header('Location: noaccess.html');  
			}
		}
	}
	else
	{
		echo $conn->error; 
	}	

$conn->close(); 

?>
<html lang = "en" > 
	<head > 
		<meta charset = "utf-8" > <meta name = "viewport" content = "width=device-width, initial-scale=1, shrink-to-fit=no" > 
		<title > Securtiy DoS Preventer</title>  
	  	<link rel = "stylesheet" href = "https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity = "sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin = "anonymous" > 
		<link rel = "stylesheet" href = "index.css" type = "text/css" > 
	</head > 
	<body > 
		<div class = "sidenav" > 
			<div class = "login-main-text" > 
				<h2 class = "display-4" > Security DoS <br> Preventer </h2 > 
				<h3 > Login page </h3 > 
				<p > Login to access security details. </p >
				<p>Project by Suha Amber</p>
			</div > 
		</div > 
		<div class = "main" > 
			<div class = "col-lg-5 col-md-6 col-sm-12" > 
				<div class = "login-form" > 
					<form action = "index2.php" method = "POST" > 
						<div class = "form-group" > 
							<label > User Name </label > 
							<input type = "text" class = "form-control" placeholder = "User Name" name='username'> 
						</div > 
						<div class = "form-group" > 
						<label > Password </label > 
						<input type = "password" class = "form-control" placeholder = "Password" name='password'> 
						</div > 
						<button type = "submit" class = "btn btn-black" > Login </button> 
						<a href = "createPage.html" class = "btn btn-secondary" > Create new account </a>
					</form >
				</div >
			</div >
		</div >
	
  	<script src = "https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity = "sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"  crossorigin = "anonymous" ></script> 
  	<script src =   "https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity ="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin = "anonymous" ></script>
 	<script src =   "https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity = "sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin = "anonymous" > </script>
  	</body> 
</html>
