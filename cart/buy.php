<?php
session_start();

require_once '../include/connect.php';









?>
<!DOCTYPE html>
<html>
<head>
	<title>Строительный папа</title>
	<link rel="stylesheet" type="text/css" href="style_cart.css">
	<link rel="shortcut icon" href="../img/goods9.png" type="image/x-icon">
	<meta charset="utf-8">
</head>
<body>
	<div class="header">
		<div class="logo"><a href="../index.php"><img src="../img/logo.png" width="260px" height="80px"></a></div>
			<div class="menu">
				<nav class="menu_header">
					<a href="../about.php">О компании</a>
					<a href="../goods.php">Каталог товаров</a>
					<a href="main_cart.php">Корзина</a>
					<a href="../register.php">Профиль</a>
				</nav>
			</div>			
	</div>	
	<div class="main_buy">
		<div class="items">
		<?php

		foreach ($_SESSION['cart'] as $key => $value) {
    if ($key);



    $itm_crt = mysqli_query($connect, "SELECT * FROM `goods` WHERE `id` = '$value'");



  


    while ($itm = mysqli_fetch_assoc($itm_crt)) {
    	?>
    <div class="item_buy">
    	<div class="item_cart_name"><?=$itm[name_goods]?></div>
    	<div><?=$itm[cost]?> ₽/шт</div>
    	<div>
    		<form action="phone.php" method="POST" class="phone_frm">
    		<select name="<?=$itm[id]?>"> 
		<option selected value="1">1 шт</option> 
				<?php 
				for ($i=1; $i <= 100; $i++) :
					
				?>
				<option value="<?=$i?>"><?=$i?> шт</option>
				<?php
			
		endfor;
				?>
			</select>
    	</div>
    	<img src="../admin/uploads/<?=$itm[img]?>" height="140px" width="140px">
    </div>	
    
    	<?php





	}

    	

    	  	
    }

    
    

    	

   


		
		?>
	</div>

	<?php
	if ($_SESSION['user']) {
		
		?>

		<div class="client">
			<div>Имя: <div class="client_item"><?= $_SESSION['user']['name']?></div></div>
			<div>Фамилия: <div class="client_item"><?= $_SESSION['user']['surname']?></div></div>
			<div>Электронная почта: <div class="client_item"><?= $_SESSION['user']['login']?></div></div>
		</div>

		<div>
			
				<input type="text" name="phone" placeholder=" Номер телефона" class="client_item">
				<input type="text" name="adress" placeholder=" Адрес" class="client_item">
				<button class="btn_phone">Оформить</button>
			</form>
		</div>
		<?php

	} else {
		?>
		<div class="error"> Для начала войдите в учетную запись:
		<a href="../register.php">Вход</a> | <a href="../register_two.php">Регистрация</a>
		</div>
		<?php

	}

		?>

		


	</div>
	
    	
    

</body>
</html>	