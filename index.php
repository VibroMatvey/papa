<?php

session_start();

require_once 'include/connect.php';

$cat_order = mysqli_query($connect, "SELECT * FROM `category`");


?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Строительный папа</title>
	<link rel="stylesheet" type="text/css" href="styles/styles_dad3.css">
	<link rel="stylesheet" type="text/css" href="styles/adaptive1.css">
    <link rel="shortcut icon" href="img/goods9.png" type="image/x-icon">
	<meta charset="utf-8">
</head>
<body>

	<div class="header">
		<div class="logo"><a href=""><img src="img/logo.png" width="260px" height="80px"></a></div>
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
	<div class="container1">
			<form method="POST" action="search.php" id="searchform">
			   <input type="search" name="search_value" placeholder="Поиск" class="search" > 
			   <button type="submit" class="search_button" value="search"><img src="img/11.png" height="25px" width="25px"></button>
			</form>
			<?php
			$search = $_SESSION['search'];

			$result = mysqli_query($connect, "SELECT `name_goods`, `id`, `ord` FROM `goods` WHERE `name_goods` LIKE '%$search%'");

			while ($row = mysqli_fetch_assoc($result)) {

				if ($_SESSION['search']) {
					
				
				
				?>

				<div class="search_value">
					<a href="goods_item.php?id=<?=$row[id]?>"><?=$row[name_goods]?></a>
				</div>

			
				<?php
				
			
		}
	}

	if ($_SESSION['search']) {
	
	?>
	<a href="index.php" class="out_search">Назад</a>
	<?php
		} 

		if (is_numeric($_SESSION['search'])) {
			?>
			<div class="out_search1">поисковой запрос должен быть без цифр и латинских букв</div>
			<?php
		}

		if (preg_match('~[a-z]+~i', $_SESSION['search'])) {
			?>
			<div class="out_search1">поисковой запрос должен быть без цифр и латинских букв</div>
			<?php
		}
			unset($_SESSION['search']);

			?>
			
	</div>

	
	<div class="slider-container">
		<div class="slider-track">
			<?php

			while ($cat = mysqli_fetch_assoc($cat_order)) {
			?>
			<a href="goods1.php?ord=<?=$cat[id]?>"><div class="slide">
				<div><?=$cat[cat_name]?></div>
				<div class="img_slide"><img src="admin/uploads/<?=$cat[img]?>" width="100px" height="100px" class="img_slide"></div>
			</div></a>
			<?php	
		}
			?>
			
		</div>
		<div class="slider-buttons">
			<button class="btn-prev"><img src="img/left.png" width="25px" height="25px"></button>
			<button class="btn-next"><img src="img/right.png" width="25px" height="25px"></button>
		</div>
	</div>
	

		<div class="container2">
			<a href="goods1.php?ord=1"><img src="img/container1.png" class="img_ct2"></a>
		</div>

		<div class="container3">
			<div class="container3_block1">
				
				<div class="container3_main_text">
				<img src="img/1.svg">
				Работаем
				с юридическими
				лицами</div>

				<div class="container3_text">
				<li class="dots"><span class="container3_text_second">Специальные цены и условия для юридических лиц</span></li>

				<li class="dots"><span class="container3_text_second">Персональный менеджер и возможность отсрочки платежа</span></li>
				</div>
			</div>
			<div class="container3_block2">
				
				<div class="container3_main_text">
				<img src="img/2.svg">
				Наша доставка</div>

				<div class="container3_text">
				<li><span class="container3_text_third">Доставка по звонку с оплатой на месте</span></li>
				<li><span class="container3_text_third">Доступна доставка манипулятором</span></li>
				</div>
			</div>
			<div class="container3_block2">
				
				<div class="container3_main_text">
				<img src="img/3.svg">
					Легкий обмен
				и возврат</div>

				<div class="container3_text">
				<li><span class="container3_text_third">В любой день до истечения срока годности товара</span></li>

				<li><span class="container3_text_third">В любом нашем магазине</span></li>
				</div>
			</div>
			<div class="container3_block2">
				
				<div class="container3_main_text">
				<img src="img/4.svg">
				Большой спектр услуг</div>

				<div class="container3_text">
				<li><span class="container3_text_third">Разгрузка и подъем</span></li>

				<li><span class="container3_text_third">Колеровка, распиловка, упаковка</span></li>

			    <li><span class="container3_text_third">Прокат инструменто</span></li>
				</div>
			</div>
			<div class="container3_block2">
				
				<div class="container3_main_text">
				<img src="img/5.svg">
				Продаем с 1993 года</div>

				<div class="container3_text">
				<li><span class="container3_text_third">Помощь в подборке строительных материалов</span></li>

				<li><span class="container3_text_third">Более 20 000 наименований товаров</span></li>
				<li><span class="container3_text_third">Акции и распродажи</span></li>
				</div>
			</div>
			<div class="container3_block2">
				
				<div class="container3_main_text">
				<img src="img/6.svg">
				Работаем с бригадами</div>

				<div class="container3_text">
				<li><span class="container3_text_third">Специальные условия для бригадиров</span></li>

				<li><span class="container3_text_third">Поиск бригады для ремонта и строительства</span></li>
				</div>
			</div>
		</div>

		<div class="container4">
			<a href="about.php"><img src="img/container4.png" class="img_ct2"></a>
		</div>

		<div class="container4">
			<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2181.084991709128!2d53.210986891973455!3d56.86163754200085!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x43e13ec9c1082c9d%3A0x300cb54458c8123a!2z0JzQtdC20LTRg9C90LDRgNC-0LTQvdGL0Lkg0JLQvtGB0YLQvtGH0L3Qvi3QldCy0YDQvtC_0LXQudGB0LrQuNC5INGD0L3QuNCy0LXRgNGB0LjRgtC10YI!5e0!3m2!1sru!2sru!4v1648572788090!5m2!1sru!2sru" class="img_ct2" width="1200" height="400" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
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

		
			
	</div>

	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<script src="js/scripts.js"></script>
	<script src="admin/js/admin.js"></script>
</body>
</html>