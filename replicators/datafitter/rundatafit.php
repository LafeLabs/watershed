<?php

exec('python simdata.py "1 1 1 1" > simdataoutput.txt');

$data = file_get_contents("simdataoutput.txt");
echo $data;

?>
<a href = "editor.php" style = "font-size:50px">editor.php</a>