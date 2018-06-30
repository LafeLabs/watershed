<?php
    $data = file_get_contents("html/wall.txt"); 

    $filename = "wall".time().".txt";
    $timestamp = substr(substr($filename,4),0,-4);
    $file = fopen("feed/".$filename,"w");// create new file with this name
    fwrite($file,$data); //write data to file
    fclose($file);  //close file

    $oldfeed = file_get_contents("feed/index.html"); 
    $file2 = fopen("feed/index.html","w");// create new file with this name
    fwrite($file2,"<p><a href = \"".$filename."\">".$filename."</a></p>".$oldfeed); //write data to file
    fclose($file2);  //close file
    
?>