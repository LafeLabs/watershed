<?php

    $url = "https://raw.githubusercontent.com/LafeLabs/watershed/master/replicators/page/json/dna.txt";
    $dnaraw = file_get_contents($url);
    $dna =json_decode($dnaraw);
    $baseurl = explode("json",$url)[0];

    foreach ($dna as $value) {
        $filetype =  explode('/',$value)[0];
        if(!file_exists($filetype)){
            mkdir($filetype);
        }
        $filename = $value;
        $data = file_get_contents($baseurl.$value);
        $file = fopen($filename,"w");// create new file with this name
        fwrite($file,$data); //write data to file
        fclose($file);  //close file

        if($filetype == "php" && $filename != "php/replicator.txt"){
            $phpfilename = explode(".",$filename)[0].".php";
            $phpfilename = explode("/",$phpfilename)[1];
            $file = fopen($phpfilename,"w");// create new file with this name
            fwrite($file,$data); //write data to file
            fclose($file);  //close file                
        }
    }
    mkdir("pages");
?>
<a href = "pageeditor.php" style = "font-size:5em;">pageeditor.php</a>
