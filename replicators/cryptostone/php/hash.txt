<?php
  $data = $_REQUEST["data"];
  $algo = $_REQUEST["algo"];
  echo hash($algo,$data);
?>