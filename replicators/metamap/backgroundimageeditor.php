<!doctype html>
<html>
<head>
<title>Metamap</title>
<!-- 
PUBLIC DOMAIN, NO COPYRIGHTS, NO PATENTS.
-->
<script id = "bytecodeScript">
/*

*/
</script>
<script id = "topfunctions">

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



 function string2byteCode(localString){
    var localByteCode = "";
    for(var stringIndex = 0;stringIndex < localString.length;stringIndex++){
        var tempCharCode = localString.charCodeAt(stringIndex);
        if(tempCharCode != 0){
            localByteCode += "0";
            localByteCode += tempCharCode.toString(8);
            localByteCode += ",";
        }
    }
    return localByteCode;
}
        
function byteCode2string(localByteCode){
    var localString = "";
    var stringArray = localByteCode.split(",");
    for(var index = 0;index < stringArray.length;index++){
        var myCharCode = String.fromCharCode(parseInt(stringArray[index],8));
        if(parseInt(stringArray[index],8) >= 040 && parseInt(stringArray[index],8) < 0177 ){
            localString += myCharCode;
        }
        if(parseInt(stringArray[index],8) == 012){//newline
            localString += myCharCode;
        }
        if(parseInt(stringArray[index],8) == 011){//vertical tab
            localString += myCharCode;
        }		
        if(parseInt(stringArray[index],8) >= 0400 && parseInt(stringArray[index],8) <= 0777){
            if(currentTable[parseInt(stringArray[index],8)].length > 0){
                localString += byteCode2string(currentTable[parseInt(stringArray[index],8)]);
            }
        }		
        
    }
    return localString;
}
        
function drawGlyph(localString){
    var tempArray = localString.split(',');
    for(var index = 0;index < tempArray.length;index++){
        doTheThing(parseInt(tempArray[index],8));
    }
}
    
function spellGlyph(localString){
    var tempArray = localString.split(',');
    for(var index = 0;index < tempArray.length;index++){
        ctx.lineWidth = 2;
        // ctx.strokeStyle="black";
        if(x > 0.94*innerWidth){
            y+= 1.1*side;
            x = side;
        }
        doTheThing(parseInt(tempArray[index],8) + 01000);
        if(parseInt(tempArray[index],8) > 01000){
            doTheThing(01060);
            doTheThing(01061);
            var sixtyfours = (parseInt(tempArray[index],8) & 0700) >> 6;
            var eights = (parseInt(tempArray[index],8) & 070) >> 3;
            var ones = parseInt(tempArray[index],8) & 07;
            doTheThing(01060 + sixtyfours);            
            doTheThing(01060 + eights);            
            doTheThing(01060 + ones);            
        }
    }
}


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
     if(localCommand == 0300){// <page0300>
        x = x0;
        y = y0;
        theta = theta0;
        side = unit;
        thetaStep = Math.PI/2;
        scaleFactor = 2;
        ctx.lineWidth = 2;
        ctx.strokeStyle= resetColor;//"#00ff00";
        ctx.fillStyle=resetColor;
        currentStroke = resetColor;
        currentFill = resetColor;
        currentWord = "";
        currentHTML = "";
        currentStyle = "";

        //</page0300>
    }
    if(localCommand == 0304){//<page0304>
    thetaStep = Math.PI/2;
    //</page0304>
    }
    if(localCommand == 0305){//<page0305>
    thetaStep = 2*Math.PI/5;
    //</page0305>
    }
    if(localCommand == 0306){//<page0306>
    thetaStep = Math.PI/3;
    //</page0306>
    }
    if(localCommand == 0310){//<page0310>
    scaleFactor = Math.sqrt(2); 
    //</page0310>
    }
    if(localCommand == 0311){//<page0311>
    scaleFactor = phi; //"golden" ratio 
    //</page0311>
    }
    if(localCommand == 0312){//<page0312>
    scaleFactor = Math.sqrt(3); 
    //</page0312>
    }
    if(localCommand == 0313){//<page0313>
    scaleFactor = 2;  //2x
    //</page0313>
    }
    if(localCommand == 0314){//<page0314>
    scaleFactor = 3;  //3x
    //</page0314>
    }
    if(localCommand == 0315){//<page0315>
    scaleFactor = 3.14159;  //pi*
    //</page0315>
    }
    if(localCommand == 0316){//<page0316>
    scaleFactor = 5;  //5*
    //</page0316>
    }
    if(localCommand == 0317){//<page0317>
    side = unit; 
    //</page0317>
    }
    if(localCommand == 0320){//<page0320>
    ctx.strokeStyle="black";
    ctx.lineWidth = 2;    	
    ctx.fillStyle = "black";
    currentStroke = "black";
    currentFill = "black";
    //</page0320>
    }
    if(localCommand == 0321){//<page0321>
    ctx.strokeStyle = "white";
    ctx.lineWidth = 2;    	
    ctx.fillStyle = "white";
    currentStroke = "white";
    currentFill = "white";
    //</page0321>
    }
    if(localCommand == 0322){//<page0322>
    ctx.strokeStyle="red";
    ctx.lineWidth = 2;
    ctx.fillStyle = "red";    
    currentStroke = "red";
    currentFill = "red";
    //</page0322>
    }
    if(localCommand == 0323){//<page0323>
    ctx.strokeStyle="orange";
    ctx.lineWidth = 2;
    ctx.fillStyle = "orange";    
    currentStroke = "orange";
    currentFill = "orange";
    //</page0323>
    }
    if(localCommand == 0324){//<page0324>
    ctx.strokeStyle="yellow";
    ctx.lineWidth = 2;
    ctx.fillStyle = "yellow";    
    currentStroke = "yellow";
    currentFill = "yellow";
    //</page0324>
    }
    if(localCommand == 0325){//<page0325>
    ctx.strokeStyle="green";
    ctx.lineWidth = 2;
    ctx.fillStyle = "green";    
    currentStroke = "green";
    currentFill = "green";
    //</page0325>
    }
    if(localCommand == 0326){//<page0326>
    ctx.strokeStyle="blue";
    ctx.lineWidth = 2;
    ctx.fillStyle = "blue";    
    currentStroke = "blue";
    currentFill = "blue";
    //</page0326>
    }
    if(localCommand == 0327){//<page0327>
    ctx.strokeStyle="purple";
    ctx.lineWidth = 2;
    ctx.fillStyle = "purple";    
    currentStroke = "purple";
    currentFill = "purple";
    //</page0327>
    }
    if(localCommand == 0330){//<page0330>
    x += side*Math.cos(theta);   
    y += side*Math.sin(theta); 
    //</page0330>
    }
    if(localCommand == 0331){//<page0331>
    x -= side*Math.cos(theta);   
    y -= side*Math.sin(theta); 
    //</page0331>
    }
    if(localCommand == 0332){//<page0332>
    x += side*Math.cos(theta - thetaStep);
    y += side*Math.sin(theta - thetaStep);
    //</page0332>
    }
    if(localCommand == 0333){//<page0333>
    x += side*Math.cos(theta + thetaStep);
    y += side*Math.sin(theta + thetaStep);
    //</page0333>
    }
    if(localCommand == 0334){//<page0334>
    theta -= thetaStep; // CCW
    //</page0334>    
    }
    if(localCommand == 0335){//<page0335>
    theta += thetaStep; // CW
    //</page0335>
    }
    if(localCommand == 0336){//<page0336>
    side /= scaleFactor; // -
    //</page0336>
    }
    if(localCommand == 0337){//<page0337>
    side *= scaleFactor; // +
    //</page0337>
    }
    if(localCommand == 0340){//<page0340>

    //point
    ctx.beginPath();
    ctx.arc(x, y, 3, 0, 2 * Math.PI);
    ctx.fill();	
    ctx.closePath();
    currentSVG += "<circle cx=\"";
    currentSVG += Math.round(x).toString();
    currentSVG += "\" cy = \"";
    currentSVG += Math.round(y).toString();
    currentSVG += "\" r = \"3\" stroke = \"" + currentStroke + "\" stroke-width = \"2\" ";
    currentSVG += "fill = \"" + currentStroke + "\" />\n";		
    //</page0340>
    }
    if(localCommand == 0341){//<page0341>
    //circle
    ctx.beginPath();
    ctx.arc(x, y, side, 0, 2 * Math.PI);
    ctx.closePath();
    ctx.stroke();
    currentSVG += "    <circle cx=\"";
    currentSVG += Math.round(x).toString();
    currentSVG += "\" cy = \"";
    currentSVG += Math.round(y).toString();
    currentSVG += "\" r = \"" + side.toString() + "\" stroke = \"" + currentStroke + "\" stroke-width = \"2\" ";
    currentSVG += "fill = \"none\" />\n";		
    //</page0341>
    }
    if(localCommand == 0342){//<page0342>
    //line
    ctx.beginPath();
    ctx.moveTo(x,y);
    ctx.lineTo(x + side*Math.cos(theta),y + side*Math.sin(theta));
    ctx.stroke();		
    ctx.closePath();

    var x2 = Math.round(x + side*Math.cos(theta));
    var y2 = Math.round(y + side*Math.sin(theta));
    currentSVG += "    <line x1=\""+Math.round(x).toString()+"\" y1=\""+Math.round(y).toString()+"\" x2=\""+x2.toString()+"\" y2=\""+y2.toString()+"\" style=\"stroke:" + currentStroke + ";stroke-width:2\" />\n"

    //</page0342>
    }
    if(localCommand == 0343){//<page0343>
    ctx.beginPath();
    ctx.arc(x, y, side, theta - thetaStep,theta + thetaStep);
    ctx.stroke();
    ctx.closePath();
    localString = "";
    localString += "  <path d=\"";	
    localString += "M";
    var localInt = x + side*Math.cos(theta - thetaStep);
    localString += localInt.toString();
    localString += " ";
    localInt = y + side*Math.sin(theta - thetaStep);
    localString += localInt.toString();
    currentSVG += localString;
    localString = "           A" + side.toString() + " " + side.toString() + " 0 0 1 ";
    localInt = x + side*Math.cos(theta + thetaStep);
    localString += localInt.toString() + " ";
    localInt = y + side*Math.sin(theta + thetaStep);
    localString += localInt.toString() + "\" fill = \"none\" stroke = \"" + currentStroke + "\" stroke-width = \"2\" />\n";
    currentSVG += localString;
    //</page0343>    
    }
    if(localCommand == 0344){//<page0344>
    //part of a poly line or path 
    ctx.lineTo(x + side*Math.cos(theta),y + side*Math.sin(theta));
    ctx.stroke();		

    var x2 = Math.round(x + side*Math.cos(theta));
    var y2 = Math.round(y + side*Math.sin(theta));
    currentSVG += "L" + x2 + " " + y2 + " ";

    //</page0344>
    }
    if(localCommand == 0345){//<page0345>
    //arc
    ctx.arc(x, y, side, theta - thetaStep,theta + thetaStep);
    ctx.stroke();

    localString = "";
    localString += "M";
    var localInt = x + side*Math.cos(theta - thetaStep);
    localString += localInt.toString();
    localString += " ";
    localInt = y + side*Math.sin(theta - thetaStep);
    localString += localInt.toString();
    currentSVG += localString;
    localString = "           A" + side.toString() + " " + side.toString() + " 0 0 1 ";
    localInt = x + side*Math.cos(theta + thetaStep);
    localString += localInt.toString() + " ";
    localInt = y + side*Math.sin(theta + thetaStep);
    localString += localInt.toString();
    currentSVG += localString;

    //</page0345>
    }
    if(localCommand == 0346){//<page0346>
    //arc, reverse direction
    ctx.arc(x, y, side, theta + thetaStep,theta - thetaStep,true);
    ctx.stroke();

    localString = "";
    localString += "M";
    var localInt = x + side*Math.cos(theta - thetaStep);
    localString += localInt.toString();
    localString += " ";
    localInt = y + side*Math.sin(theta - thetaStep);
    localString += localInt.toString();
    currentSVG += localString;
    localString = "           A" + side.toString() + " " + side.toString() + " 0 0 1 ";
    localInt = x + side*Math.cos(theta + thetaStep);
    localString += localInt.toString() + " ";
    localInt = y + side*Math.sin(theta + thetaStep);
    localString += localInt.toString();
    currentSVG += localString;
    //</page0346>
    }
    if(localCommand == 0347){//<page0347>
    //filled circle
    ctx.beginPath();
    ctx.arc(x, y, side, 0, 2 * Math.PI);
    ctx.closePath();
    ctx.stroke();
    ctx.fill();
    currentSVG += "    <circle cx=\"";
    currentSVG += Math.round(x).toString();
    currentSVG += "\" cy = \"";
    currentSVG += Math.round(y).toString();
    currentSVG += "\" r = \"" + side.toString() + "\" stroke = \"" + currentStroke + "\" stroke-width = \"2\" ";
    currentSVG += "fill = \"" + currentFill + "\" />\n";		

    //</page0347>
    }
    if(localCommand == 0350){//<page0350>
    thetaStep /= 2;  //angle/2
    //</page0350>
    }
    if(localCommand == 0351){//<page0351>
    thetaStep *= 2;  //2angle
    //</page0351>
    }
    if(localCommand == 0352){//<page0352>
    thetaStep /= 3; //angle/3
    //</page0352>
    }
    if(localCommand == 0353){//<page0353>
    thetaStep *= 3; //3angle
    //</page0353>
    }
    if(localCommand == 0360){//<page0360>  //first part of bezier in middle of a path
        ctx.moveTo(Math.round(x),Math.round(y));
        cpx1 = Math.round(x + side*Math.cos(theta));
        cpy1 = Math.round(y + side*Math.sin(theta));
        currentSVG += " M";
        currentSVG += (Math.round(x)).toString() + ",";
        currentSVG += (Math.round(y)).toString() + " C";
        currentSVG += cpx1.toString() + "," + cpy1.toString() + " ";
    //</page0360>
    }
    if(localCommand == 0361){//<page0361>
        x2 = Math.round(x);
        y2 = Math.round(y);
        cpx2 = Math.round(x + side*Math.cos(theta));
        cpy2 = Math.round(y + side*Math.sin(theta));
        ctx.bezierCurveTo(cpx1,cpy1,cpx2,cpy2,x2,y2);
        ctx.stroke();
        currentSVG += cpx2.toString() + "," + cpy2.toString() + " ";
        currentSVG += x2.toString() + "," + y2.toString() + " ";		
    
    //</page0361>
    }
    if(localCommand == 0362){//<page0362>
    ctx.beginPath();
    ctx.moveTo(x,y);
    currentSVG += "	<path d = \"M";
    currentSVG += Math.round(x).toString() + " ";
    currentSVG += Math.round(y).toString() + " ";

    //	   currentSVG += "  <polyline points=\"";		
    //</page0362>
    }
    if(localCommand == 0363){//<page0363>
    ctx.closePath();
    ctx.stroke();		
    ctx.fill();		
    currentSVG += "Z\""+ " stroke = \"" + currentStroke + "\" stroke-width = \"2\" fill = \"" + currentFill + "\" "+"/>";
    //</page0363>
    }
    if(localCommand == 0364){//<page0364>
    ctx.closePath();
    currentSVG += "\""+ " stroke = \"" + currentStroke + "\" stroke-width = \"2\" fill = \"" + "none" + "\" "+"/>";
    //</page0364>
    }
    if(localCommand == 0365){//<page0365>
    ctx.font=side.toString(8) + "px " + myFont;
    ctx.fillText(currentWord,x,y);
    currentSVG += "    <text x=\"";
    currentSVG += Math.round(x).toString();
    currentSVG += "\" y = \"";
    currentSVG += Math.round(y).toString();
    currentSVG += "\" fill = \"" + currentStroke + "\""; 
    currentSVG += " font-size = \"";
    currentSVG += side + "px\"";
    currentSVG += " font-family = \"futura\"";
    currentSVG += ">";
    if(currentWord == "&"){
        currentWord = "&amp;";
    }
    if(currentWord == "<"){
        currentWord = "&lt;";
    }
    if(currentWord == ">"){
        currentWord = "&gt;";
    }
    currentSVG += currentWord;

    currentSVG += "</text>\n";	
    currentWord = "";
    currentHTML = "";
    //</page0365>
    }
    if(localCommand == 0366){//<page0366>
    ctx.beginPath();
    ctx.moveTo(Math.round(x),Math.round(y));
    cpx1 = Math.round(x + side*Math.cos(theta));
    cpy1 = Math.round(y + side*Math.sin(theta));
    currentSVG += "<path    d = \"M";
    currentSVG += (Math.round(x)).toString() + ",";
    currentSVG += (Math.round(y)).toString() + " C";
    currentSVG += cpx1.toString() + "," + cpy1.toString() + " ";

    //<path  d="M100,200 C150,150 200,150 250,200" />
    //</page0366>
    }
    if(localCommand == 0367){//<page0367>
    x2 = Math.round(x);
    y2 = Math.round(y);
    cpx2 = Math.round(x + side*Math.cos(theta));
    cpy2 = Math.round(y + side*Math.sin(theta));
    ctx.bezierCurveTo(cpx1,cpy1,cpx2,cpy2,x2,y2);
    ctx.stroke();
    currentSVG += cpx2.toString() + "," + cpy2.toString() + " ";
    currentSVG += x2.toString() + "," + y2.toString() + "\" fill = \"none\" stroke-width = \"2\" stroke = \"" + currentStroke + "\" />";		
    //</page0367>
    }
    
 
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
{
    "imgurl": "https://i.imgur.com/t8GMiKT.jpg",
    "imgw": "21",
    "imgleft": "-8.5",
    "imgtop": "-10.7",
    "unitpixels": 100,
    "unitfeet": 400,
    "latlon0": "28.6024,-81.2002",
    "marker0": "center",
    "glyph0": "0341,0340,",
    "latlon1": "28.6056,-81.2002",
    "marker1": "apollo noon",
    "glyph1": "0341,0340,",
    "currentGlyph": "0340,0341,0337,0341,0337,0341,0336,0336,0314,0337,0341,0336,0313,0330,0330,0330,0336,0336,0340,0336,0336,0330,0337,01011,0101,0160,0157,0154,0154,0157,040,0116,0157,0162,0164,0150,0365,01011,0360,0337,0337,0331,0333,0333,0331,0331,0331,0331,0331,0331,0333,0331,0331,0333,0331,0331,0333,0333,0333,0331,0331,0201,0350,0335,0201,0335,0201,0335,0201,0335,0201,0335,0201,0335,0201,0335,0201,0335,0330,0306,0335,0201,0335,0201,0335,0201,0335,0201,0335,0201,0335,0201,0305,0335,0201,0335,0201,0335,0201,0335,0201,0335,0304,0201,0335,0201,0335,0201,0335,0201,0335,0201,0306,0335,0335,0201,0335,0335,0201,0335,0335,0336,0330,0341,0337,0337,0341,0330,0333,0333,0360,0337,0337,",
    "links": [
        {
            "url": "https://sciences.ucf.edu/physics/",
            "text": "Physics Department",
            "latlon": "28.5999, -81.198053"
        },
        {
            "url": "http://locations.einsteinbros.com",
            "text": "Einstein Bagelzzzzzzz",
            "latlon": "28.601115, -81.199387"
        }
    ],
    "images": [
        {
            "url": "https://i.imgur.com/rV9CWwx.jpg",
            "latlon": "28.599889, -81.1981",
            "unitfeet": 503
        },
        {
            "url": "https://i.imgur.com/8nGddQU.jpg",
            "latlon": "28.609503, -81.197801",
            "unitfeet": 500
        }
    ],
    "avatar": {
        "glyph": "0322,0340,0341,0342,",
        "unitfeet": 100
    }
}</div>    
<div id = "extdatadiv" style = "display:none"><?php
if(isset($_GET['url'])){
    echo file_get_contents($_GET['url']);
}?></div>
<div id = "page">
<a  id = "editorlink" href = "editor.php">editor.php</a>
<canvas id="invisibleCanvas" style="display:none"></canvas>
<canvas id="mainCanvas"></canvas>
<textarea id="textIO"></textarea>
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

if(document.getElementById("extdatadiv").innerHTML.length > 10){
    currentJSON = JSON.parse(document.getElementById("extdatadiv").innerHTML);
}

unit = currentJSON.unitpixels;

document.getElementById("mainImage").src = currentJSON.imgurl;

imagedata[0].value = currentJSON.imgurl;
imagedata[1].value = currentJSON.imgw;
imagedata[2].value = currentJSON.imgtop;
imagedata[3].value = currentJSON.imgleft;

</script>
<script id = "redraw">
redraw();
function redraw(){
       
    ctx = document.getElementById("mainCanvas").getContext("2d");
    ctx.clearRect(0,0,innerWidth,innerHeight);
    doTheThing(0300);
    drawGlyph(currentJSON.glyph0);

    doTheThing(0300);
    var xy = latlon2xy(currentJSON.latlon1);
    var xvar = parseFloat(xy.split(",")[0]);
    x = x0 + unit*xvar;
    var yvar = parseFloat(xy.split(",")[1]);
    y = y0 - unit*yvar;
    drawGlyph(currentJSON.glyph1);

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
</script>
<script id = "pageevents">

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


</script>
<style>

 #editorlink{
     position:absolute;
     left:70%;
     top:10px;
     z-index:2;
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
#imageTable{
    right:15px;
    top:15px;
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