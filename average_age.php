<?php
require_once 'login.php';
include_once 'header.php';
$db_server = mysql_connect($db_hostname, $db_username, $db_password);
if (!$db_server) die("Unable to connect to MySQL: " . mysql_error());
mysql_select_db($db_database)
	or die("Unable to select database: " . mysql_error());



$age1 = $age2 = $town = $output = "";
$col_tot = 101;
$row_tot = 173;

if (isset($_POST['town'])) $town = $_POST['town'];
if (isset($_POST['age1'])) $age1 = $_POST['age1'];
if (isset($_POST['age2'])) $age2 = $_POST['age2'];


echo <<<_END
<html><head><title>2001 Census Assessment Tool - Age profile of population</title></head>

<body><pre>
<bAverage Age</b>

	

<form method="post" action="retrieve.php">
Town <input type="text" name="town" size="7" /> 
From age:  <input type="text" name="age1" size="7" />
To age: Age <input type="text" name="age2" size="7" />    
    <input type="submit" value="Submit" />
    ONS Crown Copyright Reserved;


</form>
</pre></body></html>
_END;




$output  = "SELECT row_no FROM age_range WHERE town LIKE '%$town%'";
$output_all  = "SELECT * FROM age_range ";

$result = mysql_query($output);
$result_all = mysql_query($output_all);






if (!$result) die ("Database access failed: " . mysql_error());

	$selected_row = mysql_fetch_row($result);
	$row_no = $selected_row[0];
	$array_all = mysql_fetch_array($result_all,MYSQL_NUM);
	echo 	"<table><tr><th>Area </th>";
		echo "<th> Average Age </th>";
		echo " </tr>";
	

			
//calculate total and average for each row



$count = 0;
while ( $row = mysql_fetch_array($result_all,MYSQL_NUM))
{
	$total[$count]= total_row($row);
	$average[$row[1]]=number_format(average_row($row,$total[$count]),1);
	
	


$count ++;

}


asort($average);

foreach($average as $key => $value)
{
	echo "<td>$key</td>";
	echo "<td>$value</td>";



 #($count = 0; $count <= $row_tot; $count ++)
#{
#	echo key($outer);
#	echo array_pop($outer);
#	echo end($outer);
#	next($outer);

	


	#echo "<td>".."</td>";
	#echo "<td>".$average[$count][1]."</td>";	
	echo "<tr></tr>";
}



echo "<tr></tr>";


echo "</table>";		



function total_row($row)
{global $col_tot;
$total = 0;
	for ($loop = 0; $loop<$col_tot;$loop++)
	{
		$total += $row[$loop+3];
	}
return $total;
}

function average_row($row, $total)
{global $col_tot;
$average = 0;
	for ($loop = 0; $loop<$col_tot;$loop++)
	{
		$average += $row[$loop+3]*$loop/$total;
	}

return $average;
}




?>