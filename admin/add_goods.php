<?php

require_once '../include/connect.php';

$name_goods = $_POST["name_goods"];
$cost = $_POST["cost"];
$description = $_POST["description"];
$name = $_FILES['image']['name'];
$tmp_name = $_FILES['image']['tmp_name'];
$order = $_POST['ord'];



mysqli_query($connect, "INSERT INTO `goods` (`id`, `name_goods`, `cost`, `description`, `ord`, `img`) VALUES (NULL, '$name_goods', '$cost', '$description', $order, '$name')");


move_uploaded_file($tmp_name, "uploads/" . $name);

	
	header('Location: admin.php?pageno=1');

?>