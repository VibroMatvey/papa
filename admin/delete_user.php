<?php
session_start();
 
require_once '../include/connect.php';

$id = $_GET['id'];

$delete = mysqli_query($connect, "DELETE FROM `users` WHERE `users`.`id` = '$id'");

header("location: admin.php?pageno_usr=1");



?>