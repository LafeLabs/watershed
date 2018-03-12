<?php
/* javascript this pairs with:

function savephp(){
    currentData = document.getElementById("scroll").innerHTML;       
    var httpc = new XMLHttpRequest();
    var url = "saver.php";        
    httpc.open("POST", url, true);
    httpc.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    httpc.send("data=" + currentData);//send text to saver.php
}

*/
    $str = $_POST["data"]; //get data 
    $filename = "data.txt";  //put it data file
    $file = fopen($filename,"w");// create new file with this name
    fwrite($file,$str); //write data to file
    fclose($file);  //close file
?>