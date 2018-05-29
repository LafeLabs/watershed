<?php

$files = scandir(getcwd()."/figures");

foreach($files as $value){
    if($value != "." && $value != ".."){
        echo "<p><img src = \"figures/".$value."\"/></p>";
    }
}
?>
<style>    
img{
    width:500px;   
}
</style>
<a href = "editor.php">editor.php</a>