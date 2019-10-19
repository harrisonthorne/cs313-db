<?php
require('../main.php');
header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
header("Access-Control-Allow-*: *");
echo $_GET['msg'];
?>
