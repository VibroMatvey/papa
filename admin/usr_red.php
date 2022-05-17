<?php
require_once '../include/connect.php';

$name = $_POST['name'];
$surname = $_POST['surname'];
$login = $_POST['login'];
$password = $_POST['password'];
$id = $_GET['id'];

$password = md5($password);

if (!$password) {

mysqli_query($connect, "UPDATE `users` SET `name` = '$name', `surname` = '$surname', `login` = '$login' WHERE `users`.`id` = '$id'");

header('location: admin.php?pageno_usr=1');

} else {

	mysqli_query($connect, "UPDATE `users` SET `name` = '$name', `surname` = '$surname', `login` = '$login', `password` = '$password' WHERE `users`.`id` = '$id'");

	header('location: admin.php?pageno_usr=1');

}



?>