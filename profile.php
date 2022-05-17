<?php
session_start();

$login = $_SESSION['user']['login'];

require_once 'include/connect.php';

$phn = mysqli_query($connect, "SELECT `phone` FROM `order` WHERE '$login' = `email`");

$p = mysqli_fetch_assoc($phn);
?>
<!DOCTYPE html>
<html>
<head>
	<title>Строительный папа</title>
	<link rel="stylesheet" type="text/css" href="styles/profile_styless.css">
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
	<div class="main_profile">
		<div class="name">Профиль</div>
			<div class="content">
				<div class="user"><div class="user_item">Имя:</div> <br><?= $_SESSION['user']['name']?></div>
				<div class="user"><div class="user_item">Фамилия:</div> <br><?= $_SESSION['user']['surname']?></div>
				<div class="user"><div class="user_item">Логин:</div> <br><?= $_SESSION['user']['login']?></div>
				<div class="user"><div class="user_item">Номер:</div> <br>
				<?php 
				
				if ($p) {
				 	echo $p[phone];
				 } else {
				 	?>
				 	<h3>*Номер появится после оформления заказа*</h3>
				 	<?php
				 }
				?>
			</div>
					
				


				



				</div>
				<div class="name_buy">Заказы</div>
		<?php

						$a = mysqli_query($connect, "SELECT * FROM `order` WHERE `email` = '$login'");

						while($b = mysqli_fetch_assoc($a)) {

						$c = $b[id];

						
						

						$str_item_ord = mysqli_query($connect, "SELECT * FROM `order_items` WHERE `id_order` = '$c'");

						$row_cnt = $str_item_ord->num_rows;

						?>
						
							<div class="name_buy2">Заказ №<?=$c?> (<?=$row_cnt?> 
								<?php
								if ($row_cnt == 1) {
									echo "товар";
								} elseif ($row_cnt == 2 || $row_cnt == 3 || $row_cnt == 4) {
									echo "товара";
								} elseif ($row_cnt >= 5) {
									echo "товаров";
								}
								$summ_buy = mysqli_query($connect, "SELECT sum(price * qwt) FROM `order_items` WHERE `id_order` = '$c'");
								$sm = mysqli_fetch_assoc($summ_buy);

								echo " " . "на сумму:" . " " . ($sm["sum(price * qwt)"]) . " ₽";

								
								?>), 
								<?php
								if ($b[stat] == 0) {
									$stat = "Доставляется на адрес: " . $b[adress];
									echo $stat;
								} elseif ($b[stat] == 1) {
									$stat2 = "Доставлено на адрес: " . $b[adress];
									echo $stat2;
								} elseif ($b[stat] == 2) {
									$stat3 = "В обработке. Адрес: " . $b[adress];
									echo $stat3;
								} elseif ($b[stat] == 3) {
									$stat4 = "Отменен. Адрес: " . $b[adress];
									echo $stat4;
								}		
								?>
								

							</div>
								<div class="buy">
					
						<?php
						while ($out_item = mysqli_fetch_assoc($str_item_ord)) {
							?>
						<div class="item_buy">	
							<div class="name_order"><?=$out_item[name]?></div>
							<?php 
							if ($out_item[qwt] <= 1) {
							?>
							<div class="price_order"><?=$out_item[qwt]?> шт, <?=$out_item[price]?> ₽</div>
							<?php
						} else {
							$summ = $out_item[price] * $out_item[qwt];
							?>
							<div class="price_order"><?=$out_item[qwt]?> шт, <?=$summ?> ₽</div>
							<?php
						}
							?>
							<img src="admin/uploads/<?=$out_item[img]?>" width="100px" height="100px">
						</div>	
							<?php
						}
						?>
						
								</div>
						<?php
					}
						?>
				<a href="include/logout.php" class="out_a"><div class="out">Выход</div></a>
				
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<script src="js/scripts.js"></script>
</body>
</html>