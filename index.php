<?php // index.php
require_once 'login.php';
include_once 'header.php';


$db_server = mysql_connect($db_hostname, $db_username, $db_password);
if (!$db_server) die("Unable to connect to MySQL: " . mysql_error());
mysql_select_db($db_database)
	or die("Unable to select database: " . mysql_error());


echo "<h3>Home page</h3>
	  This site provides tools for analysing Census data to improve evidence-based planning.</br>
	  If nothing else it provides an interesting way of comparing trends between Unitary Authorities throughout Engalnd and Wales. Enjoy!</br>";




$result = mysql_query("SELECT * FROM hits");
$data = mysql_fetch_assoc($result);
$total_hits = $data['total'];

$total_hits++;

mysql_query("UPDATE hits SET total = '" . $total_hits . "'");

echo "</br> TOTAL HITS: ";
echo ($total_hits);


mysql_free_result($result);
mysql_close();


?>