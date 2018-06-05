<!doctype html>
<html>
    <head>
        <title>Scroll Meta Creator</title>
    </head>
    <body>
<div id= "page">
        <p><a id = "editlink" href = "editor.php">editor.php</a></p>
        <p><a id = "indexlink" href = "index.php">index.php</a></p>
        <table id = "inputtable">
            <tr>
                <td>name:</td>
                <td><input id = "nameinput"/></td>
            </tr>
        </table>
        <div class = "button" id = "createbutton">CREATE</div>
</div>
        <script>

            document.getElementById("createbutton").onclick = function(){
                name = document.getElementById("nameinput").value;

                if(name.length > 0){
                    var httpc = new XMLHttpRequest();
                    var url = "scrollcreator.php";        
                    httpc.open("POST", url, true);
                    httpc.setRequestHeader("Content-Type", "application/x-www-form-urlencoded;charset=utf-8");
                    httpc.send("name=" + name);//send text to scrollcreator.php
                    document.getElementById("page").innerHTML = "<a href = \"scrolleditor.php\">scrolleditor.php</a>";
                }
            }
        </script>
        <style>
            *{
                box-sizing: border-box;
                font-size:22px;
                font-family:courier;
            }
            input{
                font-size:22px;
                font-family:courier;
            }
            #createbutton{
                text-align:center;
                width:8em;
                margin-top:1em;
                margin-bottom:1em;
                border:solid;
                border-radius:0.5em;
                padding-top:0.5em;
                padding-bottom:0.5em;
            }
            .button{
                cursor:pointer;
                font-family:courier;
                font-size:22px;
            }
            .button:hover{
                background-color:green;
            }
            .button:active{
                background-color:yellow;
            }
        </style>
    </body>
</html>