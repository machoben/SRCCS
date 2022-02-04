<?php

$filename = 'file.txt';
$file = fopen($filename, 'r');
$message = '';
$cardnumber=fread($file, filesize('file.txt')); 
fclose($file);
//echo $cardnumber;


?>