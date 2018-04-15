 <!doctype html>
<html>
<head>
<title>Calculator</title>
<!-- 
PUBLIC DOMAIN, NO COPYRIGHTS, NO PATENTS.
-->

<script src="https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.0/MathJax.js?config=TeX-AMS-MML_HTMLorMML"></script>
    <script>
    MathJax.Hub.Config({
      tex2jax: {
        inlineMath: [['$','$'], ['\\(','\\)']],
        processEscapes: true
      }
    });//			MathJax.Hub.Typeset();//tell Mathjax to update the math
</script>
</head>
<body>
<div id = "datadiv" style = "display:none">
<?php
    $data = file_get_contents("json/feed.txt");
    echo $data;    
?>
</div>
<div id = "page">
<?php
    $data = file_get_contents("html/page.txt");
    echo $data;    
?>
</div>
<script id = "topfunctions">
<?php
    $data = file_get_contents("javascript/topfunctions.txt");
    echo $data;
?>   
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