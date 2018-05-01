<?php

exec('python fitcurve.py > foo.txt');

echo file_get_contents("foo.txt");

?>
<p>
<a href = "editor.php">editor.php</a>