 <!doctype html>
<html>
<head>
<script src="https://cdnjs.cloudflare.com/ajax/libs/ace/1.2.6/ace.js" type="text/javascript" charset="utf-8"></script>
</head>
<body>
        <a href = "text2php.php" id = "text2phplink">text2php.php</a>
    <a href = "index.php" id = "indexlink">index.php</a>

<div id = "namediv"></div>
<div id="maineditor"></div>
<div id = "filescroll">
    <div class = "html file">html/page.txt</div>

    <div class = "css file">css/style.txt</div>

    <div class = "javascript file">javascript/jslibrary.txt</div>

    <div class = "php file">php/editor.txt</div>
    <div class = "php file">php/index.txt</div>
    <div class = "php file">php/replicator.txt</div>
    <div class = "php file">php/filesaver.txt</div>
    <div class = "php file">php/fileloader.txt</div>
    <div class = "php file">php/feedsaver.txt</div>
    <div class = "php file">php/localbackup.txt</div>
    <div class = "php file">php/svgloader.txt</div>
    <div class = "php file">php/text2php.txt</div>
    <div class = "php file">php/branch.txt</div>
    <div class = "php file">php/scandir.php</div>

    <div class = "json file">json/dna.txt</div>
    <div class = "json file">json/currentjson.txt</div>

</div>

<script>
currentFile = "html/page.txt";
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
//editor.setValue(document.getElementById("datadiv").innerText);
document.getElementById("maineditor").onkeyup = function(){
    data = encodeURIComponent(editor.getSession().getValue());
    var httpc = new XMLHttpRequest();
    var url = "filesaver.php";        
    httpc.open("POST", url, true);
    httpc.setRequestHeader("Content-Type", "application/x-www-form-urlencoded;charset=utf-8");
    httpc.send("data="+data+"&filename="+currentFile);//send text to filesaver.php
    console.log(data);//for debugging, always potentially useful
}
</script>
<style>
#namediv{
    position:absolute;
    top:5px;
    left:25%;
    font-family:courier;
    padding:0.5em 0.5em 0.5em 0.5em;
    border:solid;
    background-color:#101010;

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
    top:1%;
    bottom:1%;
    right:1%;
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
    left:1%;
    top:10%;
    bottom:1%;
    right:30%;
}
#text2phplink{
    position:absolute;
    left:0px;
    top:0px;
    color:white;
}
#indexlink{
    position:absolute;
    left:0px;
    top:1em;
    color:white;
}

</style>
</body>
</html>