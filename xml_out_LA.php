<?php
    require("login.php");
           // Start XML file, create parent node
         $dom = new DOMDocument("1.0");
         $node = $dom->createElement("markers");
         $parnode = $dom->appendChild($node);
            // Opens a connection to a MySQL server
            $connection=mysql_connect ($db_hostname, $db_username, $db_password);
            if (!$connection) {  die('Not connected : ' . mysql_error());
          }
          // Set the active MySQL database
          
          $db_selected = mysql_select_db($db_database, $connection);
          if (!$db_selected) {
          die ('Can\'t use db : ' . mysql_error());
           }
           // Select all the rows in the markers table
           $query = "SELECT * FROM method WHERE 1";
           $result = mysql_query($query);
           if (!$result) {
           die('Invalid query: ' . mysql_error());
           }
            header("Content-type: text/xml");
             // Iterate through the rows, adding XML nodes for each
             while ($row = @mysql_fetch_assoc($result)){
              // ADD TO XML DOCUMENT NODE
              $node = $dom->createElement("marker");
              $newnode = $parnode->appendChild($node);
              $newnode->setAttribute("LA",$row['LA']);
              $newnode->setAttribute("home_pc", $row['home_pc']);
              $newnode->setAttribute("home_rank", $row['home_rank']);
              $newnode->setAttribute("underground_pc", $row['underground_pc']);
              $newnode->setAttribute("underground_rank", $row['underground_rank']);
              $newnode->setAttribute("train_pc", $row['train_pc']);
              $newnode->setAttribute("train_rank", $row['train_rank']);
              $newnode->setAttribute("bus_pc", $row['bus_pc']);
              $newnode->setAttribute("bus_rank", $row['bus_rank']);
              $newnode->setAttribute("motorcycle_pc", $row['motorcycle_pc']);
              $newnode->setAttribute("motorcycle_rank", $row['motorcycle_rank']);
              $newnode->setAttribute("driver_pc", $row['driver_pc']);
              $newnode->setAttribute("driver_rank", $row['driver_rank']);
              $newnode->setAttribute("passenger_pc", $row['passenger_pc']);
              $newnode->setAttribute("passenger_rank", $row['passenger_rank']);
              $newnode->setAttribute("taxi_pc", $row['taxi_pc']);
              $newnode->setAttribute("taxi_rank", $row['taxi_rank']);
              $newnode->setAttribute("bicycle_pc", $row['bicycle_pc']);
              $newnode->setAttribute("bicycle_rank", $row['bicycle_rank']);
              $newnode->setAttribute("foot_pc", $row['foot_pc']);
              $newnode->setAttribute("foot_rank", $row['foot_rank']);
              $newnode->setAttribute("other_pc", $row['other_pc']);
              $newnode->setAttribute("other_rank", $row['other_rank']);
               }
               echo $dom->saveXML();

               
?>