<?php

    mkdir("bytecode");
    mkdir("html");
    mkdir("css");
    mkdir("javascript");
    mkdir("php");
    mkdir("json");
    mkdir("svg");

    $url = "https://raw.githubusercontent.com/LafeLabs/watershed/master/actiongeometry/json/dna.txt";
    $dnaraw = file_get_contents($url);
    $dna =json_decode($dnaraw);

    $baseurl = explode("json",$url)[0];

    foreach ($dna as $value) {
        $data = file_get_contents($baseurl.$value->url);
        $filename = $value->type."/".$value->name.".txt";
        $file = fopen($filename,"w");// create new file with this name
        fwrite($file,$data); //write data to file
        fclose($file);  //close file
        if($value->type == "php" && $value->name != "replicator"){
            $filename = $value->name.".php";
            $file = fopen($filename,"w");// create new file with this name
            fwrite($file,$data); //write data to file
            fclose($file);  //close file                
        }
    }
    

?>

