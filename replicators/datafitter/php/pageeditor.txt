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
<title>Page Editor</title>
</head>
<body>
<a id = "pagelink" href = "index.php">Back to Page</a>
<a id = "editorlink" href = "editor.php">Code Editor</a>
<div id="maineditor" contenteditable="true" spellcheck="false"></div>

<div id = "scroll">
    
</div>
<script>
currentFile = "html/page.txt";
var httpc = new XMLHttpRequest();
httpc.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        filedata = this.responseText;
        editor.setValue(filedata);
            document.getElementById("scroll").innerHTML = filedata;
    }
};
httpc.open("GET", "fileloader.php?filename=" + currentFile, true);
httpc.send();


editor = ace.edit("maineditor");
editor.setTheme("ace/theme/cobalt");
editor.getSession().setMode("ace/mode/html");
editor.getSession().setUseWrapMode(true);
editor.$blockScrolling = Infinity;

document.getElementById("maineditor").onkeyup = function(){
    document.getElementById("scroll").innerHTML = editor.getSession().getValue();
    data = encodeURIComponent(editor.getSession().getValue());
    var httpc = new XMLHttpRequest();
    var url = "filesaver.php";        
    httpc.open("POST", url, true);
    httpc.setRequestHeader("Content-Type", "application/x-www-form-urlencoded;charset=utf-8");
    httpc.send("data="+data+"&filename="+currentFile);//send text to filesaver.php
}

</script>
<style>
body{
    background-color:#404040;
}

#maineditor{
    position:absolute;
    top:5em;
    bottom:50%;
    right:2em;
    left:2em;
    font-size:22px;
}
#scroll{
    position:absolute;
    bottom:1em;
    top:50%;
    right:2em;
    left:2em;
    background-color:white;
    overflow:scroll;
    padding:1em 1em 1em 1em;
    
}
#scroll h1,h2,h3,h4,h5{
    width:100%;
    text-align:center;
}
#scroll img{
    width:80%;
    display:block;
    margin:auto;
}
#editorlink{
    position:absolute;
    right:1em;
    top:1em;
    color:white;
    display:block;
    font-size:24px;
}
#pagelink{
    position:absolute;
    left:1em;
    top:1em;
    color:white;
    display:block;
    font-size:24px;
}

</style>

</body>
</html>