<?php
session_start();
 
require_once '../include/connect.php';

$login = $_GET['login'];

$delete = mysqli_query($connect, "DELETE FROM `buy` WHERE `login` = '$login'");

header("location: admin.php?pdgeno_buy=1");