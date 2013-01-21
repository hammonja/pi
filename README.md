pi
==

raspberry Pi work


main PI isntall from  : http://www.raspberrypi.org/downloads 

2012-12-16-wheezy-raspbian.zip  : http://downloads.raspberrypi.org/images/raspbian/2012-12-16-wheezy-raspbian/2012-12-16-wheezy-raspbian.zip

for the rest see the wiki

when you shag up the SD card and it is only 56mb big do the following:

in windows cmd run diskpart

list disk 

select disk <4> 

clean 

create partition primary 

format fs=fat32 quick 

assign 

exit

and voila a big sd is back 
