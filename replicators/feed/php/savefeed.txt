<?php
    $data = file_get_contents("html/feed.txt"); 

    $filename = "feed".time().".txt";
    $timestamp = substr(substr($filename,4),0,-4);
    $file = fopen("feeds/".$filename,"w");// create new file with this name
    fwrite($file,$data); //write data to file
    fclose($file);  //close file

    $oldfeed = file_get_contents("feeds/index.html"); 
    $file = fopen("feeds/index.html","w");// create new file with this name
    fwrite($file,"<p>(<a href = \"".$filename."\">".$filename."</a>)</p>".$oldfeed); //write data to file
    fclose($file);  //close file
    
?>
<p>
<a href = "index.php">index.php/</a>    
</p>
<style>
    p{
      font-size:5em;  
    }
</style>