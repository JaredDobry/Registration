<?php

$name = $_GET['name'];
$team = $_GET['team'];
$teammate1 = $_GET['teammate1'];
$teammate2 = $_GET['teammate2'];
$teammate3 = $_GET['teammate3'];
$teammate4 = $_GET['teammate4'];
$blank = ".";
$t = "Teamname:";
$n = "Name:";
$tm1 = "Teammate1:";
$tm2 = "Teammate2:";
$tm3 = "Teammate3:";
$tm4 = "Teammate4:";
	
	$fh = fopen("csteams.txt", 'a') 
		or 
			die("can't register");
	$stringData = "$t";
                fwrite($fh, $stringData); 	
	$stringData = "$team" . PHP_EOL;
                fwrite($fh, $stringData);
	$stringData = "$n";
                fwrite($fh, $stringData);
	$stringData = "$name" . PHP_EOL;
                fwrite($fh, $stringData);
	$stringData = "$tm1";
                fwrite($fh, $stringData);
        $stringData = "$teammate1" . PHP_EOL;
                fwrite($fh, $stringData);
	$stringData = "$tm2";
                fwrite($fh, $stringData);
        $stringData = "$teammate2" . PHP_EOL;
                fwrite($fh, $stringData);
	$stringData = "$tm3";
                fwrite($fh, $stringData);
        $stringData = "$teammate3" . PHP_EOL;
                fwrite($fh, $stringData);
        $stringData = "$tm4";
                fwrite($fh, $stringData);
        $stringData = "$teammate4" . PHP_EOL;
                fwrite($fh, $stringData);
        $stringData = "$blank" . PHP_EOL;
                fwrite($fh, $stringData);
	fclose($fh);

	print("Thankyou for registering! ");
	print("Remember to bring in your $7 for the day of the event!");
?>
