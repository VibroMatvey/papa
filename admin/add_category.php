<?php

require_once '../include/connect.php';

$cat_name = $_POST["cat_name"];
$name = $_FILES['image']['name'];
$tmp_name = $_FILES['image']['tmp_name'];
$name2 = $_FILES['image2']['name'];
$tmp_name2 = $_FILES['image2']['tmp_name'];




mysqli_query($connect, "INSERT INTO `category` (`cat_name`, `img`, `img_2`, `id`) VALUES ('$cat_name', '$name', '$name2', NULL)");


move_uploaded_file($tmp_name, "uploads/" . $name);
move_uploaded_file($tmp_name2, "uploads/" . $name2);

	
	header('Location: admin.php?pageno_cat=1');

?>