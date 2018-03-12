<!doctype html>
<html>
    <head>
        <title>EDITOR</title>
        <!--
            HTML EDITOR
            NO MONEY 
            NO MINING
            NO PROPERTY
            EVERYTHING IS RECURSIVE
            EVERYTHING IS FRACTAL 
            EVERYTHING IS PHYSICAL
            [EGO DEATH]
                LOOK TO THE INSECTS
                LOOK TO THE FUNGI
                LANGUAGE IS HOW THE MIND PARSES REALITY
                
        -->
    </head>
<BODY>
    <input id = "urlinput"/>
    <table id = "controlTable">
        <tr>
            <td>
                PREV P
            </td>
            <td>
                NEXT P
            </td>                    
            <td>
                CREATE P
            </td>
            <TD>
                PREV IMG
            </TD>
            <TD>
                NEXT IMG
            </TD>
            <TD>
                CREATE IMG
            </TD>        
        </tr>
    </table>
    <textarea id = "textIO"></textarea>
<div id = "scroll"><?php
    $url = "http://www.actiongeometry.org/htmleditor/data.txt";//get url
    $data = file_get_contents($url);
    echo $data;
?></div>
<script>
    paragraphs = document.getElementsByTagName("P");
    paragraphIndex = paragraphs.length-1;
    images = document.getElementsByTagName("IMG");
    imageIndex = images.length-1;
    document.getElementById("textIO").value = paragraphs[paragraphIndex].innerHTML;
    document.getElementById("textIO").onkeyup = function(){
        paragraphs[paragraphIndex].innerHTML = this.value;
    }
    paragraphs[paragraphIndex].style.border = "solid";
    images[imageIndex].style.border = "solid";
    images[imageIndex].style.borderWidth = "8px";
    document.getElementById("urlinput").value = images[imageIndex].src;

    document.getElementById("urlinput").onchange = function(){
        images[imageIndex].src = this.value;
    }

    buttons = document.getElementById("controlTable").getElementsByTagName("TD");
    buttons[0].onclick = function(){
        paragraphs[paragraphIndex].style.border = "none";
        paragraphIndex--;
        if(paragraphIndex < 0){
            paragraphIndex = paragraphs.length-1;
        }
        paragraphs[paragraphIndex].style.border = "solid";
        document.getElementById("textIO").value = paragraphs[paragraphIndex].innerHTML;
        savephp();
    }    
    buttons[1].onclick = function(){
        paragraphs[paragraphIndex].style.border = "none";
        paragraphIndex++;
        if(paragraphIndex > paragraphs.length-1){
            paragraphIndex = 0;
        }
        paragraphs[paragraphIndex].style.border = "solid";
        document.getElementById("textIO").value = paragraphs[paragraphIndex].innerHTML;
        savephp();
    }
    buttons[2].onclick  = function(){
        paragraphs[paragraphIndex].style.border = "none";
        var newp = document.createElement("P");
        document.getElementById("scroll").appendChild(newp);
        paragraphs = document.getElementsByTagName("P");
        paragraphIndex = paragraphs.length-1;
        document.getElementById("textIO").value = paragraphs[paragraphIndex].innerHTML;
        paragraphs[paragraphIndex].style.border = "solid";
    }
    buttons[3].onclick = function(){
        images[imageIndex].style.border = "none";
        imageIndex--;
        if(imageIndex < 0){
            imageIndex = images.length-1;
        }
        images[imageIndex].style.border = "solid";
        images[imageIndex].style.borderWidth = "8px";
        document.getElementById("urlinput").value = images[imageIndex].src;
    }    
    buttons[4].onclick = function(){
        images[imageIndex].style.border = "none";
        imageIndex++;
        if(imageIndex > images.length-1){
            imageIndex = 0;
        }
        images[imageIndex].style.border = "solid";
        images[imageIndex].style.borderWidth = "8px";
        document.getElementById("urlinput").value = images[imageIndex].src;
    }    
    buttons[5].onclick  = function(){
        images[imageIndex].style.border = "none";
        var newimg = document.createElement("IMG");
        document.getElementById("scroll").appendChild(newimg);
        images = document.getElementsByTagName("IMG");
        imageIndex = images.length-1;
        images[imageIndex].src = "http://www.actiongeometry.org/favicon.png";
        document.getElementById("urlinput").value = images[imageIndex].src;
        images[imageIndex].style.border = "solid";
        images[imageIndex].style.borderWidth = "8px";
    }


function savephp(){
    currentData = document.getElementById("scroll").innerHTML;       
    var httpc = new XMLHttpRequest();
    var url = "saver.php";        
    httpc.open("POST", url, true);
    httpc.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    httpc.send("data=" + currentData);//send text to saver.php
}

</script>
<STYLE>
    #controlTable{
        position:absolute;
        top:0.1em;
        height:1em;
        border-collapse: collapse;
    }
    #controlTable td{
        border:solid;
        border-color:#00ff00;
        width:4%;
        cursor:pointer;
    }
    #urlinput{
        position:absolute;
        top:1.5em;
        left:10%;
        width:50%;
        border-color:#0000ff;
    }
    #controlTable td:hover{
        background-color:#008000;
    }
    #scroll{
        position:absolute;
        left:5px;
        right:5px;
        top:6em;
        bottom:10px;
        border-top:solid;
        border-color:#00ff00;
        overflow:scroll;
        padding:1em 1em 1em 1em;
    }
    #textIO{
        position:absolute;
        top:3.5em;
        left:5%;
        right:5%;
        height:1em;
        z-index: 2;
    }
    img{
        width:50%;
        margin:auto;
        display:block;
    }
    h1,H2,H3,H4,H5{
        text-align:center;
    }
    p{
        text-align:justify;
        cursor:pointer;
    }
    body{
        color:#00ff00;
        background-color:black;
        font-family:courier;
        font-size:1.2em;
        position:absolute;
        left:0px;
        top:0px;
        bottom:0px;
        right:0px;
    }
    a{
        color:#00ff00;                
    }
    textarea,input{
        border:solid;
        border-color:#00ff00;
        color:#00ff00;
        background-color:black;
        font-family:courier;
        font-size:1em;
        
    }
</STYLE>
</BODY>
</html>