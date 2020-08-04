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
	<title > Logins </title > 
	<link rel = "stylesheet" href = "https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity = "sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin = "anonymous" > 
  <link rel="canonical" href="localhost/Security-DoS-Preventer/logins_page/">
	<link rel = "stylesheet" href = "cssstyle.css" type = "text/css" >
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
                <a class="nav-link" href="visitor_page.php">
                  Search Visitors 
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="login_details.php">
                  Search Login Details 
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link active" href="#">
                  Search Logins <span class="sr-only">(current)</span>
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
            <form action="#" method="GET">
              <div class="form-inline">
                <label>Show</label>
                <div class="form-check">
                  <input class="form-input mx-2" name="query[]" type="checkbox" value="ip_address" id="query">
                  <label class="form-check-label" for="ipadd">
                    IP Address
                  </label> 
                  <input class="form-input mx-2" name="query[]" type="checkbox" value="timestamp" id="query">
                  <label class="form-check-label mr-2" for="time">
                    Timestamp
                  </label>
                </div>
                <label for="Username">for: </label>
                <select id="Username" class="form-control mx-2" name="Username">
                    <?php 
                    include 'dbinfo.php';

                    $sql = "SELECT DISTINCT username from logins"; 

                    if($result=$conn->query($sql))
                    {
                        while($row=mysqli_fetch_array($result))
                        {
                            echo '<option value='.$row['username'].'>'.$row['username'].'</option>';
                        }
                    }    
                    $conn->close(); 
                    ?>
                    <option value="All">All</option>
                </select>
                <button type="submit" class="btn btn-dark mx-2" name="submit">Run Query</button>    
              </div>
            </form>
            <?php 
              include 'dbinfo.php';

              if(isset($_GET['submit']))
              {
                  $sql = "SELECT DISTINCT username ";
                  $name = $_GET['query'];
                  foreach ($name as $color) {
                    $sql .= ",".$color;
                  }

                  $sql .= " from logins";

                  $count = 0;
                  foreach($name as $color)
                  {
                      if($color=="ip_address")
                      {   $count+=1; }
                      if($color=="timestamp")
                      {   $count+=2; }

                  }

                  $selected = $_GET['Username'];
                  if($selected!="All")
                  {
                      $sql.=" where username='$selected'";
                  }

                  if($result = $conn->query($sql))
                  {
                      if(mysqli_num_rows($result)>0)
                      {
                          echo "<table class='table table-bordered table-striped'>";
                          echo "<thead>";
                          echo "<tr>";
                          echo "<th>Username</th>";
                          switch($count)
                          {
                              case 1: echo "<th>IP Address</th>"; 
                                      break; 
                              case 2: echo "<th>Timestamp</th>";
                                      break; 
                              case 3: echo "<th>IP Address</th>";
                                      echo "<th>Timestamp</th>";
                                      break;
                          }
                          echo "</tr>";
                          echo "</thead>";
                          echo "<tbody>";
                          while ($row = mysqli_fetch_array($result))
                          {
                              echo "<tr>";
                              echo "<td>".$row['username']."</td>";
                              switch($count)
                              {
                                  case 1: echo "<td>".$row['ip_address']."</td>"; 
                                          break; 
                                  case 2: echo "<td>".$row['timestamp']."</td>";
                                          break; 
                                  case 3: echo "<td>".$row['ip_address']."</td>";
                                          echo "<td>".$row['timestamp']."</td>";
                                          break;
                              }
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
              else
                {
                  echo "ERROR: Unable to execute query. ".$conn->error();
                }
              }
              
              $conn->close();
            ?>
          </div>
    </div>
  </div> 
	</body > 
</html >
