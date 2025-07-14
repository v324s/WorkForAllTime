<?
	include 'include/settings.php';
	include 'include/cart.php';
	if (@$_COOKIE['cart']) { 
		$cart=$_COOKIE['cart'];
	}
	$cartArr=explode("|",$cart);
	if ($_GET['act']=='clear') {
		setcookie('cart','');
		header('Location: korzina');
	}
	if ($_GET['act']=='orderform') {
		$orderform=true;
	}else{
		$orderform=false;
	}
	if ($_POST['fio'] && $_POST['gorod'] && $_POST['tel'] && $_POST['address'] && $_POST['email']) {
		$fio=$_POST['fio'];
		$gorod=$_POST['gorod'];
		$tel=$_POST['tel'];
		$address=$_POST['address'];
		$email=$_POST['email'];
		if ($_COOKIE['cart']) {
			$cart=$_COOKIE['cart'];
			setcookie('cart','');
		}
		$date=date("y-m-d");
		$q=mysql_query("insert into zakazi(datazakaza, fio, tel, email, gorod, address, cart) values('$date','$fio','$tel','$email','$gorod','$address','$cart')");
		if ($q) {
			header('Location: korzina?act=zaktrue');
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link href="fonts/css.css" rel="stylesheet">
	<title>Книжный дизайн | <? echo $book['name']; ?></title>
	<link rel="stylesheet" type="text/css" href="css/main.css">
</head>
<body>
	<?
	include 'include/site-header.php';
	?>
	<section style="position: relative;">
		<section class="bokblock">
			<?
			include 'include/site-ads.php';
			?>
		</section><main class="osnovcontent">
			<div class="osnovapodbooks">
				<?
				if ($orderform) {
					echo '<div class="namepage">Оформление заказа</div>';
				}else{
					echo '<div class="namepage">Корзина</div>';
				}
				?>
				<div class="dlyafiltra">
					<div>
						
					</div>
					<div style="display: inline-block;">В корзине <b><? if ($cartCount){ echo $cartCount;}else{echo "0";} ?></b> товаров(-а)
					</div>
				</div>
				<?
				if ($orderform) {
					echo '<div style="padding:3%;">
							<form id="orderform" name="orderform" method="post" action="korzina.php">
								<input type="text" name="fio" id="fio" size="30" placeholder="ФИО" required>
								<br><br>
								<input type="text" name="gorod" id="gorod" size="30" placeholder="Город" required>
								<br><br>
								<input type="text" name="tel" id="tel" size="11" placeholder="Телефон" value="+7" required>
								<br><br>
								<input type="text" name="address" id="address" size="30" placeholder="Адрес" required>
								<br><br>
								<input type="text" name="email" id="email" size="30" placeholder="E-mail" required>
								<br><br>
								<input class="butorderform" type="submit" name="submit" id="submit" value="Оформить">
							</form>
						  </div>';
				}
				if ($_GET['act']=='zaktrue') {
					echo '<div style="padding:3%;">
							<div id="orderform">
								Ваш заказ поступил на сервер. В ближайшее время с Вами свяжется наш сотрудник для подтверждения заказа. 
							</div>
						  </div>';
				}
				if ($cart!=""){
					$cartCount=count($cartArr);
					$cartTotalPrice=0;
					foreach ($cartArr as $k => $v) {
						$result=mysql_query("select * from books where id='$v'");
						$row=mysql_fetch_array($result);
						$number=$k+1;
						echo '<div class="cartrow">
								<div class="cartpodimg">
									<img class="cartimg" src="'.$row['img'].'">
								</div>
								<div class="cartpodtitle">
									<div class="cartname">'.$row['name'].'</div>
									<div class="cartavtor">'.$row['avtor'].'</div>
								</div>
								<div class="cartcena">'.$row['cena'].' ₽</div>
							  </div>';
						$cartTotalPrice=$cartTotalPrice+$row['cena'];
					}
				}else{
					echo '<div style="text-align: center;padding: 2%;">Ваша корзина пуста</div>';
				}
				?>
			</div>
		</main><section class="bokblock">
			<div class="infpodcennik">
				<div class="cena" style="font-size: 24px;">Итого: <? if ($cartTotalPrice) {echo $cartTotalPrice;}else{echo "0";} ?> ₽</div>
				<div class="infbutbuy" style="position: relative;text-align: center;" <? echo 'onclick="window.location.href=\'korzina?act=orderform\'"'; ?>>Оформить заказ</div>
				<div class="clearkorz" onclick="window.location.href='korzina?act=clear'">Очистить корзину</div>
			</div>
		</section>
	</section>
	<?
	include 'include/site-footer.php';
	?>
</body>
</html>