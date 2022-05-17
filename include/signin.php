<?php
session_start();
    
    
	$loginad = "admin";
	$passwordad = "admin";

	if ($loginad == $_POST['login'] && $passwordad == $_POST['password']) {
		session_start();
		$_SESSION["login"] = $_POST['login'];
		$_SESSION["password"] = $_POST['password'];

	}

	
	require_once 'connect.php';

	$login = $_POST['login'];
	$password = md5($_POST['password']);

	$check_user = mysqli_query($connect, "SELECT * FROM `users` WHERE `login` = '$login' AND `password` = '$password'");
	if (mysqli_num_rows($check_user) > 0) {
		session_start();
		$user = mysqli_fetch_assoc($check_user);

			$_SESSION['user'] = [
				"id" => $user['id'],
				"name" => $user['name'],
				"surname" => $user['surname'],
				"login" => $user['login'],
			];

			header('location:../profile.php');

	} else {
		$_SESSION['messagee'] = 'Не верный логин или пароль!';
  		header('location:../register.php');
	}



?>