<?php 

$currentFile = $_POST["filename"];


exec("pdflatex ".$currentFile);

?>