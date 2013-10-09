<?php
$n = "Name:";
$e = "Email:";
$name = $_GET['name'];
$email = $_GET['email'];
$blank = ".";
	$fh = fopen("volunteers.txt", 'a') 
		or 
			die("can't register");
	$stringData = "$n";
                fwrite($fh, $stringData);
	$stringData = "$name" . PHP_EOL;
                fwrite($fh, $stringData);
	$stringData = "$e";
		fwrite($fh, $stringData);
	$stringData = "$email" . PHP_EOL;
		fwrite($fh, $stringData);
	$stringData = "$blank" . PHP_EOL;
		fwrite($fh, $stringData);
	fclose($fh);

	print("Thankyou for registering! ");
	print("Remember to bring in your $7 for the day of the event!");
?>
