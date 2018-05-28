<?php

$files1 = scandir("html/");

foreach ($files1 as $value) {
    if($value != "." && $value != ".." && $value != "page.txt"){
        $filebase = explode(".",$value)[0].".html";
        $code = file_get_contents("html/".$value);
        $file = fopen($filebase,"w");// create new file with this name
        fwrite($file,$code); //write data to file
        fclose($file);  //close file      
    }
}

?><a style = "font-size:10em" href = "editor.php">editor.php</a>