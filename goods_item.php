<?php

session_start();

require_once 'include/connect.php';

$id = $_GET['id'];

$variables = mysqli_query($connect, "SELECT * FROM `goods` WHERE `id` = '$id'");




	





?>


<!DOCTYPE html>
<html>
<head>
	<title>Строительный папа</title>
	<link rel="stylesheet" type="text/css" href="styles/styles_dad3.css">

	<meta charset="utf-8">
</head>
<body class="body_goods">

	<div class="header">
		<div class="logo"><a href="index.php"><img src="img/logo.png" width="260px" height="80px"></a></div>
				<div class="menu">
					<nav class="menu_header">
						<a href="about.php">О компании</a>
						<a href="goods.php">Каталог товаров</a>
						<a href="cart/main_cart.php">Корзина</a>
						<a href="register.php">Профиль</a>
					</nav>
				</div>			
	</div>			
	
<div class="main_item_goods1">
	<?php

	while ($var = mysqli_fetch_assoc($variables)) {
		?>

		<div class="item"><?=$var[name_goods]?>
			<div class="item_twice"><?=$var[description]?></div>
		</div>		
		<div class="item"><?=$var[cost]?> ₽/шт
			<form action="cart/main_cart.php" method="GET">
					<input type="hidden" name="id_item" value="<?= $var[id]?>">
					<input type="submit" name="" value="В корзину" class="btn_add_to_cart">
				</form>
		</div>
		<img src="admin/uploads/<?=$var[img]?>" height="400px" width="400px">



		<?php
	}
	


	?>
</div>

<div class="footer">
	<div class="textt">
		<p class="a">Cтроительный папа в Ижевске</p>

		<p class="b">Ассортимент интернет-магазина Cтроительный папа включает различные группы товаров, предназначенных для строительно-ремонтных и отделочных работ, а также для сада. У нас каждый покупатель сможет приобрести по самой выгодной цене:
	<ul>
		<li><span class="footer_text_size">стройматериалы, инструменты и электротовары;</span></li>
		<li><span class="footer_text_size">сантехническую продукцию и все для организации водоснабжения;</span></li>
		<li><span class="footer_text_size">столярные изделия и скобяные изделия;</span></li>
		<li><span class="footer_text_size">различные виды напольного покрытия и плитки;</span></li>
		<li><span class="footer_text_size">краску, декор и товары для хранения;</span></li>
		<li><span class="footer_text_size">все для обустройства кухни;</span></li>
		<li><span class="footer_text_size">товары для организации освещения дома и придомового участка;</span></li>
		<li><span class="footer_text_size"><p class="c">все для сада и огорода.</p></span></li>
	</ul>	
		<p class="b">Широкий ассортимент товаров – это гарантия того, что каждый наш покупатель сможет подобрать оптимальное решение для реализации своего проекта.</p>
	<div class="hr_footer">
		<hr size="1px" >
	</div>	
	<div class="social">
	<a><img src="img/ss.svg" width="300px"></a> <a class="number">8 (954) 841-02-50</a>
	</div>	
		
	</div>
	
			
			
			
</div>
		
			
	</div>

	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<script src="js/scripts.js"></script>
	<script src="admin/js/admin.js"></script>
</body>
</html>	