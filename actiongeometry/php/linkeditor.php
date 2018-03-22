<!doctype html>
<html>
<head>
<title>image editor</title>
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
function string2byteCodeSpelling(localString){
    var localByteCode = "";
    for(var stringIndex = 0;stringIndex < localString.length;stringIndex++){
        var tempCharCode = localString.charCodeAt(stringIndex);
        if(tempCharCode != 0){
            localByteCode += "0";
            localByteCode += (tempCharCode + 01000).toString(8);
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
        if(parseInt(stringArray[index],8) >= 01040 && parseInt(stringArray[index],8) < 01177 ){
            myCharCode = String.fromCharCode(parseInt(stringArray[index],8) - 01000);
            localString += myCharCode;
        }
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
<script id = "bytecodeScript">
/*
<?php
$foo = file_get_contents("bytecode/bytecode0x6xx.txt");
echo $foo;
echo "\n";
?>
*/
</script>
<script>
    fullCube = false;
    currentTable = []; 
    for(var index = 0;index < 01777;index ++){
        currentTable.push("");
    }
    var inputbytecode = document.getElementById("bytecodeScript").text;
    var bytecodearray = inputbytecode.split("\n");
    for(var index = 0;index < bytecodearray.length;index++){
        if(bytecodearray[index].includes(":")){
            var localBytecode = bytecodearray[index].split(":");
            var localAddress = parseInt(localBytecode[0],8);
            currentTable[localAddress] = localBytecode[1];
        }
    }
    currentTableStart = [];
    for(var index = 0;index < currentTable.length;index++){
        currentTableStart.push(currentTable[index]);
    }

</script>
</head>
<body>
<a href = "editor.php">editor.php</a>
<textarea id = "imglist"></textarea>
<textarea id = "bytecodetext"></textarea>
<script>

bytecodetext = "";
codetext = "";
for(var index = 0600;index < 0700;index++){
    if(currentTable[index].length > 8){
        codetext += "0" + index.toString(8) + ",";
        codetext += byteCode2string(currentTable[index]) + "\n";
        bytecodetext += "0" + index.toString(8) + ":";
        bytecodetext += currentTable[index] + "\n";
    }
}

document.getElementById("imglist").value = codetext;
document.getElementById("bytecodetext").value = bytecodetext;

document.getElementById("imglist").onkeyup = function(){
    var rawlist = this.value;
    var listarray = rawlist.split("\n");
    var outputcode = "";
    for(var index = 0;index < listarray.length;index++){
        if(listarray[index].length > 4){
            outputcode += listarray[index].split(",")[0] + ":";
            currentTable[parseInt(listarray[index].split(",")[0],8)] = string2byteCode(listarray[index].split(",")[1]);
            outputcode += string2byteCode(listarray[index].split(",")[1]);
            outputcode += "\n";
        }   
    }
    document.getElementById("bytecodetext").value = outputcode;
    data = encodeURIComponent(outputcode);
    currentFile = "bytecode/bytecode0x6xx.txt";
    var httpc = new XMLHttpRequest();
    var url = "filesaver.php";        
    httpc.open("POST", url, true);
    httpc.setRequestHeader("Content-Type", "application/x-www-form-urlencoded;charset=utf-8");
    httpc.send("data="+data+"&filename="+currentFile);//send text to filesaver.php

    
}

</script>
<style>
#imglist{
    position:absolute;
    right:5px;
    top:5px;
    height:40%;
    width:80%;
    font-family:courier;
}
#bytecodetext{
    position:absolute;
    right:5px;
    bottom:5px;
    height:40%;
    width:80%;
    font-family:courier;
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
p{
    text-align:center;
    border-bottom:solid;
}
</style>
</body>