<?php
session_start();
 
require_once '../include/connect.php';

$id = $_GET['id'];

$delete = mysqli_query($connect, "DELETE FROM `category` WHERE `category`.`id` = '$id'");

header("location: admin.php?pageno_cat=1");



?>