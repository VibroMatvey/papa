<?php
error_reporting(0);

session_start();

require_once '../include/connect.php';

$cat_order = mysqli_query($connect, "SELECT * FROM `category`");

if ($_GET['id_item']) {
    foreach ($_SESSION['cart'] as $key => $value) {
		if ($_GET['id_item'] == $value) {
			
			$_SESSION['error_cart'] = "Товар уже в корзине!";

			header('location: ../cart/main_cart.php');

			die();
		}
	}
	if (!isset($_SESSION['cart'])) {
		$_SESSION['cart'] = array();
	}
	array_push($_SESSION['cart'], $_GET['id_item']);

	array_unique($_SESSION['cart']);
}

if ($_GET['id_item']) {

	$_SESSION['msg'] = 'Товар добавлен в корзину!';

	header('location: ../goods1.php?pageno=1');
}

	

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
	<div class="main">
		<div class="slider-container">
		<div class="slider-track">
			<?php

			while ($cat = mysqli_fetch_assoc($cat_order)) {
			?>
			<a href="../goods1.php?ord=<?=$cat[id]?>"><div class="slide">
				<div><?=$cat[cat_name]?></div>
				<div class="img_slide"><img src="../admin/uploads/<?=$cat[img]?>" width="100px" height="100px" class="img_slide"></div>
			</div></a>
			<?php	
		}
			?>
			
		</div>
		<div class="slider-buttons">
			<button class="btn-prev"><img src="../img/left.png" width="25px" height="25px"></button>
			<button class="btn-next"><img src="../img/right.png" width="25px" height="25px"></button>
		</div>
	</div>
		<?php

		foreach ($_SESSION['cart'] as $key => $value) {
    if ($key);



    $itm_crt = mysqli_query($connect, "SELECT * FROM `goods` WHERE `id` = '$value'");

  


    while ($itm = mysqli_fetch_assoc($itm_crt)) {
    	?>
    <div class="item_cart">
    	<div class="item_cart_name"><?=$itm[name_goods]?></div>
    	<div><?=$itm[description]?></div>
    	<div><?=$itm[cost]?> ₽/шт</div>
    	<img src="../admin/uploads/<?=$itm[img]?>" height="140px" width="140px">
    	<a href="delete_item.php?id_item=<?=$itm[id]?>">Удалить из корзины</a>
    </div>	
    
    	<?php


    	
    }


}
		
		?>
		<?php
			if ($_SESSION['error_cart']) {
				?>
				<div class="msg">
					<?=$_SESSION['error_cart']?>
					<a href="main_cart.php">ок</a>				
				</div>
				<?php
				unset($_SESSION['error_cart']);
			}
			?>
		<br>
	<div class="buttons">	
		<div class="delete"><a href="delete.php">
			<?php

			if ($_SESSION['cart']) {
				echo "Очистить корзину";
			} else {
				echo "Корзина пуста...";
			}

			?>
		</a></div>


		<?php
		if ($_SESSION['cart']) {
			
		?>
		<a href="buy.php"><div class="buy">
			Оформить заказ
		</div></a>
		<?php
	}
		?>
		
	


	</div>
	
	

	</div>
	
	<?php
		if ($_SESSION['message_buy']) {
			
		?>
		<div class="buy_msg">
			<div><?= $_SESSION['message_buy']?></div>
			<div class="msg_btn"><a href="main_cart.php">Остатья в корзине</a>
			<a href="../profile.php">В профиль</a></div>
		</div>
		<?php
		unset($_SESSION['message_buy']);
	}
		?>	
	
    	
    

	


	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<script src="../js/scripts.js"></script>
</body>
</html>