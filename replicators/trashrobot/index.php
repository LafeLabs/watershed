<!doctype html>
<html>
<head>
<title>Metamap</title>
<!-- 
PUBLIC DOMAIN, NO COPYRIGHTS, NO PATENTS.
-->
<script id = "bytecodeScript">
/*
<?php
echo file_get_contents("bytecode/baseshapes.txt")."\n";
echo file_get_contents("bytecode/shapetable.txt")."\n";
echo file_get_contents("bytecode/font.txt")."\n";
echo file_get_contents("bytecode/symbols013xx.txt")."\n";
echo file_get_contents("bytecode/symbols017xx.txt")."\n";
echo file_get_contents("bytecode/symbols010xx.txt")."\n";
?>
0141:0730,
0163:0731,
0144:0732,
0146:0733,
0147:0734,
0150:0735,
0152:0736,
0153:0737,
*/
</script>
<script id = "topfunctions">
<?php
echo file_get_contents("javascript/topfunctions.txt");
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
    echo file_get_contents("javascript/actions03xx.txt");
    echo "\n";
    echo file_get_contents("javascript/actions0xx.txt");
    echo "\n";
    echo file_get_contents("javascript/actions07xx.txt");
    echo "\n";
    ?>    
}
</script>
</head>
<body>
<div id = "datadiv" style = "display:none">
<?php
    echo file_get_contents("json/currentjson.txt");
?>
</div>    
<div id = "extdatadiv" style = "display:none"><?php
if(isset($_GET['url'])){
    $urlfilename = $_GET['url'];
    if(substr($urlfilename,-4) == ".svg"){
        $svgcode = file_get_contents($_GET['url']);
        $topcode = explode("</json>",$svgcode)[0];
        $jsoncode = explode("<json>",$topcode)[1];
        echo $jsoncode;
    }
    else{
        echo file_get_contents($_GET['url']);
    }
}?>
</div>
<div id = "page">
<?php
    echo file_get_contents("html/page.txt");
?>
</div>
<script>
</script>
<script id = "init">
init();
function init(){
<?php
    echo file_get_contents("javascript/init.txt");
?>
}
</script>
<script id = "redraw">
redraw();
function redraw(){
<?php
    echo file_get_contents("javascript/redraw.txt");
?>
}
</script>
<script id = "pageevents">
<?php
    echo file_get_contents("javascript/pageevents.txt");
?>
</script>
<?php
    echo "<style>\n";
    echo file_get_contents("css/style.txt");
    echo "</style>\n";
?>
</body>
</html>