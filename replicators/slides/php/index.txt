<!doctype html>
<html>
<head>
<title>Slide Deck</title>
<!-- 
PUBLIC DOMAIN, NO COPYRIGHTS, NO PATENTS.

-->
<!--
<script src="https://hammerjs.github.io/dist/hammer.js"></script>
-->

<script src="https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.0/MathJax.js?config=TeX-AMS-MML_HTMLorMML"></script>
   <script>
	MathJax.Hub.Config({
		tex2jax: {
		inlineMath: [['$','$'], ['\\(','\\)']],
		processEscapes: true,
		processClass: "mathjax",
        ignoreClass: "no-mathjax"
		}
	});//			MathJax.Hub.Typeset();//tell Mathjax to update the math
</script>
<!--Stop Google:-->
<META NAME="robots" CONTENT="noindex,nofollow">
<!--ace editor::-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/ace/1.2.6/ace.js" type="text/javascript" charset="utf-8"></script>

<script id = "bytecodeScript">
/*
<?php
echo file_get_contents("bytecode/baseshapes.txt")."\n";
echo file_get_contents("bytecode/shapetable.txt")."\n";
echo file_get_contents("bytecode/font.txt")."\n";
echo file_get_contents("bytecode/keyboard.txt")."\n";
echo file_get_contents("bytecode/symbols013xx.txt")."\n";
echo file_get_contents("bytecode/symbols010xx.txt")."\n";
?>
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
    ?>    
}
</script>
</head>
<body>
<div id = "datadiv"><?php
    echo file_get_contents("decks/main.txt");
?></div>    
<div id = "shadowdatadiv"  style = "display:none" class = "no-mathjax"><?php
    echo file_get_contents("decks/main.txt");
?></div>    
<div id = "extdatadiv" style = "display:none"><?php
if(isset($_GET['url'])){
    $urlfilename = $_GET['url'];
    echo file_get_contents($_GET['url']);
}?></div>
<div id = "pageNumberDiv" style = "display:none"><?php
 if(isset($_GET['page'])){
    $pagenumber = $_GET['page'];
    echo $pagenumber;
}   
?></div>
<div id = "mainpage">
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