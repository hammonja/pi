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
                text: 'powered by Raspberry PI'
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
                        bob +': '+ this.y +'�C';
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
                    $temp = $rows['temp'];
                    if ($bob < 1) {
                                echo "[$date , $temp]";
                                $bob=10;
                        } else {
                                echo ",[$date , $temp]";
                        }
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
                    $temp = $rows['temp'];
                    if ($bob < 1) {
                                echo "[$date , $temp]";
                                $bob=10;
                        } else {
                                echo ",[$date , $temp]";
                        }
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

<div id="container" style="min-width: 400px; height: 400px; margin: 0 auto"></div>
this page is updated every 5 minutes
<br>
<a href="log1.html"> click here to see sensor1 log </a>
<br>
<a href="log2.html"> click here to see sensor2 log </a>
<br>
<a href="tempdata.php"> click here to see datebase contents </a>

last update @ Sun Jan 20 20:14:31 UTC 2013<p><img src='test.jpeg'>
</body>
</html>
