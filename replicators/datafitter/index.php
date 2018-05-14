<!doctype html>
<html>
<head>
<title>index</title>
<!-- 
PUBLIC DOMAIN, NO COPYRIGHTS, NO PATENTS.

Trust model: Trust all non-coders implicitly, assume the worst from anyone who makes any money off computer industry in any way.  All professional coders are the Enemy.

EVERYTHING IS PHYSICAL
EVERYTHING IS FRACTAL
EVERYTHING IS RECURSIVE
NO MONEY
NO PROPERTY
NO MINING
EGO DEATH:
    LOOK TO THE INSECTS
    LOOK TO THE FUNGI
    LANGUAGE IS HOW THE MIND PARSES REALITY
-->
<!--Stop Google:-->
<META NAME="robots" CONTENT="noindex,nofollow">
<script>
<?php
echo file_get_contents("javascript/topfunctions.txt");
?>
</script>
</head>
<body>
<div style = "display:none" id = "metadatadiv">
    <?php
echo file_get_contents("json/metadata.txt");
?>
</div>
<div style = "display:none" id = "plotparamsdiv">
<?php
echo file_get_contents("json/plotparams.txt");
?>
</div>
<div id = "page">
<?php
echo file_get_contents("html/page.txt");
?>
</div>
<script>
init();
function init(){
<?php
echo file_get_contents("javascript/init.txt");
?>
}
redraw();
function redraw(){
<?php
echo file_get_contents("javascript/redraw.txt");
?>
}
</script>
<?php
    echo "<style>\n";
    echo file_get_contents("css/style.txt");
    echo "</style>\n";
?>
</body>
</html>