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
$foo = file_get_contents("bytecode/images05xx.txt");
echo $foo;
echo "\n";
$foo = file_get_contents("bytecode/symbols015xx.txt");
echo $foo;
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
<div id = "imagescroll">
</div>
<textarea id = "imglist"></textarea>
<textarea id = "bytecodetext"></textarea>
<script>

bytecodetext = "";
codetext = "";
for(var index = 0500;index < 0600;index++){
    if(currentTable[index].length > 8){
        codetext += "0" + index.toString(8) + ",";
        bytecodetext += "0" + index.toString(8) + ":";
        bytecodetext += currentTable[index] + "\n";

        bytecodetext += "0" + (index + 01000).toString(8) + ":";
        bytecodetext += currentTable[index + 01000] + "\n";

        codetext += byteCode2string(currentTable[index]) + ",";
        codetext += byteCode2string(currentTable[index  + 01000]) + "\n";
        var newimg = document.createElement("IMG");
        newimg.src = byteCode2string(currentTable[index]);
        document.getElementById("imagescroll").appendChild(newimg);
        var newp = document.createElement("p");
        newp.innerHTML = byteCode2string(currentTable[index  + 01000]);
        document.getElementById("imagescroll").appendChild(newp);

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
            outputcode += "0" + (parseInt(listarray[index].split(",")[0],8) + 01000).toString(8) + ":";
            outputcode += string2byteCodeSpelling(listarray[index].split(",")[2]);
            currentTable[parseInt(listarray[index].split(",")[0],8) + 01000] = string2byteCodeSpelling(listarray[index].split(",")[2]);
            outputcode += "\n";
        }   
    }
    document.getElementById("bytecodetext").value = outputcode;
    
    document.getElementById("imagescroll").innerHTML = "";
    for(var index = 0500;index < 0600;index++){
    if(currentTable[index].length > 8){

        var newimg = document.createElement("IMG");
        newimg.src = byteCode2string(currentTable[index]);
        document.getElementById("imagescroll").appendChild(newimg);
        var newp = document.createElement("p");
        newp.innerHTML = byteCode2string(currentTable[index  + 01000]);
        document.getElementById("imagescroll").appendChild(newp);

    }
}
}

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
p{
    text-align:center;
    border-bottom:solid;
}
</style>
</body>