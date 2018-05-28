<!doctype html>
<html>
    <head>
        <title>Image JSON Editor</title>
    </head>
    <body>
        <div id = "datadiv" style = "display:none">
            <?php
                echo file_get_contents("json/currentjson.txt");
            ?>
        </div>    
        <a id = "editorLink" href = "editor.php">editor.php</a>
        <a id = "indexLink" href = "index.php">index.php</a>
        <table id = "mainTable">
            <tr>
                <td class = "button">PREV</td><td class = "button">NEXT</td><td class = "button">NEW</td>
            </tr>
            <tr>
                <td>url:</td><td><input/></td>
            </tr>
            <tr>
                <td>unitfeet:</td><td><input/></td>
            </tr>
            <tr>
                <td>latlon:</td><td><input/></td>
            </tr>
        </table>
        <textarea id = "textIO"></textarea>        
        <img id = "derp"/>
        <script>
            currentJSON = JSON.parse(document.getElementById("datadiv").innerHTML);
            document.getElementById("textIO").value = JSON.stringify(currentJSON.images,null,"    ");
            imageIndex = 0;
            inputs = document.getElementsByTagName("input");
            buttons = document.getElementsByClassName("button");
            redraw();
            
            function redraw(){
                inputs[0].value = currentJSON.images[imageIndex].url;
                inputs[1].value = currentJSON.images[imageIndex].unitfeet;
                inputs[2].value = currentJSON.images[imageIndex].latlon;
                document.getElementById("derp").src = currentJSON.images[imageIndex].url;
            }
            function redraw2(){
                    document.getElementById("textIO").value = JSON.stringify(currentJSON.images,null,"    ");
                    data = encodeURIComponent(JSON.stringify(currentJSON,null,"    "));
                    var httpc = new XMLHttpRequest();
                    var url = "filesaver.php";        
                    httpc.open("POST", url, true);
                    httpc.setRequestHeader("Content-Type", "application/x-www-form-urlencoded;charset=utf-8");
                    httpc.send("data="+data+"&filename=json/currentjson.txt");//send text to filesaver.php
            }
            
            inputs[0].onchange = function(){
                    currentJSON.images[imageIndex].url = this.value;
                    redraw2();
            }
            inputs[1].onchange = function(){
                    currentJSON.images[imageIndex].unitfeet = parseInt(this.value);
                    redraw2();
            }
            inputs[2].onchange = function(){
                    currentJSON.images[imageIndex].latlon = this.value;
                    redraw2();
            }
            
            buttons[0].onclick  = function(){
                imageIndex--;
                if(imageIndex < 0){
                    imageIndex = currentJSON.images.length - 1;
                }                
                redraw();
                console.log(imageIndex);
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



        </script>
        <style>
            body{
                font-family:courier;
                font-size:18px;
            }
            #derp{
                position:absolute;
                left:10px;
                bottom:10px;
                width:30%;
            }
            #textIO{
                font-family:courier;
                font-size:18px;
                color:#00ff00;
                background-color:black;
                position:absolute;
                left:50%;
                right:0px;
                width:50%;
                height:80%;
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
        </style>
    </body>
</html>
