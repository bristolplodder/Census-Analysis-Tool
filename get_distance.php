<?php
require_once 'login.php';
include_once 'header.php';
$db_server = mysql_connect($db_hostname, $db_username, $db_password);
if (!$db_server) die("Unable to connect to MySQL: " . mysql_error());
mysql_select_db($db_database)
	or die("Unable to select database: " . mysql_error());



$age1 = $age2 = $town = $output = "";
$col_tot = 13;
$row_tot = 174;

if (isset($_POST['town'])) $town = $_POST['town'];


echo <<<_END


<html>
<title></title>

<h3>2001 Census Assessment Tool - Travel to work distance</h3>

<font face="verdana" size="3">

<body><pre>
<b>Which area (County/ Unitary Authority) do you want to interrogate ?</b>

<form method="post" action="get_distance.php">
Town <input type="text" name="town" size="7" value = $town> 
 
    <input type="submit" value="Submit" />
    Total distance travelled by people living in this area is estimated from the number of people in each band (excludes home workers)
    ONS Crown Copyright Reserved</form>
</pre></body></html>
_END;



$output  = "SELECT * FROM distance WHERE LA LIKE '%$town%'";
$output_all  = "SELECT * FROM distance ";

$result = mysql_query($output);
$result_all = mysql_query($output_all);


if (!$result) die ("Database access failed: " . mysql_error());


echo "<table style='font-size: 75%;'>"; 
	
echo	"<th>|   Town  </th> <th>|  Rank (out of 174)  </th> <th>|  Average distance travelled to work  |</th>";

$selected_row = mysql_fetch_row($result);
echo "<tr><b><td>";
echo $selected_row[1];
echo "</td>";
echo "<td>";
echo $selected_row[0];
echo "</td>";
echo "<td>";
echo $selected_row[12];
echo "km</td></b></tr>";



for ($loopy = 1 ; $loopy <= $row_tot ; $loopy++)
{

$looped_row = mysql_fetch_row($result_all);


//	$row_no = $selected_row[0];
//	$array_all = mysql_fetch_array($result_all,MYSQL_NUM);

	
for ($loopx = 0 ; $loopx <= $col_tot-1 ; $loopx++)
{
$out[$loopx][$loopy] = $looped_row[$loopx];

}



//echo "<tr><td>$out[1][$loop1]</td><td>$out[0][$loop1]</td><td>$out[12][$loop1]km</td></tr></br> ";
}




// create 0 array for percentages
//$percent_array = array_fill(0, $row_tot, 0);
	

			
//calculate total and average for each row



//$count = 0;
//while ( $row = mysql_fetch_array($result_all,MYSQL_NUM))
//{
	//$total[$count]= total_row($row);
	//$average[$count]=number_format(average_row($row,$total[$count]),1);
	
	
//fill out percent array
//		for ($k = $age1+3 ; $k <= $age2+4 ; ++$k)
//		{
//		$percent_array[$k-3][$count] = 100*$row[$k]/$total[$count];
//		}



//calculate "percent segment - % within age range"

//$percent_segment = percent_segment();


//print selection

/*
	if ($count == ($row_no-2))
	{
	echo "<tr></tr>";
	echo "<td><b>".$row[1]."</b></td>";
	for ($k = $age1+3 ; $k <= $age2+3 ; ++$k)
	{
		
		echo "<td><b>".$row[$k]."</b></td>";
	}
	echo "<td></td>.<td><b>".number_format($percent_segment[$count],2)."<b></td>";
	}


$count ++;

//}

*/


// print top five


echo "<tr></tr>";
echo "<th><b> --  TOP TEN  --</b></th>";
echo "<tr></tr>";


for ($loopy = 1 ; $loopy <= 10 ; $loopy++)
{
echo "<tr><td>";
echo $out[1][$loopy];
echo "</td>";
echo "<td>";
echo $out[0][$loopy];
echo "</td>";
echo "<td>";
echo $out[12][$loopy];
echo "km</td></tr>";

}

/*
$rank_top = rank_top();
$keys = array_keys($rank_top);

$top_locations  = "SELECT row_no,town FROM age_range";

for($count_tops = 0; $count_tops <=4; $count_tops++)
{
	$top_query = mysql_query($top_locations);
	for ($count_rows = 0; $count_rows <= $row_tot; $count_rows++)
	{
		$top_output = mysql_fetch_array($top_query);
		
		if (($rank_top[0][$count_tops][0]) == $count_rows-1)
		{

			echo "<tr></tr>";
			echo "<td>".$top_output['town']."</td>";
			for ($k = $age1 ; $k <= $age2+1 ; ++$k)
			{		
				echo "<td></td>";
			}


			echo "<td>".(number_format(($rank_top[0][($count_tops)][1]),2))."</td>";
			echo "<tr></tr>";
		}

	}

}

*/
 // print bottom five

  	

echo "<tr></tr>";
echo "<th><b> --  BOTTOM TEN  --</b></th>";
echo "<tr></tr>";


for ($loopy = $row_tot-9 ; $loopy <= $row_tot ; $loopy++)
{
echo "<tr><td>";
echo $out[1][$loopy];
echo "</td>";
echo "<td>";
echo $out[0][$loopy];
echo "</td>";
echo "<td>";
echo $out[12][$loopy];
echo "km</td></tr>";

}
echo "</table>";

/*
$rank_bottom = rank_bottom();
$keys = array_keys($rank_bottom);

$bottom_locations  = "SELECT row_no,town FROM age_range";

for($count_bottoms = 0; $count_bottoms <=4; $count_bottoms++)
{
	$bottom_query = mysql_query($bottom_locations);
	for ($count_rows = 0; $count_rows <= $row_tot; $count_rows++)
	{
		$bottom_output = mysql_fetch_array($bottom_query);
		
		if (($rank_bottom[0][$count_bottoms][0]) == $count_rows-1)
		{

			echo "<tr></tr>";
			echo "<td>".$bottom_output['town']."</td>";
			for ($k = $age1 ; $k <= $age2+1 ; ++$k)
			{		
				echo "<td></td>";
			}


			echo "<td>".(number_format(($rank_bottom[0][($count_bottoms)][1]),2))."</td>";
			echo "<tr></tr>";
		}

	}

}

*/

		


/*
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





function average_seg($age1, $age2,$row)
{$total = 0;
	for ($loop = $age1+2; $loop<=$age2+2;$loop++)
	{
		$total += $row[$loop];
		
	}
$average_seg = intval($total/(1+$age2-$age1));
return $average_seg;
}


function print_row ($row)
{
	global $age1, $age2;
	echo "<td>$row[0]</td>";
	for ($k = $age1+2 ; $k < $age2+3 ; ++$k)
		{
		echo "<td>$row[$k]</td>";
		}
	echo "<tr></tr>";
}

function percent_segment ()
{
	global $age1, $age2, $row_tot, $percent_array;
	$percent_segment = array_fill(0, $row_tot, 0);

	for ($y = 0 ; $y < $row_tot; $y++)
	{	
		for ($x = $age1 ; $x <= $age2 ; $x++)
		{
		$percent_segment[$y] += $percent_array[$x][$y];
		}
	}
return $percent_segment;
}



function rank_top()
{
	global $percent_segment;

$rank = array();
$rank = $percent_segment;
arsort($rank);
$rank = array_slice($rank, 0, 5,TRUE);

$count = 0;
foreach($rank as $key => $value)
{
	
		$rank_top[$count] = array("$key", "$value");

	$count ++;
}


for ($loop =0; $loop <=4; $loop++)
{
$top_keys[] = $loop;
}

$rank_top = array_fill_keys($top_keys,$rank_top);	


return $rank_top;
}

function rank_bottom()
{
	global $percent_segment;

$rank = array();
$rank = $percent_segment;
asort($rank);
$rank = array_slice($rank, 0,5, TRUE);

$count = 0;
foreach($rank as $key => $value)
{
	
		$rank_top[$count] = array("$key", "$value");

	$count ++;
}


for ($loop =0; $loop <=4; $loop++)
{
$top_keys[] = $loop;
}

$rank_top = array_fill_keys($top_keys,$rank_top);	

return $rank_top;
}

*/
?>