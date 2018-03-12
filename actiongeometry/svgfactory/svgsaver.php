<?php
/* javascript this pairs with:

    buttons0630[4].onclick = function(){//SAVE SVG 
        exportSVG();
        var httpc = new XMLHttpRequest();
        var url = "svgsaver.php";        
        httpc.open("POST", url, true);
        httpc.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        httpc.send("data=" + document.getElementById("textIO0630").value + "&filename=" + inputs0630[6].value);//send text to saver.php
    }

*/

    $str = $_POST["data"]; //get data 
    $filename = "svg/".$_POST["filename"].".svg";  //filename
    $file = fopen($filename,"w");// create new file with this name
    fwrite($file,$str); //write data to file
    fclose($file);  //close file
?>
