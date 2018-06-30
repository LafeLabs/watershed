 <!doctype html>
<html>
<head>
 <!-- 
PUBLIC DOMAIN, NO COPYRIGHTS, NO PATENTS.

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
<script src="https://cdnjs.cloudflare.com/ajax/libs/ace/1.2.6/ace.js" type="text/javascript" charset="utf-8"></script>
<title>Wall Editor</title>
</head>
<body>
<table id = "linktable">
    <tr><td><a id = "indexlink" href = "index.php">
        BACK TO WALL
    </a></td></tr>
    <tr><td><a id = "postlink" href = "post.php">
        POST TO WALL
    </a></tr></td>
    <tr><td><a id = "editorlink" href = "editor.php">
        CODE EDITOR
    </a></tr></td>
    <tr><td><a id = "feedslink" href = "wallhistory.php">
        WALL HISTORY
    </a></tr></td>
</table>

<div class = "button" id = "savefeedbutton">SAVE CURRENT WALL</div>
<div class = "button" id = "loadfeedbutton">LOAD RECENT WALL</div>
<div id = "editbox">
    <textarea id = "maineditor"></textarea>
</div>

<script>
currentFile = "html/wall.txt";
var httpc = new XMLHttpRequest();
httpc.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        filedata = this.responseText;
        document.getElementById("maineditor").value = filedata;
    }
};
httpc.open("GET", "fileloader.php?filename=" + currentFile, true);
httpc.send();

document.getElementById("maineditor").onkeyup = function(){
    data = encodeURIComponent(document.getElementById("maineditor").value);
    var httpc = new XMLHttpRequest();
    var url = "filesaver.php";        
    httpc.open("POST", url, true);
    httpc.setRequestHeader("Content-Type", "application/x-www-form-urlencoded;charset=utf-8");
    httpc.send("data="+data+"&filename="+currentFile);//send text to filesaver.php
}

document.getElementById("savefeedbutton").onclick = function(){

    httpc.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("maineditor").value = filedata;
            }
    };
    
    filedata = document.getElementById("maineditor").value;
    httpc.open("POST", "savewall.php", true);
    httpc.setRequestHeader("Content-Type", "application/x-www-form-urlencoded;charset=utf-8");
    httpc.send();

}
document.getElementById("loadfeedbutton").onclick = function(){

    
    httpc.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            filedata = this.responseText;
            document.getElementById("maineditor").value = filedata;
        }
    };

    httpc.open("GET", "loadwall.php", true);
    httpc.setRequestHeader("Content-Type", "application/x-www-form-urlencoded;charset=utf-8");
    httpc.send();

}

</script>
<style>
body{
    font-family:helvetica;
    font-size:1.5em;
}
input{
    font-family:helvetica;
    font-size:1.5em;
}
textarea{
    font-family:helvetica;
    font-size:1.5em;
}
.button{
    padding:0.5em 0.5em 0.5em 0.5em;
    cursor:pointer;
    border:solid;
    border-radius:0.25em;
    text-align:center;
}
.button:hover{
    background-color:green;
}
.button:active{
    background-color:yellow;
}
#savefeedbutton{
    position:absolute;
    left:1em;
    top:1em;
    width:10em;
}
#loadfeedbutton{
    position:absolute;
    right:1em;
    top:1em;
    width:10em;
}
#linktable{
    position:absolute;
    top:0px;
    width:40%;
    left:30%;
    text-align:center;
}
#maineditor{
    height:100%;
    width:100%;
}
#editbox{
    position:absolute;
    top:7em;
    right:2em;
    left:2em;
    bottom:2em;
    overflow:scroll;
}
</style>
</body>
</html>