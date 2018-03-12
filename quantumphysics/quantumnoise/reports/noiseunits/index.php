<?php
    $dnaraw = file_get_contents("json/dna.txt");
    $dna =json_decode($dnaraw);
    
?>
<!doctype html>
<html>
<head>
<title>index</title>
<!-- 
PUBLIC DOMAIN, NO COPYRIGHTS, NO PATENTS.
-->

<?php
    for($x = 0; $x < count($dna); $x++) {
        if($dna[$x] -> name == "jslibrary"){
            echo file_get_contents($dna[$x] -> url);
        }    
    }
?>

</head>
<body>
<div id = "page">
<?php

    for($x = 0; $x < count($dna); $x++) {
        if($dna[$x] -> name == "page"){
            echo file_get_contents($dna[$x] -> url);
        }    
    }
    
?>
</div>
<?php
    echo "<style>\n";
    for($x = 0; $x < count($dna); $x++) {
        if($dna[$x] -> name == "style"){
            echo file_get_contents($dna[$x] -> url);
        }    
    }
    echo "</style>\n";
?>
</body>
</html>