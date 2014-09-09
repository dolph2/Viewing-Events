<?php

   header( 'Location: /index.php' ) ;

?>
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
$con=mysqli_connect("nathandb.coordcpcs.com","hughbliss","password","nathandb1000");
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
$val = getLnt($_POST[address] . $_POST[city] . $_POST[state] . $_POST[zipcode]);
 echo "Latitude: ".$val['lat']."<br>";
 echo "Longitude: ".$val['lng']."<br>";
$sql="INSERT INTO events (address, city, state, zipcode, phone, 
email, title, time, date, description, lat, lon)
VALUES
('$_POST[address]','$_POST[city]','$_POST[state]','$_POST[zipcode]',
	'$_POST[phone]','$_POST[email]','$_POST[title]','$_POST[time]',
	'$_POST[date]','$_POST[description]',".$val['lat'].",".$val['lng'].")";
echo "Latitude2: ".floatval($val['lat'])."<br>";
if (!mysqli_query($con,$sql))
  {
  die('Error: ' . mysqli_error($con));
  }
echo "1 record added";
mysqli_close($con);
?>
