<?php
if(isset($_GET['name'])){
    $name = $_GET['name'];
    mkdir($name);

    $data = " ";
    $file = fopen("scrolls/".$name.".txt","w");// create new file with this name
    fwrite($file,$data); //write data to file
    fclose($file);  //close file
   
}
?>
<p>
add to the url above the following: "?name=[name of new scroll]" and reload the browser.     
</p>
<a href = "editor.php">editor.php</a>