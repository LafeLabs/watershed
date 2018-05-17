<?php
    $data = file_get_contents("json/currentjson.txt"); 

    $filename = "map".time().".txt";
    $file = fopen("maps/".$filename,"w");// create new file with this name
    fwrite($file,$data); //write data to file
    fclose($file);  //close file

    $oldfeed = file_get_contents("maps/index.html"); 
    $file = fopen("maps/index.html","w");// create new file with this name
    fwrite($file,"<p><a href = \"".$filename."\">".$filename."</a></p>\n".$oldfeed); //write data to file
    fclose($file);  //close file

?>
<a href = "editor.php">editor.php</a>