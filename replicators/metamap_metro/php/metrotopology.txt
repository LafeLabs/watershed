<!doctype html>
<html>
<head>
<title>Metamap</title>
<!-- 
PUBLIC DOMAIN, NO COPYRIGHTS, NO PATENTS.
-->
<script id = "bytecodeScript">
/*
<?php
echo file_get_contents("bytecode/baseshapes.txt")."\n";
echo file_get_contents("bytecode/shapetable.txt")."\n";
echo file_get_contents("bytecode/font.txt")."\n";
echo file_get_contents("bytecode/keyboard.txt")."\n";
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
<div id = "stationjson" style = "display:none">
<?php
    echo file_get_contents("json/stationjson.txt");
?>
</div>
<div id = "extdatadiv" style = "display:none"><?php
if(isset($_GET['url'])){
    echo file_get_contents($_GET['url']);
}?>
</div>
<div id = "page">
<?php
    echo file_get_contents("html/page.txt");
?>
</div>
<script>
</script>
<script id = "init">
init();
function init(){
<?php
    echo file_get_contents("javascript/init.txt");
?>
}
</script>
<script id = "redraw">
redraw();
function redraw(){

           
ctx = document.getElementById("mainCanvas").getContext("2d");
ctx.clearRect(0,0,innerWidth,innerHeight);

drawGlyph(currentJSON.greenline);
drawGlyph(currentJSON.blueline);
drawGlyph(currentJSON.redline);
drawGlyph(currentJSON.yellowline);
drawGlyph(currentJSON.orangeline);
drawGlyph(currentJSON.silverline);


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


for(var index = 0;index < links.length;index++){
    var xy = latlon2xy(currentJSON.links[index].latlon);
    var xvar = parseFloat(xy.split(",")[0]);
    links[index].style.left = (x0 + unit*xvar).toString() + "px";
    var yvar = parseFloat(xy.split(",")[1]);
    links[index].style.top = (y0 - unit*yvar).toString() + "px";
}

for(var index = 0;index < imgs.length;index++){
    var xy = latlon2xy(currentJSON.images[index].latlon);
    var xvar = parseFloat(xy.split(",")[0]);
    imgs[index].style.left = (x0 + unit*xvar).toString() + "px";
    var yvar = parseFloat(xy.split(",")[1]);
    imgs[index].style.top = (y0 - unit*yvar).toString() + "px";
    imgs[index].style.width = (unit*currentJSON.images[index].unitfeet/currentJSON.unitfeet).toString() + "px";

}


var glyphArray = currentGlyph.split(",");
currentJSON.currentGlyph = "";
for(var index = 0;index < glyphArray.length;index++){
    if(glyphArray[index] != "0207" && glyphArray[index].length > 0){
        currentJSON.currentGlyph += glyphArray[index] + ",";
    }
}

for(var index = 0;index < stationjson.length;index++){

    if(stationjson[index].endofline || stationjson[index].transfer){
        doTheThing(0300);
        var xy = latlon2xy(stationjson[index].latlon);
        var xvar = parseFloat(xy.split(",")[0]);
        var yvar = parseFloat(xy.split(",")[1]);
        x = x0 + unit*xvar;
        y = y0 - unit*yvar;
        side = unit;
        drawGlyph("0337,0337,0337,0337,");
        if(stationjson[index].endofline){
            doTheThing(0224);
        }
        else{
            doTheThing(0223);
            if(stationjson[index].name == "Rosslyn"){
                drawGlyph("0336,0336,0330,0332,0337,0337,");
            }
            if(stationjson[index].name == "L'Enfant Plaza"){
                drawGlyph("0336,0336,0331,0332,0336,0331,0337,0337,0337,");
            }
            if(stationjson[index].name == "Metro Center"){
                drawGlyph("0336,0336,0330,0332,0337,0337,");
            }

        }

        drawGlyph("0336,0336,0333," + string2byteCode(stationjson[index].name) + "0365,");
    }
}



currentFile = "json/currentjson.txt";
data = encodeURIComponent(JSON.stringify(currentJSON,null,"    "));
var httpc = new XMLHttpRequest();
var url = "filesaver.php";        
httpc.open("POST", url, true);
httpc.setRequestHeader("Content-Type", "application/x-www-form-urlencoded;charset=utf-8");
httpc.send("data="+data+"&filename="+currentFile);//send text to filesaver.php



}
</script>
<script id = "pageevents">

document.getElementById("savesvg").onclick = function(){
        svgwidth = 800;
        svgheight = 800;
        tempx0 = x0;
        tempy0 = y0;
        x0 -= 0.5*(innerWidth - svgwidth);
        y0 -= 0.5*(innerHeight - svgheight);
        ctx = document.getElementById("invisibleCanvas").getContext("2d");
        currentSVG = "<svg width=\"" + svgwidth.toString() + "\" height=\"" + svgheight.toString() + "\" viewbox = \"0 0 " + svgwidth.toString() + " " + svgheight.toString() + "\"  xmlns=\"http://www.w3.org/2000/svg\">\n";
        currentSVG += "\n<!--\n<json>\n" + JSON.stringify(currentJSON,null,"    ") + "\n</json>\n-->\n";

        drawGlyph(currentJSON.greenline);   
        drawGlyph(currentJSON.blueline);
        drawGlyph(currentJSON.redline);
        drawGlyph(currentJSON.yellowline);
        drawGlyph(currentJSON.orangeline);
        drawGlyph(currentJSON.silverline);

for(var index = 0;index < stationjson.length;index++){

    if(stationjson[index].endofline || stationjson[index].transfer){
        doTheThing(0300);
        var xy = latlon2xy(stationjson[index].latlon);
        var xvar = parseFloat(xy.split(",")[0]);
        var yvar = parseFloat(xy.split(",")[1]);
        x = x0 + unit*xvar;
        y = y0 - unit*yvar;
        side = unit;
        drawGlyph("0337,0337,0337,0337,");
        if(stationjson[index].endofline){
            doTheThing(0224);
        }
        else{
            doTheThing(0223);
            if(stationjson[index].name == "Rosslyn"){
                drawGlyph("0336,0336,0330,0332,0337,0337,");
            }
            if(stationjson[index].name == "L'Enfant Plaza"){
                drawGlyph("0336,0336,0331,0332,0336,0331,0337,0337,0337,");
            }
            if(stationjson[index].name == "Metro Center"){
                drawGlyph("0336,0336,0330,0332,0337,0337,");
            }

        }

        drawGlyph("0336,0336,0333," + string2byteCode(stationjson[index].name) + "0365,");
    }
}


        doTheThing(0300);
        drawGlyph(currentJSON.currentGlyph);
        currentSVG += "</svg>";
        document.getElementById("textIO").value = currentSVG;
        var httpc = new XMLHttpRequest();
        var url = "feedsaver.php";        
        httpc.open("POST", url, true);
        httpc.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        httpc.send("data=" + encodeURIComponent(document.getElementById("textIO").value));//send text to feedsaver.php
        x0 = tempx0;
        y0 = tempy0;
        redraw();
 }
 
 
 document.getElementById("savemap").onclick = function(){
        var httpc = new XMLHttpRequest();
        var url = "mapsaver.php";        
        httpc.open("POST", url, true);
        httpc.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        httpc.send("data=" + encodeURIComponent(JSON.stringify(currentJSON,null,"    ")));//send text to mapsaver.php
}
 
 document.getElementById("findme").onclick = function(){
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition);
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
        redraw();
    }
}

document.getElementById("exportmap").onclick = function(){
    document.getElementById("textIO").value = JSON.stringify(currentJSON,null,"    ");
}

document.getElementById("editmode").onclick = function(){
    glyphEditMode = !glyphEditMode;
    redraw();
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

controls[0].onchange = function(){
    currentAddress = parseInt(this.value,8);
    currentGlyph = currentTable[currentAddress] + ",0207,";
    redraw();
}

controls[1].onkeydown = function(e) {
        charCode = e.keyCode || e.which;
        if(charCode == 010){
            doTheThing(010);
            redraw();
        }
        if(charCode == 045){
            doTheThing(020);
            redraw();
        }
        if(charCode == 047){
            doTheThing(021);
            redraw();
        }
        if(charCode == 046){
//        doTheThing(023);
            currentAddress++;
            currentGlyph = currentTable[currentAddress] + ",0207,";
            redraw();
        }
        if(charCode == 050){
//        doTheThing(022);
            currentAddress--;
            currentGlyph = currentTable[currentAddress] + ",0207,";
            redraw();
        }    
    }
    
    controls[2].onkeydown = function(e) {
        charCode = e.keyCode || e.which;
        if(charCode == 010){
            doTheThing(010);
            redraw();
        }
        if(charCode == 045){
            doTheThing(020);
            redraw();
        }
        if(charCode == 047){
            doTheThing(021);
            redraw();
        }
    }
    
    controls[3].onkeydown = function(e) {
        charCode = e.keyCode || e.which;
        if(charCode == 010){
            doTheThing(010);
            redraw();
        }
        if(charCode == 045){
            doTheThing(020);
            redraw();
        }
        if(charCode == 047){
            doTheThing(021);
            redraw();
        }
    }
controls[1].onkeypress = function(a){//action
        charCode = a.keyCode || a.which;
        console.log(a.which);
        if(parseInt(currentTable[charCode],8) >= 0200){
            var glyphSplit = currentGlyph.split(",");
            currentGlyph = "";
            for(var index = 0;index < glyphSplit.length;index++){
                if(glyphSplit[index].length > 0 && glyphSplit[index] != "0207"){
                    currentGlyph += glyphSplit[index] + ",";
                }
                if(glyphSplit[index] == "0207"){
                    currentGlyph += currentTable[charCode] + ",0207,";
                }
            }
            var glyphSplit = currentGlyph.split(",");
            currentGlyph = "";
            for(var index = 0;index < glyphSplit.length;index++){
                if(glyphSplit[index].length > 0  && parseInt(glyphSplit[index]) >= 040){
                    currentGlyph += glyphSplit[index] + ",";
                }
            }
            redraw();
        } 
        if(parseInt(currentTable[charCode],8) < 040){
            doTheThing(parseInt(currentTable[charCode],8));
            redraw();
        }
        this.value = "";
    }
    
    controls[2].onkeypress = function(a){//print
        charCode = a.keyCode || a.which;
        var glyphSplit = currentGlyph.split(",");
        currentGlyph = "";
        for(var index = 0;index < glyphSplit.length;index++){
            if(glyphSplit[index].length > 0 && glyphSplit[index] != "0207"){
                currentGlyph += glyphSplit[index] + ",";
            }
            if(glyphSplit[index] == "0207"){
                currentGlyph += "0" + (charCode + 01000).toString(8) + ",0207,";
            }
        }
        var glyphSplit = currentGlyph.split(",");
        currentGlyph = "";
        for(var index = 0;index < glyphSplit.length;index++){
            if(glyphSplit[index].length > 0  && parseInt(glyphSplit[index]) >= 040){
                currentGlyph += glyphSplit[index] + ",";
            }
        }
        redraw();
        
        this.value = "";
    }
    
     controls[3].onkeypress = function(a){//stack
        charCode = a.keyCode || a.which;    
        var glyphSplit = currentGlyph.split(",");
        currentGlyph = "";
        for(var index = 0;index < glyphSplit.length;index++){
            if(glyphSplit[index].length > 0 && glyphSplit[index] != "0207"){
                currentGlyph += glyphSplit[index] + ",";
            }
            if(glyphSplit[index] == "0207"){
                currentGlyph += "0" + (charCode).toString(8) + ",0207,";
            }
        }
        var glyphSplit = currentGlyph.split(",");
        currentGlyph = "";
        for(var index = 0;index < glyphSplit.length;index++){
            if(glyphSplit[index].length > 0  && parseInt(glyphSplit[index]) >= 040){
                currentGlyph += glyphSplit[index] + ",";
            }
        }
        redraw();
        this.value = "";
    }
    

imagedata[0].onchange = function(){
    document.getElementById("mainImage").src = this.value;
}
    
imagedata[1].onchange = function(){
    currentJSON.imgw = this.value;
    redraw();
}
imagedata[2].onchange = function(){
    currentJSON.imgtop = this.value;
    redraw();
}
imagedata[3].onchange = function(){
    currentJSON.imgleft = this.value;
    redraw();
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

</script>
<?php
    echo "<style>\n";
    echo file_get_contents("css/style.txt");
    echo "</style>\n";
?>
</body>
</html>