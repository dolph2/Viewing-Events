<html>
<body>
	<table width="101%" height="15%" style="background-color:red; position:absolute; 
		top:-1%; left:-1%">
		<tr>
			<td width="5%"></td>
			<td>
				<a href="http://www.viewingevents.com/index.php">Viewing Events</a>
			</td>
			<td width=30%></td>
			<td>
				<form action="map.php" method="post">
					Search for nearby events:<input placeholder="Zipcode or Address" type="text" name="searchcode" required>
					<input value="Search" type="submit">
				</form>
			</td>
			<td>
				<a href="http://www.viewingevents.com/event.php">Create Event</a>
			</td>
			<td>
				<a href="http://www.viewingevents.com/fulleventlist.php">Full Event List</a>
			</td>
		</tr>

	</table>
	<div style="position:absolute; top:18%; width:95%">
		<?php
$con=mysqli_connect("nathandb.coordcpcs.com","hughbliss","password","nathandb1000");
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

$result = mysqli_query($con,"SELECT * FROM events");

while($row = mysqli_fetch_array($result))
  {
  echo "<h3>". htmlspecialchars($row['title'])."</h3>"."Where: ".htmlspecialchars($row['address']) . ", " . htmlspecialchars($row['city']) . ", " . htmlspecialchars($row['state']) . 
	" " . htmlspecialchars($row['zipcode']) . " " . htmlspecialchars($row['country']) . "<br>Time: " . htmlspecialchars($row['time']) . "<br>Date: " . htmlspecialchars($row['date'])
		 . "<br>Contact Info: " . $row['phone'] . ", " . $row['email']
		 . "<br>Details: " . htmlspecialchars($row['description']);
  echo "<br>";
  }

mysqli_close($con);
?>
</div>
</body>
</html>