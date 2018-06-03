 <!doctype html>
<html>
<head>
<title>Function Plotter</title>
<!-- 
PUBLIC DOMAIN, NO COPYRIGHTS, NO PATENTS.
-->

<script id = "topfunctions">
<?php

if(isset($_GET['url'])){
    $urlfilename = $_GET['url'];
    if(substr($urlfilename,-4) == ".svg"){
        $svgcode = file_get_contents($_GET['url']);
        $topcode = explode("</topfunctions>",$svgcode)[0];
        $jsoncode = explode("<topfunctions>",$topcode)[1];
        echo $jsoncode;
    }
    else{
        echo file_get_contents($_GET['url']);
    }
}
else{
    $data = file_get_contents("javascript/topfunctions.txt");
    echo $data;
}
?>   
</script>

<?php
    $data = file_get_contents("javascript/jslibrary.txt");
    echo $data;    
?>

</head>
<body>
<div id = "datadiv" style = "display:none">
<?php
    $data = file_get_contents("svg/index.html");
    echo $data;    
?>
</div>
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