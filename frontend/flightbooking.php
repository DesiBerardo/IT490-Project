<?php
echo "Flight booking";
$flightArr = json_decode($_GET["array"]);
echo var_dump($flightArr[0]);
?>