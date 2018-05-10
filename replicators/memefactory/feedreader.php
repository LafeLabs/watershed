<!doctype html>
<html>
    <head>
        <title>Meme Feed</title>
    </head>
    <body>
        <div id = "datadiv" style = "display:none">
            <?php
                echo file_get_contents("json/memefeed.txt");
            ?>
        </div>
        <div id = "memescroll">
            
        </div>
        <script>
            memefeed = JSON.parse("[" + document.getElementById("datadiv").innerHTML + "]");
            for(var index = 0;index < memefeed.length;index++){
                var newdiv = document.createElement("DIV");
                document.getElementById("memescroll").appendChild(newdiv);
                newdiv.className = "meme";
                newdiv.style.backgroundImage = "url('" + memefeed[index].url + "')";
            }
        </script>
        <style>
        * {
            box-sizing: border-box;
        }
        #memescroll{
            position:absolute;
            overflow:scroll;
            top:10px;
            left:10px;
            bottom:1px;
            right:10px;
            border:solid;
        }
        
        .meme {
  margin: auto;
  width: 80%;
  background-size: 100%; 
  text-align: center;
  position: relative;
}

p {
  position: absolute; 
  left: 0;
  right: 0; 
  margin: 15px 0;
  padding: 0 5px;
  font-family: impact;
  font-size: 2.5em;
  text-transform: uppercase;
  color: white;
  letter-spacing: 1px;
}

.bottom {
   bottom: 0;
 }

.top {
   top: 0;
 }
        </style>
    </body>
</html>