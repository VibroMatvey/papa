<?php

session_start();

require_once '../include/connect.php';

$login = $_SESSION['user']['login'];

$name = $_SESSION['user']['name'];

$phone = $_POST['phone'];

$adress = $_POST['adress'];



mysqli_query($connect, "UPDATE `users` SET `phone` = '$phone' WHERE `users`.`login` = '$login';");

mysqli_query($connect, "INSERT INTO `order` (`name`, `phone`, `email`, `adress`) VALUES ('$name', '$phone', '$login', '$adress')");

mysqli_query($connect, "INSERT INTO `register`.`order_items` (`id`) SELECT `id` FROM `register`.`order`");

$a = mysqli_query($connect, "SELECT `id` FROM `order`");

$row_cnt = $a->num_rows;

foreach ($_SESSION['cart'] as $key => $value) {

$str_name_price = mysqli_query($connect, "SELECT * FROM `goods` WHERE `id` = '$value'");

$out_name_price = mysqli_fetch_assoc($str_name_price);

$name_goods = $out_name_price[name_goods];

$cost_goods = $out_name_price[cost];

$img_item = $out_name_price[img];

$id = $out_name_price[id];

$qwt = $_POST[$id];

mysqli_query($connect, "INSERT INTO `order_items` (`id_order`, `id_product`, `name`, `price`, `qwt`, `img`) VALUES ('$row_cnt', '$value', '$name_goods', '$cost_goods', '$qwt', '$img_item')");


}

unset($_SESSION['cart']);

header('location:../profile.php');

