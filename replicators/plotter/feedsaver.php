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
    $data = $_POST["data"]; //get data 
    $filename = "svg".time().".svg";
    $file = fopen("svg/".$filename,"w");// create new file with this name
    fwrite($file,$data); //write data to file
    fclose($file);  //close file
    $oldfeed = file_get_contents("svg/index.html"); 
    $file = fopen("svg/index.html","w");// create new file with this name
    
    fwrite($file,"<p><img src = \"".$filename."\"></p>\n".$oldfeed); //write data to file
    fclose($file);  //close file
?>
