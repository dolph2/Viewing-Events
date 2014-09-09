<!DOCTYPE html>
<?php
		function getLnt($zip){
			$url = "http://maps.googleapis.com/maps/api/geocode/json?address=
				".urlencode($zip)."&sensor=false";
			$result_string = file_get_contents($url);
			$result = json_decode($result_string, true);
			$result1[]=$result['results'][0];
			$result2[]=$result1[0]['geometry'];
			$result3[]=$result2[0]['location'];
			return $result3[0];
		}
	
		$val = getLnt($_POST[searchcode]);	
		

		$con=mysqli_connect("nathandb.coordcpcs.com","hughbliss","password","nathandb1000");
		// Check connection
		if (mysqli_connect_errno())
 		 {
 			 echo "Failed to connect to MySQL: " . mysqli_connect_error();
  		}

		$result = mysqli_query($con,"SELECT *, ( 3959 * acos( cos( radians(".$val['lat'].") ) * cos( radians( lat ) ) * cos( radians( lon ) - radians(".$val['lng'].") ) + sin( radians(".$val['lat'].") ) * sin( radians( lat ) ) ) ) AS distance FROM events HAVING distance < 1000 ORDER BY distance LIMIT 0 , 10");

		
		mysqli_close($con);
	?>
<html>
  <head>
    <style>
      #map_canvas {
        width: 62%;
        height: 80%;
      }
    </style>
    <script src="http://maps.googleapis.com/maps/api/js?AIzaSyAg2H1VJ4SCysXaBshEy_KatZs1bZQPC98&sensor=false"></script>
    <script>
      
      var map; 
      function bindInfoWindow(marker, map, infowindow, strDescription) {
           google.maps.event.addListener(marker, 'click', function() {
           infowindow.setContent(strDescription);
           infowindow.open(map, marker);
        });
      }
     function initialize() {
        var map_canvas = document.getElementById('map_canvas');
        var map_options = {
          center: new google.maps.LatLng(41.5403, -87.5463),
          zoom: 4,
          mapTypeId: google.maps.MapTypeId.ROADMAP
        }
        var bounds = new google.maps.LatLngBounds();
        map = new google.maps.Map(map_canvas, map_options);
	
        var content_str;
	var marker;
	var pt;
        var infowindow =  new google.maps.InfoWindow({
            content: ""
        });
        
<?php
	
while($row = mysqli_fetch_array($result))
  		{
  			

                      echo "\npt = new google.maps.LatLng(".$row['lat'].",".$row['lon'].");";

            echo "\nmarker = new google.maps.Marker({";
            echo "    position: pt,";
            echo "    map: map,";
	    echo "});\n";
           
            echo "bounds.extend(pt);\n";
            echo "content_str = '".htmlspecialchars($row['title'])."<br>".htmlspecialchars($row['address']).", ".
		htmlspecialchars($row['city'])."<br>". htmlspecialchars($row['time']) . "<br>" .htmlspecialchars($row['phone'])
		. ", ". htmlspecialchars($row['email'])."'\n";
            echo "\nbindInfoWindow(marker, map, infowindow, content_str);";
	      
  		}
?>


  map.fitBounds(bounds);
      }
    
      google.maps.event.addDomListener(window, 'load', initialize);
    </script>
  </head>
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
<div style="position:absolute; top:18%; width:35%">
<?php
	//echo "Latitude: ".$val['lat']."<br>";
 	//echo "Longitude: ".$val['lng']."<br>";
mysqli_data_seek($result, 0);
		while($row = mysqli_fetch_array($result))
  		{
  			echo "<h3>". htmlspecialchars($row['title'])."</h3>"."Where: ".htmlspecialchars($row['address']) . ", " . htmlspecialchars($row['city']) . ", " . htmlspecialchars($row['state']) . 
			" " . htmlspecialchars($row['zipcode']) . " " . htmlspecialchars($row['country']) . "<br>Time: " . htmlspecialchars($row['time']) . "<br>Date: " . htmlspecialchars($row['date'])
			 . "<br>Contact Info: " . $row['phone'] . ", " . $row['email']
			 . "<br>Details: " . htmlspecialchars($row['description'])
			 . "<br>Distance: ". $row['distance']." mi";
  			echo "<br>";
  		}
?></div>
	
    <div style="position:absolute; left:37%; top:18%" id="map_canvas"></div>
  </body>
</html>