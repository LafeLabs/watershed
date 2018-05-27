<!doctype html>
<html>
<head>
<title>Run Trash Robot</title>
<!-- 
PUBLIC DOMAIN, NO COPYRIGHTS, NO PATENTS.
-->
</head>
<body>
<input id = "controlinput"/>
<div id = "robotbox">
    <img id = "program" src = "http://www.metamapdc.org/lafe/trashrobot/svg/svg1527428531.svg"/>
</div>
<style>
#controlinput{
    position:absolute;
    left:5px;
    top:5px;
    font-size:25px;
}
#robotbox{
  position:absolute;
  left:0px;
  top:50px;
  bottom:0px;
  right:0px;
}
#program{
  position:absolute;
  height:100%;
  border:solid;
  animation-name: runprogram;
  animation-duration: 20s;
  animation-iteration-count: 1;
  animation-timing-function: linear;
}
@keyframes runprogram {
    from {left: -100%;}
    to {left: 100%;}
}
</style>
</body>
</html>