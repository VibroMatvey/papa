<?php
session_start();
 
require_once '../include/connect.php';

$id = $_GET['id'];

$delete = mysqli_query($connect, "DELETE FROM `goods` WHERE `goods`.`id` = '$id'");

header("location: admin.php?pageno=1");



?>