<?php
session_start();

require_once 'include/connect.php';

$cat_order = mysqli_query($connect, "SELECT * FROM `category`");

?>

<!DOCTYPE html>
<html>
<head>
	<title>Строительный папа</title>
	<link rel="stylesheet" type="text/css" href="styles/styles_dad3.css">
    <link rel="stylesheet" type="text/css" href="styles/adaptive1.css">
    <link rel="shortcut icon" href="img/goods9.png" type="image/x-icon">
	<meta charset="utf-8">
</head>
<body>

<?php

			

			?>

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
	
<div class="main">
	
	<div class="container_goods1">


<?php

while ($cat = mysqli_fetch_assoc($cat_order)) {

?>
		<div class="category">

			<div><a href="goods1.php?ord=<?=$cat[id]?>"><img src="admin/uploads/<?=$cat[img_2]?>" width="100px" height="100px"></img></a></div>
			<a href="goods1.php?ord=<?=$cat[id]?>"><?=$cat[cat_name]?></a>
		</div>
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
	<a href="about.php"><img src="img/ss.svg" width="300px"></a> <a class="number">8 (954) 841-02-50</a>
	</div>	
		
	</div>
	
			
			
			
</div>
		
			
	</div>

	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<script src="js/scripts.js"></script>
	<script src="admin/js/admin.js"></script>
</body>
</html>