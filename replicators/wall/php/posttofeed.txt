<?php
/* javascript this pairs with:

document.getElementById("publishbutton").onclick = function(){
    textvalue = document.getElementById("textinput").value;
    imagesrc = document.getElementById("urlinput").value;
    
    addedhtml = "\n<img src = \"" + imagesrc + "\"/>\n";
    addedhtml += "\n<p>" + textvalue + "</p>\n";


    data = encodeURIComponent(addedhtml);
    var httpc = new XMLHttpRequest();
    var url = "posttofeed.php";        
    httpc.open("POST", url, true);
    httpc.setRequestHeader("Content-Type", "application/x-www-form-urlencoded;charset=utf-8");
    httpc.send("data="+data);//send text to posttofeed.php
}
 
*/
    $data = $_POST["data"]; //get data 
    $filename = "html/feed.txt";
    
    $oldfeed = file_get_contents("html/feed.txt"); //get old feed
    $file = fopen("html/feed.txt","w");// open the file
    fwrite($file,$data.$oldfeed); //write to file with new data at top
    fclose($file);  //close file
?>
