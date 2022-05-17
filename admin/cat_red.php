<?php
require_once '../include/connect.php';

$cat_name = $_POST["cat_name"];
$name = $_FILES['image1']['name'];
$tmp_name = $_FILES['image1']['tmp_name'];
$name2 = $_FILES['image2']['name'];
$tmp_name2 = $_FILES['image2']['tmp_name'];
$id = $_GET['id'];
if ($name2 && $name) {

mysqli_query($connect, "UPDATE `category` SET `cat_name` = '$cat_name', `img` = '$name', `img_2` = '$name2' WHERE `category`.`id` = '$id'");
move_uploaded_file($tmp_name, "uploads/" . $name);
move_uploaded_file($tmp_name2, "uploads/" . $name2);

header('location: admin.php?pageno_cat=1');
} elseif ($name2) {
	mysqli_query($connect, "UPDATE `category` SET `cat_name` = '$cat_name', `img_2` = '$name2' WHERE `category`.`id` = '$id'");
	move_uploaded_file($tmp_name2, "uploads/" . $name2);

		header('location: admin.php?pageno_cat=1');
} elseif ($name) {
	mysqli_query($connect, "UPDATE `category` SET `cat_name` = '$cat_name', `img` = '$name' WHERE `category`.`id` = '$id'");
	move_uploaded_file($tmp_name, "uploads/" . $name1);
	

	header('location: admin.php?pageno_cat=1');
} else {
	mysqli_query($connect, "UPDATE `category` SET `cat_name` = '$cat_name' WHERE `category`.`id` = '$id'");

	header('location: admin.php?pageno_cat=1');
}

?>