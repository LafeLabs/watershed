<!doctype html>
<html>
<head>
<title>index</title>
<!-- 
PUBLIC DOMAIN, NO COPYRIGHTS, NO PATENTS.

Trust model: Trust all non-coders implicitly, assume the worst from anyone who makes any money of computer industry in any way.  All professional coders are the Enemy.

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
</head>
<body>
    <a id = "editorlink" href = "editor.php">Code Editor</a>
    <a id = "pageeditorlink" href = "pageeditor.php">Page Editor</a>
<div id = "page">
<?php
echo file_get_contents("html/page.txt");
?>
</div>
<style>
h1,h2,h3,h4,h5{
    width:100%;
    text-align:center;
}
#page{
    position:absolute;
    overflow:scroll;
    text-align:justify;
    width:100%;
    top:5em;
    bottom:0px;
    padding:1em 1em 1em 1em;
}
#page img{
    width:80%;
    display:block;
    margin:auto;
}
#pageeditorlink{
    position:absolute;
    top:0.5em;
    left:2em;
}
#editorlink{
    position:absolute;
    top:0.5em;
    right:2em;
}
</style>
</body>
</html>