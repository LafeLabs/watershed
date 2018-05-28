<!doctype html>
<html>
<head>
<title>Metamap</title>
<!-- 
PUBLIC DOMAIN, NO COPYRIGHTS, NO PATENTS.

Trust model: Trust all non-coders implicitly, assume the worst from anyone who makes any money of computer industry in any way.

EVERYTHING IS PHYSICAL
EVERYTHING IS FRACTAL
EVERYTHING IS RECURSIVE
NO MONEY
NO PROPERTY
NO MINING
EGO DEATH:
    LOOK TO THE INSECTS
    LOOK TO THE FUNGI
    LANGUAGE IS HOW THE MIND PARSES REALITY
-->
<!--Stop Google:-->
<META NAME="robots" CONTENT="noindex,nofollow">
<script id = "bytecodeScript">
/*
<?php
echo file_get_contents("bytecode/baseshapes.txt")."\n";
echo file_get_contents("bytecode/shapetable.txt")."\n";
echo file_get_contents("bytecode/font.txt")."\n";
//echo file_get_contents("bytecode/keyboard.txt")."\n";
echo file_get_contents("bytecode/symbols013xx.txt")."\n";
echo file_get_contents("bytecode/symbols010xx.txt")."\n";
?>
*/
</script>
<script id = "topfunctions">
<?php
echo file_get_contents("javascript/topfunctions.txt");
?>   
</script>
<script id = "actions">
function doTheThing(localCommand){    
    if(localCommand >= 040 && localCommand <= 0176){
        currentHTML += String.fromCharCode(localCommand);
        currentWord += String.fromCharCode(localCommand);
    }
    if(localCommand >= 0200 && localCommand <= 0277){//shapes 
        if(!(localCommand == 0207 && editMode == false) ){
            drawGlyph(currentTable[localCommand]);    	    
        }
    }
    if(localCommand >= 01000 && localCommand <= 01777){//symbol glyphs
            drawGlyph(currentTable[localCommand]);    	    
    } 
    <?php
    echo file_get_contents("javascript/actions03xx.txt");
    echo "\n";
    echo file_get_contents("javascript/actions0xx.txt");
    echo "\n";
    ?>    
}
</script>
</head>
<body>
<div id = "datadiv" style = "display:none">
<?php
    echo file_get_contents("json/currentjson.txt");
?>
</div>    
<div id = "extdatadiv" style = "display:none"><?php
if(isset($_GET['url'])){
    echo file_get_contents($_GET['url']);
}?>
</div>
<div id = "page">
<input id = "actionInput"/>
<canvas id="invisibleCanvas" style="display:none"></canvas>
<canvas id="mainCanvas"></canvas>
<textarea id="textIO"></textarea>
<div id = "linkScroll">
    <a href = "editor.php">editor.php</a>
    <a href = "glypheditor.php">glypheditor.php</a>
    <a href = "savemap.php">savemap.php</a>
    <a href = "loadrecentmap.php">loadrecentmap.php</a>
    <a href = "linkeditor.php">linkeditor.php</a>
    <a href = "imageeditor.php">imageeditor.php</a>
    <a href = "backgroundimageeditor.php">backgroundimageeditor.php</a>
    <a href = "glypheditor.php">glypheditor.php</a>
    <a href = "shapetableeditor.php">shapetableeditor.php</a>
    <a href = "makenewpage.php">makenewpage.php</a>
    <a href = "makenewmap.php">makenewmap.php</a>
    <a href = "latlon.php">latlon.php</a>
</div>
<table id = "zoompan">
    <tr>
        <td class = "button">up</td>
        <td class = "button">down</td>
        <td class = "button">left</td>
        <td class = "button">right</td>
        <td class = "button">out</td>
        <td class = "button">in</td>
    </tr>
</table>

<table id = "buttonTable">
<tr><td class = "button" id = "imageon">IMAGE MODE</td></tr>
<tr><td class = "button" id = "importmap">IMPORT MAP</td></tr>
<tr><td class = "button" id = "exportmap">EXPORT MAP</td></tr>
<tr><td class = "button" id = "findme">FIND ME</td></tr>
</table>
<img id = "mainImage"/>
</div>
<script>
</script>
<script id = "init">
init();
function init(){

    doTheThing(06);//import embedded hypercube in this .html doc
    doTheThing(07);//initialize Geometron global variables

    document.getElementById("mainCanvas").width = innerWidth;
    document.getElementById("mainCanvas").height = innerHeight;

    x0 = innerWidth/2;
    y0 = innerHeight/2;    

    currentJSON = JSON.parse(document.getElementById("datadiv").innerHTML);
    if(document.getElementById("extdatadiv").innerHTML.length > 10){
        currentJSON = JSON.parse(document.getElementById("extdatadiv").innerHTML);
    }
    
    if(currentJSON.shapes.length > 0){
        for(var index = 0;index < currentJSON.shapes.length;index++){
            if(currentJSON.shapes[index].length > 1){
                var localaddr = parseInt(currentJSON.shapes[index].split(":")[0],8);
                var localglyph = currentJSON.shapes[index].split(":")[1];
                currentTable[localaddr] = localglyph;
            }
        }  
    }
    
    unit = currentJSON.unitpixels;
    document.getElementById("mainImage").src = currentJSON.imgurl;

    for(var index = 0;index < currentJSON.links.length;index++){
        var newa = document.createElement("a");
        newa.className = "links";
        newa.innerHTML = currentJSON.links[index].text;
        newa.href = currentJSON.links[index].url;
        document.getElementById("page").appendChild(newa);
    }
    links = document.getElementsByClassName("links");

    for(var index = 0;index < currentJSON.images.length;index++){
        var newimg = document.createElement("img");
        newimg.className = "imgs";
        newimg.src = currentJSON.images[index].url;
        document.getElementById("page").appendChild(newimg);
    }
    imgs = document.getElementsByClassName("imgs");
    herelatlon = currentJSON.latlon0;
    mainImageOn = true;
    avatarBool = false;
    zoompanbuttons = document.getElementById("zoompan").getElementsByClassName("button");
    
    document.getElementById("actionInput").select();

}
</script>
<script id = "redraw">
redraw();
function redraw(){
    ctx = document.getElementById("mainCanvas").getContext("2d");
    ctx.clearRect(0,0,innerWidth,innerHeight);
    doTheThing(0300);
    drawGlyph(currentJSON.glyph0);
    doTheThing(0300);
    drawGlyph(currentJSON.currentGlyph);    
    doTheThing(0300);
    var xy = latlon2xy(currentJSON.latlon1);
    var xvar = parseFloat(xy.split(",")[0]);
    x = x0 + unit*xvar;
    var yvar = parseFloat(xy.split(",")[1]);
    y = y0 - unit*yvar;
    drawGlyph(currentJSON.glyph1);
    if(avatarBool){
        doTheThing(0300);
        var xy = latlon2xy(herelatlon);
        var xvar = parseFloat(xy.split(",")[0]);
        x = x0 + unit*xvar;
        var yvar = parseFloat(xy.split(",")[1]);
        y = y0 - unit*yvar;
        side = unit*currentJSON.avatar.unitfeet/currentJSON.unitfeet;
        drawGlyph(currentJSON.avatar.glyph);
    }
    
    document.getElementById("mainImage").style.width = (currentJSON.imgw*unit).toString()  + "px";
    document.getElementById("mainImage").style.left = (x0 + currentJSON.imgleft*unit).toString()  + "px";
    document.getElementById("mainImage").style.top = (y0 + currentJSON.imgtop*unit).toString()  + "px";
    document.getElementById("mainImage").style.transform = "rotate(" + currentJSON.imgangle.toString() +"deg)";
    for(var index = 0;index < links.length;index++){
        var xy = latlon2xy(currentJSON.links[index].latlon);
        var xvar = parseFloat(xy.split(",")[0]);
        links[index].style.left = (x0 + unit*xvar).toString() + "px";
        var yvar = parseFloat(xy.split(",")[1]);
        links[index].style.top = (y0 - unit*yvar).toString() + "px";
        links[index].style.fontSize = (currentJSON.links[index].fontfeet*unit/currentJSON.unitfeet).toString() + "px";
        links[index].style.transform = "rotate(" + currentJSON.links[index].rotation + "deg)";
    }

    for(var index = 0;index < imgs.length;index++){
        var xy = latlon2xy(currentJSON.images[index].latlon);
        var xvar = parseFloat(xy.split(",")[0]);
        imgs[index].style.left = (x0 + unit*xvar).toString() + "px";
        var yvar = parseFloat(xy.split(",")[1]);
        imgs[index].style.top = (y0 - unit*yvar).toString() + "px";
        imgs[index].style.width = (unit*currentJSON.images[index].unitfeet/currentJSON.unitfeet).toString() + "px";
    }
}

</script>
<script id = "pageevents">

 document.getElementById("findme").onclick = function(){
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition);
        var xy = latlon2xy(herelatlon);
    } else {
            alert("Geolocation is not supported by this browser.");
    }
    function showPosition(position) {
        mylat = position.coords.latitude;
        mylon = position.coords.longitude;
        herelatlon = mylat.toString() + "," + mylon.toString();
        avatarBool = true;
        redraw();
    }
 }

document.getElementById("importmap").onclick = function(){
    if(document.getElementById("textIO").value.length > 1){
        currentJSON = JSON.parse(document.getElementById("textIO").value);
        document.getElementById("mainImage").src = currentJSON.imgurl;
        unit = currentJSON.unitpixels;
        document.getElementById("actionInput").select();
    
        for(var index = 0;index < links.length;index++){
            document.getElementById("page").removeChild(links[index]);
        }

        links = [];
        for(var index = 0;index < currentJSON.links.length;index++){
            var newa = document.createElement("a");
            newa.className = "links";
            newa.innerHTML = currentJSON.links[index].text;
            newa.href = currentJSON.links[index].url;
            document.getElementById("page").appendChild(newa);
            links.push(newa);
        }
        redraw();
    }
}

document.getElementById("exportmap").onclick = function(){
    document.getElementById("textIO").value = JSON.stringify(currentJSON,null,"    ");
}


document.getElementById("imageon").onclick = function(){
    if(!mainImageOn){
        document.getElementById("mainImage").style.display = "block";
    }
    else{
        document.getElementById("mainImage").style.display = "none";
    }
    mainImageOn = !mainImageOn;
}



zoompanbuttons[0].onclick = function(){
    doTheThing(030);
}
zoompanbuttons[1].onclick = function(){
    doTheThing(031);
}
zoompanbuttons[2].onclick = function(){
    doTheThing(032);
}
zoompanbuttons[3].onclick = function(){
    doTheThing(033);
}
zoompanbuttons[4].onclick = function(){
    doTheThing(036);
}
zoompanbuttons[5].onclick = function(){
    doTheThing(037);
}



document.getElementById("actionInput").onkeydown = function(e) {
        charCode = e.keyCode || e.which;
        if(charCode == 045){
            doTheThing(032);
        }
        if(charCode == 047){
            doTheThing(033);
        }
        if(charCode == 046){
            doTheThing(030);
        }
        if(charCode == 050){
            doTheThing(031);
        }
        if(charCode == 0255){
            doTheThing(036);
        }
        if(charCode == 075){
            doTheThing(037);
        }
        this.value = "";
}

</script>
<style>
#linkScroll{
    position:absolute;
    right:0px;
    top:0px;
    width:10em;
    overflow:scroll;
    height:60%;
    background-color:black;
    z-index:3;
    font-size:22px;
    font-family:courier;
}

#linkScroll a{
    display:block;
    color:white;
    margin-top:1em;
    margin-left:1em;
}

#actionInput{
    position:absolute;
    font-size:20px;
    left:0px;
    top:0px;
    width:1em;
    z-index:4;
}
#page{
    width:100%;
    height:100%;
    position:absolute;
    left:0px;
    top:0px;
    overflow:hidden;
}
#zoompan{
    position:absolute;
    left:2em;
    top:0.1em;
    font-size:18px;
}
.links{
    position:absolute;
    color:blue;
    background-color:white;
    z-index:1;
    font-family:"Arial Black", Gadget, sans-serif;
}
.imgs{
    position:absolute;
    z-index:-1;
}



 #textIO{
    position:absolute;
    width:100px;
    height:100px;
    left:0px;
    bottom:0px;
    border:solid;
}
#mainCanvas{
    position:absolute;
    z-index:0;
    left:0px;
    top:0px;
}

table{
    font-family:courier;
    font-size:18;
    position:absolute;
}

.button{
    padding:0.5em 0.5em 0.5em 0.5em;
    font-family:courier;
    cursor:pointer;
    border:solid;
    border-radius:0.5em;
}
.button:hover{
    background-color:green;
}
.button:active{
    background-color:yellow;
}


#buttonTable{
    position:absolute;
    left:15px;
    top:40%;
}
img{
    position:absolute;
    z-index:-2;
}
#mainImage{
    position:absolute;
    z-index:-2;
}

</style>
</body>
</html> 