<?php
	session_start();

	if ($_SESSION['user']) {
		header('location: profile.php');
	}

	$loginad = "admin";
	$passwordad = "admin";

	if ($_SESSION["login"] === $loginad && $_SESSION['password'] === $passwordad) {
		header('location: admin/admin.php?pageno=1');

		require_once 'include/connect.php';

		$variables = mysqli_query($connect, "SELECT * FROM `goods`");
	}

	

?>

<!DOCTYPE html>
<html>
<head>
	<title>Строительный папа</title>
	<link rel="stylesheet" type="text/css" href="styles/styles_reg.css">
	<link rel="stylesheet" type="text/css" href="styles/adaptive1.css">
	<link rel="shortcut icon" href="img/goods9.png" type="image/x-icon">
	<meta charset="utf-8">
</head>
<body>
	<div class="header">
		<div class="logo"><a href="index.php"><img src="img/logo.png" width="260px" height="80px"></a></div>
				<div class="menu">
					<nav>
						<a href="about.php">О компании</a>
						<a href="goods.php">Каталог товаров</a>
						<a href="cart/main_cart.php">Корзина</a>
						<a href="register.php">Профиль</a>
					</nav>
				</div>			
				
	</div>
		<form action="include/signin.php" method="POST">
			<label>Логин</label>
			<input type="text" name="login" placeholder="Введите почту">
			<label>Пароль</label>
			<input type="password" name="password" placeholder="Введите пароль">
			<button type="submit">Войти</button>
			<p>
				<a href="register_two.php" class="reg_btn">Регистрация</a>
			</p>
			
			<?php
				if ($_SESSION['messagee']) {
					?> 
					<div class="msg"><?=$_SESSION['messagee']?></div> 
					<?php
				}
				unset($_SESSION['messagee']);

				if ($_SESSION['message']) {
					?> 
					<div class="msg"><?=$_SESSION['message']?></div> 
					<?php
				}
				unset($_SESSION['message']);
			?>
		
		</form>

		
	
</body>
</html>