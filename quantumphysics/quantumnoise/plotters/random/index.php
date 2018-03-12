<?php
    $dnaraw = file_get_contents("json/dna.txt");
    $dna =json_decode($dnaraw);
?>
<!doctype html>
<html>
<head>
<title>Calculator</title>
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

<?php
    for($x = 0; $x < count($dna); $x++) {
        if($dna[$x] -> name == "jslibrary"){
            echo file_get_contents($dna[$x] -> url);
        }    
    }
?>

</head>
<body>
<div id = "datadiv" style = "display:none">
<?php
    $data = file_get_contents("svg/index.html");
    echo $data;    
?>
</div>

<div id = "feedData" style = "display:none">
{
                "sigma": 20,
                "height": 300,
                "width": 400,
                "N": 200,
                "lineWidth":2,
                "color":"black"
}
</div>
<div id = "page">
<?php

    for($x = 0; $x < count($dna); $x++) {
        if($dna[$x] -> name == "page"){
            echo file_get_contents($dna[$x] -> url);
        }    
    }
    
?>
</div>
<script>
</script>
<script id = "init">
init();
function init(){
<?php

    for($x = 0; $x < count($dna); $x++) {
        if($dna[$x] -> name == "init"){
            echo file_get_contents($dna[$x] -> url);
        }    
    }
    
?>
}
</script>
<script id = "redraw">
redraw();
function redraw(){
<?php

    for($x = 0; $x < count($dna); $x++) {
        if($dna[$x] -> name == "redraw"){
            echo file_get_contents($dna[$x] -> url);
        }    
    }
    
?>
}
</script>
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