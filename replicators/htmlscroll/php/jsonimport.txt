<!doctype html>
<html>
<head>
<title>Import JSON from remote url</title>
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
   <a href = "editor.php" id = "editorlink">editor.php</a>    
   <textarea id  = "textIO"></textarea>
   <div class = "button" id = "getjson">IMPORT JSON</div>
<script>

document.getElementById("getjson").onclick = function(){
    newjson = JSON.parse(document.getElementById("textIO").value);
    currentFile = newjson.url;
    var httpc = new XMLHttpRequest();
    httpc.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            data = this.responseText;//get contents of txt file
            localFile = newjson.type + "/" + newjson.filename;
            var httpc = new XMLHttpRequest();
            var url = "filesaver.php";        
            httpc.open("POST", url, true);
            httpc.setRequestHeader("Content-Type", "application/x-www-form-urlencoded;charset=utf-8");
            httpc.send("data="+data+"&filename="+localFile);//send text to filesaver.php
        }
    };
    httpc.open("GET", "fileloader.php?filename=" + currentFile, true);
    httpc.send();
        
}

foo = {
        "type":"php",
        "filename":"text2php.txt",
        "localpath":"metamap/wmcalc/",
        "url":"https://raw.githubusercontent.com/LafeLabs/watershed/master/metamap/wmcalc/php/text2php.txt",
        "description":""
}    
    
</script>
<style>
#textIO{
    position:absolute;
    left:30%;
    right:30%;
    top:30%;
    bottom:5%;
    font-size:26px;
    font-family:courier;
    border:solid;
}
#getjson{
    position:absolute;
    left:50%;
    top:10px;
}
#editorlink{
    position:absolute;
    top:0px;
    left:50px;
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
 </style> 
</body>
</html>