<!doctype html>
<html>
<head>
<title>Keyboard Viewer/editor</title>
<!-- 
PUBLIC DOMAIN, NO COPYRIGHTS, NO PATENTS.
-->
<script id = "bytecodeScript">
/*
<?php

$data = file_get_contents("bytecode/baseshapes.txt");
echo $data."\n";
$data = file_get_contents("bytecode/shapetable.txt");
echo $data."\n";
$data = file_get_contents("bytecode/symbols013xx.txt");
echo $data."\n";
$data = file_get_contents("bytecode/symbols010xx.txt");
echo $data."\n";
$data = file_get_contents("bytecode/font.txt");
echo $data."\n";
$data = file_get_contents("bytecode/keyboard.txt");
echo $data."\n";

?>
*/
</script>
<script id = "topfunctions">
<?php
    $data = file_get_contents("javascript/topfunctions.txt");
    echo $data;
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
    <?php
            $data = file_get_contents("javascript/actions03xx.txt");
            echo $data;
            $data = file_get_contents("javascript/actions0xx.txt");
            echo $data;
    ?>    
}
</script>
<script id = "jslibrary">
<?php
    $data = file_get_contents("javascript/jslibrary.txt");
    echo $data;    
?>
</script>
</head>
<body>
<div id = "page">
<?php
    $data = file_get_contents("html/page.txt");
    echo $data;    
?>
</div>
<script>
</script>
<script id = "init">
init();
function init(){
<?php
    $data = file_get_contents("javascript/init.txt");
    echo $data;    
?>
}
</script>
<script id = "redraw">
redraw();
function redraw(){
<?php
    $data = file_get_contents("javascript/redraw.txt");
    echo $data;    
?>
}
</script>
<script id = "pageevents">
<?php
    $data = file_get_contents("javascript/pageevents.txt");
    echo $data;    
?>
</script>
<?php
    echo "<style>\n";
    $data = file_get_contents("css/style.txt");
    echo $data;
    echo "</style>\n";
?>
</body>
</html>