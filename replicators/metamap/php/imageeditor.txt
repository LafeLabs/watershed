<!doctype html>
<html>
    <head>
        <title>Image JSON Editor</title>
    </head>
    <body>
        <div id = "datadiv" style = "display:none">
            <?php
                echo file_get_contents("json/currentjson.txt");
            ?>
        </div>    
        <a id = "editorLink" href = "editor.php">editor.php</a>
        <table id = "mainTable">
            <tr>
                <td class = "button">PREV</td><td class = "button">NEXT</td>
            </tr>
            <tr>
                <td>url:</td><td><input/></td>
            </tr>
            <tr>
                <td>text:</td><td><input/></td>
            </tr>
            <tr>
                <td>latlon:</td><td><input/></td>
            </tr>
        </table>
        <textarea id = "textIO"></textarea>        
        <script>
            currentJSON = JSON.parse(document.getElementById("datadiv").innerHTML);
            document.getElementById("textIO").value = JSON.stringify(currentJSON.images,null,"    ");
        
        </script>
        <style>
            #textIO{
                position:absolute;
                left:50%;
                right:0px;
                width:50%;
                height:80%;
            }
            .button{
                cursor:pointer;
            }
        </style>
    </body>
</html>
