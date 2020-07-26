<?php
session_start(); 
if(empty($_SESSION['username']))
{
header('Location: index.php');
}
?>

<html lang = "en" > 
	<head > 
	<meta charset = "utf-8" > 
	<meta name = "viewport" content = "width=device-width, initial-scale=1, shrink-to-fit=no" > 
	<title > Home Page </title > 
	<link rel = "stylesheet" href = "https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity = "sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin = "anonymous" > 
	<link rel = "stylesheet" href = "cssstyle.css" type = "text/css" >
	
	<link href=".https://getbootstrap.com/docs/4.0/dist/css/bootstrap.min.css" rel="stylesheet">
	</head > 
	<body > 
		<nav class = "navbar navbar-dark bg-dark sticky-top" > 
			<span class = "navbar-brand mb-0 h1" > Security DoS Preventer </span > 
			<a href = "logout.php" class = "btn btn-light my-2 my-sm-0" > Log out </a > 
		</nav > 
 <div class="container-fluid">
    <div class="row">
        <nav class="col-md-2 d-none d-md-block bg-light sidebar">
          <div class="sidebar-sticky">
            <ul class="nav flex-column">
              <li class="nav-item">
                <a class="nav-link" href="homePage.php">
                  Homepage 
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link active" href="#">
                  Search Visitors <span class="sr-only">(current)</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="login_details.php">
                  Search Login Details
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="logins_page.php">
                  Search Logins
                </a>
              </li>
            </ul>
          </div>
        </nav>
			 <div class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
			<p> Details of last 10 visitors to the website: </p>
			<?php include 'phpcode2.php' ?>
	</div>	

</div>
</div> 
	</body > 
</html >
