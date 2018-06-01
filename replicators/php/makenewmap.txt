<?php
if(isset($_GET['name'])){
    $name = $_GET['name'];
    mkdir($name);
    $replicatorcode = file_get_contents("https://raw.githubusercontent.com/LafeLabs/watershed/master/replicators/metamap/php/replicator.txt");
    $file = fopen($name."/replicator.php","w");// create new file with this name
    fwrite($file,$replicatorcode); //write data to file
    fclose($file);  //close file
   
    echo "<a href =\"".$name."/"."\">".$name."</a>";
    
}
?>
<p>
add to the url above the following: "?name=[name of new directory to put page into]" and reload the browser.     
</p>
<a href = "editor.php">editor.php</a>