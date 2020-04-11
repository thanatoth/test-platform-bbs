<?php
/**
 * Created by PhpStorm.
 * User: tanakatomoya
 * Date: 2019-10-11
 * Time: 09:53
 */
include_once('Q4.php');

$ope = new DB_Operations();
$ope->delete();
header('Location: http://localhost:8888/donuts/test.php') ;

