<?php

$name = $_REQUEST["name"];

mkdir($name);
mkdir($name."/html");
mkdir($name."/css");
mkdir($name."/javascript");
mkdir($name."/php");
mkdir($name."/json");
mkdir($name."/bytecode");


$htmlfiles = scandir("html");
foreach($htmlfiles as $value){
    if($value != "." && $value != ".."){
        $localfilename = $value;
        $source = "html/".$localfilename;
        $destination = $name."/html/".$localfilename;
        copy($source,$destination);                
    }
}
$cssfiles = scandir("css");
foreach($cssfiles as $value){
    if($value != "." && $value != ".."){
        $localfilename = $value;
        $source = "css/".$localfilename;
        $destination = $name."/css/".$localfilename;
        copy($source,$destination);                
    }
}
$javascriptfiles = scandir("javascript");
foreach($javascriptfiles as $value){
    if($value != "." && $value != ".."){
        $localfilename = $value;
        $source = "javascript/".$localfilename;
        $destination = $name."/javascript/".$localfilename;
        copy($source,$destination);                
    }
}
$jsonfiles = scandir("json");
foreach($jsonfiles as $value){
    if($value != "." && $value != ".."){
        $localfilename = $value;
        $source = "json/".$localfilename;
        $destination = $name."/json/".$localfilename;
        copy($source,$destination);                
    }
}
$phpfiles = scandir("php");
foreach($phpfiles as $value){
    if($value != "." && $value != ".."){
        $localfilename = $value;
        $source = "php/".$localfilename;
        $destination = $name."/php/".$localfilename;
        copy($source,$destination);                
    }
}
$bytecodefiles = scandir("bytecode");
foreach($bytecodefiles as $value){
    if($value != "." && $value != ".."){
        $localfilename = $value;
        $source = "bytecode/".$localfilename;
        $destination = $name."/bytecode/".$localfilename;
        copy($source,$destination);                
    }
}

$localfiles = scandir(getcwd());
foreach($localfiles as $value){
    if(!is_dir($value)){
        $localfilename = $value;
        $source = $localfilename;
        $destination = $name."/".$localfilename;
        copy($source,$destination);                
    }
}

?>
<a href = "<?php

echo $name;

?>/index.php"><?php
echo $name;
?>/index.php</a>


