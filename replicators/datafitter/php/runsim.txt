<?php
$simparams = $_REQUEST["simparams"];//get parameters
exec('python simdata.py "'.$simparams.'" > simdataoutput.txt');
$data = file_get_contents("simdataoutput.txt");
echo $data;
?>