<?php 
function readSensor($sensor) 
{ 
	$output = array(); 
	$return_var = 0; 
	$i=1; 
	exec('sudo /usr/local/bin/loldht '.$sensor, $output, $return_var); 
  	while (substr($output[$i],0,1)!="H") 
	{ 
                $i++; 
	} 
	$humid=substr($output[$i],11,5); 
        $temp=substr($output[$i],33,5); 
        	$db = mysqli_connect("localhost","datalogger","datalogger") or die("DB Connect error"); 
	mysqli_select_db($db, "datalogger"); 
	$q = "INSERT INTO datalogger VALUES (now(), $sensor, '$temp', '$humid',0)"; 
	mysqli_query($db, $q); 
	mysqli_close($db); 
	return; 
} 

readSensor(8); 

?> 
