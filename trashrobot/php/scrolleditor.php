

 <!doctype html>
<html>
<head>
<script src="https://cdnjs.cloudflare.com/ajax/libs/ace/1.2.6/ace.js" type="text/javascript" charset="utf-8"></script>
</head>
<body>
    
    <a href = "editor.php" id = "text2phplink">editor.php</a>

<div id = "namediv"></div>
<div id="maineditor"></div>
<div id = "filescroll">
    <div class = "html file">html/scrolls/dualhbridge.txt</div>
    <div class = "html file">html/scrolls/power.txt</div>
    <div class = "html file">html/scrolls/upcycle.txt</div>
    <div class = "html file">html/scrolls/arduino.txt</div>
    <div class = "html file">html/scrolls/opticalpickup.txt</div>
</div>
<div id = "scroll"></div>
<table id = "maincontrol">
    <tr>
        <td>&ltBR/&gt</td><td>&ltP&gt</td><td>&lt/P&gt</td>
        <td>&ltH2&gt</td><td>&lt/H2&gt</td><td>{IMG</td><td>IMG}</td>
    </tr>
    <tr>
        <td>{FIG</td><td>FIG}</td><td>{CAP</td><td>CAP}</td>
    </tr>
</table>
<textarea id = "filetextarea"></textarea>
<script>
currentFile = "html/scrolls/dualhbridge.txt";
var httpc = new XMLHttpRequest();
httpc.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        filedata = this.responseText;
        editor.setValue(filedata);
        document.getElementById("scroll").innerHTML = filedata;
    }
}

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
                document.getElementById("scroll").innerHTML = filedata;
 
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
editor.getSession().setUseWrapMode(true);

//editor.setValue(document.getElementById("datadiv").innerText);
document.getElementById("maineditor").onkeyup = function(){
    data = encodeURIComponent(editor.getSession().getValue());
    var httpc = new XMLHttpRequest();
    var url = "filesaver.php";        
    httpc.open("POST", url, true);
    httpc.setRequestHeader("Content-Type", "application/x-www-form-urlencoded;charset=utf-8");
    httpc.send("data="+data+"&filename="+currentFile);//send text to filesaver.php
    document.getElementById("scroll").innerHTML = editor.getSession().getValue();
 
}


buttons = document.getElementById("maincontrol").getElementsByTagName("TD");

buttons[0].onclick = function(){
    editor.insert("<br/>");
    savescroll();
}
buttons[1].onclick = function(){
    editor.insert("<p>");
    savescroll();
}
buttons[2].onclick = function(){
    editor.insert("</p>");
    savescroll();
}

buttons[3].onclick = function(){
    editor.insert("<h2>");
    savescroll();
}
buttons[4].onclick = function(){
    editor.insert("</h2>");
    savescroll();
}
buttons[5].onclick = function(){
    editor.insert("<img src = \"");
    savescroll();
}
buttons[6].onclick = function(){
    editor.insert("\"/>");
    savescroll();
}

buttons[7].onclick = function(){
    editor.insert("<figure>\n    ");
    savescroll();
}
buttons[8].onclick = function(){
    editor.insert("\n</figure>");
    savescroll();
}
buttons[9].onclick = function(){
    editor.insert("<figcaption>");
    savescroll();
}
buttons[10].onclick = function(){
    editor.insert("</figcaption>");
    savescroll();
}

function savescroll(){
    data = encodeURIComponent(editor.getSession().getValue());
    var httpc = new XMLHttpRequest();
    var url = "filesaver.php";        
    httpc.open("POST", url, true);
    httpc.setRequestHeader("Content-Type", "application/x-www-form-urlencoded;charset=utf-8");
    httpc.send("data="+data+"&filename="+currentFile);//send text to filesaver.php
    document.getElementById("scroll").innerHTML = editor.getSession().getValue();

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
    overflow:hidden;
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
#filetextarea{
    position:absolute;
    left:75%;
    top:55%;
    bottom:1%;
    right:1em;
}
#filescroll{
    position:absolute;
    overflow:scroll;
    top:1%;
    bottom:50%;
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
    left:30%;
    top:10%;
    bottom:40%;
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
#imagelink{
    position:absolute;
    left:0px;
    top:2em;
    color:white;
    
}
#linklink{
    top:3em;
    left:0px;
    position:absolute;
    color:white;
}
#scroll{
    position:absolute;
    left:5px;
    right:70%;
    top:10%;
    bottom:10%;
    background-color:white;
    border:solid;
    border-color:blue;
    border-width:3px;
    border-radius:1em;
    overflow:scroll;
    padding:1.5em 1.5em 1.5em 1.5em;
}
#scroll img{
    width:90%;
    border:solid;
}
figure{
    width:95%;
    display:block;
    margin:auto;
}
figure img{
    width:100%;
    border:solid;
}

#maincontrol{
    position:absolute;
    bottom:1em;
    top:70%;
    left:35%;
    right:35%;
}
#maincontrol td{
    border-collapse:collapse;
    cursor:pointer;
    background-color:white;
    font-family:courier;
}
#maincontrol td:hover{
    background-color:green;
}
#maincontrol td:active{
    background-color:yellow;
}
h2,h4{
    text-align:center;
    display:block;
    margin:auto;
}
</style>
</body>
</html>