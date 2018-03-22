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
<script id = "bytecodeScript">
/*
<?php

for($x = 0; $x < count($dna); $x++) {
    if($dna[$x] -> type == "bytecode"){
        echo file_get_contents($dna[$x] -> url)."\n";
    }    
}

?>
*/
</script>
<script id = "topfunctions">
<?php

    for($x = 0; $x < count($dna); $x++) {
        if($dna[$x] -> name == "topfunctions"){
            echo file_get_contents($dna[$x] -> url);
        }    
    }
    
?>   
</script>
<script id = "actions">
function doTheThing(localCommand){    

    if(localCommand >= 0600 && localCommand <= 0677){
        currentAddress = localCommand;

        var httpc = new XMLHttpRequest();
        httpc.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                filedata = this.responseText;
                document.getElementById("scroll").innerHTML = filedata;
                MathJax.Hub.Typeset();//tell Mathjax to update the math

            }
        };
        httpc.open("GET", "fileloader.php?filename=" + byteCode2string(currentTable[localCommand]), true);
        httpc.send();
    }
  
}
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
<div id = "jsondata" style = "display:none">
<?php
    echo file_get_contents("json/currentjson.txt");
?>
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