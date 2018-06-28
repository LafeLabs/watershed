 <!doctype html>
<html>
<head>
<title>Function Plotter</title>
<!-- 
PUBLIC DOMAIN, NO COPYRIGHTS, NO PATENTS.

EVERYTHING IS PHYSICAL
EVERYTHING IS FRACTAL
EVERYTHING IS RECURSIVE

-->

<!--Stop Google:-->
<META NAME="robots" CONTENT="noindex,nofollow">

<script id = "topfunctions"><?php
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
?></script>

<?php
    $data = file_get_contents("javascript/jslibrary.txt");
    echo $data;    
?>

</head>
<body>
<div id = "plotdatadiv" style = "display:none;"><?php
    echo file_get_contents("json/plotdata.txt");
?></div>
    
<div id = "jsondatadiv" style = "display:none;"><?php

if(isset($_GET['url'])){
    $urlfilename = $_GET['url'];
    $svgcode = file_get_contents($_GET['url']);
    $topcode = explode("</currentjson>",$svgcode)[0];
    $outcode = explode("<currentjson>",$topcode)[1];
    echo $outcode;
}
else{
    echo file_get_contents("json/currentjson.txt");
}

?></div>

<div id = "page">
<a id = "editorlink" href = "equationeditor.php">equationeditor.php</a>
<a id  = "uplink" href = "../">../</a>
<a id  = "svgindexlink" href = "svg/index.html">SVG Plots</a>

<canvas id="mainCanvas"></canvas>
<img id = "mainImage"/>

<div id = "actionbox">Action:<input id = "actioninput"/></div>
<div id = "inputbox">Image URL:<input id = "imgurlinput"/></div>
<textarea id = "eqtext"></textarea>
<textarea id="textIO"></textarea> 
<table id = "plotparamstable">
</table>
<table id = "funcparamstable">
</table>
<div id = "imgurldata" style = "display:none"><?php 
if(isset($_GET['url'])){
    $urlfilename = $_GET['url'];
    $svgcode = file_get_contents($_GET['url']);
    $topcode = explode("</imgurl>",$svgcode)[0];
    $outcode = explode("<imgurl>",$topcode)[1];
    echo $outcode;
}
?></div>
<div id = "shadowequation" style = "display:none" class = "no-mathjax"><?php

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

?></div>
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
    <?php
$svgs = scandir(getcwd()."/svg");
$svgs = array_reverse($svgs);
foreach($svgs as $value){
    if($value != "." && $value != ".." && substr($value,-4) == ".svg"){
        echo "\n<p><a href = \"index.php?url=";
        echo "svg/".$value;
        echo "\"><img src = \"";

        $svgcode = file_get_contents("svg/".$value);
        $topcode = explode("</imgurl>",$svgcode)[0];
        $outcode = explode("<imgurl>",$topcode)[1];
        if(strlen($outcode) > 4){
            $imgurl =  trim($outcode);
        }
        else{
            $imgurl = "svg/".$value;
        }
        echo $imgurl;
        echo "\"></a></p>\n";
    }
}
?>

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