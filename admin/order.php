<?php

require_once '../include/connect.php';

$stat = $_POST['stat'];
$id = $_POST['id'];

mysqli_query($connect, "UPDATE `order` SET `stat` = '$stat' WHERE `order`.`id` = '$id'");

header('location: admin.php?pageno_buy=1');

?>