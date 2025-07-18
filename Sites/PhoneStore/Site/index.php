<?php
$con=mysqli_connect("localhost","root","root","imt") or die("MySQL Connection Failed");
header('content-type: text/html; charset= utf-8');
function cartStatus() {
	$cart="";
	if (@$_COOKIE['cart']) { $cart=$_COOKIE['cart'];}
	if (@$_GET['addtocart']) {
		if (!@$_COOKIE['cart']) {
			$cart=$_GET['addtocart'];
		} else {
			$cart=$cart."|".$_GET['addtocart'];
		}
		setcookie("cart","$cart");
	}
	if (@$_GET['clear']) {
		setcookie("cart","");
		$cart="";
	}
	if ($cart=="") { $cartCount="0"; }
	else {
		$cartArr=explode("|",$cart);
		$cartCount=count($cartArr);
	}
	return $cartCount;
}
$cartCount=cartStatus();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Интернет-магазин телефонов</title>
	<link rel="icon" type="image/png" href="favicon.ico">
	<link rel="stylesheet" type="text/css" href="style.css">
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
</head>
<body link="#FFFFFF"; alink="#ff0000" vlink="#00dcfd">
<div class="perDiv">
	<div class="logo"><img src="mat/gns.png" align="middle"></div>
	<div class="posleShapka"></div>
	<div class="Lmenu"><img src="mat/menu.png">
				<ul type="square" style="text-align: left">
					<li style="list-style-image: url(mat/li/glav.png);"><a class="ul" href="index.php"><div class="menuspan">Главная</div></a></li>
					<li style="list-style-image: url(mat/li/knop.png);"><a class="ul" href="knop-S.php"><div class="menuspan">Кнопочные телефоны</div></a></li>
					<li style="list-style-image: url(mat/li/smart.png);"><a class="ul" href="smart-S.php"><div class="menuspan">Смартфоны</div></a></li>
				</ul>
	</div>
	<div class="Rmenu"><img src="mat/rekl.png">Корзина:<br>
<?
echo "Кол-во товаров в карзине: ".$cartCount."шт.<br><br><br>";
echo "<a href=\"index.php?clear=1\">Очистить корзину</a> <br><br>","<a href=\"cart.php\">Перейти в корзину</a><br><br>";
?>
	</div>
	<div class="soder">
		<h1>ГЛАВНАЯ</h1>
		<hr width="500px" color=#00fadf>
		<br>
		<div class="soderzh">Очень хороший интернет-магазин мобильных телефонов/смартфонов. Воспользуйтесь левым меню-навигацией.<div>
	</div><br><br><br><br><br><br><br>
	<div class="podval">
		<p class="podvala">© 2016-2017 «П-21»</p>
		<p class="podvala">Гусев Владислав Евгеньевич</p>		
	</div>
	</div>
</body>
</html>