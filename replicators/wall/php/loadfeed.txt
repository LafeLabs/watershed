<?php

$files = scandir(getcwd()."/feeds");

$latesttime = 0;

foreach($files as $value){
    if($value != "." && $value != ".." && substr($value,0,4) == "feed"){
     //   echo $value."<br/>".substr(substr($value,4),0,-4)."<br/>";
        $timestamp = substr(substr($value,4),0,-4);
     //   echo gmdate("Y-m-d H:i:s", $timestamp)."<br/>";     
     //   echo intval($timestamp) - 4287;
     //   echo "<br/>";
        if($timestamp > $latesttime){
            $latesttime = $timestamp;
        }
    }
}

$latestfilename = "feeds/feed".$latesttime.".txt";
$outstring =  file_get_contents($latestfilename);
echo $outstring;
$file = fopen("html/feed.txt","w");// create new file with this name
fwrite($file,$outstring); //write data to file
fclose($file);  //close file

?>
