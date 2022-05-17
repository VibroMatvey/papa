<?php
session_start();
require_once 'connect.php';


$name = $_POST['name'];
$surname = $_POST['surname'];
$login = $_POST['login'];
$password = $_POST['password'];



$password1 = md5($password);

$a = mb_strlen($password);
$b = mb_strlen($name);
$c = mb_strlen($surname);

if($a <= 7 || $b <= 3 || $c <= 3) {
    $_SESSION['message2'] = "Пароль должен содержать минимум 8 латинских символов или цифр, имя и фамилия 3 символа!";
    header('location: ../register_two.php');
} else {

	mysqli_query($connect, "INSERT INTO `users` (`id`, `name`, `surname`, `login`, `password`) VALUES (NULL, '$name', '$surname', '$login', '$password1')");
	
	 $_SESSION['message'] = 'Успешная регистрация!';
  header('location:../register.php');

	}



?>