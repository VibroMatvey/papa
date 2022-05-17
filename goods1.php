<?php
	session_start();
	
	if (isset($_GET['pageno'])) {
   
    $pageno = $_GET['pageno'];
	} else { 
	    $pageno = 1;
	}
	
	$size_page = 8;
	
	$offset = ($pageno-1) * $size_page;

	require_once 'include/connect.php';

	$variables = mysqli_query($connect, "SELECT COUNT(*) FROM `goods`");
	
	$variables1 = mysqli_query($connect, "SELECT * FROM `goods`");
	
	$total_rows = mysqli_fetch_array($variables)[0];
	
	$total_pages = ceil($total_rows / $size_page);
	
	$sql = "SELECT * FROM `goods` LIMIT $offset, $size_page";
	
	$res_data = mysqli_query($connect, $sql);

	$cat_order = mysqli_query($connect, "SELECT * FROM `category`");
	
	$cat_ord = mysqli_query($connect, "SELECT * FROM `category`");

	

	if ($_SESSION['cart']) {
		foreach ($_SESSION['cart'] as $key => $value) {
			"$_SESSION[cart][$key] => $value";
		}

		$str_out_cart = "SELECT * FROM `goods` WHERE `id` IN (";

		foreach ($_SESSION['cart'] as $key => $value) {
			$str_out_cart .= $value . ",";
		}

		$str_out_cart = substr($str_out_cart, 0, -1) . ")";
		$run_out_cart = mysqli_query($connect, $str_out_cart);
		$count_product = mysqli_num_rows($run_out_cart);

	}

	

	

	


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
	
<div class="main_goods">
	<?php

	if ($_SESSION['msg']) {
				echo '<div class="msg"> ' . $_SESSION['msg'] . '<a href="goods1.php?pageno=1">Продолжить покупки</a>' . '<a href="cart/main_cart.php">В корзину</a>' . '</div>';
			}
			unset($_SESSION['msg']);

	?>

	<?php

	while ($cat = mysqli_fetch_assoc($cat_order)) {
		if ($cat[id] == $_GET['ord']) {
		?>	
			<div class="text_goods1"><?=$cat[cat_name]?></div>
		<?php	
		}
	}

	

	if ($_GET['pageno']) {
		?>
		<div class="text_goods1">Каталог товаров</div>
		<?php
	}

	?>
	<div class="content_goods">
		<div class="fltr">
			<input type="checkbox" id="check-menu">
			<label for="check-menu" class="chck_menu">Категории</label>
			<div class="burger-line first"></div>
			<div class="burger-line second"></div>
			<div class="burger-line third"></div>
			<div class="burger-line fourth"></div>
			<nav class="main-menu">
				<a href="goods1.php?pageno=1" class="a-menu">Все</a>
				<?php

				while ($cat1 = mysqli_fetch_assoc($cat_ord)) {
					?>
					<a href="goods1.php?ord=<?=$cat1[id]?>" class="a-menu"><?=$cat1[cat_name]?></a>
					<?php
				}

				?>
			</nav>
				
		</div>

		<div class="fltr2">
			<form action="filtr.php" method="POST">
				<div class="up_container">
					<input type="radio" name="up_down" id="up" value="up_btn">
					<label for="up" class="up_name">По возрастанию</label>
				</div>
				<div class="down_container">
					<input type="radio" name="up_down" id="down" value="down_btn">
					<label for="down" class="down_name">По убыванию</label>
				</div>
			</form>
		</div>
	

		
			
				
			
		

		<div class="gds">
			<?php

			

	while ($var = mysqli_fetch_assoc($variables1)) 
	{
		if ($var[ord] == $_GET['ord']) {
			?>
		<a href="goods_item.php?id=<?=$var[id]?>" class="item_a">	
		<div class="goods_item">
			<div class="img_item"><img src="admin/uploads/<?=$var['img']?>" height="140px" width="140px"></div>

			<div class="name_item">
			<div class="main_name_item"><?=$var['name_goods']?></div>
			<div class="description_name_item"><?=$var['description']?></div>
			</div>
			<div class="cost_item"><?=$var['cost']?> ₽/шт
				<form action="cart/main_cart.php" method="GET">
					<input type="hidden" name="id_item" value="<?= $var['id']?>">
					<input type="submit" name="" value="В корзину" class="btn_add_to_cart">
				</form>
			</div>
			
			
		</div>
		</a>
		<?php
		} elseif (!isset($_GET['ord'])) {
            while ($var = mysqli_fetch_assoc($res_data)) 
	{
			?>
			<a href="goods_item.php?id=<?=$var[id]?>" class="item_a">
			<div class="goods_item">
			<div class="img_item"><img src="admin/uploads/<?=$var['img']?>" height="140px" width="140px"></div>

			<div class="name_item">
			<div class="main_name_item"><?=$var['name_goods']?></div>
			<div class="description_name_item"><?=$var['description']?></div>
			</div>
			<div class="cost_item"><?=$var['cost']?> ₽/шт
				<form action="cart/main_cart.php" method="GET">
					<input type="hidden" name="id_item" value="<?= $var['id']?>">
					<input type="submit" name="" value="В корзину" class="btn_add_to_cart">
				</form>
			</div>
			
			
		</div>
		</a>
		<?php
		}
		}
	}
	
?>

			<?php
			if($_GET['pageno']) {
			?>
			<div class="pagination">
        	<?php
        	for ($p = 1; $p <= $total_pages; $p++) :
        	?>
            <a href="?pageno=<?=$p?>" class="btn_pag"><?=$p?></a>
            <?php
        	endfor;
        	?>
        	<?php
        	}
        	?>
</div>
		</div>
	</div>
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