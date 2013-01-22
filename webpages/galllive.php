<?php
//connect to the server
mysql_connect('localhost', 'root', 'sophie1'); 
?>                
<!DOCTYPE HTML>
<html>
	<head>
<meta http-equiv="refresh" content="300">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>Highcharts Example</title>

		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
		<script type="text/javascript">
$(function () {
Date.prototype.customFormat = function(formatString){
    var YYYY,YY,MMMM,MMM,MM,M,DDDD,DDD,DD,D,hhh,hh,h,mm,m,ss,s,ampm,AMPM,dMod,th;
    var dateObject = this;
    YY = ((YYYY=dateObject.getFullYear())+"").slice(-2);
    MM = (M=dateObject.getMonth()+1)<10?('0'+M):M;
    MMM = (MMMM=["January","February","March","April","May","June","July","August","September","October","November","December"][M-1]).substring(0,3);
    DD = (D=dateObject.getDate())<10?('0'+D):D;
    DDD = (DDDD=["Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday"][dateObject.getDay()]).substring(0,3);
    th=(D>=10&&D<=20)?'th':((dMod=D%10)==1)?'st':(dMod==2)?'nd':(dMod==3)?'rd':'th';
    formatString = formatString.replace("#YYYY#",YYYY).replace("#YY#",YY).replace("#MMMM#",MMMM).replace("#MMM#",MMM).replace("#MM#",MM).replace("#M#",M).replace("#DDDD#",DDDD).replace("#DDD#",DDD).replace("#DD#",DD).replace("#D#",D).replace("#th#",th);

    h=(hhh=dateObject.getHours());
    if (h==0) h=24;
    if (h>12) h-=12;
    hh = h<10?('0'+h):h;
    AMPM=(ampm=hhh<12?'am':'pm').toUpperCase();
    mm=(m=dateObject.getMinutes())<10?('0'+m):m;
    ss=(s=dateObject.getSeconds())<10?('0'+s):s;
    return formatString.replace("#hhh#",hhh).replace("#hh#",hh).replace("#h#",h).replace("#mm#",mm).replace("#m#",m).replace("#ss#",ss).replace("#s#",s).replace("#ampm#",ampm).replace("#AMPM#",AMPM);
}
    var chart;
    $(document).ready(function() {
        chart = new Highcharts.Chart({
            chart: {
                renderTo: 'container',
                type: 'spline'
            },
            title: {
                text: 'Temperature Station @ 44 Rances Lane'
            },
            subtitle: {
                text: 'all data'
            },
            xAxis: {
                type: 'datetime',
                dateTimeLabelFormats: { // don't display the dummy year
                    hour: '%H:%M'
                }
            },
            yAxis: {
                title: {
                    text: 'Temperature'
                },
                min: -10
            },
            tooltip: {
                formatter: function() {
			var _date = new Date(this.x);
			var bob = new String;
			bob = _date.customFormat( "#DD#/#MM# #hh#:#mm#:#ss#" );
                        return '<b>'+ this.series.name +'</b><br/>'+
                        bob +': '+ this.y +'°C';
                }
            },            
            series: [{
                name: 'Office',
                // Define the data points. All series have a dummy year
                // of 1970/71 in order to be compared on the same x axis. Note
                // that in JavaScript, months start at 0 for January, 1 for February etc.
                
                data: [ 
		<?php
		//query the database
                $query = mysql_query("SELECT * FROM rances44.sensordata where sensor='28-0000040cb5aa'");

                //fetch the results / convert results into an array
                $bob=0;
                WHILE($rows = mysql_fetch_array($query)):
                    $date = $rows['date'];
                    $officetemp = $rows['temp'];
			$myvar = strtotime($date) * 1000;
                    if ($bob < 1) {
                                echo "[$myvar , $officetemp]";
                               
                        } else {
                                echo ",[$myvar , $officetemp]";
                        }
			$bob=bob+1;
                endwhile;

		?>                                
                	]
            }, {
                name: 'Outside',
                data: [ 
		<?php
		//query the database
                $query = mysql_query("SELECT * FROM rances44.sensordata where sensor='28-0000040cb8b1'");
                //fetch the results / convert results into an array
                $bob=0;
                WHILE($rows = mysql_fetch_array($query)):
                    $date = $rows['date'];
                    $outsidetemp = $rows['temp'];
			$myvar = strtotime($date) * 1000;
                    if ($bob < 1) {
                                echo "[$myvar , $outsidetemp]";
                                
                        } else {
                                echo ",[$myvar , $outsidetemp]";
                        }
		$bob=$bob+1;
                endwhile;

		?>                                
                
                ]
            }]
        });
    });
    
});
		</script>
	</head>
	<body>
<script src="http://code.highcharts.com/highcharts.js"></script>
<script src="http://code.highcharts.com/modules/exporting.js"></script>

<div id="container" align="left" style="width: 800px; height: 400px; margin: 0 auto"></div>
<center>
                <?php
                //query the database
                 $query = mysql_query("SELECT min(temp) as mint, max(temp) as maxt FROM rances44.sensordata where sensor='28-0000040cb5aa'");
                //fetch the results / convert results into an array
                WHILE($rows = mysql_fetch_array($query)):
                    $min = $rows['mint'];
                    $max = $rows['maxt'];
                endwhile;
                ?>
<h3>Current Office Temp <?php echo "$officetemp C</h3> min : $min C max : $max C" ?> <br>

                <?php
                //query the database
                 $query = mysql_query("SELECT min(temp) as mint, max(temp) as maxt FROM rances44.sensordata where sensor='28-0000040cb8b1'");
                WHILE($rows = mysql_fetch_array($query)):
                    $min = $rows['mint'];
                    $max = $rows['maxt'];
                endwhile;
                ?>
<h3>Current Outside Temp <?php echo "$outsidetemp C</h3> min : $min C max : $max C" ?> <br>
<p>
this page is updated every 5 minutes <br> last update @ <?php echo date("F j, Y, g:i a"); ?><p>
<a href="glive.php"> click here to see 24 hour data  </a>
<p>
</center>
</body>
</html>
