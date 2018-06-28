<!doctype html>
<html>
<head>
<title>index</title>
<!-- 
PUBLIC DOMAIN, NO COPYRIGHTS, NO PATENTS.

EVERYTHING IS PHYSICAL
EVERYTHING IS FRACTAL
EVERYTHING IS RECURSIVE

-->
<!--Stop Google:-->
<META NAME="robots" CONTENT="noindex,nofollow">
<!-- links to MathJax JavaScript library, un-comment to use math-->
<!--

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

-->
</head>
<body>
    <div id = "extdatadiv" style = "display:none"><?php
if(isset($_GET['url'])){
    echo file_get_contents($_GET['url']);
}?>
</div>
    <a id = "creatorlink" href = "metacreator.php">metacreator.php</a>
    <a id = "pageeditorlink" href = "pageeditor.php">pageeditor.php</a>
<div id = "page">
<?php
echo file_get_contents("html/page.txt");
?>
</div>
<script>
    if(document.getElementById("extdatadiv").innerHTML.length > 10){
        document.getElementById("page").innerHTML = document.getElementById("extdatadiv").innerHTML;
    }
    
</script>
<style>
h1,h2,h3,h4,h5{
    width:100%;
    text-align:center;
}
#page{
    position:absolute;
    overflow:scroll;
    text-align:justify;
    width:90%;
    top:5em;
    bottom:0px;
    padding:1em 1em 1em 1em;
    font-size:24px;
}
#page img{
    width:50%;
    display:block;
    margin:auto;
}
#pageeditorlink{
    position:absolute;
    top:0.5em;
    left:2em;
    font-size:24px;
}
#creatorlink{
    position:absolute;
    top:0.5em;
    right:2em;
    font-size:24px;
}
</style>
</body>
</html>