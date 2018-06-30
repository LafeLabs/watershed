<!doctype html>
<html>
<head>
<title>index</title>
<!-- 
PUBLIC DOMAIN, NO COPYRIGHTS, NO PATENTS.

Trust model: Trust all non-coders implicitly, assume the worst from anyone who makes any money of computer industry in any way.  All professional coders are the Enemy.

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
</head>
<body>
    <div id = "extdatadiv" style = "display:none"></div>

    <a id = "editorlink" href = "editor.php">Code Editor</a>
    <a id = "pageeditorlink" href = "pageeditor.php">Page Editor</a>
<div id = "page">
<p style = "font-size:40px;color:black;">
    &#x24b6
    &#x24b7&#x267b
    &#x24b8
    &#x24b9
    &#x2296
    &#x2295
    &#x2abd
    &#x2abe
</p>
<p>
    <a href = "../">../</a>
</p>

<p>Enter in the input below hexidecimal digits to find a 16x16 grid of unicode symbols starting with that set of digits.  EG entering 34 will display 0x3400 through 0x34FF in unicode. </p>
<input id = "baseinput" style = "font-family:courier;font-size:30px;width:2em"/>
<div id = "outputdiv"></div>
<input id = "codeout"/>
<table id = "unicodetable">
    <tr>
        <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
    </tr>
    <tr>
        <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
    </tr>
    <tr>
        <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
    </tr>
    <tr>
        <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
    </tr>
    <tr>
        <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
    </tr>
    <tr>
        <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
    </tr>
    <tr>
        <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
    </tr>
    <tr>
        <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
    </tr>
    <tr>
        <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
    </tr>
    <tr>
        <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
    </tr>
    <tr>
        <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
    </tr>
    <tr>
        <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
    </tr>
    <tr>
        <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
    </tr>
    <tr>
        <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
    </tr>
    <tr>
        <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
    </tr>
    <tr>
        <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
    </tr>
</table>
<div id = "outputdiv"></div>
<script>
    tds = document.getElementById("unicodetable").getElementsByTagName("td");
    basenumber = 0x26;
redraw();
function redraw(){
    for(var index = 0;index < tds.length;index++){
        if(index < 16){
            tds[index].id = "td" + basenumber.toString(16) + "0" +index.toString(16);
            tds[index].innerHTML = "&#x" + basenumber.toString(16) + "0" + index.toString(16);
        }
        else{
            tds[index].id = "td" + basenumber.toString(16) + index.toString(16);
            tds[index].innerHTML = "&#x" + basenumber.toString(16) + index.toString(16);
        }

        tds[index].onclick = function(){
            document.getElementById("outputdiv").innerHTML  = "&amp#x" +this.id.substring(2);
            document.getElementById("outputdiv").innerHTML  += ":&#x" +this.id.substring(2);
            document.getElementById("codeout").value = "&#x" +this.id.substring(2);
            document.getElementById("codeout").select();
            document.execCommand("copy");
        }
    }
}
document.getElementById("baseinput").onchange = function(){
    basenumber = parseInt(this.value,16);
    redraw();
}

</script>
<style>
    #outputdiv{
        font-size:50px;
        font-family:courier;
    }
    body{
        font-family:helvetica;
    }
    td{
        cursor:pointer;
    }
    td:hover{
        background-color:green;
    }
    td:active{
        background-color:yellow;
    }
    #codeout{
        position:absolute;
        right:0px;
        top:0px;
        font-size:30px;
        width:5em;
    }
</style>
</div>

<style>
h1,h2,h3,h4,h5{
    width:100%;
    text-align:center;
}
#page{
    position:absolute;
    overflow:scroll;
    text-align:justify;
    width:90%;
    top:5em;
    bottom:0px;
    padding:1em 1em 1em 1em;
    font-size:24px;
}
#page img{
    width:50%;
    display:block;
    margin:auto;
}
#pageeditorlink{
    position:absolute;
    top:0.5em;
    left:2em;
    font-size:24px;
}
#editorlink{
    position:absolute;
    top:0.5em;
    right:2em;
    font-size:24px;
}
</style>
</body>
</html>