<!doctype html>
<html>
    <head>
        <title>Link JSON Editor</title>
    </head>
    <body>
        <div id = "datadiv" style = "display:none">
            <?php
                echo file_get_contents("json/currentjson.txt");
            ?>
        </div>    
        <a id = "editorLink" href = "editor.php">editor.php</a>
        <table id = "mainTable">
            <tr>
                <td class = "button">PREV</td><td class = "button">NEXT</td><td  class = "button">NEW</td>
            </tr>
            <tr>
                <td>url:</td><td><input/></td>
            </tr>
            <tr>
                <td>text:</td><td><input/></td>
            </tr>
            <tr>
                <td>latlon:</td><td><input/></td>
            </tr>
            <tr>
                <td>fontfeet:</td><td><input/></td>
            </tr>
            <tr>
                <td>rotation:</td><td><input/></td>
            </tr>
        </table>
        <textarea id = "textIO"></textarea>        
        <script>
            currentJSON = JSON.parse(document.getElementById("datadiv").innerHTML);
            document.getElementById("textIO").value = JSON.stringify(currentJSON.links,null,"    ");
            linkIndex = 0;
            inputs = document.getElementsByTagName("input");
            buttons = document.getElementsByClassName("button");
            redraw();
            
            function redraw(){
                inputs[0].value = currentJSON.links[linkIndex].url;
                inputs[1].value = currentJSON.links[linkIndex].text;
                inputs[2].value = currentJSON.links[linkIndex].latlon;
                inputs[3].value = currentJSON.links[linkIndex].fontfeet;
                inputs[4].value = currentJSON.links[linkIndex].rotation;
            }
            function redraw2(){
                    document.getElementById("textIO").value = JSON.stringify(currentJSON.links,null,"    ");
                    data = encodeURIComponent(JSON.stringify(currentJSON,null,"    "));
                    var httpc = new XMLHttpRequest();
                    var url = "filesaver.php";        
                    httpc.open("POST", url, true);
                    httpc.setRequestHeader("Content-Type", "application/x-www-form-urlencoded;charset=utf-8");
                    httpc.send("data="+data+"&filename=json/currentjson.txt");//send text to filesaver.php
            }
            
            inputs[0].onchange = function(){
                    currentJSON.links[linkIndex].url = this.value;
                    redraw2();
            }
            inputs[1].onchange = function(){
                    currentJSON.links[linkIndex].text = this.value;
                    redraw2();
            }
            inputs[2].onchange = function(){
                    currentJSON.links[linkIndex].latlon = this.value;
                    redraw2();
            }
            inputs[3].onchange = function(){
                    currentJSON.links[linkIndex].fontfeet = this.value;
                    redraw2();
            }
            inputs[4].onchange = function(){
                    currentJSON.links[linkIndex].rotation = this.value;
                    redraw2();
            }

            
            buttons[0].onclick  = function(){
                linkIndex--;
                if(linkIndex < 0){
                    linkIndex = currentJSON.links.length - 1;
                }                
                redraw();
            }
            buttons[1].onclick  = function(){
                linkIndex++;
                if(linkIndex >= currentJSON.links.length){
                    linkIndex = 0;
                }               
                redraw();
            }
    
            buttons[2].onclick  = function(){
                var foo = JSON.stringify(currentJSON.links[0],null,"    ");
                var zeep = JSON.parse(foo);
                currentJSON.links.push(zeep);
                document.getElementById("textIO").value = JSON.stringify(currentJSON.links,null,"    ");
                data = encodeURIComponent(JSON.stringify(currentJSON,null,"    "));
                var httpc = new XMLHttpRequest();
                var url = "filesaver.php";        
                httpc.open("POST", url, true);
                httpc.setRequestHeader("Content-Type", "application/x-www-form-urlencoded;charset=utf-8");
                httpc.send("data="+data+"&filename=json/currentjson.txt");//send text to filesaver.php
                redraw();
            }

document.getElementById("textIO").onkeyup = function(){
    currentJSON.links = JSON.parse(document.getElementById("textIO").value);
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
