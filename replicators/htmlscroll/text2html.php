<?php

//$code = file_get_contents("html/index.txt");
//$file = fopen("index.html","w");// create new file with this name
//fwrite($file,$code); //write data to file
//fclose($file);  //close file      

$files1 = scandir("html/");

foreach ($files1 as $value) {
    if($value != "." &&$value != ".."){
        $filebase = explode(".",$value)[0].".html";
        $code = file_get_contents("html/".$value);
        $file = fopen($filebase,"w");// create new file with this name
        fwrite($file,$code); //write data to file
        fclose($file);  //close file      
    }
}


?><a href = "editor.php">editor.php</a>
<br/>
<a href = "index.html">index.html</a>