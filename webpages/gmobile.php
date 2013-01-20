<html>
	<head>
<meta http-equiv="refresh" content="300">
</head>
<body>
<font  face="tahoma">
<?php
//connect to the server
mysql_connect('localhost', 'root', 'sophie1'); 
?>                

<html>
	<head>
		<meta http-equiv="refresh" content="300">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	</head>
	<body>
<center>
                <?php


                $query = mysql_query("SELECT * FROM rances44.sensordata where sensor='28-0000040cb5aa' and date >= SYSDATE() - INTERVAL 1 DAY");
                WHILE($rows = mysql_fetch_array($query)):
                    $date = $rows['date'];
                    $officetemp = $rows['temp'];
                endwhile;
                $query = mysql_query("SELECT * FROM rances44.sensordata where sensor='28-0000040cb8b1' and date >= SYSDATE() - INTERVAL 1 DAY");
                WHILE($rows = mysql_fetch_array($query)):
                    $date = $rows['date'];
                    $outsidetemp = $rows['temp'];
                endwhile;
                //query the database
                 $query = mysql_query("SELECT min(temp) as mint, max(temp) as maxt FROM rances44.sensordata where sensor='28-0000040cb5aa' and date >= SYSDATE() - INTERVAL 1 DAY");
                //fetch the results / convert results into an array
                WHILE($rows = mysql_fetch_array($query)):
                    $min = $rows['mint'];
                    $max = $rows['maxt'];
                endwhile;
                ?>
<br>
<h3>Current Office Temp <?php echo "$officetemp C</h3> min : $min C max : $max C" ?> <br>

                <?php
                //query the database
                 $query = mysql_query("SELECT min(temp) as mint, max(temp) as maxt FROM rances44.sensordata where sensor='28-0000040cb8b1' and date >= SYSDATE() - INTERVAL 1 DAY");
                WHILE($rows = mysql_fetch_array($query)):
                    $min = $rows['mint'];
                    $max = $rows['maxt'];
                endwhile;
                ?>
<h3>Current Outside Temp <?php echo "$outsidetemp C</h3> min : $min C max : $max C" ?> <br>
<p>
Last data update @ <?php echo $date; ?> <br> last page update @ <?php echo date("F j, Y, g:i a"); ?><p>
</center>
</font>
</body>
</html>
