<?php

$name = $_GET['name'];
$blank = ".";
	$fh = fopen("pcsolo.txt", 'a') 
		or 
			die("can't register");
	$stringData = "$n";
                fwrite($fh, $stringData);
	$stringData = "$name" . PHP_EOL;
                fwrite($fh, $stringData);
	$stringData = "$blank" . PHP_EOL;
		fwrite($fh, $stringData);
	fclose($fh);

	print("Thankyou for registering! ");
	print("Remember to bring in your $7 for the day of the event!");
?>
