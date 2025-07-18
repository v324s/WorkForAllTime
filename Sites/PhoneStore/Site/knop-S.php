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
echo "<a href=\"knop-S.php?clear=1\">Очистить корзину</a> <br><br>","<a href=\"cart.php\">Перейти в корзину</a><br><br>";
?>
	</div>
	<div class="soder">
		<h1>КНОПОЧНЫЕ ТЕЛЕФОНЫ</h1>
		<hr width="500px" color=#00fadf>
					Страница<br>
					<a href="knop-S.php">1</a>
					<hr width="100px" color=#00fadf>
					<br>
						<div class="news-s">
						<a href="k1.php" class="NewsGLAV-s""><img src="k1.jpg" class="NewsIMG-s"></a>
						<a href="k1.php" class="NewsGLAV-s"><b>Nokia 3310 (2017)</b></a>
						<p class="NewsPROCH-s">телефон<br>
экран 2.4", разрешение 320x240<br>
камера 2 МП<br>
память 16 Мб, слот для карты памяти</p>
						</div>
						<div class="news-s">
						<a href="k2.php" class="NewsGLAV-s"><img src="k2.jpg" class="NewsIMG-s"></a>
						<a href="k2.php" class="NewsGLAV-s"><b>Philips Xenium E570</b></a>
						<p class="NewsPROCH-s">телефон<br>
поддержка двух SIM-карт<br>
экран 2.8", разрешение 320x240<br>
камера</p>
						</div>
						<div class="news-s">
						<a href="k3.php" class="NewsGLAV-s"><img src="k3.jpg" class="NewsIMG-s"></a>
						<a href="k3.php" class="NewsGLAV-s"><b>KENEKSI X9</b></a>
						<p class="NewsPROCH-s">телефон<br>
    поддержка двух SIM-карт<br>
    экран 2.8", разрешение 320x240<br>
    камера 1.30 МП<br>
    слот для карты памяти</p>
						</div>
						<div class="news-s">
						<a href="k4.php" class="NewsGLAV-s"><img src="k4.jpg" class="NewsIMG-s"></a>
						<a href="k4.php" class="NewsGLAV-s"><b>Alcatel 2051D</b></a>
						<p class="NewsPROCH-s">телефон с раскладным корпусом<br>
    поддержка двух SIM-карт<br>
    экран 2.4", разрешение 320x240<br>
    камера 2 МП<br>
    слот для карты памяти</p>
						</div>
<div class="news-s">
<a href="k5.php" class="NewsGLAV-s"><img src="k5.jpg" class="NewsIMG-s"></a>
<a href="k5.php" class="NewsGLAV-s"><b>Fly TS112</b></a>
<p class="NewsPROCH-s">телефон<br>
    поддержка трех SIM-карт<br>
    экран 2.8", разрешение 320x240<br>
    камера 1.30 МП<br>
    память 32 Мб, слот для карты памяти</p>
</div>
			<hr width="100px" color=#00fadf>
			Страница<br>
			<a href="knop-S.php">1</a>
			<hr width="100px" color=#00fadf>
</div>
	</div>
	<div class="podval">
		<p class="podvala">© 2016-2017 «П-21»</p>
		<p class="podvala">Гусев Владислав</p>		
	</div>
	</div>
</body>
</html>