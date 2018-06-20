<!doctype html>
<html>
    <head>
        <title>Image Array JSON Editor</title>
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
    <div id = "page">
        
        <a id = "editorLink" href = "editor.php">editor.php</a>
        <a id = "indexLink" href = "index.php">index.php</a>

        <table id = "mainTable">
            <tr>
                <td>url:</td><td><input/></td>
            </tr>
            <tr>
                <td>unitfeet:</td><td><input/></td>
            </tr>
            <tr>
                <td>latlon:</td><td><input/></td>
            </tr>
            <tr>
                <td>rotation:</td><td><input/></td>
            </tr>
        </table>
        <textarea id = "textIO"></textarea>        
        <img id = "mainImage"/>
        
        <table id = "buttontable">
            <tr>
                <td class = "button">PREV</td>
                <td class = "button">NEXT</td>
                <td  class = "button">NEW</td>
                <td class = "button">DELETE</td>
            </tr>
            <tr>
                <td class = "button">&#x2bc5</td>
                <td class = "button">&#x2bc6</td>
                <td class = "button">&#x2bc7</td>
                <td class = "button">&#x2bc8</td>
            </tr>
            <tr>
                <td class = "button">&#x2a38</td>
                <td class = "button">&#x2a37</td>
                <td class = "button">&#x2796</td>
                <td class = "button">&#x2795</td>
            </tr>
            <tr>
                <td class = "button">3000' &#x2b61</td>
                <td class = "button">3000' &#x2b63</td>
                <td class = "button">2500' &#x2b60</td>
                <td class = "button">2500' &#x2b62</td>
            </tr>
            <tr>
                <td class = "button">300' &#x2b61</td>
                <td class = "button">300' &#x2b63</td>
                <td class = "button">250' &#x2b60</td>
                <td class = "button">250' &#x2b62</td>
            </tr>

            <tr>
                <td class = "button">30' &#x2b61</td>
                <td class = "button">30' &#x2b63</td>
                <td class = "button">25' &#x2b60</td>
                <td class = "button">25' &#x2b62</td>
            </tr>

            <tr>
                <td class = "button">&#x2b6f</td>
                <td class = "button">&#x2b6e</td>
                <td class = "button">0</td>
                <td class = "button">0</td>
            </tr>

        </table>
            <input id = "actioninput"/>

    </div>
        <script>
            init();
            redraw();

            function init(){
                currentJSON = JSON.parse(document.getElementById("datadiv").innerHTML);
                document.getElementById("textIO").value = JSON.stringify(currentJSON.images,null,"    ");
                imageIndex = 0;
                inputs = document.getElementsByTagName("input");
                buttons = document.getElementsByClassName("button");
                
                x0 = innerWidth/2;
                y0 = innerHeight/2;    
                unit = currentJSON.unitpixels;
                document.getElementById("mainImage").src = currentJSON.imgurl;
                
                
                for(var index = 0;index < currentJSON.images.length;index++){
                    var newimg = document.createElement("img");
                    newimg.className = "imgs";
                    newimg.src = currentJSON.images[index].url;
                    document.getElementById("page").appendChild(newimg);
                }
                imgs = document.getElementsByClassName("imgs");


            }
            function redraw(){
                
                inputs[0].value = currentJSON.images[imageIndex].url;
                inputs[1].value = currentJSON.images[imageIndex].unitfeet;
                inputs[2].value = currentJSON.images[imageIndex].latlon;
                if(currentJSON.images[imageIndex].rotation != undefined){
                    inputs[3].value = currentJSON.images[imageIndex].rotation;
                }    

                document.getElementById("mainImage").style.width = (currentJSON.imgw*unit).toString()  + "px";
                document.getElementById("mainImage").style.left = (x0 + currentJSON.imgleft*unit).toString()  + "px";
                document.getElementById("mainImage").style.top = (y0 + currentJSON.imgtop*unit).toString()  + "px";
                document.getElementById("mainImage").style.transform = "rotate(" + currentJSON.imgangle.toString() +"deg)";

                for(var index = 0;index < imgs.length;index++){
                    var xy = latlon2xy(currentJSON.images[index].latlon);
                    var xvar = parseFloat(xy.split(",")[0]);
                    imgs[index].style.left = (x0 + unit*xvar).toString() + "px";
                    var yvar = parseFloat(xy.split(",")[1]);
                    imgs[index].style.top = (y0 - unit*yvar).toString() + "px";
                    imgs[index].style.width = (unit*currentJSON.images[index].unitfeet/currentJSON.unitfeet).toString() + "px";
                    imgs[index].style.border = "none";
                    if(currentJSON.images[index].rotation != undefined){
                        imgs[index].style.transform = "rotate(" + currentJSON.images[index].rotation.toString() + "deg)";
                    }    
                    
                }
                
                imgs[imageIndex].style.border = "solid";


                
            }
            function redraw2(){
                    document.getElementById("textIO").value = JSON.stringify(currentJSON.images,null,"    ");
                    data = encodeURIComponent(JSON.stringify(currentJSON,null,"    "));
                    var httpc = new XMLHttpRequest();
                    var url = "filesaver.php";        
                    httpc.open("POST", url, true);
                    httpc.setRequestHeader("Content-Type", "application/x-www-form-urlencoded;charset=utf-8");
                    httpc.send("data="+data+"&filename=json/currentjson.txt");//send text to filesaver.php
                    redraw();
            }
            
            inputs[0].onchange = function(){
                    currentJSON.images[imageIndex].url = this.value;
                    imgs[imageIndex].src = this.value;
                    redraw2();
            }
            inputs[1].onchange = function(){
                    currentJSON.images[imageIndex].unitfeet = parseFloat(this.value);
                    redraw2();
            }
            inputs[2].onchange = function(){
                    currentJSON.images[imageIndex].latlon = this.value;
                    redraw2();
            }
            inputs[3].onchange = function(){
                    currentJSON.images[imageIndex].rotation = parseFloat(this.value);
                    redraw2();
            }

            
            buttons[0].onclick  = function(){
                imageIndex--;
                if(imageIndex < 0){
                    imageIndex = currentJSON.images.length - 1;
                }                
                redraw();
            }
            buttons[1].onclick  = function(){
                imageIndex++;
                if(imageIndex >= currentJSON.images.length){
                    imageIndex = 0;
                }               
                redraw();
            }

            buttons[2].onclick  = function(){
                var foo = JSON.stringify(currentJSON.images[0],null,"    ");
                var zeep = JSON.parse(foo);
                currentJSON.images.push(zeep);
                document.getElementById("textIO").value = JSON.stringify(currentJSON.images,null,"    ");
                data = encodeURIComponent(JSON.stringify(currentJSON,null,"    "));
                var httpc = new XMLHttpRequest();
                var url = "filesaver.php";        
                httpc.open("POST", url, true);
                httpc.setRequestHeader("Content-Type", "application/x-www-form-urlencoded;charset=utf-8");
                httpc.send("data="+data+"&filename=json/currentjson.txt");//send text to filesaver.php
                redraw();
            }
            buttons[3].onclick = function(){ //delete

                var foo = JSON.stringify(currentJSON.images,null,"    ");
                var zeep = JSON.parse(foo);
                currentJSON.images = [];
                for(var index = 0;index < zeep.length;index++){
                    if(index != imageIndex){
                        currentJSON.images.push(zeep[index]);
                    }
                }
                
                document.getElementById("textIO").value = JSON.stringify(currentJSON.images,null,"    ");
                data = encodeURIComponent(JSON.stringify(currentJSON,null,"    "));
                var httpc = new XMLHttpRequest();
                var url = "filesaver.php";        
                httpc.open("POST", url, true);
                httpc.setRequestHeader("Content-Type", "application/x-www-form-urlencoded;charset=utf-8");
                httpc.send("data="+data+"&filename=json/currentjson.txt");//send text to filesaver.php
                redraw();

            }
            buttons[4].onclick = function(){
                y0 -= 50;
                redraw2();
            }
            buttons[5].onclick = function(){
                y0 += 50;
                redraw2();
            }
            buttons[6].onclick = function(){
                x0 -= 50;
                redraw2();
            }
            buttons[7].onclick = function(){
                x0 += 50;
                redraw2();
            }
            
            buttons[8].onclick = function(){
                currentJSON.images[imageIndex].unitfeet /= 1.5; 
                redraw2();
            }
            buttons[9].onclick = function(){
                currentJSON.images[imageIndex].unitfeet *= 1.5; 
                redraw2();
            }

            buttons[10].onclick = function(){
                unit /= 1.3;
                redraw2();
            }
            buttons[11].onclick = function(){
                unit *= 1.3;
                redraw2();
            }


            buttons[12].onclick = function(){
                var locallat = parseFloat(currentJSON.images[imageIndex].latlon.split(",")[0]);
                var locallon = parseFloat(currentJSON.images[imageIndex].latlon.split(",")[1]);
                locallat += 0.01;
                locallat = Math.round(locallat*100000)*0.00001;
                localon = Math.round(locallon*100000)*0.00001;
                currentJSON.images[imageIndex].latlon = locallat.toFixed(5) + "," + locallon.toFixed(5);
                redraw2();
            }
            buttons[13].onclick = function(){
                var locallat = parseFloat(currentJSON.images[imageIndex].latlon.split(",")[0]);
                var locallon = parseFloat(currentJSON.images[imageIndex].latlon.split(",")[1]);
                locallat -= 0.01;
                locallat = Math.round(locallat*100000)*0.00001;
                localon = Math.round(locallon*100000)*0.00001;
                currentJSON.images[imageIndex].latlon = locallat.toFixed(5) + "," + locallon.toFixed(5);
                redraw2();
            }
            buttons[14].onclick = function(){
                var locallat = parseFloat(currentJSON.images[imageIndex].latlon.split(",")[0]);
                var locallon = parseFloat(currentJSON.images[imageIndex].latlon.split(",")[1]);
                locallon -= 0.01;
                locallat = Math.round(locallat*100000)*0.00001;
                localon = Math.round(locallon*100000)*0.00001;
                currentJSON.images[imageIndex].latlon = locallat.toFixed(5) + "," + locallon.toFixed(5);
                redraw2();
            }
            buttons[15].onclick = function(){
                var locallat = parseFloat(currentJSON.images[imageIndex].latlon.split(",")[0]);
                var locallon = parseFloat(currentJSON.images[imageIndex].latlon.split(",")[1]);
                locallon += 0.01;
                locallat = Math.round(locallat*100000)*0.00001;
                localon = Math.round(locallon*100000)*0.00001;
                currentJSON.images[imageIndex].latlon = locallat.toFixed(5) + "," + locallon.toFixed(5);
                redraw2();
            }

            buttons[16].onclick = function(){
                var locallat = parseFloat(currentJSON.images[imageIndex].latlon.split(",")[0]);
                var locallon = parseFloat(currentJSON.images[imageIndex].latlon.split(",")[1]);
                locallat += 0.001;
                locallat = Math.round(locallat*100000)*0.00001;
                localon = Math.round(locallon*100000)*0.00001;
                currentJSON.images[imageIndex].latlon = locallat.toFixed(5) + "," + locallon.toFixed(5);
                redraw2();
            }
            buttons[17].onclick = function(){
                var locallat = parseFloat(currentJSON.images[imageIndex].latlon.split(",")[0]);
                var locallon = parseFloat(currentJSON.images[imageIndex].latlon.split(",")[1]);
                locallat -= 0.001;
                locallat = Math.round(locallat*100000)*0.00001;
                localon = Math.round(locallon*100000)*0.00001;
                currentJSON.images[imageIndex].latlon = locallat.toFixed(5) + "," + locallon.toFixed(5);
                redraw2();
            }
            buttons[18].onclick = function(){
                var locallat = parseFloat(currentJSON.images[imageIndex].latlon.split(",")[0]);
                var locallon = parseFloat(currentJSON.images[imageIndex].latlon.split(",")[1]);
                locallon -= 0.001;
                locallat = Math.round(locallat*100000)*0.00001;
                localon = Math.round(locallon*100000)*0.00001;
                currentJSON.images[imageIndex].latlon = locallat.toFixed(5) + "," + locallon.toFixed(5);
                redraw2();
            }
            buttons[19].onclick = function(){
                var locallat = parseFloat(currentJSON.images[imageIndex].latlon.split(",")[0]);
                var locallon = parseFloat(currentJSON.images[imageIndex].latlon.split(",")[1]);
                locallon += 0.001;
                locallat = Math.round(locallat*100000)*0.00001;
                localon = Math.round(locallon*100000)*0.00001;
                currentJSON.images[imageIndex].latlon = locallat.toFixed(5) + "," + locallon.toFixed(5);
                redraw2();
            }
            

            buttons[20].onclick = function(){
                var locallat = parseFloat(currentJSON.images[imageIndex].latlon.split(",")[0]);
                var locallon = parseFloat(currentJSON.images[imageIndex].latlon.split(",")[1]);
                locallat += 0.0001;
                locallat = Math.round(locallat*100000)*0.00001;
                localon = Math.round(locallon*100000)*0.00001;
                currentJSON.images[imageIndex].latlon = locallat.toFixed(5) + "," + locallon.toFixed(5);
                redraw2();
            }
            buttons[21].onclick = function(){
                var locallat = parseFloat(currentJSON.images[imageIndex].latlon.split(",")[0]);
                var locallon = parseFloat(currentJSON.images[imageIndex].latlon.split(",")[1]);
                locallat -= 0.0001;
                locallat = Math.round(locallat*100000)*0.00001;
                localon = Math.round(locallon*100000)*0.00001;
                currentJSON.images[imageIndex].latlon = locallat.toFixed(5) + "," + locallon.toFixed(5);
                redraw2();
            }
            buttons[22].onclick = function(){
                var locallat = parseFloat(currentJSON.images[imageIndex].latlon.split(",")[0]);
                var locallon = parseFloat(currentJSON.images[imageIndex].latlon.split(",")[1]);
                locallon -= 0.0001;
                locallat = Math.round(locallat*100000)*0.00001;
                localon = Math.round(locallon*100000)*0.00001;
                currentJSON.images[imageIndex].latlon = locallat.toFixed(5) + "," + locallon.toFixed(5);
                redraw2();
            }
            buttons[23].onclick = function(){
                var locallat = parseFloat(currentJSON.images[imageIndex].latlon.split(",")[0]);
                var locallon = parseFloat(currentJSON.images[imageIndex].latlon.split(",")[1]);
                locallon += 0.0001;
                locallat = Math.round(locallat*100000)*0.00001;
                localon = Math.round(locallon*100000)*0.00001;
                currentJSON.images[imageIndex].latlon = locallat.toFixed(5) + "," + locallon.toFixed(5);
                redraw2();
            }

            buttons[24].onclick = function(){
                currentJSON.images[imageIndex].rotation -= 5;
                redraw2();
            }
            buttons[25].onclick = function(){
                currentJSON.images[imageIndex].rotation += 5;
                redraw2();
            }

            
document.getElementById("textIO").onkeyup = function(){
    currentJSON.images = JSON.parse(document.getElementById("textIO").value);
    data = encodeURIComponent(JSON.stringify(currentJSON,null,"    "));
    var httpc = new XMLHttpRequest();
    var url = "filesaver.php";        
    httpc.open("POST", url, true);
    httpc.setRequestHeader("Content-Type", "application/x-www-form-urlencoded;charset=utf-8");
    httpc.send("data="+data+"&filename=json/currentjson.txt");//send text to filesaver.php
    redraw();
}


buttonindex = 0;
highlightcolor = "green";
buttons[buttonindex].style.backgroundColor = highlightcolor;
                document.getElementById("actioninput").select();


document.getElementById("actioninput").onkeydown = function(a){
    charCode = a.keyCode || a.which;
    console.log(charCode);
    if(a.key == " "){
        buttons[buttonindex].click();
    }
    if(a.key == "f" || charCode == 047){
        buttons[buttonindex].style.backgroundColor = "transparent";
        buttonindex++;
        if(buttonindex > buttons.length - 1){
            buttonindex = 0;
        }
        buttons[buttonindex].style.backgroundColor = highlightcolor;
    }
    if(a.key == "d" || charCode == 045){
        buttons[buttonindex].style.backgroundColor = "transparent";
        buttonindex--;
        if(buttonindex < 0){
            buttonindex = buttons.length - 1;
        }
        buttons[buttonindex].style.backgroundColor = highlightcolor;
    }
    if(a.key == "s" || charCode == 050){
        buttons[buttonindex].style.backgroundColor = "transparent";
        buttonindex += 4;
        if(buttonindex > buttons.length - 1){
            buttonindex -= 28;
        }
        buttons[buttonindex].style.backgroundColor = highlightcolor;
    }
    if(a.key == "a" || charCode == 046){
        buttons[buttonindex].style.backgroundColor = "transparent";
        buttonindex -= 4;
        if(buttonindex < 0){
            buttonindex += 28;
        }
        buttons[buttonindex].style.backgroundColor = highlightcolor;
    }

    document.getElementById("actioninput").value = "";
}


</script>
<style>
    body{
        font-family:courier;
        font-size:18px;
    }
    #textIO{
        font-family:courier;
        font-size:18px;
        color:#00ff00;
        background-color:black;
        position:absolute;
        left:80%;
        right:0px;
        width:50%;
        height:80%;
    }
    #indexLink{
        position:absolute;
        left:50%;
        top:0em;
        z-index:2;
    }
    #editorLink{
        position:absolute;
        left:50%;
        top:1em;
        z-index:2;
    }
    .button{
        cursor:pointer;
    }
    .button:hover{
        background-color:green;
    }
    .button:active{
        background-color:yellow;
    }
    #buttontable{
        position:absolute;
        bottom:5px;
        left:5px;
        border-collapse:collapse;
    }
    #buttontable td{
        border:solid;
        text-align:center;
    }
    #mainImage{
        position:absolute;
        z-index:-2;
    }
    #page{
        width:100%;
        height:100%;
        position:absolute;
        left:0px;
        top:0px;
        overflow:hidden;
    }
    #actioninput{
        position:absolute;
        left:0px;
        bottom:50%;
        width:1em;
        font-size:20px;
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

        </style>
    </body>
</html>
