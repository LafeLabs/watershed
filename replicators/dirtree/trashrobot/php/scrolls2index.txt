<?php
/*
scrolls2index.php
convert all the scrolls other than main, notes, and replicator into their own directories
get all the files in scrolls/ directory.  for each file that is NOT main, notes or repicator, test to see if /scrolls/[filename-.txt] exists. if not, mkdir that directory.
splice scroll into index.html template, write to /scrolls/[dir]/index.html


*/


$files = scandir(getcwd()."/scrolls/");


$outstring = "";

foreach($files as $value){
    if($value != "." && $value != ".."){
        if(!is_dir($value)){
            if($value != "main" && $value != "replicator" && $value != "notes"){
                $newdirname =  substr($value,0,-4);
                mkdir(getcwd()."/scrolls/".$newdirname);    
                
            }
        }
    }
}

//echo $outstring;

?>