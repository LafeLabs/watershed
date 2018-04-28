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
    -->
</head>
<body>
<a href = "editor.php">editor.php</a>
<div id = "gpsButton">WHERE AM I?</div>
<input id = "outputfield"/>

<script>

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
    }
}
</script>
<style>
     #outputfield{
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
         width:80%;
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