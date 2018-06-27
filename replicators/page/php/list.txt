<?php

$files = scandir(getcwd());

echo "<ul>\n";

foreach($files as $value){
    if($value != "." && $value != ".."){
        if(is_dir($value)){
            echo "\n<li><a href = \"".$value."/\">".$value."/</a></li>\n";
        }
    }
}
echo "\n</ul>\n";
?>
<p><a href = "index.php">index.php</a></p>
<p><a href = "editor.php">editor.php</a></p>

<style>
    body{
        font-size:2em;
    }
</style>