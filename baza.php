<?php

$host='sql200.infinityfree.com';
$user='if0_39211211';
$password='o5VWCaxdFMww';
$database='if0_39211211_XXX';

$link=mysqli_connect($host, $user ,$password ,$database)
or die("Povezovanje ni mogoče");

mysqli_set_charset($link ,"utf8");

?>