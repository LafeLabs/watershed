<?php


function listfiles($localpath){
    $fullpath = getcwd().$localpath;
    $files = scandir($fullpath);
    foreach($files as $filename){
        if($filename != "." && $filename != ".." && is_dir($fullpath."/".$filename)){
           echo  "\n<li class = \"one\"><a href = \"".$localpath."/".$filename."/\">".$filename."/</a></li>\n";
           $nextpath = $localpath."/".$filename;
            echo "<ul>";
           listfiles($nextpath);
            echo "</ul>";
        }
    }
}


echo "<ul>\n";

listfiles("");

echo "</ul>\n";

?>
<p><a href = "index.php">index.php</a></p>
<p><a href = "editor.php">editor.php</a></p>

<style>
    body{
        font-size:2em;
    }
    ul ul{
        font-size:0.5em;
        margin-left:6em;
    }
    
</style>