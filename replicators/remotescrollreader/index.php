<!doctype html>
<html>
<head>
<title>index</title>
<!-- 
PUBLIC DOMAIN, NO COPYRIGHTS, NO PATENTS.
-->
</head>
<body>
<div id = "page">
<?php
echo file_get_contents("html/page.txt");
?>
</div>
<script id = "pageevents">
<?php
echo file_get_contents("javascript/pageactions.txt");
?>
</script>
<?php
    echo "<style>\n";
    echo file_get_contents("css/style.txt");
    echo "</style>\n";
?>
</body>
</html>