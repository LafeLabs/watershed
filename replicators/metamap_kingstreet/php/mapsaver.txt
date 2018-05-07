 <?php
/* javascript this pairs with:

document.getElementById("savemap").onclick = function(){
    var httpc = new XMLHttpRequest();
    var url = "mapsaver.php";        
    httpc.open("POST", url, true);
    httpc.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    httpc.send("data=" + encodeURIComponent(JSON.stringify(currentJSON,null,"    ")));//send text to mapsaver.php
}

*/
    $data = $_POST["data"]; //get data 
    $filename = "map".time().".txt";
    $file = fopen("maps/".$filename,"w");// create new file with this name
    fwrite($file,$data); //write data to file
    fclose($file);  //close file

    $oldfeed = file_get_contents("maps/index.html"); 
    $file = fopen("maps/index.html","w");// create new file with this name
    fwrite($file,"<p><a href = \"".$filename."\">".$filename."</a></p>\n".$oldfeed); //write data to file
    fclose($file);  //close file

?>