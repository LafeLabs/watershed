<!doctype html>
<html>
<head>
<title>hash</title>
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
</head>
<body>
<a id = "editorlink" href = "editor.php">editor.php</a>
<input id = "maininput"/>
<div id = "output">
</div>

<script>

algo = "sha256";

document.getElementById("maininput").onchange = function(){
    data = encodeURIComponent(this.value);
    var httpc = new XMLHttpRequest();
    httpc.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            filedata = this.responseText;
            document.getElementById("output").innerHTML = filedata;
        }
    };
    httpc.open("GET", "hash.php?data=" + data + "&algo=" + algo, true);
    httpc.send();
}
    
    
</script>
<style>
#maininput{
    position:absolute;
    left:1em;
    top:1em;
    width:80%;
    font-family:courier;
    font-size:22px;
}
#editorlink{
    position:absolute;
    right:1em;
    top:1em;
}

#output{
    position:absolute;
    top:20%;
    font-family:courier;
    font-size:22px;
    left:1em;
}
</style>
</body>
</html>