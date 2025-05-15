<?php

$host='localhost';
$user='root';
$password='';
$database='dostava-hrane';

$link=mysqli_connect($host, $user ,$password ,$database)
or die("Povezovanje ni mogoče");

mysqli_set_charset($link ,"utf-8");

