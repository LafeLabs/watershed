<!doctype html>
<html>
<body>
<?php 
$dirlist = scandir(getcwd());
for($index =0;$index < count($dirlist);$index++){
    if($dirlist[$index][0] <> "." && !is_dir($dirlist[$index]) && substr($dirlist[$index],-4) == ".svg"){
        echo "    <a href = \"";
        echo $dirlist[$index];
        echo "\"><img src = \"";
        echo $dirlist[$index];
        echo "\"/></a>\n";
    }
}
?>
<style>
body{
    color:#00ff00;
    background-color:black;
    font-family:courier;
    font-size:1.2em;
    PADDING:1EM 1EM 1EM 1EM;
}
img{
    display:block;
    margin:auto;
    width:80%;
}
a{
    color:#00ff00;                
}
</style>
</body>
</html>