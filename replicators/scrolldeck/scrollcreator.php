<?php
    $name = $_POST['name'];
    $data = " ";
    $file = fopen("scrolls/".$name.".txt","w");// create new file with this name
    fwrite($file,$data); //write data to file
    fclose($file);  //close file
?>