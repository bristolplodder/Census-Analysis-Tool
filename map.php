<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Travel to Work - Mapping Tool</title>
   <link rel="stylesheet" href="style.css" type="text/css" media="all" />
    <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
    <script type="text/javascript" src="map.js"></script>
    <script type="text/javascript" src="loadxmldoc.js"></script>
    <script src="LA.js"
            type="text/javascript"></script>

<script>
<?php
require 'login.php';
$db_server = mysql_connect($db_hostname, $db_username, $db_password);
if (!$db_server) die("Unable to connect to MySQL: " . mysql_error());
mysql_select_db($db_database)
  or die("Unable to select database: " . mysql_error());



$hit_result = mysql_query("SELECT * FROM hits");
$data = mysql_fetch_assoc($hit_result);
$total_hits = $data['total'];

$total_hits++;

mysql_query("UPDATE hits SET total = '" . $total_hits . "'");

mysql_free_result($hit_result);
?>
</script>

    
</head>
<body>
  <form id="addressForm" action="/"> 
    <div>
      Select travel to work mode:    
      <select type="text" name="address" id="address">
      <option value="home">Work from home</option>
      <option value="underground">Underground</option>
      <option value="train">Train</option>
      <option value="bus">Bus</option>
      <option value="motorcycle">Motorcycle</option>
      <option value="driver">Vehicle Driver</option>
      <option value="passenger">Vehicle Passenger</option>
      <option value="taxi">Taxi</option>
      <option value="bicycle">Bicycle</option>
      <option value="foot">Foot</option>
      <option value="other">Other</option>
      </select>
      <input type="submit" id="addressButton" value="Get results" />	
    <a href='map.html'>Refresh</a>
    <a href='index.php'>Homepage</a>
    </div>
  </form>
  
  <div id="map"></div>
  <div>ONS Crown Copyright Reserved</div>
 
</body>
</html>