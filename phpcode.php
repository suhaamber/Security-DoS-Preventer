<?php 
include 'dbinfo.php';


$sql3 = "SELECT * FROM logins ORDER BY timestamp DESC LIMIT 5";
if ($result = $conn->query ($sql3))
  {
    if (mysqli_num_rows ($result) > 0)
      {
	echo "<table class='table table-bordered table-striped'>";
	echo "<thead>";
	echo "<tr>";
	echo "<th>Username</th>";
	echo "<th>IP Address</th>";
	echo "<th>Timestamp</th>";
	echo "</tr>";
	echo "</thead>";
	echo "<tbody>";
	while ($row = mysqli_fetch_array ($result))
	  {
	    echo "<tr>";
	    echo "<td>".$row['username']."</td>";
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
else
  {
    echo "ERROR: Unable to execute query. ".$conn->error();
  }

$conn->close();
?>
