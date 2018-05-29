<!doctype html>
<html>
    <head>
        <title>Meta Creator</title>
    </head>
    <body>
        <a id = "editlink" href = "editor.php">editor.php</a>
        <a id = "indexlink" href = "index.php">index.php</a>
        <table id = "inputtable">
            <tr>
                <td>name:</td>
                <td><input/></td>
            </tr>
            <tr>
                <td>type:</td>
                <td><input/></td>
            </tr>
        </table>
        <div class = "button" id = "createbutton">CREATE</div>
        <h4>Types:</h4>
        <ul id = "typelist">
            <li class = "button">metamap</li>
            <li class = "button">page</li>
            <li class = "button">latexscroll</li>
            <li class = "button">plotter</li>
            <li class = "button">svgfactory</li>
            <li class = "button">datafitter</li>
            <li class = "button">trashrobot</li>
            <li class = "button">calculator</li>
        </ul>
        <script>

            document.getElementById("createbutton").onclick = function(){
                var httpc = new XMLHttpRequest();
                var url = "creator.php";        
                httpc.open("POST", url, true);
                httpc.setRequestHeader("Content-Type", "application/x-www-form-urlencoded;charset=utf-8");
                httpc.send("name=" + name + "&type" + type);//send text to filesaver.php
            }
        </script>
        <style>
            *{
            box-sizing: border-box;
            }
            .button{
                cursor:pointer;
                font-family:courier;
                font-size:30px;
                padding:1em 1em 1em 1em;
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