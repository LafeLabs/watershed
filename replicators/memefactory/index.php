<!doctype html>
<html>
<head>
<title>index</title>
<!-- 
PUBLIC DOMAIN, NO COPYRIGHTS, NO PATENTS.
-->
</head>
<body>
<div id = "datadiv" style = "display:none">
<?php
echo file_get_contents("json/currentjson.txt");
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
</script>
<script>
redraw();
function redraw(){
<?php
echo file_get_contents("javascript/redraw.txt");
?>
}
</script>

<script id = "pageevents">
<?php
echo file_get_contents("javascript/pageactions.txt");
?>
</script>
<?php
    echo "<style>\n";
    echo file_get_contents("css/style.txt");
    echo "</style>\n";
?>
</body>
</html>