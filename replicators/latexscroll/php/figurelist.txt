<?php

$files = scandir(getcwd()."/figures");

foreach($files as $value){
    if($value != "." && $value != ".."){
        echo "<p>figures/".$value."</p>";
        echo "<p><a href = \"figures/".$value."\"><img src = \"figures/".$value."\"/></a></p>";
    }
}
?>
<style>    
img{
    width:500px;   
}
p{
    font-size:24px;
    font-family:Helvetica;
}
</style>
<a href = "editor.php">editor.php</a>