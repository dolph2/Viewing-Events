<!DOCTYPE html>
<html>
<head>
	<title>Events</title>
<head>
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
	<div style="position:absolute; top:18%">
	<form action="insert.php" method="post">  
  <table>
    <tr><td>Address:</td>
        <td><input type="text" name="address" required></td>
    </tr>
    <tr><td>City:</td>
	<td><input type="text" name = "city" required></td>
    </tr>
    <tr><td>State:</td>
	<td><input type="text" name ="state"></td>
    </tr>
    <tr><td>Country:</td>
	<td><input type="text" name ="country">(if outside US)</td>
    </tr>
    <tr><td>Zip/Postal Code:</td>
	<td><input type="text" name="zipcode" required></td>
    </tr>
    <tr><td>Phone:</td>
	<td><input type="text" name="phone">(xxx)-xxx-xxxx</td>
    </tr>
    <tr><td>Email:</td>
	<td><input type="text" name="email" required></td>
    </tr>
    <tr><td>Event Title:</td>
	<td><input type="text" name="title" required></td>
    </tr>
    <tr><td>Start Time:</td>
	<td><input type="text" name="time" required>(ie. 5:00PM)</td>
    </tr>
    <tr><td>Date:</td>
	<td><input type="text" name="date" required>MM/DD/YYYY</td>
    </tr>
    <tr><td>Description:</td>
	<td><textarea name="description" rows="5" cols="50" required>
		</textarea>Add any additional details (Max 250 characters)</td>
    </tr>
    <tr><td><input type="submit" value="Create Event"></td></tr>
   </table></div>	
</form>

</body>
</html>