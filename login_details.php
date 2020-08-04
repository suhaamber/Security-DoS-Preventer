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
			<span class = "navbar-brand mb-0 h1" > Login Details </span > 
			<a href = "logout.php" class = "btn btn-light my-2 my-sm-0" > Log out </a > 
		</nav> 
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
                  <a class="nav-link" href="visitor_page.php">
                    Search Visitors 
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link active" href="#">
                    Search Login Details <span class="sr-only">(current)</span>
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="logins_page.php">
                    Search Logins 
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="failed_logins.php">
                    Search Failed Logins 
                  </a>
                </li>
              </ul>
            </div>
          </nav>
    		  <div class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
            <form action="#" method="POST">
              <div class="form-inline">
                <label for="users">Show login details for: </label>
                <select id="users" class="form-control mx-2" name="users">
                    <?php 
                    include 'dbinfo.php';

                    $sql = "SELECT username from login_details"; 

                    if($result=$conn->query($sql))
                    {
                        while($row=mysqli_fetch_array($result))
                        {
                            echo '<option value='.$row['username'].'>'.$row['username'].'</option>';
                        }
                    }    
                    $conn->close(); 
                    ?>
                    <option value="All">All users</option>
                </select>
                <button type="submit" class="btn btn-dark mx-2" name="submit">Run Query</button>    
              </div>
            </form>
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

              if(isset($_POST['submit'])){
                  $selected = $_POST['users'];

                  if($selected != "All")
                  {
                      $sql = "SELECT username, email_id, first_name from login_details where username='$selected'";

                      if ($result = $conn->query($sql))
                      {
                          if (mysqli_num_rows($result)>0)
                          {
                              echo "<table class='table table-bordered table-striped'>";
                              echo "<thead>";
                              echo "<tr>";
                              echo "<th>Username</th>";
                              echo "<th>Email ID</th>";
                              echo "<th>First Name</th>";
                              echo "</tr>";
                              echo "</thead>";
                              echo "<tbody>";
                              while ($row = mysqli_fetch_array($result))
                              {
                                  echo "<tr>";
                                  echo "<td>".$row['username']."</td>";
                                  echo "<td>".$row['email_id']."</td>";
                                  echo "<td>".$row['first_name']."</td>";
                                  echo "</tr>";
                              }
                              echo "</tbody>";
                              echo "</table>";

                              mysqli_free_result ($result);
                          }
                          
                          else
                          {
                              echo "<p class='lead'><em>No records were found.</em></p>";
                          }   
                      }
                  }
                  else
                  {
                      $sql = "SELECT username, email_id, first_name from login_details";

                      if ($result = $conn->query($sql))
                      {
                          if (mysqli_num_rows($result)>0)
                          {
                              echo "<table class='table table-bordered table-striped'>";
                              echo "<thead>";
                              echo "<tr>";
                              echo "<th>All Usernames
                              </th>";
                              echo "<th>Email ID</th>";
                              echo "<th>First Name</th>";
                              echo "</tr>";
                              echo "</thead>";
                              echo "<tbody>";
                              while ($row = mysqli_fetch_array($result))
                              {
                                  echo "<tr>";
                                  echo "<td>".$row['username']."</td>";
                                  echo "<td>".$row['email_id']."</td>";
                                  echo "<td>".$row['first_name']."</td>";
                                  echo "</tr>";
                              }
                              echo "</tbody>";
                              echo "</table>";

                              mysqli_free_result ($result);
                          }
                          
                          else
                          {
                              echo "<p class='lead'><em>No records were found.</em></p>";
                          }
                      }
                  } 
              }
              
              $conn->close();
            ?>
          </div>	
        </div>
    </div> 
	</body > 
</html >
