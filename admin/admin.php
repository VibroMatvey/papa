 <?php
	session_start();

	if (!$_SESSION["login"] && !$_SESSION["password"]) {
		echo "Error 404" . " " . "YOU NOT ADMIN!";
		die();
	}

	if (isset($_GET['pageno'])) {
   
    $pageno = $_GET['pageno'];
	} else { 
	    $pageno = 1;
	}

	if (isset($_GET['pageno_cat'])) {
   
    $pageno_cat = $_GET['pageno_cat'];
	} else { 
	    $pageno_cat = 1;
	}

	if (isset($_GET['pageno_usr'])) {
   
    $pageno_usr = $_GET['pageno_usr'];
	} else { 
	    $pageno_usr = 1;
	}

	if (isset($_GET['pageno_buy'])) {
   
    $pageno_buy = $_GET['pageno_buy'];
	} else { 
	    $pageno_buy = 1;
	}
	
	$size_page = 5;
	
	$offset = ($pageno-1) * $size_page;

	$offset_cat = ($pageno_cat-1) * $size_page;

	$offset_usr = ($pageno_usr-1) * $size_page;

	$offset_buy = ($pageno_buy-1) * $size_page;

	require_once '../include/connect.php';

	$variables = mysqli_query($connect, "SELECT COUNT(*) FROM `goods`");

	$total_rows = mysqli_fetch_array($variables)[0];

	$total_pages = ceil($total_rows / $size_page);

	$sql = "SELECT * FROM `goods` LIMIT $offset, $size_page";

	$res_data = mysqli_query($connect, $sql);

	$cat_order = mysqli_query($connect, "SELECT COUNT(*) FROM `category`");

	$total_rows_cat = mysqli_fetch_array($cat_order)[0];

	$total_pages_cat = ceil($total_rows_cat / $size_page);

	$sql_cat = "SELECT * FROM `category` LIMIT $offset_cat, $size_page";

	$res_data_cat = mysqli_query($connect, $sql_cat);

	$users = mysqli_query($connect, "SELECT COUNT(*) FROM `users`");

	$total_rows_usr = mysqli_fetch_array($users)[0];

	$total_pages_usr = ceil($total_rows_usr / $size_page);

	$sql_usr = "SELECT * FROM `users` LIMIT $offset_usr, $size_page";

	$res_data_usr = mysqli_query($connect, $sql_usr);

	$buy = mysqli_query($connect, "SELECT COUNT(*) FROM `order`");

	$total_rows_buy = mysqli_fetch_array($buy)[0];

	$total_pages_buy = ceil($total_rows_buy / $size_page);

	$sql_buy = "SELECT * FROM `order` LIMIT $offset_buy, $size_page";

	$res_data_buy = mysqli_query($connect, $sql_buy);

	

	

?>

<!DOCTYPE html>
<link rel="stylesheet" type="text/css" href="styles_admin.css">
<html>
<head>
	<title>admin panel</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="styles/adaptive1.css">
    <link rel="shortcut icon" href="img/goods9.png" type="image/x-icon">
</head>
<body>
	<div class="header">
		<div class="btns_adm">
			<a href="admin.php?pageno=1"><div class="btn_menu">Товары</div></a>
			<a href="admin.php?pageno_cat=1"><div class="btn_menu">Категории</div></a>
			<a href="admin.php?pageno_usr=1"><div class="btn_menu">Пользователи</div></a>
			<a href="admin.php?pageno_buy=1"><div class="btn_menu">Заказы</div></a>
		</div>
		<div class="out_block"><a href="../admin/logout2.php"><div class="out">ВЫХОД</div></a></div>
	</div>		
	
<div class="main_admin">

<div class="tbl">
<table>
	 <?php 
if ($_GET['pageno']) {
 
?> 
	<th>id</th>
	<th>название</th>
	<th>цена</th>
	<th>описание</th>
	<th>категория</th>
	<th>изображение</th>
	<th>действие</th>	
<?php } ?>			

<?php

	


while($row = mysqli_fetch_array($res_data)){
    

if ($_GET['pageno']) {
	
	
	

	

	

	
		
	

	?>
		
			 <tr>
				 <td width="100px" height="100px"><?=$row['id']?></td>
				 <td width="100px" height="100px"><?=$row['name_goods']?></td>
				 <td width="100px" height="100px"><?=$row['cost']?></td>
				 <td width="100px" height="100px"><?=$row['description']?></td>
				 <td width="100px" height="100px"><?=$row['ord']?></td>
				 <td width="100px" height="100px"><img src="uploads/<?=$row['img']?>" width="100px"></td>
				 <td width="100px" height="100px">
				 	<a href="delete_goods.php?id=<?=$row['id']?>">Удалить</a>

				 	<p class="btn_red"><a href="admin.php?id_r=<?=$row['id']?>">Редактировать</a>
				 </td>

			 </tr>
		

		 
		  <?php

}
}

?>
</table>
</div>
<?php

if ($_GET['pageno']) {
	
	


?>
<div class="pagination">
	<?php
	for ($p = 1; $p <= $total_pages; $p++) :
	?>
    <a href="?pageno=<?=$p?>" class="btn_pag"><?=$p?></a>
    <?php
	endfor;
	?>
</div>
<div class="form">
	<form action="add_goods.php" method="post" enctype="multipart/form-data">
		<p><input type="text" name="name_goods" placeholder="имя">
		<p><input type="text" name="cost" placeholder="стоимость">
		<p><input type="text" name="description" placeholder="описание">
		<p><select name="ord">
		    <option disabled selected>Категория</option>
			<?php
			$cat_goods = mysqli_query($connect, "SELECT * FROM `category`");
			while ($cat = mysqli_fetch_assoc($cat_goods)) {
				
			
			?>
			<option value="<?=$cat[id]?>"><?=$cat[cat_name]?></option>
			<?php
		}
			?>
		</select>
		<p><input type="file" name="image">
		<p><button type="submit">Добавить</button>
   </form>
</div>
<?php
}
?>




<table>
     <?php 
if ($_GET['pageno_cat']) {
 
?> 
	<th>Название</th>
	<th>id</th>
	<th>изображение слайдер</th>
	<th>изображение категории</th>
	<th>действие</th>	
<?php } ?>			

<?php


while ($row_cat = mysqli_fetch_array($res_data_cat)) 
{
	if ($_GET['pageno_cat']) {
	?>
	
		 <tr>
			 <td width="100px" height="100px"><?=$row_cat['cat_name']?></td>
			 <td width="100px" height="100px"><?=$row_cat['id']?></td>
			 <td width="100px" height="100px"><img src="uploads/<?=$row_cat['img']?>" width="100px"></td>
			 <td width="100px" height="100px"><img src="uploads/<?=$row_cat['img_2']?>" width="100px"></td>
			 <td width="100px" height="100px">
			 	<a href="delete_cat.php?id=<?=$row_cat['id']?>">Удалить</a>
			 	<p class="btn_red"><a href="admin.php?id_c=<?=$row_cat['id']?>">Редактировать</a>
			 </td>
		 </tr>


		  
		  <?php
}
}

?>

<?php

if ($_GET['pageno_cat']) {
	# code...


?>

</table>

<div class="pagination">
    <?php
	for ($p = 1; $p <= $total_pages_cat; $p++) :
	?>
    <a href="?pageno_cat=<?=$p?>" class="btn_pag"><?=$p?></a>
    <?php
	endfor;
	?>
</div>

<div class="form">
	<form action="add_category.php" method="post" enctype="multipart/form-data">
		<p><input type="text" name="cat_name" placeholder="имя">
		<p><input type="file" name="image">
			<p><input type="file" name="image2">
		<p><button type="submit">Добавить</button>
   </form>
</div>
<?php
}
?>




<table>
    <?php 
if ($_GET['pageno_usr']) {
 
?> 
	<th>id</th>
	<th>Имя</th>
	<th>Фамилия</th>
	<th>Логин</th>
	<th>Пароль</th>
	<th>Действие</th>
<?php } ?>
<?php

while ($row_usr = mysqli_fetch_array($res_data_usr)) 
{
	if ($_GET['pageno_usr']) {
	?>
	
		 <tr>
			 <td width="100px" height="100px"><?=$row_usr['id']?></td>
			 <td width="100px" height="100px"><?=$row_usr['name']?></td>
			 <td width="100px" height="100px"><?=$row_usr['surname']?></td>
			 <td width="100px" height="100px"><?=$row_usr['login']?></td>
			 <td width="100px" height="100px"><?=$row_usr['password']?></td>
			 <td width="100px" height="100px">
			 	<a href="delete_user.php?id=<?=$row_usr['id']?>">Удалить</a>
			 	<p class="btn_red"><a href="admin.php?id_u=<?=$row_usr['id']?>">Редактировать</a>
			 </td>
		 </tr>

		  
		  <?php
}
}

?>

</table>

<?php if ($_GET['pageno_usr']) {?>

<div class="pagination">
    <?php
	for ($p = 1; $p <= $total_pages_usr; $p++) :
	?>
    <a href="?pageno_usr=<?=$p?>" class="btn_pag"><?=$p?></a>
    <?php
	endfor;
	?>
</div>

<?php } ?>
<table>
    <?php 
if ($_GET['pageno_buy']) {
 
?> 
	<th>Статус</th>
	<th>Номер заказа</th>
	<th>Телефон</th>
	<th>Логин</th>
	<th>Адрес</th>
	<th>Товары</th>
<?php } ?>
<?php

while ($row_buy = mysqli_fetch_array($res_data_buy)) 
{
	if ($_GET['pageno_buy']) {
	?>
	
		 <tr>
			 <td width="100px" height="100px"><?php if ($row_buy['stat'] == 0) {
									$stat = "Доставляется...";
									echo $stat;
								} elseif ($row_buy['stat'] == 1) {
									$stat2 = "Доставлено.";
									echo $stat2;
								} elseif ($row_buy['stat'] == 2) {
									$stat3 = "В обработке...";
									echo $stat3;
								} elseif ($row_buy['stat'] == 3) {
									$stat4 = "Отменен.";
									echo $stat4;
								}
								?></td>
			 <td width="100px" height="100px"><?=$row_buy['id']?></td>
			 <td width="100px" height="100px"><?=$row_buy['phone']?></td>
			 <td width="100px" height="100px"><?=$row_buy['email']?></td>
			 <td width="100px" height="100px"><?=$row_buy['adress']?></td>
			 <td width="100px" height="100px">
			     <?php
			 		$id = $row_buy['id'];

				$item_buy = mysqli_query($connect, "SELECT * FROM `order_items` WHERE `id_order` = '$id'");
				
				while ($itm = mysqli_fetch_assoc($item_buy)) {
				 	$name = $itm[name] . " ";

				 	echo $name;
				 } 
			 	?>
			 </td>
			
			 
		 </tr>

		  
		  <?php
}
}

?>

</table>

<?php if ($_GET['pageno_buy']) {?>

<div class="pagination">
    <?php
	for ($p = 1; $p <= $total_pages_buy; $p++) :
	?>
    <a href="?pageno_buy=<?=$p?>" class="btn_pag"><?=$p?></a>
    <?php
	endfor;
	?>
</div>
<form method="POST" action="order.php">
	<select name="stat">
	 <option disabled selected>Статус заказа</option>
 	 <option value="1">Доставлено</option>
 	 <option value="0">Доставляется</option>
 	 <option value="2">В обработке...</option>
 	 <option value="3">Отменен</option>
	</select>
	<p><select name="id">
	    <option disabled selected>Номер заказа</option>
		<?php
		$buy_id = mysqli_query($connect, "SELECT * FROM `order`");
		while ($row_buy_id = mysqli_fetch_assoc($buy_id)) {
		
		
		?>
		<option><?=$row_buy_id[id]?></option>
		<?php
	}
		?>
	</select>
	<p><button type="submit">Редактировать</button>
</form>

<?php } ?>

<?php

if ($_GET['id_r']) {
	$id = $_GET['id_r'];

	$str_row_product = mysqli_query($connect, "SELECT * FROM `goods` WHERE `id` = '$id'");

	$product = mysqli_fetch_assoc($str_row_product);

	?>
	<table>
		<th>id</th>
		<th>название</th>
		<th>цена</th>
		<th>описание</th>
		<th>категория</th>
		<th>изображение</th>
			<tr>
				 <td width="100px" height="100px"><?=$product[id]?></td>
				 <td width="100px" height="100px"><?=$product[name_goods]?></td>
				 <td width="100px" height="100px"><?=$product[cost]?></td>
				 <td width="100px" height="100px"><?=$product[description]?></td>
				 <td width="100px" height="100px"><?=$product[ord]?></td>
				 <td width="100px" height="100px"><img src="uploads/<?=$product[img]?>" width="100px"></td>
				 

			 </tr>
	</table>

	<div class="form">
	<form action="red_good.php?id=<?=$product[id]?>" method="post" enctype="multipart/form-data">
		<p><input type="text" name="name_goods" value="<?=$product[name_goods]?>">
		<p><input type="text" name="cost" value="<?=$product[cost]?>">
		<p><input type="text" name="description" value="<?=$product[description]?>">
		<p><select name="ord">
			<?php
			$cat_goods2 = mysqli_query($connect, "SELECT * FROM `category` WHERE `id` = '$product[ord]'");
			$cat_index = mysqli_fetch_assoc($cat_goods2);


			?>
		    <option selected value="<?=$cat_index[id]?>"><?=$cat_index[cat_name]?></option>
			<?php
			$cat_goods = mysqli_query($connect, "SELECT * FROM `category`");

			while ($cat = mysqli_fetch_assoc($cat_goods)) {
				
			
			?>
			<option value="<?=$cat[id]?>"><?=$cat[cat_name]?></option>
			<?php
		}
			?>
		</select>
		<p><input type="file" name="image" value="<?=$product[img]?>">
		<p><button type="submit">Редактировать</button>
   </form>
</div>
	<?php
}

?>

<?php

if ($_GET['id_c']) {

$id_cat = $_GET['id_c'];

$res_data_cat_red = mysqli_query($connect, "SELECT * FROM `category` WHERE `id` = '$id_cat'");

$row_cat_red = mysqli_fetch_array($res_data_cat_red); 

	?>
	
	<table>
	<th>Название</th>
	<th>id</th>
	<th>изображение слайдер</th>
	<th>изображение категории</th>

	<tr>
			 <td width="100px" height="100px"><?=$row_cat_red[cat_name]?></td>
			 <td width="100px" height="100px"><?=$row_cat_red[id]?></td>
			 <td width="100px" height="100px"><img src="uploads/<?=$row_cat_red[img]?>" width="100px"></td>
			 <td width="100px" height="100px"><img src="uploads/<?=$row_cat_red[img_2]?>" width="100px"></td>
		 </tr>
	</table>	 

	<form action="cat_red.php?id=<?=$row_cat_red[id]?>" method="POST" enctype="multipart/form-data">
		<input type="text" name="cat_name" value="<?=$row_cat_red[cat_name]?>">
		<p><input type="file" name="image1" value="<?=$row_cat_red[img]?>">
		<p><input type="file" name="image2" value="<?=$row_cat_red[img_2]?>">
			<p><button type="submit">Редактировать</button>

	</form>
	

	<?php
}

?>

<?php

if ($_GET['id_u']) {
	$id_usr = $_GET['id_u'];

	$res_data_usr_red = mysqli_query($connect, "SELECT * FROM `users` WHERE `id` = '$id_usr'");

	$row_usr_red = mysqli_fetch_array($res_data_usr_red);

	?>
	<table>
		<th>id</th>
		<th>Имя</th>
		<th>Фамилия</th>
		<th>Логин</th>
		<th>Пароль</th>
			<tr>
				 <td width="100px" height="100px"><?=$row_usr_red[id]?></td>
				 <td width="100px" height="100px"><?=$row_usr_red[name]?></td>
				 <td width="100px" height="100px"><?=$row_usr_red[surname]?></td>
				 <td width="100px" height="100px"><?=$row_usr_red[login]?></td>
				 <td width="100px" height="100px"><?=$row_usr_red[password]?></td>
			</tr>
	</table>
	
	<p><form action="usr_red.php?id=<?=$row_usr_red[id]?>" method="POST">
		<p><input type="text" name="name" value="<?=$row_usr_red[name]?>">
		<p><input type="text" name="surname" value="<?=$row_usr_red[surname]?>">
		<p><input type="text" name="login" value="<?=$row_usr_red[login]?>">
		<p><input type="text" name="password" placeholder="Новый пароль">
		<p><button type="submit">Редактировать</button>	
	</form>
	<?php
}

?>





</div>
</body>
</html>