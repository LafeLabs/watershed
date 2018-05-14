<?php

$files1 = scandir("python/");

foreach ($files1 as $value) {
    if($value != "." &&$value != ".."){
        $filebase = explode(".",$value)[0].".py";
        $code = file_get_contents("python/".$value);
        $file = fopen($filebase,"w");// create new file with this name
        fwrite($file,$code); //write data to file
        fclose($file);  //close file      
    }
}

?><a style = "font-size:10em" href = "editor.php">editor.php</a>