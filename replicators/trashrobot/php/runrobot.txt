<!doctype html>
<html>
<head>
<title>Run Trash Robot</title>
<!-- 
PUBLIC DOMAIN, NO COPYRIGHTS, NO PATENTS.
-->
</head>
<body>
<div  id  = "datadiv" style = "display:none">
<?php
    $files = scandir(getcwd()."/svg");
    echo $files[sizeof($files) - 1];
?>
</div>
<table id = "controlTable">
    <tr>
        <td>Duration:</td><td><input/></td>
        <td>Iterations:</td><td><input/></td>
        <td>Program image URL:</td><td><input/></td>
    </tr>
</table>
<a id = "indexlink" href = "index.php">index.php</a>
<a id = "editorlink" href = "editor.php">editor.php</a>
<div id = "robotbox">
    <img id = "program" src = "http://www.metamapdc.org/lafe/trashrobot/svg/svg1527428531.svg"/>
</div>
<style>
input{
    width:4em;
}
#controlTable{
    position:absolute;
    left:5px;
    top:5px;
    font-family:courier;
    font-size:20px;
}
#indexlink{
    position:absolute;
    font-size:24px;
    right:5px;
    top:0px;
}
#editorlink{
    position:absolute;
    font-size:24px;
    right:5px;
    top:1em;
}

#robotbox{
  position:absolute;
  left:0px;
  top:50px;
  bottom:0px;
  right:0px;
}
@keyframes runprogram {
    from {left: -100%;}
    to {left: 100%;}
}
</style>
<style id = "animationstyle"></style>
<script>
    duration = "4";
    iterations = "infinite";
    url = "svg/" + document.getElementById("datadiv").innerHTML;
    document.getElementById("program").src = url;
    document.getElementById("animationstyle").innerHTML = "#program{";
    document.getElementById("animationstyle").innerHTML += "position:absolute;";
    document.getElementById("animationstyle").innerHTML += "height:100%;";
    document.getElementById("animationstyle").innerHTML += "border:solid;";
    document.getElementById("animationstyle").innerHTML += "left:-90%;";
    document.getElementById("animationstyle").innerHTML += "}";
    

    function redraw(){
        document.getElementById("animationstyle").innerHTML = "#program{";
        document.getElementById("animationstyle").innerHTML += "position:absolute;";
        document.getElementById("animationstyle").innerHTML += "height:100%;";
        document.getElementById("animationstyle").innerHTML += "border:solid;";
        document.getElementById("animationstyle").innerHTML += "animation-name:runprogram;";
        document.getElementById("animationstyle").innerHTML += "animation-duration: " + duration + "s;";
        document.getElementById("animationstyle").innerHTML += "animation-iteration-count:" + iterations + ";";
        document.getElementById("animationstyle").innerHTML += "animation-timing-function: linear;";
        document.getElementById("animationstyle").innerHTML += "}";
        document.getElmenetById("program").src = url;
    }

    controls = document.getElementById("controlTable").getElementsByTagName("INPUT");
    controls[0].value = duration;
    controls[1].value = iterations;
    controls[2].value = url;
    controls[0].onchange = function(){
        duration = this.value;
        redraw();
    }
    controls[1].onchange  = function(){
        iterations = this.value;
        redraw();
    }
    controls[2].onchange = function(){
        url = this.value;
        redraw();
    }
    redraw();
</script>
</body>
</html>