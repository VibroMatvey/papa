<?php
require_once '../include/connect.php';

$name = $_POST['name_goods'];
$cost = $_POST['cost'];
$desc = $_POST['description'];
$ord = $_POST['ord'];
$id = $_GET['id'];
$name_img = $_FILES['image']['name'];
$tmp_name = $_FILES['image']['tmp_name'];

if ($name_img) {

mysqli_query($connect, "UPDATE `goods` SET `name_goods` = '$name', `cost` = '$cost', `description` = '$desc', `ord` = '$ord', `img` = '$name_img' WHERE `goods`.`id` = '$id'");
move_uploaded_file($tmp_name, "uploads/" . $name);

header('location: admin.php?pageno=1');
} else {
	mysqli_query($connect, "UPDATE `goods` SET `name_goods` = '$name', `cost` = '$cost', `description` = '$desc', `ord` = '$ord' WHERE `goods`.`id` = '$id'");

		header('location: admin.php?pageno=1');
}

?>