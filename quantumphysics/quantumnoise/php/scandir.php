<?php
$files = scandir(getcwd());
echo "<ul>\n";
foreach($files as $value){
    if($value != "." && $value != ".."){
        $localfilename = $value;
        echo "<li>";
        if(is_dir($value)){
            echo "<a href = \"";
            echo $value;
            echo "/\">";
            echo $value;
            echo "/</a></li>\n";                
        }
        else{
            echo $value;
            echo "</li>\n";    
        }
    }
}
echo "\n</ul>";
?>