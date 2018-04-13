<?php
$blankindex = file_get_contents("html/index.txt");
$data = $blankindex;
$filename = "index.html";
$file = fopen($filename,"w");// create new file with this name
fwrite($file,$data); //write data to file
fclose($file);  //close file

?><a style = "font-size:10em;" href = "index.html">index.html</a>