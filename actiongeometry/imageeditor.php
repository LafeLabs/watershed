<?php
    $imgurlsraw = file_get_contents("html/imageurls.txt");
    $imgs = explode("\n",$imgurlsraw);
    
?>
<!doctype html>
<html>
<head>
<title>index</title>
<!-- 
PUBLIC DOMAIN, NO COPYRIGHTS, NO PATENTS.
-->
<script>
     function string2byteCode(localString){
    var localByteCode = "";
    for(var stringIndex = 0;stringIndex < localString.length;stringIndex++){
        var tempCharCode = localString.charCodeAt(stringIndex);
        if(tempCharCode != 0){
            localByteCode += "0";
            localByteCode += tempCharCode.toString(8);
            localByteCode += ",";
        }
    }
    return localByteCode;
}
        
function byteCode2string(localByteCode){
    var localString = "";
    var stringArray = localByteCode.split(",");
    for(var index = 0;index < stringArray.length;index++){
        var myCharCode = String.fromCharCode(parseInt(stringArray[index],8));
        if(parseInt(stringArray[index],8) >= 040 && parseInt(stringArray[index],8) < 0177 ){
            localString += myCharCode;
        }
        if(parseInt(stringArray[index],8) == 012){//newline
            localString += myCharCode;
        }
        if(parseInt(stringArray[index],8) == 011){//vertical tab
            localString += myCharCode;
        }		
        if(parseInt(stringArray[index],8) >= 0400 && parseInt(stringArray[index],8) <= 0777){
            if(currentTable[parseInt(stringArray[index],8)].length > 0){
                localString += byteCode2string(currentTable[parseInt(stringArray[index],8)]);
            }
        }		
        
    }
    return localString;
}
</script>
</head>
<body>
    <a href = "editor.php">editor.php</a>
<div id = "imglistdiv" style = "display:none">
<?php
echo $imgurlsraw;
?>    
</div>
<div id = "imagescroll">
<?php
foreach ($imgs as $value) {
    echo "<img src = \"".$value."\"/>";
    echo "<div class = \"inputdiv\"><input></div>";
}
?>
</div>
<textarea id = "imglist"></textarea>
<textarea id = "bytecodetext"></textarea>
<script>
document.getElementById("imglist").value = document.getElementById("imglistdiv").innerHTML;
imageArray = document.getElementById("imglist").value.split("\n");

currentBytecode = "";

for(var index = 0;index < imageArray.length;index++){
    if(imageArray[index].length > 4){
        currentBytecode += "0" + (0500 + index).toString(8) + ":";
        currentBytecode += string2byteCode(imageArray[index]) + "\n";
    }
}
document.getElementById("bytecodetext").value = currentBytecode;

</script>
<style>
#imglist{
    position:absolute;
    right:5px;
    top:5px;
    height:40%;
    width:40%;
    font-family:courier;
}
#bytecodetext{
    position:absolute;
    right:5px;
    bottom:5px;
    height:40%;
    width:40%;
    font-family:courier;
}

#imagescroll{
    position:absolute;
    left:5px;
    top:5px;
    bottom:5px;
    width:40%;
    overflow:scroll;
    padding:1em 1em 1em 1em;
}
#imagescroll img{
    width:90%;
    display:block;
    margin:auto;
}
a{
    position:absolute;
    z-index:2;
}
.inputdiv{
    display:block;
    margin:auto;
    text-align:center;
}
input{
    width:80%;
}
</style>
</body>