 <?php
/* javascript this pairs with:

 document.getElementById("publish").onclick = function(){
    data = encodeURIComponent(document.getElementById("textIO").value);
    var httpc = new XMLHttpRequest();
    var url = "feedsaver.php";        
    httpc.open("POST", url, true);
    httpc.setRequestHeader("Content-Type", "application/x-www-form-urlencoded;charset=utf-8");
    httpc.send("data="+data);//send text to feedsaver.php

 }
*/
    $olddata = file_get_contents("json/feed.txt");
    $data = $_POST["data"]; //get data 
    $filename = "json/feed.txt";
    $file = fopen($filename,"w");// create new file with this name
    fwrite($file,$data.",\n".$olddata); //write data to file
    fclose($file);  //close file
?>