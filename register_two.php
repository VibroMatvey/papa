<?php

session_start();

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
		<form action="include/signup.php" method="POST">
			<label>Регистрация</label>
			<input type="text" name="name" placeholder="Введите Имя">
			
			<input type="text" name="surname" placeholder="Введите Фамилию">
			
			<input type="email" name="login" placeholder="Введите почту">
			
			<input type="password" name="password" placeholder="Введите пароль">
			<button>Зарегистрироваться</button>
			<p>
				<a href="register.php" class="reg_btn">Авторизация</a>
			</p>
			
		</form>

		
		<div>
			<?php
				if ($_SESSION['message2']) {
					echo '<p class="msg"> ' . $_SESSION['message2'] . ' </p>';
				}
				unset($_SESSION['message2']);
			?>
		</div>
		
	
</body>
</html>