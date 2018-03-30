<?php

    $url = "https://raw.githubusercontent.com/LafeLabs/watershed/master/metamap/wmcalc/json/dna.txt";
    $dnaraw = file_get_contents($url);
    $dna =json_decode($dnaraw);
    $baseurl = explode("json",$url)[0];

    foreach ($dna as $key) {
        echo $dna -> $key[0];
    }

?>