<!doctype html>
<html>
<head>
<!--Stop Google:-->
<META NAME="robots" CONTENT="noindex,nofollow">
<title>Metamap Background Image Editor</title>
<!-- 
PUBLIC DOMAIN, NO COPYRIGHTS, NO PATENTS.
-->
<script id = "bytecodeScript">
/*

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
    ?>    
    if(localCommand == 06){ //<page06>
    fullCube = false;
    currentTable = []; 
    for(var index = 0;index < 01777;index ++){
        currentTable.push("");
    }
    var inputbytecode = document.getElementById("bytecodeScript").text;
    var bytecodearray = inputbytecode.split("\n");
    for(var index = 0;index < bytecodearray.length;index++){
        if(bytecodearray[index].includes(":")){
            var localBytecode = bytecodearray[index].split(":");
            var localAddress = parseInt(localBytecode[0],8);
            currentTable[localAddress] = localBytecode[1];
        }
    }
    currentTableStart = [];
    for(var index = 0;index < currentTable.length;index++){
        currentTableStart.push(currentTable[index]);
    }
    //</page06>
    }
    if(localCommand == 07){//<page07>
    //intialize
    worldLine = [];
    addressStack = [];
    worldIndex = 0;
    myFont = "Futura";
    boxFontSize = 0.2;
    viewStep = 50;
    currentURL = "";
    currentWord = "";
    currentSVG = "";
    currentHTML = "";
    currentStyle = "";
    latex = true;
    currentAddress = 0260;
    currentDeck = 0400;
    currentGlyph = "0300,";
    resetColor = "#000000";
    currentStroke = "black";
    currentFill = "black";
    currentAction = 0;
    currentCommand = "0300";
    phi = 0.5*(Math.sqrt(5) + 1);
    scaleFactor = 2;
    thetaStep = Math.PI/2;
    theta0 = -Math.PI/2; 
    theta = theta0;
    x0 = innerWidth/2;
    y0 = innerHeight/2;
    x = x0;
    y = y0;
    unit = 300;
    side = unit;
    x0 = innerWidth/2;
    y0 = innerHeight/2;
    unit = x0/8;//16 wm span total screen size
    side = unit;
    currentGlyph = "0300,0330,0341,0333,0207,0336,0341,";
    viewGlyph = "";
    x0 = 5;
    y0 = 55;
    unit = 50;
    side = unit;
    keyMode = "none";
    editMode = true;

    //</page07>
    }
    //root magic here

}
</script>
</head>
<body>
<div id = "datadiv" style = "display:none">
<?php
    echo file_get_contents("json/currentjson.txt");
?>
</div>    
<div id = "page">
<a  id = "editorlink" href = "editor.php">editor.php</a>
<a  id = "indexlink" href = "index.php">index.php</a>

<canvas id="invisibleCanvas" style="display:none"></canvas>
<canvas id="mainCanvas"></canvas>
<textarea id="textIO"></textarea>
<input id = "actioninput"/>
<table id = "imageTable">   
    <tr>
        <td>IMAGE URL:</td><td><input/></td>
    </tr>
    <tr>
        <td>IMAGE WIDTH:</td><td><input value = "2"/></td>
    </tr>
    <tr>
        <td>IMAGE TOP:</td><td><input value  = "-1"/></td>
    </tr>
    <tr>
        <td>IMAGE LEFT:</td><td><input value = "-1"/></td>
    </tr>
    <tr>
        <td>UNIT PIXELS:</td><td><input value = "100"/></td>
    </tr>
    <tr>
        <td>UNIT FEET:</td><td><input value = "300"/></td>
    </tr>
    <tr>
        <td>LATLON0:</td><td><input value = "38.8895,-77.0352"/></td>
    </tr>
    <tr>
        <td>MARKER0:</td><td><input value = "washington monument"/></td>
    </tr>
    <tr>
        <td>LATLON1:</td><td><input value = " 38.889255, -77.050125 "/></td>
    </tr>
    <tr>
        <td>MARKER1:</td><td><input value = "Lincoln memorial center"/></td>
    </tr>
    <tr>
        <td>IMGANGLE:</td><td><input value = "0"/></td>
    </tr>

    <tr style = "display:none">
        <td class = "button">SAVE JSON</td>
    </tr>
    <tr style = "display:none">
        <td class = "button">EXPORT JSON</td>
    </tr>
    <tr style = "display:none">
        <td class = "button">IMPORT JSON</td>
    </tr>

</table>
<table id = "buttonTable">
    <tr>
        <td>WIDTH:</td>
        <td class = "button">2X</td>
        <td class = "button">1/2X</td>
        <td class = "button">+10%</td>
        <td class = "button">-10%</td>
        <td class = "button">+1%</td>
        <td class = "button">-1%</td>
    </tr>
    <tr>
        <td>TOP:</td>
        <td class = "button">2X</td>
        <td class = "button">1/2X</td>
        <td class = "button">+10%</td>
        <td class = "button">-10%</td>
        <td class = "button">+1%</td>
        <td class = "button">-1%</td>
    </tr>
    <tr>
        <td>LEFT:</td>
        <td class = "button">2X</td>
        <td class = "button">1/2X</td>
        <td class = "button">+10%</td>
        <td class = "button">-10%</td>
        <td class = "button">+1%</td>
        <td class = "button">-1%</td>
    </tr>

</table>
<img id = "mainImage"/>
</div>
<script id = "init">

doTheThing(06);//import embedded hypercube in this .html doc
doTheThing(07);//initialize Geometron global variables

document.getElementById("mainCanvas").width = innerWidth;
document.getElementById("mainCanvas").height = innerHeight;

x0 = innerWidth/2;
y0 = innerHeight/2;    

imagedata = document.getElementById("imageTable").getElementsByTagName("input");
currentJSON = JSON.parse(document.getElementById("datadiv").innerHTML);

unit = currentJSON.unitpixels;

document.getElementById("mainImage").src = currentJSON.imgurl;

imagedata[0].value = currentJSON.imgurl;
imagedata[1].value = currentJSON.imgw;
imagedata[2].value = currentJSON.imgtop;
imagedata[3].value = currentJSON.imgleft;

imagedata[4].value = currentJSON.unitpixels;
imagedata[5].value = currentJSON.unitfeet;

imagedata[6].value = currentJSON.latlon0;
imagedata[7].value = currentJSON.marker0;
imagedata[8].value = currentJSON.latlon1;
imagedata[9].value = currentJSON.marker1;
imagedata[10].value = currentJSON.imgangle;

document.getElementById("actioninput").select();
</script>
<script id = "redraw">
redraw();
function redraw(){
       
    ctx = document.getElementById("mainCanvas").getContext("2d");
    ctx.clearRect(0,0,innerWidth,innerHeight);
    unit = currentJSON.unitpixels;
    doTheThing(0300);
    var xy = latlon2xy(currentJSON.latlon1);
    var xvar = parseFloat(xy.split(",")[0]);
    x = x0 + unit*xvar;
    var yvar = parseFloat(xy.split(",")[1]);
    y = y0 - unit*yvar;
    drawGlyph("0340,0341,0336,0336,0333,");
    drawGlyph(string2byteCode(currentJSON.marker1));
    drawGlyph("0365,");
    doTheThing(0300);
    drawGlyph("0340,0341,0336,0336,0333,");
    drawGlyph(string2byteCode(currentJSON.marker0));
    drawGlyph("0365,");
    document.getElementById("mainImage").style.transform = "rotate(" + currentJSON.imgangle.toString() +"deg)";

    document.getElementById("mainImage").style.width = (currentJSON.imgw*unit).toString()  + "px";
    document.getElementById("mainImage").style.left = (x0 + currentJSON.imgleft*unit).toString()  + "px";
    document.getElementById("mainImage").style.top = (y0 + currentJSON.imgtop*unit).toString()  + "px";
    
    
    currentFile = "json/currentjson.txt";
    data = encodeURIComponent(JSON.stringify(currentJSON,null,"    "));
    var httpc = new XMLHttpRequest();
    var url = "filesaver.php";        
    httpc.open("POST", url, true);
    httpc.setRequestHeader("Content-Type", "application/x-www-form-urlencoded;charset=utf-8");
    httpc.send("data="+data+"&filename="+currentFile);//send text to filesaver.php


}

function saveJSON(){
    currentFile = "json/currentjson.txt";
    data = encodeURIComponent(JSON.stringify(currentJSON,null,"    "));
    var httpc = new XMLHttpRequest();
    var url = "filesaver.php";        
    httpc.open("POST", url, true);
    httpc.setRequestHeader("Content-Type", "application/x-www-form-urlencoded;charset=utf-8");
    httpc.send("data="+data+"&filename="+currentFile);//send text to filesaver.php
}

function exportJSON(){
    document.getElementById("textIO").value = JSON.stringify(currentJSON,null,"    ");
}
function importJSON(){
    if(document.getElementById("textIO").value.length > 10){
        currentJSON = JSON.parse(document.getElementById("textIO").value);
    }
}


</script>
<script id = "pageevents">
controlbuttons = document.getElementById("imageTable").getElementsByClassName("button");

controlbuttons[0].onclick = function(){
    saveJSON();
}
controlbuttons[1].onclick = function(){
    exportJSON();
}
controlbuttons[2].onclick = function(){
    importJSON();
}

imagebuttons = document.getElementById("buttonTable").getElementsByClassName("button");

imagebuttons[0].onclick = function(){
    currentJSON.imgw = 2*currentJSON.imgw;
    currentJSON.imgtop = 2*currentJSON.imgtop;
    currentJSON.imgleft = 2*currentJSON.imgleft;
    imagedata[1].value = currentJSON.imgw;
    imagedata[2].value = currentJSON.imgtop;
    imagedata[3].value = currentJSON.imgleft;
    redraw();
}
imagebuttons[1].onclick = function(){
    currentJSON.imgw = 0.5*currentJSON.imgw;
    currentJSON.imgtop = 0.5*currentJSON.imgtop;
    currentJSON.imgleft = 0.5*currentJSON.imgleft;
    imagedata[1].value = currentJSON.imgw;
    imagedata[2].value = currentJSON.imgtop;
    imagedata[3].value = currentJSON.imgleft;
    redraw();
}
imagebuttons[2].onclick = function(){
    currentJSON.imgw = 1.1*currentJSON.imgw;
    currentJSON.imgtop = 1.1*currentJSON.imgtop;
    currentJSON.imgleft = 1.1*currentJSON.imgleft;
    imagedata[1].value = currentJSON.imgw;
    imagedata[2].value = currentJSON.imgtop;
    imagedata[3].value = currentJSON.imgleft;
    redraw();
}
imagebuttons[3].onclick = function(){
    currentJSON.imgw = 0.9*currentJSON.imgw;
    currentJSON.imgtop = 0.9*currentJSON.imgtop;
    currentJSON.imgleft = 0.9*currentJSON.imgleft;
    imagedata[1].value = currentJSON.imgw;
    imagedata[2].value = currentJSON.imgtop;
    imagedata[3].value = currentJSON.imgleft;
    redraw();
}
imagebuttons[4].onclick = function(){
    currentJSON.imgw = 1.01*currentJSON.imgw;
    currentJSON.imgtop = 1.01*currentJSON.imgtop;
    currentJSON.imgleft = 1.01*currentJSON.imgleft;
    imagedata[1].value = currentJSON.imgw;
    imagedata[2].value = currentJSON.imgtop;
    imagedata[3].value = currentJSON.imgleft;
    redraw();
}
imagebuttons[5].onclick = function(){
    currentJSON.imgw = 0.99*currentJSON.imgw;
    currentJSON.imgtop = 0.99*currentJSON.imgtop;
    currentJSON.imgleft = 0.99*currentJSON.imgleft;
    imagedata[1].value = currentJSON.imgw;
    imagedata[2].value = currentJSON.imgtop;
    imagedata[3].value = currentJSON.imgleft;
    redraw();
}


imagebuttons[6].onclick = function(){
    currentJSON.imgtop = 2*currentJSON.imgtop;
    imagedata[2].value = currentJSON.imgtop;
    redraw();
}
imagebuttons[7].onclick = function(){
    currentJSON.imgtop = 0.5*currentJSON.imgtop;
    imagedata[2].value = currentJSON.imgtop;
    redraw();
}
imagebuttons[8].onclick = function(){
    currentJSON.imgtop = 1.1*currentJSON.imgtop;
    imagedata[2].value = currentJSON.imgtop;
    redraw();
}
imagebuttons[9].onclick = function(){
    currentJSON.imgtop = 0.9*currentJSON.imgtop;
    imagedata[2].value = currentJSON.imgtop;
    redraw();
}
imagebuttons[10].onclick = function(){
    currentJSON.imgtop = 1.01*currentJSON.imgtop;
    imagedata[2].value = currentJSON.imgtop;
    redraw();
}
imagebuttons[11].onclick = function(){
    currentJSON.imgtop = 0.99*currentJSON.imgtop;
    imagedata[2].value = currentJSON.imgtop;
    redraw();
}

imagebuttons[12].onclick = function(){
    currentJSON.imgleft = 2*currentJSON.imgleft;
    imagedata[3].value = currentJSON.imgleft;
    redraw();
}
imagebuttons[13].onclick = function(){
    currentJSON.imgleft = 0.5*currentJSON.imgleft;
    imagedata[3].value = currentJSON.imgleft;
    redraw();
}
imagebuttons[14].onclick = function(){
    currentJSON.imgleft = 1.1*currentJSON.imgleft;
    imagedata[3].value = currentJSON.imgleft;
    redraw();
}
imagebuttons[15].onclick = function(){
    currentJSON.imgleft = 0.9*currentJSON.imgleft;
    imagedata[3].value = currentJSON.imgleft;
    redraw();
}
imagebuttons[16].onclick = function(){
    currentJSON.imgleft = 1.01*currentJSON.imgleft;
    imagedata[3].value = currentJSON.imgleft;
    redraw();
}
imagebuttons[17].onclick = function(){
    currentJSON.imgleft = 0.99*currentJSON.imgleft;
    imagedata[3].value = currentJSON.imgleft;
    redraw();
}

imagedata[0].onchange = function(){
    document.getElementById("mainImage").src = this.value;
    currentJSON.imgurl = this.value;
}
imagedata[1].onchange = function(){
    currentJSON.imgw = parseFloat(this.value);
    redraw();
}
imagedata[2].onchange = function(){
    currentJSON.imgtop = parseFloat(this.value);
    redraw();
}
imagedata[3].onchange = function(){
    currentJSON.imgleft = parseFloat(this.value);
    redraw();
}

imagedata[4].onchange = function(){
    currentJSON.unitpixels = parseFloat(this.value);
    redraw();
}
imagedata[5].onchange = function(){
    currentJSON.unitfeet = parseFloat(this.value);
    redraw();
}
imagedata[6].onchange = function(){
    currentJSON.latlon0 = this.value;
    redraw();
}
imagedata[7].onchange = function(){
    currentJSON.marker0 = this.value;
    redraw();
}
imagedata[8].onchange = function(){
    currentJSON.latlon1 = this.value;
    redraw();
}
imagedata[9].onchange = function(){
    currentJSON.marker1 = this.value;
    redraw();
}

imagedata[10].onchange = function(){
    currentJSON.imgangle = parseFloat(this.value);
    redraw();
}


imagebuttonindex = 0;
highlightcolor = "green";
imagebuttons[imagebuttonindex].style.backgroundColor = highlightcolor;

document.getElementById("actioninput").onkeydown = function(a){
    charCode = a.keyCode || a.which;
    console.log(charCode);
    if(a.key == " "){
        imagebuttons[imagebuttonindex].click();
    }
    if(a.key == "f" || charCode == 047){
        imagebuttons[imagebuttonindex].style.backgroundColor = "transparent";
        imagebuttonindex++;
        if(imagebuttonindex > imagebuttons.length - 1){
            imagebuttonindex = 0;
        }
        imagebuttons[imagebuttonindex].style.backgroundColor = highlightcolor;
    }
    if(a.key == "d" || charCode == 045){
        imagebuttons[imagebuttonindex].style.backgroundColor = "transparent";
        imagebuttonindex--;
        if(imagebuttonindex < 0){
            imagebuttonindex = imagebuttons.length - 1;
        }
        imagebuttons[imagebuttonindex].style.backgroundColor = highlightcolor;
    }
    if(a.key == "s" || charCode == 050){
        imagebuttons[imagebuttonindex].style.backgroundColor = "transparent";
        imagebuttonindex += 6;
        if(imagebuttonindex > imagebuttons.length - 1){
            imagebuttonindex -= 18;
        }
        imagebuttons[imagebuttonindex].style.backgroundColor = highlightcolor;
    }
    if(a.key == "a" || charCode == 046){
        imagebuttons[imagebuttonindex].style.backgroundColor = "transparent";
        imagebuttonindex -= 6;
        if(imagebuttonindex < 0){
            imagebuttonindex += 18;
        }
        imagebuttons[imagebuttonindex].style.backgroundColor = highlightcolor;
    }

    document.getElementById("actioninput").value = "";
}

</script>
<style>
#page{
    width:100%;
    height:100%;
    position:absolute;
    left:0px;
    top:0px;
    overflow:hidden;
}

#buttonTable{
    position:absolute;
    left:25%;
    top:10px;
    background-color:rgba(255,255,255, 0.5);
}

 #editorlink{
     position:absolute;
     left:70%;
     top:0.5empx;
     z-index:2;
 }
 #indexlink{
     position:absolute;
     left:70%;
     top:2em;
     z-index:2;
 }
 #actioninput{
     position:absolute;
     left:0px;
     bottom:30%;
     width:1em;
     font-size:20px;
 }
 #textIO{
    display:none;
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
#imageTable{
    left:15px;
    top:15px;
    background-color:rgba(255,255,255, 0.5);

}
#imageTable input{
    width:5em;
    font-family:courier;
}
table{
    font-family:courier;
    font-size:18;
    position:absolute;
}
#controlTable input{
    width:3em;
    font-family:courier;
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
</html>