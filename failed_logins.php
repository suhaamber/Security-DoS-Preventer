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
	<title > Failed Logins </title > 
	<link rel = "stylesheet" href = "https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity = "sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin = "anonymous" > 
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
                <a class="nav-link" href="#">
                  Search Visitors 
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
              <li class="nav-item">
                  <a class="nav-link active" href="failed_logins.php">
                    Search Failed Logins <span class="sr-only">(current)</span>
                  </a>
                </li>
            </ul>
          </div>
        </nav>
		<div  class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
                <form action="#" method="POST">
                <div class="form-inline">
                    <label for="ipadd">Show failed attempts to access webiste for: </label>
                    <select id="ipadd" class="form-control mx-2" name="ipadd">
                        <?php 
                        include 'dbinfo.php';

                        $sql = "SELECT DISTINCT ip_address from failed_logins"; 

                        if($result=$conn->query($sql))
                        {
                            while($row=mysqli_fetch_array($result))
                            {
                                echo '<option value='.$row['ip_address'].'>'.$row['ip_address'].'</option>';
                            }
                        }    
                        $conn->close(); 
                        ?>
                        <option value="All">All attempts</option>
                    </select>
                    <button type="submit" class="btn btn-dark mx-2" name="submit">Run Query</button>    
                </div>
                </form>
                <?php 
                    include 'dbinfo.php';

                    if(isset($_POST['submit'])){
                        $selected = $_POST['ipadd'];

                        if($selected != "All")
                        {
                            $sql = "SELECT timestamp from failed_logins where ip_address='$selected'";

                            if ($result = $conn->query($sql))
                            {
                                if (mysqli_num_rows($result)>0)
                                {
                                    echo "<table class='table table-bordered table-striped col-md-4 col-lg-4'>";
                                    echo "<thead>";
                                    echo "<tr>";
                                    echo "<th>Timestamps for ".$selected."</th>";
                                    echo "</tr>";
                                    echo "</thead>";
                                    echo "<tbody>";
                                    while ($row = mysqli_fetch_array($result))
                                    {
                                        echo "<tr>";
                                        echo "<td>".$row['timestamp']."</td>";
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
                            $sql = "SELECT * from failed_logins";

                            if ($result = $conn->query($sql))
                            {
                                if (mysqli_num_rows($result)>0)
                                {
                                    echo "<table class='table table-bordered table-striped'>";
                                    echo "<thead>";
                                    echo "<tr>";
                                    echo "<th>All IP Addresses</th>";
                                    echo "<th>Timestamps</th>";
                                    echo "</tr>";
                                    echo "</thead>";
                                    echo "<tbody>";
                                    while ($row = mysqli_fetch_array($result))
                                    {
                                        echo "<tr>";
                                        echo "<td>".$row['ip_address']."</td>";
                                        echo "<td>".$row['timestamp']."</td>";
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
</body> 
</html>