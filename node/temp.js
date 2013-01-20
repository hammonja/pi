#!/usr/bin/node
 
var exec = require('child_process').exec;
 
var tempId = '28-0000040cb5aa',
    dispTempInterval,
    dispTempIntervalClock = 10; //sec
 
var dispTemp = function(){
    exec( "cat /sys/bus/w1/devices/" + tempId + "/w1_slave | grep t= | cut -f2 -d= | awk '{print $1/1000}'", function( error, stdout, stderr ){
        if ( error != null ){
          console.log( "Error: " + error);
        }
 
        var temp = parseFloat(stdout).toFixed(2);
        console.log ( "Current temperature: " + temp + "C" );
    });
}
 
console.log( 'Started node-temp');
console.log( '-----------------');
 
/* Start interval */
dispTempInterval = setInterval( function(){
  dispTemp();
}, dispTempIntervalClock*1000 );
