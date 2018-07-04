<?php

$files = scandir(getcwd());

echo "<ul>\n";

foreach($files as $value){
    if($value != "." && $value != ".."){
        if(is_dir($value)){
            echo "\n<li class = \"one\"><a href = \"".$value."/\">".$value."/</a></li>\n";
            $files2 = scandir(getcwd()."/".$value);
            echo "<li><ul>";
            foreach($files2 as $value2){
                $fullpath2 = getcwd()."/".$value."/".$value2;
                if($value2 != "." && $value2 != ".." && is_dir($fullpath2)){
                    
                        
                        echo "\n<li  class = \"two\"><a href = \"".$value."/".$value2."\">".$value2."/</a></li>\n";
                        
                        $files3 = scandir($fullpath2);
                        echo "<ul>";
                        foreach($files3 as $value3){
                            $fullpath3 = $fullpath2."/".$value3;
                            if($value3 != "." && $value3 != ".." && is_dir($fullpath3)){
                                    echo "\n<li  class = \"three\"><a href = \"".$value."/".$value2."/".$value3."/\">".$value3."/</a></li>\n";
                                    
                            }   
                        }
                        echo "</ul></li>";
                }
            }
            echo "</ul></li>";
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
    .one{
        font-size:1em;
    }
    .two{
        font-size:0.5em;
    }
    .three{
        font-size:0.25em;
    }
    li ul{
        position:relative;
        left:10em;
        top:-2em;
        color:red;
    }
    
</style>