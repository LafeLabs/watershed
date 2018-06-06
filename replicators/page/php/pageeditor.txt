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
<!-- links to MathJax JavaScript library, un-comment to use math-->
<!--

<script src="https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.0/MathJax.js?config=TeX-AMS-MML_HTMLorMML"></script>
<script>
	MathJax.Hub.Config({
		tex2jax: {
		inlineMath: [['$','$'], ['\\(','\\)']],
		processEscapes: true,
		processClass: "mathjax",
        ignoreClass: "no-mathjax"
		}
	});//			MathJax.Hub.Typeset();//tell Mathjax to update the math
</script>

-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/ace/1.2.6/ace.js" type="text/javascript" charset="utf-8"></script>
<title>Page Editor</title>
</head>
<body  class="no-mathjax">
<a id = "pagelink" href = "index.php">index.php</a>
<a id = "editorlink" href = "editor.php">editor.php</a>
<a id = "savelink" href = "savepage.php">savepage.php</a>
<a id = "loadlink" href = "loadpage.php">loadpage.php</a>
<a id = "newpagelink" href = "metacreator.php">metacreator.php</a>

<a id = "unicodelink" href = "unicode.php">unicode.php</a>

<div id = "imgurllabel">Publish Image URL:</div>
<input id = "imgurlinput"/>

<div id="maineditor" contenteditable="true" spellcheck="false"></div>

<div id = "scroll" class = "mathjax">
    
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

    //un-comment this for math:
    //MathJax.Hub.Typeset();//tell Mathjax to update the math
}

document.getElementById("imgurlinput").onchange = function(){
    var imgtext = "\n<img src = \"" + this.value + "\"/>\n";
    document.getElementById("scroll").innerHTML = imgtext  + document.getElementById("scroll").innerHTML;
    
    editor.setValue(document.getElementById("scroll").innerHTML);
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
    top:52%;
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
    width:50%;
    display:block;
    margin:auto;
}
#imgurllabel{
    position:absolute;
    left:30%;
    font-size:20px;
    font-family:courier;
    top:0.2em;
    color:white;
}
#imgurlinput{
    position:absolute;
    display:block;
    left:30%;
    width:40%;
    font-size:20px;
    font-family:courier;
    top:1.5em;
}
#pagelink{
    position:absolute;
    left:1em;
    top:1em;
    color:white;
    display:block;
    font-size:24px;
}
#savelink{
    position:absolute;
    left:1em;
    top:2em;
    color:white;
    display:block;
    font-size:24px;
}
#loadlink{
    position:absolute;
    left:9em;
    top:1.5em;
    color:white;
    display:block;
    font-size:24px;
}
#editorlink{
    position:absolute;
    right:1em;
    top:1em;
    color:white;
    display:block;
    font-size:24px;
}
#newpagelink{
    position:absolute;
    right:1em;
    top:2em;
    color:white;
    display:block;
    font-size:24px;
}
#unicodelink{
    position:absolute;
    right:10em;
    top:2em;
        color:white;
    display:block;
    font-size:24px;

}
</style>

</body>
</html>