<!doctype html>
<html>
<head>
<title>Wall History</title>
<!-- 
PUBLIC DOMAIN, NO COPYRIGHTS, NO PATENTS.

EVERYTHING IS PHYSICAL
EVERYTHING IS FRACTAL
EVERYTHING IS RECURSIVE

-->
<!--Stop Google:-->
<META NAME="robots" CONTENT="noindex,nofollow">
</head>    
<body>
<p>
    <a href = "walleditor.php">walleditor</a>
</p>
<?php

$files = array_reverse(scandir(getcwd()."/feed"));

foreach($files as $value){
    if($value != "." && $value != ".." && substr($value,0,4) == "wall"){
  //      echo $value."<br/>".substr(substr($value,4),0,-4)."<br/>";
        $timestamp = substr(substr($value,4),0,-4);

        echo "<p>\n";
        echo "date and time:";
        echo gmdate("Y-m-d H:i:s", $timestamp)."\n";     
        echo ",\nfilesize=";
        echo filesize(getcwd()."/feed/".$value);
        echo "bytes";
        echo "<br/>\n";
        echo "<a href = \"feed/".$value."\">feed/".$value."</a><br/>\n";
        echo "<a href = \"index.php?url=feed/".$value."\">index.php?url=feed/".$value."</a>\n";
        echo "</p>\n";
    }
}

?>
<style>
body{
    font-size:1.5em;
    font-family:helvetica;
}
</style>
</body>
</html>
