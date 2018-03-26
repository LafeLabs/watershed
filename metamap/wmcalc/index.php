<?php
    $dnaraw = file_get_contents("json/dna.txt");
    $dna =json_decode($dnaraw);
    
?>
<!doctype html>
<html>
<head>
<title>Metamap Coordinate Calculator</title>
<!-- 
PUBLIC DOMAIN, NO COPYRIGHTS, NO PATENTS.
-->
<script id = "topfunctions">
<?php

    for($x = 0; $x < count($dna); $x++) {
        if($dna[$x] -> name == "topfunctions"){
            echo file_get_contents($dna[$x] -> url);
        }    
    }
    
?>   
</script>

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

<script id = "pageevents">
<?php
    for($x = 0; $x < count($dna); $x++) {
        if($dna[$x] -> name == "pageevents"){
            echo file_get_contents($dna[$x] -> url);
        }    
    }
?>
</script>
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