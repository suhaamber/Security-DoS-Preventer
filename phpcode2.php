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


$sql3 = "SELECT * FROM visitors ORDER BY timestamp DESC LIMIT 10";
if ($result = $conn->query ($sql3))
  {
    if (mysqli_num_rows ($result) > 0)
      {
        echo "<table class='table table-bordered table-striped'>";
        echo "<thead>";
        echo "<tr>";     
        echo "<th>IP Address</th>";
        echo "<th>Timestamp</th>";
        echo "</tr>";
        echo "</thead>";
        echo "<tbody>";
        while ($row = mysqli_fetch_array ($result))
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
else
  {
    echo "ERROR: Unable to execute query. ".$conn->error();
}

$conn->close(); 

?>
