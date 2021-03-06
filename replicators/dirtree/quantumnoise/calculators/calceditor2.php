 <!doctype html>
<html>
<head>
<script src="https://cdnjs.cloudflare.com/ajax/libs/ace/1.2.6/ace.js" type="text/javascript" charset="utf-8"></script>
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
<title>PHP Editor replicator</title>
</head>
<body class = "no-mathjax">
<div id = "linkscroll">
    <a href = "text2php.php">text2php.php</a>
    <a href = "index.php">index.php</a>
    <a href = "editor.php">editor.php</a>
    <a href = "dnagenerator.php" id = "dnalink">dnagenerator.php</a>
</div><!--foo-->
<div id = "calcscroll" class = "mathjax">
<div id = "calcequation"></div>
<table id = "calctable"></table>
<div style = "display:none" id = "calcdata"></div>
<div id = "calcfeed"></div>

</div>
<div id = "namediv"></div>
<div id="maineditor" contenteditable="true" spellcheck="false"></div>

<div id = "filescroll">

    <div class = "html file">html/page.txt</div>
    <div class = "css file">css/style.txt</div>
    <div class = "scrolls file">scrolls/lc.txt</div>

    <div class = "javascript file">javascript/topfunctions.txt</div>
    <div class = "javascript file">javascript/jslibrary.txt</div>
    <div class = "javascript file">javascript/init.txt</div>
    <div class = "javascript file">javascript/redraw.txt</div>
    <div class = "javascript file">javascript/pageevents.txt</div>

    <div class = "php file">php/index.txt</div>
    <div class = "php file">php/editor.txt</div>
    <div class = "php file">php/calceditor.txt</div>
    <div class = "php file">php/replicator.txt</div>
    <div class = "php file">php/filesaver.txt</div>
    <div class = "php file">php/fileloader.txt</div>
    <div class = "php file">php/text2php.txt</div>
    <div class = "php file">php/dnagenerator.txt</div>

    <div class = "json file">json/dna.txt</div>
    <div class = "json file">json/feed.txt</div>

</div>

<script>
currentFile = "php/calceditor.txt";

var httpc = new XMLHttpRequest();
httpc.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        filedata = this.responseText;
        editor.setValue(filedata);
    }
};
httpc.open("GET", "fileloader.php?filename=" + currentFile, true);
httpc.send();
files = document.getElementById("filescroll").getElementsByClassName("file");
for(var index = 0;index < files.length;index++){
    files[index].onclick = function(){
        currentFile = this.innerHTML;
        //use php script to load current file;
        var httpc = new XMLHttpRequest();
        httpc.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                filedata = this.responseText;
                editor.setValue(filedata);
                var fileType = currentFile.split("/")[0]; 
                var fileName = currentFile.split("/")[1];
              
            }
        };
        httpc.open("GET", "fileloader.php?filename=" + currentFile, true);
        httpc.send();
        if(this.classList[0] == "css"){
            editor.getSession().setMode("ace/mode/css");
            document.getElementById("namediv").style.color = "yellow";
            document.getElementById("namediv").style.borderColor = "yellow";
        }
        if(this.classList[0] == "html"){
            editor.getSession().setMode("ace/mode/html");
            document.getElementById("namediv").style.color = "#0000ff";
            document.getElementById("namediv").style.borderColor = "#0000ff";
        }
        if(this.classList[0] == "scrolls"){
            editor.getSession().setMode("ace/mode/html");
            document.getElementById("namediv").style.color = "#87CEEB";
            document.getElementById("namediv").style.borderColor = "#87CEEB";
        }
        if(this.classList[0] == "javascript"){
            editor.getSession().setMode("ace/mode/javascript");
            document.getElementById("namediv").style.color = "#ff0000";
            document.getElementById("namediv").style.borderColor = "#ff0000";
        }
        if(this.classList[0] == "bytecode"){
            editor.getSession().setMode("ace/mode/text");
            document.getElementById("namediv").style.color = "#654321";
            document.getElementById("namediv").style.borderColor = "#654321";
        }
        if(this.classList[0] == "php"){
            editor.getSession().setMode("ace/mode/php");
            document.getElementById("namediv").style.color = "#800080";
            document.getElementById("namediv").style.borderColor = "#800080";
        }
        if(this.classList[0] == "json"){
            editor.getSession().setMode("ace/mode/json");
            document.getElementById("namediv").style.color = "orange";
            document.getElementById("namediv").style.borderColor = "orange";
        }

        document.getElementById("namediv").innerHTML = currentFile;
    }
}
document.getElementById("namediv").innerHTML = currentFile;
document.getElementById("namediv").style.color = "#0000ff";
document.getElementById("namediv").style.borderColor = "#0000ff";

editor = ace.edit("maineditor");
editor.setTheme("ace/theme/cobalt");
editor.getSession().setMode("ace/mode/html");
editor.getSession().setUseWrapMode(true);
editor.$blockScrolling = Infinity;

document.getElementById("maineditor").onkeyup = function(){
    data = encodeURIComponent(editor.getSession().getValue());

    var httpc = new XMLHttpRequest();
    var url = "filesaver.php";        
    httpc.open("POST", url, true);
    httpc.setRequestHeader("Content-Type", "application/x-www-form-urlencoded;charset=utf-8");
    httpc.send("data="+data+"&filename="+currentFile);//send text to filesaver.php
    var fileType = currentFile.split("/")[0]; 
    var fileName = currentFile.split("/")[1];
    
    if(currentFile.split("/")[0] == "scrolls"){
        rawdata = editor.getSession().getValue();
        equationdata = rawdata.split("<equation>")[1].split("</equation>")[0];
        document.getElementById("calcequation").innerHTML = equationdata;
        
        tabledata = rawdata.split("<calctable>")[1].split("</calctable>")[0];
        document.getElementById("calctable").innerHTML = tabledata;
        MathJax.Hub.Typeset();//tell Mathjax to update the math
    
                
        var httpc = new XMLHttpRequest();
        httpc.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                filedata = this.responseText;
                filedata = filedata.replace("</div>", "</div><!--foo-->"); 

                filedata = encodeURIComponent(filedata);

                var httpc = new XMLHttpRequest();
                var url = "filesaver.php";        
                httpc.open("POST", url, true);
                httpc.setRequestHeader("Content-Type", "application/x-www-form-urlencoded;charset=utf-8");
                httpc.send("data="+filedata+"&filename=calceditor2.php");//send text to filesaver.php
            }
        };
        httpc.open("GET", "fileloader.php?filename=calceditor.php", true);
        httpc.send();
    }
}

</script>
<style>
#namediv{
    position:absolute;
    top:5px;
    left:20%;
    font-family:courier;
    padding:0.5em 0.5em 0.5em 0.5em;
    border:solid;
    background-color:#101010;

}
a{
    color:white;
    display:block;
    margin-bottom:0.5em;
    margin-left:0.5em;
}
body{
    background-color:#404040;
}
.html{
    color:#0000ff;
}
.css{
    color:yellow;
}
.php{
    color:#800080;
}
.javascript{
    color:#ff0000;
}
.bytecode{
    color:#654321;
}
.json{
    color:orange;
}
.scrolls{
    color:#87ceeb;
}

.file{
    cursor:pointer;
    border-radius:0.25em;
    border:solid;
    padding:0.25em 0.25em 0.25em 0.25em;
}
.files:hover{
    background-color:green;
}
.files:active{
    background-color:yellow;
}
#filescroll{
    position:absolute;
    overflow:scroll;
    top:60%;
    bottom:0%;
    right:0%;
    left:75%;
    border:solid;
    border-radius:5px;
    border-width:3px;
    background-color:#101010;
    font-family:courier;
    font-size:18px;
}
#linkscroll{
    position:absolute;
    overflow:scroll;
    top:5em;
    bottom:50%;
    right:0px;
    left:75%;
    border:solid;
    border-radius:5px;
    border-width:3px;
    background-color:#101010;
    font-family:courier;
    font-size:18px;
    
}
#maineditor{
    position:absolute;
    left:34%;
    top:5em;
    bottom:1em;
    right:26%;
}
#calcscroll{
    position:absolute;
    left:1em;
    right:68%;
    top:5em;
    bottom:1em;
    border-radius:0.5em;
    padding:0.5em;
    background-color:white;
    
}
table{
    width:100%;
}
</style>

</body>
</html>