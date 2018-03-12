<?php
$filename = $_REQUEST["url"];//get url, which points to an SVG with JSON in it eg 
$svgdata = file_get_contents($filename);
$foo = explode("<json>",$svgdata)[1];
$jsondata = explode("</json>",$foo)[0];
echo $jsondata;
?>