<?php
require_once 'login.php';
include_once 'header.php';
$db_server = mysql_connect($db_hostname, $db_username, $db_password);
if (!$db_server) die("Unable to connect to MySQL: " . mysql_error());
mysql_select_db($db_database)
	or die("Unable to select database: " . mysql_error());


$age1 = $age2 = $town = $output = "";
$col_tot = 35;
$row_tot = 174;

if (isset($_POST['town'])) $town = $_POST['town'];

$drop = "--";


$options = array(
  '' => '--',
  '2' => 'Work from home',
  '5' => 'Underground',
  '8' => 'Train',
  '11' => 'Bus',
  '14' => 'Motorcycle',
   '17' => 'Vehicle Driver',
   '20' => ' Vehicle Passenger',
   '23' => 'Taxi',
   '26' => 'Bicycle',
   '29' => 'Foot',
   '32' => 'Other'


);

function selected($drop){
  
  if(empty($_POST['mydropdown'])){
    return;
  }
  
  if(!is_array($_POST['mydropdown'])){
    return;
  }
  
  if(!in_array($drop, $_POST['mydropdown'])){
    return;
  }
  
  return 'selected="selected"';
}

?>


<h3>2001 Census Assessment Tool - Methods of travel to work</h3>



<body><pre>
<font face="verdana" size="3">
<b>Which home area (County/ Unitary Authority) do you want to interrogate ?</b>

<form action="method.php" method="post">
  Town <input type="text" name="town" size="7" value= "<?php echo $town;?>">
  Method of Travel  <select name="mydropdown[]" >
    <?php foreach($options as $code => $text): ?>
      <option value="<?php echo $code; ?>" <?php echo selected($code); ?>>
        <?php echo $text; ?>
      </option>
    <?php endforeach; ?>
  </select>
  <input type="submit" value="submit">
</form> 

Proportions of people travelling to work by mode as percentages of all trips to work (inc work from home)
ONS Crown Copyright Reserved
<?php 


$output  = "SELECT * FROM method WHERE LA LIKE '%$town%'";
$output_all  = "SELECT * FROM method ";

$result = mysql_query($output);
$result_all = mysql_query($output_all);


if (!$result) die ("Database access failed: " . mysql_error());

$drop = $_REQUEST['mydropdown']; 

$drop =  $drop[0];
	

echo "<table style='font-size: 75%;'>"; 

echo "<tr><th>|   Town  </th><th>|   Rank (out of 174)  </th> <th>|  Mode:  |</th></tr>";

$selected_row = mysql_fetch_row($result);
echo "<tr><b><td>";
echo $selected_row[0];
echo "</td>";
echo "<td>";
echo $selected_row[$drop+1];
echo "</td>";
echo "<td>";
echo 100*$selected_row[$drop];
echo "%</td></b></tr>";



for ($loopy = 1 ; $loopy <= $row_tot ; $loopy++)
{

$looped_row = mysql_fetch_row($result_all);


//	$row_no = $selected_row[0];
//	$array_all = mysql_fetch_array($result_all,MYSQL_NUM);

	
for ($loopx = 0 ; $loopx <= $col_tot-1 ; $loopx++)
{
$out[$loopx][$loopy] = $looped_row[$loopx];

}




}


echo "<tr></tr>";
echo "<th><b> --  TOP TEN  --</b></th>";
echo "<tr></tr>";

for ($tag = 1; $tag <= 10; $tag++)

{
for ($loopy = 1 ; $loopy <= $row_tot ; $loopy++)

{
if ($out[$drop+1][$loopy] == $tag)
{ 

echo "<tr><td>";
echo $out[0][$loopy];
echo "</td>";
echo "<td>";
echo $out[$drop+1][$loopy];
echo "</td>";
echo "<td>";
echo 100*$out[$drop][$loopy];
echo "%</td></tr>";

}
}
} 	

echo "<tr></tr>";
echo "<th><b> --  BOTTOM TEN  --</b></th>";
echo "<tr></tr>";


for ($tag = $row_tot-10; $tag <= $row_tot; $tag++)

{
for ($loopy = 1 ; $loopy <= $row_tot ; $loopy++)

{
if ($out[$drop+1][$loopy] == $tag)
{ 

echo "<tr><td>";
echo $out[0][$loopy];
echo "</td>";
echo "<td>";
echo $out[$drop+1][$loopy];
echo "</td>";
echo "<td>";
echo 100*$out[$drop][$loopy];
echo "%</td></tr>";

}
}
} 	

echo "</table>";
echo "</font>";

echo "</pre></body></html>";



?>