<?php
//connect to the server
mysql_connect('localhost', 'root', 'sophie1'); 

//query the database
$query = mysql_query("SELECT * FROM rances44.sensordata ");

//fetch the results / convert results into an array

        WHILE($rows = mysql_fetch_array($query)):
        
            $id = $rows['ID'];
	    $date = $rows['date'];	
	    $sensor = $rows['sensor'];
            $temp = $rows['temp'];
        
        echo "$id : $date : $sensor : $temp <br>";
        
        endwhile;
?>
