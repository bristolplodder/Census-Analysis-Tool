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