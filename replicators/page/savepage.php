<?php
    $data = file_get_contents("html/page.txt"); 

    $filename = "page".time().".txt";
    $file = fopen("pages/".$filename,"w");// create new file with this name
    fwrite($file,$data); //write data to file
    fclose($file);  //close file

    $oldfeed = file_get_contents("pages/index.html"); 
    $file = fopen("pages/index.html","w");// create new file with this name
    fwrite($file,"<p><a href = \"".$filename."\">".$filename."</a></p>\n".$oldfeed); //write data to file
    fclose($file);  //close file

?>
<a href = "pageeditor.php">editor.php</a>