<?php 
$currentFile = "main.tex";
exec('cd latex');
exec("pdflatex ".$currentFile);
?>