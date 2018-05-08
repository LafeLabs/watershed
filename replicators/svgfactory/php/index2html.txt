<?php

$code = file_get_contents("html/index.txt");
$file = fopen("index.html","w");// create new file with this name
fwrite($file,$code); //write data to file
fclose($file);  //close file      

?><a style = "font-size:10em" href = "editor.php">editor.php</a>