<!doctype html>
<html>
<head>
    <title>latlon</title>
    <!--
    PUBLIC DOMAIN, NO COPYRIGHTS, NO PATENTS.

    NO MONEY
    NO MINING
    NO PROPERTY
    EVERYTHING IS RECURSIVE
    EVERYTHING IS FRACTAL
    EVERYTHING IS PHYSICAL
    [EGO DEATH]:
        LOOK TO THE FUNGI
        LOOK TO THE INSECTS
        LANGUAGE IS HOW THE MIND PARSES REALITY

    Please note that this code is all client-side and does not connect to any database.  The information here is
    not connected in any way to anything, not your local filesystem on your machine nor any remote server or cloud or other Evil entity.   Please keep it that way in future itterations of this code!  

    -->
<script>

function latlon2xy(latlonin) {
    
    //input to this function is a string of the form "lattitude,longitude", where lat and lon are in decimal degrees
    var lat0 = parseFloat(currentJSON.latlon0.split(",")[0]);   //lattitude to 10 meter precision
    var coslat = Math.cos(lat0*Math.PI/180);//convert to radians, take cosine of lattitude
    var lon0 =  parseFloat(currentJSON.latlon0.split(",")[1]);//longitude to 10 meter precision
    var unitfeet = currentJSON.unitfeet;//unit length in feet

    var digits = 1;//1;//0 digits = 555 feet, 1 is 55 feet, 2 is 5.5  feet
    var precision = Math.pow(10,digits);

    var lat1 = parseFloat(latlonin.split(",")[0]);
    var lon1 = parseFloat(latlonin.split(",")[1]);
    //from the original definition of the meter:
    //90 degrees lattitude = 10,000,000 meters = 32808399 feet
    //1 degree lattitude = 10,000,000 meters/90 = 111111.1 meters = 111 km
    //0.1 degree = 11 km
    //0.01 degree = 1.1 km
    //0.001 degree = 110 m
    //0.0001 degree = 11 m
    //1 meter = 3.28084 feet
    //1 degree lattitude = 111111.1(meters)*3.28084(feet/meter) = 364538 feet
    //1 degree longitude = 1 degre lattitude X cos(lattitude) = 283699 feet at 38.8895 N
    var deltaxfeet = Math.round((lon1 - lon0)*364538*coslat);//convert longitude difference to feet
    var deltayfeet = Math.round((lat1 - lat0)*364538);//convert lattitude difference to feet
    var deltax = Math.round(precision*deltaxfeet/unitfeet)/precision;//convert from feet to "units" based on unitfeet
    var deltay = Math.round(precision*deltayfeet/unitfeet)/precision;//convert from feet to "units" based on unitfeet
    return deltax.toString() + "," + deltay.toString();
}


    
</script>
    
</head>
<body>
<div id = "datadiv" style = "display:none">
<?php
    echo file_get_contents("json/currentjson.txt");
?>
</div>    
<a href = "editor.php" id = "editorlink">editor.php</a>
<a href = "index.php" id = "indexlink">index.php</a>

<div id = "gpsButton">WHERE AM I?</div>
<input id = "outputfield"/>

<input id = "markerinput"/>

<script>

currentJSON = JSON.parse(document.getElementById("datadiv").innerHTML);

document.getElementById("outputfield").onchange = function(){
        lat = parseFloat(this.value.split(",")[0]);
        lon = parseFloat(this.value.split(",")[1]);
        markervalue = "@(" + latlon2xy(lat.toString()  + "," + lon.toString()) + ") #" + currentJSON.hashtag;
        document.getElementById("markerinput").value = markervalue;
}

document.getElementById("gpsButton").onclick = function() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition);
        var copyText = document.getElementById("outputfield");
        /* Select the text field */
        copyText.select();
        /* Copy the text inside the text field */
        document.execCommand("Copy");

        
    } else {
        alert("Geolocation is not supported by this browser.");
    }
    function showPosition(position) {
        lat = Math.round(10000*position.coords.latitude)/10000;
        lon = Math.round(10000*position.coords.longitude)/10000;
        document.getElementById("outputfield").value = lat.toString()  + "," + lon.toString();
        
        markervalue = "@(" + latlon2xy(lat.toString()  + "," + lon.toString()) + ") #" + currentJSON.hashtag;
        document.getElementById("markerinput").value = markervalue;
    }
}
</script>
<style>
    #editorlink{
        position:absolute;
        top:10px;
        right:10px;
        font-family:courier;
        font-size:22px;
    }
    #indexlink{
        position:absolute;
        top:10px;
        left:10px;
        font-family:courier;
        font-size:22px;
    }

     #outputfield{
        width:80%;
        font-family:courier;
        font-size:3em;
        display:block;
        margin:auto;
        border:solid;
        margin-bottom:1em;
     }   
     #markerinput{
        width:80%;
        font-family:courier;
        font-size:3em;
        display:block;
        margin:auto;
        border:solid;
     }
     #gpsButton{
         cursor:pointer;
         border:solid;
         padding:1em 1em 1em 1em;
         width:50%;
         margin:auto;
         border-radius:0.5em;
         font-family:courier;
         font-size:3em;
         margin-bottom:3em;
     }
     #gpsButton:hover{
         background-color:green;
     }
     #gpsButton:active{
         background-color:yellow;
     }
</style>
</body>
</html>