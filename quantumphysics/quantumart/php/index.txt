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
    if(localCommand >= 040 && localCommand <= 0176){
        currentHTML += String.fromCharCode(localCommand);
        currentWord += String.fromCharCode(localCommand);
    }
    if(localCommand >= 0200 && localCommand <= 0277){//shapes 
        if(!(localCommand == 0207 && editMode == false) ){
            drawGlyph(currentTable[localCommand]);    	    
        }
    }
    if(localCommand >= 01000 && localCommand <= 01777){//symbol glyphs
            drawGlyph(currentTable[localCommand]);    	    
    } 
    if(localCommand >= 0500 && localCommand <= 0577){//draw bitmaps
        //these are json, with position information
        var imgid = "img0" + localCommand.toString(8);
        if(document.getElementById(imgid) != null){
            document.getElementById(imgid).style.position = "absolute";
            document.getElementById(imgid).style.display = "block";
            document.getElementById(imgid).style.width = side.toString() + "px";
            document.getElementById(imgid).style.top = y.toString() + "px";
            document.getElementById(imgid).style.left = x.toString() + "px";        
            document.getElementById(imgid).style.transform = "rotate(" + (theta - theta0).toString() + "rad)";
        }
        
    }
    if(localCommand >= 0600 && localCommand <= 0677){//draw boxes
        //see if the div exists, and if it does, set size, position, and rotation based on global geometry 
        //variables
        var boxid = "box0" + localCommand.toString(8); 
        if(document.getElementById(boxid) != null){
            document.getElementById(boxid).style.position = "absolute";
            document.getElementById(boxid).style.display = "block";
            document.getElementById(boxid).style.width = (scaleFactor*side).toString() + "px";
            document.getElementById(boxid).style.top = y.toString() + "px";
            document.getElementById(boxid).style.left = x.toString() + "px";        
            document.getElementById(boxid).style.fontSize = (side/scaleFactor).toString() + "px";
            document.getElementById(boxid).style.transform = "rotate(" + (theta - theta0).toString() + "rad)";
        }
    }
    <?php

            for($x = 0; $x < count($dna); $x++) {
                if($dna[$x] -> name == "actions03xx"){
                    echo file_get_contents($dna[$x] -> url);
                }    
            }
            echo "\n";
            for($x = 0; $x < count($dna); $x++) {
                if($dna[$x] -> name == "actions0xx"){
                    echo file_get_contents($dna[$x] -> url);
                }    
            }
            echo "\n";

        
    ?>    
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
<div id = "imagedata" style = "display:none">
<?php
    echo file_get_contents("json/imagedata.txt");
?>
</div>
<div id = "jsondata" style = "display:none">
<?php
    echo file_get_contents("json/currentjson.txt");
?>
</div>
<div id = "boxes">
<?php
    echo file_get_contents("html/boxes.txt");
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