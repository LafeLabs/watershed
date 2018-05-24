<?php
    $data = file_get_contents("html/page.txt"); 

    $filename = "page".time().".txt";
    $timestamp = substr(substr($filename,4),0,-4);
    $file = fopen("pages/".$filename,"w");// create new file with this name
    fwrite($file,$data); //write data to file
    fclose($file);  //close file

    $oldfeed = file_get_contents("pages/index.html"); 
    $file = fopen("pages/index.html","w");// create new file with this name
    fwrite($file,"<p><a href = \"../?url=pages/".$filename."\">direct link to page saved at".gmdate("Y-m-d H:i:s", $timestamp)."(GMT) </a>\n"."(<a href = \"".$filename."\">".$filename."</a>)</p>".$oldfeed); //write data to file
    fclose($file);  //close file
    
    echo "<p><a href = \"index.php?url=pages/".$filename."\">direct link to page saved at".gmdate("Y-m-d H:i:s", $timestamp)."(GMT)</a></p>\n";
    
?>
<p>
<a href = "pages/">pages/</a>    
<br/>
<a href = "pageeditor.php">pageeditor.php</a>
</p>
<style>
    p{
      font-size:5em;  
    }
</style>