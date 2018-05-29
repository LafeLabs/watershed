<?php

$files = scandir(getcwd()."/latex");

foreach($files as $value){
    if($value != "." && $value != ".."){
        echo "<p><a href = \"latex/".$value."\">latex/".$value."</a></p>";
    }
}
?>
<a href = "editor.php">editor.php</a>