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
    $svgcode = file_get_contents($_GET['url']);
    $topcode = explode("</topfunctions>",$svgcode)[0];
    $outcode = explode("<topfunctions>",$topcode)[1];
    echo $outcode;
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
<a id = "editorlink" href = "editor.php">editor.php</a>
<a id  = "uplink" href = "../">../</a>

<canvas id="mainCanvas"></canvas>
<textarea id = "eqtext"></textarea>
<textarea id="textIO"></textarea> 
<table id = "plotparamstable">
</table>
<table id = "funcparamstable">
</table>
<div id = "shadowequation" style = "display:none" class = "no-mathjax">
<?php

if(isset($_GET['url'])){
    $urlfilename = $_GET['url'];
    $svgcode = file_get_contents($_GET['url']);
    $topcode = explode("</equation>",$svgcode)[0];
    $outcode = explode("<equation>",$topcode)[1];
    echo $outcode;
}
else{
    $data = file_get_contents("html/equation.txt");
    echo $data;
}

?>
</div>
<div id = "equation">
<?php

if(isset($_GET['url'])){
    $urlfilename = $_GET['url'];
    $svgcode = file_get_contents($_GET['url']);
    $topcode = explode("</equation>",$svgcode)[0];
    $outcode = explode("<equation>",$topcode)[1];
    echo $outcode;
}
else{
    $data = file_get_contents("html/equation.txt");
    echo $data;
}
?>
</div>
    <div class = "button" id = "publish">PUBLISH</div>
    <div id = "scroll">
    </div>
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
<?php
        echo "\nredraw();\n";
        echo "\nfunction redraw(){\n";
        $data = file_get_contents("javascript/redraw.txt");
        echo $data;
        echo "\n}\n";
?>
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