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
<!-- links to MathJax JavaScript library, un-comment to use math-->

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
</head>
<body>
<img id = "img1"/>
<img id = "img2"/>
<img id = "img3"/>
<img id = "img4"/>

<div id = "datadiv" style = "display:none"><?php 
echo file_get_contents("ipython/fitcoth0.ipynb");
?></div>
<a href = "editor.php">editor.php</a>
<div id = "codes">
    
</div>
<script>

currentJSON = JSON.parse(document.getElementById("datadiv").innerText);

for(var index = 0;index < currentJSON.cells.length;index++){
    if(currentJSON.cells[index].cell_type == "code"){
        var newpre = document.createElement("PRE");
        newpre.innerHTML = "";
        document.getElementById("codes").appendChild(newpre);
        for(var linei = 0;linei < currentJSON.cells[index].source.length;linei ++){
            newpre.innerHTML +=  currentJSON.cells[index].source[linei];
        }
    }
}

document.getElementById("img1").src = "data:image/png;base64," + currentJSON.cells[2].outputs[1].data["image/png"];

document.getElementById("img2").src = "data:image/png;base64," + currentJSON.cells[5].outputs[1].data["image/png"];

document.getElementById("img3").src = "data:image/png;base64," + currentJSON.cells[7].outputs[1].data["image/png"];

document.getElementById("img4").src = "data:image/png;base64," + currentJSON.cells[9].outputs[1].data["image/png"];

ydata = [];
for(var index = 0;index < currentJSON.cells[currentJSON.cells.length-2].outputs[0].text.length;index++){
    ydata.push(parseFloat(currentJSON.cells[currentJSON.cells.length-2].outputs[0].text[index]))
}
ydata2 = [];
for(var index = 0;index < currentJSON.cells[currentJSON.cells.length-3].outputs[0].text.length;index++){
    ydata2.push(parseFloat(currentJSON.cells[currentJSON.cells.length-3].outputs[0].text[index]))
}
</script>
<style>
pre{
    font-family:courier;
    border:solid;
    margin-top:4em;
}
</style>
</body>
</html>