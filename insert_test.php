<?php

include_once('Q4.php');

$ope = new DB_Operations();
$ope->insert();

header('Location: http://localhost:8888/donuts/test.php') ;
exit;
?>