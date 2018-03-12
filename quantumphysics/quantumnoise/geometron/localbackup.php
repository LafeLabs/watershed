<?php

if(!file_exists("html/")){
    mkdir("html");
}
if(!file_exists("bytecode/")){
    mkdir("bytecode");
}
if(!file_exists("css/")){
    mkdir("css");
}
if(!file_exists("javascript/")){
    mkdir("javascript");
}
if(!file_exists("php/")){
    mkdir("php");
}
if(!file_exists("json/")){
    mkdir("json");
}
if(!file_exists("svg/")){
    mkdir("svg");
}
 
    $url = "https://pastebin.com/raw/k3WdL3L3";
    $dnaraw = file_get_contents($url);
    $dna =json_decode($dnaraw);

    foreach ($dna as $value) {
        $data = file_get_contents($value->url);
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

