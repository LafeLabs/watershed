<div style = "display:none" id = "datadiv">
<?php

    $url = "https://raw.githubusercontent.com/LafeLabs/watershed/master/metamap/wmcalc/json/dna.txt";
    $dnaraw = file_get_contents($url);
    $dna =json_decode($dnaraw);
    $baseurl = explode("json",$url)[0];

    foreach ($dna as $value) {
        $filetype = explode("/",$value)[0];
        if($filetype == "json"){
            echo file_get_contents($baseurl.$value);
            echo "\n";
        }
    }
?>
</div>
<textarea id = "textIO"></textarea>
<script>
    document.getElementById("textIO").value = document.getElementById("datadiv").innerHTML;
</script>
<a href = "editor.php">editor.php</a>

