<textarea id = "textIO" style = "width:100%;height:80%;"></textarea>
<div style = "display:none" id = "datadiv">
<?php
echo file_get_contents("json/stationjson.txt");
?>
</div>
<script>
stationjson = JSON.parse(document.getElementById("datadiv").innerHTML);

document.getElementById("textIO").value = JSON.stringify(stationjson,null,"    ");    

/*    
for(var index = 0;index < stationjson.length;index++){
   lat = parseFloat(stationjson[index].latlon.split(",")[0]);
   lon = parseFloat(stationjson[index].latlon.split(",")[1]);
    lat = Math.round(lat*10000)/10000;
    lon = Math.round(lon*10000)/10000;
    stationjson[index].latlon = lat.toString() + "," + lon.toString();
}

for(var index = 0;index < stationjson.length;index++){
    stationjson[index].transfer = false;
    if(stationjson[index].name == "Metro Center"){
        stationjson[index].transfer = true;
    }
    if(stationjson[index].name == "Rosslyn"){
        stationjson[index].transfer = true;
    }
    if(stationjson[index].name == "L'Enfant Plaza"){
        stationjson[index].transfer = true;
    }
    if(stationjson[index].name == "Gallery Pl-Chinatown"){
        stationjson[index].transfer = true;
    }
    if(stationjson[index].name == "Fort Totten"){
        stationjson[index].transfer = true;
    }
    if(stationjson[index].name == "East Falls Church"){
        stationjson[index].transfer = true;
    }
    if(stationjson[index].name == "Stadium-Armory"){
        stationjson[index].transfer = true;
    }
    if(stationjson[index].name == "Pentagon"){
        stationjson[index].transfer = true;
    }
    if(stationjson[index].name == "King St-Old Town"){
        stationjson[index].transfer = true;
    }
}

stationjson[index].endofline = false;
    if(stationjson[index].name == "Huntington"){
        stationjson[index].endofline = true;
    }
    if(stationjson[index].name == "Fort Totten"){
        stationjson[index].endofline = true;
    }
    if(stationjson[index].name == "Franconia-Springfield"){
        stationjson[index].endofline = true;
    }
    if(stationjson[index].name == "Largo Town Center"){
        stationjson[index].endofline = true;
    }
    if(stationjson[index].name == "Glenmont"){
        stationjson[index].endofline = true;
    }
    if(stationjson[index].name == "Shady Grove"){
        stationjson[index].endofline = true;
    }
    if(stationjson[index].name == "Greenbelt"){
        stationjson[index].endofline = true;
    }
    if(stationjson[index].name == "New Carrollton"){
        stationjson[index].endofline = true;
    }
    if(stationjson[index].name == "Vienna/Fairfax-GMU"){
        stationjson[index].endofline = true;
    }
    if(stationjson[index].name == "Wiehle-Reston East"){
        stationjson[index].endofline = true;
    }
    if(stationjson[index].name == "Branch Ave"){
        stationjson[index].endofline = true;
    }*/

</script>
<a style = "font-size:10em" href = "editor.php">editor.php</a>