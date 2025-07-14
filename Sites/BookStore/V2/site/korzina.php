<?
	session_start();
	include 'include/settings.php';
	include 'include/cart.php';
	if (isset($_SESSION['user_id'])) {
		$uid = $_SESSION['user_id'];
	}

	
	if ($_GET['act']=='clear') {
		// setcookie('cart','');
		cartClear();
		header('Location: korzina');
	}
	if ($_GET['act']=='orderform' && $cartCount>0) {
		$orderform=true;
	}else{
		$orderform=false;
	}
	if ($_POST['formOrder'] && $_POST['gorod'] && $_POST['address']) {
		$gorod = $_POST['gorod'];
		$address = $_POST['address'];
		$time = time();

		$cartTotalPrice=0;
		foreach ($cart as $k => $v) {
			$result=mysqli_query($conn,"select * from books where id='$v'");
			$row=mysqli_fetch_array($result);
			$cartTotalPrice+=$row['cena'];
		}
		
		$jsonCart = json_encode($cart);
		$q=mysqli_query($conn,"INSERT INTO zakazi(`time`, `uid`, `gorod`, `address`, `cart`, `price`) values('$time','$uid','$gorod','$address','$jsonCart','$cartTotalPrice')");
		if ($q) {
			cartClear();
			header('Location: korzina?act=zaktrue');
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Dream Library | Корзина</title>
	<link rel="stylesheet" type="text/css" href="css/main.css">
</head>
<body>
	<?
	include 'include/site-header.php';
	?>
	<section style="position: relative;">
		<section class="bokblock">
		</section><main class="osnovcontent">
			<div class="osnovapodbooks">
				<?
				if ($orderform) {
					echo '<div class="namepage">Оформление заказа</div>';
				}elseif (!$_GET['get']){
					echo '<div class="namepage">Корзина</div>';
				}elseif ($_GET['get'] == 'favorite'){
					echo '<div class="namepage">Список желаемого</div>';
				}elseif ($_GET['get'] == 'history'){
					echo '<div class="namepage">История заказов</div>';
				}

				if ($_GET['get'] != 'history'){
				?>
				<div class="dlyafiltra">
					<div>
						
					</div>
					<?
						if (!$_GET['get']){
							?>
							<div style="display: inline-block;">В корзине <b><? if ($cartCount){ echo $cartCount;}else{echo "0";} ?></b> товаров(-а)</div>
							<?
						}elseif ($_GET['get'] == 'favorite') {
							?>
							<div style="display: inline-block;">В избранном <b><? if ($favoritesCount){ echo $favoritesCount;}else{echo "0";} ?></b> товаров(-а)</div>
							<?
						}
					?>
						
				</div>
				<?
				}
				if ($orderform) {
					$res=mysqli_query($conn,"SELECT * from users WHERE `id`='".$uid."'");
					$acc = mysqli_fetch_assoc($res);
					?>
						<div style="padding:3%;padding-top:0;">
							<center><h3>Адрес доставки</h3></center>
							<form id="orderform" name="orderform" method="post" action="korzina.php">
								<input type="text" name="gorod" id="gorod" size="30" placeholder="Город" value="<?php echo $acc['gorod']; ?>" style="width: 96%; border: none;display: block;font-size: 1.2rem;padding: 2%;border-bottom: 0.1rem solid #11bfff;" required>
								<br>
								<input type="text" name="address" id="address" size="30" placeholder="Адрес"  value="<?php echo $acc['address']; ?>" style="width: 96%; border: none;display: block;font-size: 1.2rem;padding: 2%;border-bottom: 0.1rem solid #11bfff;" required>
								<br>
								<input type="submit" name="formOrder" id="submit" style="position: relative;text-align: center;background: linear-gradient(229deg, #09bfff, #f0beff);padding: 1rem;color: white;width: 100%;border: none;letter-spacing: 2px;font-size: 20px;font-weight: 500;border-radius: 10px;" value="Оформить">
							</form>
						</div>
					<?
				}
				if ($_GET['act']=='zaktrue') {
					?>
						<div style="padding:3%;">
							<div id="orderform">
								Ваш заказ поступил на сервер. В ближайшее время с Вами свяжется наш сотрудник для подтверждения заказа. 
							</div>
						</div>
					<?
				}
				if (!$_GET['get']) {
					if (is_array($cart) && count($cart)>0){
						$cartTotalPrice=0;
						foreach ($cart as $k => $v) {
							$result=mysqli_query($conn,"select * from books where id='$v'");
							$row=mysqli_fetch_array($result);
							$number=$k+1;
							$cartTotalPrice=$cartTotalPrice+$row['cena'];
							?>
							<div class="blockbook">
								<div>
									<a href="inf?book=<? echo $row['id']; ?>">
									<div class="imgbook" style="background-image:url('<? echo $row["img"];?>');">
									</div>
									<div class="infabook">
										<div class="namebook" style="color:black;"><? echo $row["name"];?>
										</div>
										<div class="avtorbook"><? echo $row["avtor"];?>
										</div>
									</div>
									</a>
									<div class="podcenandbut">
										<div class="podcenu">
											<div class="cena"><? echo $row["cena"];?> ₽</div>
										</div>
										<div>
											<div class="butfav" onclick="window.location.href='?removefromcart=<? echo $k;?>'">Удалить</div>
										</div>
									</div>
								</div>
							  </div>
							<?
						}
					}else{
						echo '<div style="text-align: center;padding: 2%;">Ваша корзина пуста</div>';
					}
				}elseif ($_GET['get'] == 'favorite') {
					if (is_array($favorites) && count($favorites)>0){
						$cartTotalPrice=0;
						foreach ($favorites as $k => $v) {
							$result=mysqli_query($conn,"select * from books where id='$v'");
							$row=mysqli_fetch_array($result);
							$number=$k+1;
							$cartTotalPrice=$cartTotalPrice+$row['cena'];
							?>
							<div class="blockbook">
								<div>
									<a href="inf?book=<? echo $row['id']; ?>">
									<div class="imgbook" style="background-image:url('<? echo $row["img"];?>');">
									</div>
									<div class="infabook">
										<div class="namebook" style="color:black;"><? echo $row["name"];?>
										</div>
										<div class="avtorbook"><? echo $row["avtor"];?>
										</div>
									</div>
									</a>
									<div class="podcenandbut" style="padding: 0.3rem;">
										<div class="podcenu" style="margin: 0 auto;">
											<div class="cena"><? echo $row["cena"];?> ₽</div>
										</div>
									</div>
									<div style="position: relative;overflow: hidden;">
										<div class="butbuy" onclick="window.location.href='?addtocart=<? echo $v;?>'" style="width: 90%;text-align: center;padding: 5%; margin-top: 0.3rem;">Купить</div>
										<div class="butfav" onclick="window.location.href='?removefromfav=<? echo $k;?>'" style="width: 90%;text-align: center;padding: 5%; margin-top: 0.3rem;">Удалить</div>
									</div>
								</div>
							  </div>
							<?
						}
					}else{
						echo '<div style="text-align: center;padding: 2%;">Список желаемого пуст</div>';
					}
				}elseif ($_GET['get'] == 'history') {
					$zakazi = mysqli_query($conn, "SELECT * FROM `zakazi` WHERE `uid`='$uid' ORDER BY `id` DESC");
					if (mysqli_num_rows($zakazi)>0){
						for ($i=0; $i < mysqli_num_rows($zakazi) ; $i++) { 
							$history = mysqli_fetch_assoc($zakazi);
							?>
								<div class="dlyafiltra">
									<div>
										<p><b><? echo date("d.m.Y",$history['time']); ?></b></p>
									</div>
									<div>
										<p style="color: #36beff;"><b><? echo $history['price']; ?> ₽</b></p>
									</div>
								</div>
							<?

							$historyBooks=json_decode($history['cart']);
							foreach ($historyBooks as $k => $v) {
								$result=mysqli_query($conn,"select * from books where id='$v'");
								$row=mysqli_fetch_array($result);
								?>
								<div class="blockbook">
									<div>
										<a href="inf?book=<? echo $row['id']; ?>">
										<div class="imgbook" style="background-image:url('<? echo $row["img"];?>');">
										</div>
										<div class="infabook">
											<div class="namebook" style="color:black;"><? echo $row["name"];?>
											</div>
											<div class="avtorbook"><? echo $row["avtor"];?>
											</div>
										</div>
										</a>
									</div>
								</div>
								<?
							}
						}


						
					}else{
						echo '<div style="text-align: center;padding: 2%;">Вы еще ничего не заказывали</div>';
					}
				}
				?>
			</div>
		</main>
		<?
		if (!$_GET['get'] && isset($uid) && $cartCount>0){
			?>
			<section class="bokblock">
				<div class="infpodcennik">
					<div class="cena" style="font-size: 24px;">Итого: <? if ($cartTotalPrice) {echo $cartTotalPrice;}else{echo "0";} ?> ₽</div>
					<div class="infbutbuy" style="position: relative;text-align: center;" <? echo 'onclick="window.location.href=\'korzina?act=orderform\'"'; ?>>Оформить заказ</div>
					<div class="clearkorz" onclick="window.location.href='korzina?act=clear'">Очистить корзину</div>
				</div>
			</section>
			<?
		}
		?>
	</section>
	<?
	include 'include/site-footer.php';
	?>
</body>
</html>
