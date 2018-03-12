<?php
/* javascript this pairs with:

document.getElementById("savesvg").onclick = function(){
        currentSVG = "<svg width=\"" + innerWidth.toString() + "\" height=\"" + innerHeight.toString() + "\" viewbox = \"0 0 " + innerWidth.toString() + " " + innerHeight.toString() + "\"  xmlns=\"http://www.w3.org/2000/svg\">\n";
        redraw();
        currentSVG += "</svg>";
        document.getElementById("textIO").value = currentSVG;
        var httpc = new XMLHttpRequest();
        var url = "svgsaver.php";        
        httpc.open("POST", url, true);
        httpc.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        httpc.send("data=" + document.getElementById("textIO").value);//send text to saver.php
 }    
 
 */

    $str = $_POST["data"]; //get data 
    $filename = "font.svg";  //filename
    $file = fopen($filename,"w");// create new file with this name
    fwrite($file,$str); //write data to file
    fclose($file);  //close file
?>