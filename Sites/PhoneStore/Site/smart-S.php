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
echo "<a href=\"smart-S.php?clear=1\">Очистить корзину</a> <br><br>","<a href=\"cart.php\">Перейти в корзину</a><br><br>";
?>
	</div>
	<div class="soder">
		<h1>СМАРТФОНЫ</h1>
		<hr width="500px" color=#00fadf>
					Страница<br>
					<a href="smart-S.php">1</a>
					<hr width="100px" color=#00fadf>
					<br>
						<div class="news-s">
						<a href="s1.php" class="NewsGLAV-s""><img src="s1.jpg" class="NewsIMG-s"></a>
						<a href="s1.php" class="NewsGLAV-s"><b>Apple iPhone 7 Plus 128Gb</b></a>
						<p class="NewsPROCH-s">смартфон, iOS 10<br>
экран 5.5", разрешение 1920x1080<br>
камера 12 МП, автофокус, F/1.8<br>
память 128 Гб, без слота для карт памяти</p>
						</div>
						<div class="news-s">
						<a href="s2.php" class="NewsGLAV-s"><img src="s2.jpg" class="NewsIMG-s"></a>
						<a href="s2.php" class="NewsGLAV-s"><b>Microsoft Lumia 650</b></a>
						<p class="NewsPROCH-s">смартфон, MS Windows 10 Mobile<br>
    экран 5", разрешение 1280x720<br>
    камера 8 МП, автофокус, F/2.2<br>
    память 16 Гб, слот для карты памяти<br>
    3G, 4G LTE, Wi-Fi, Bluetooth, NFC, GPS, ГЛОНАСС</p>
						</div>
						<div class="news-s">
						<a href="s3.php" class="NewsGLAV-s"><img src="s3.jpg" class="NewsIMG-s"></a>
						<a href="s3.php" class="NewsGLAV-s"><b>Meizu M5 Note 32Gb</b></a>
						<p class="NewsPROCH-s">смартфон на платформе Android<br>
поддержка двух SIM-карт<br>
экран 5.5", разрешение 1920x1080<br>
камера 13 МП, автофокус, F/2.2</p>
						</div>
						<div class="news-s">
						<a href="s4.php" class="NewsGLAV-s"><img src="s4.jpg" class="NewsIMG-s"></a>
						<a href="s4.php" class="NewsGLAV-s"><b>LG X Power K220DS</b></a>
						<p class="NewsPROCH-s">смартфон, Android 6.0<br>
поддержка двух SIM-карт<br>
экран 5.3", разрешение 1280x720<br>
камера 13 МП, автофокус</p>
						</div>
<div class="news-s">
<a href="s5.php" class="NewsGLAV-s"><img src="s5.jpg" class="NewsIMG-s"></a>
<a href="s5.php" class="NewsGLAV-s"><b>Lenovo Vibe S1</b></a>
<p class="NewsPROCH-s">смартфон, Android 5.0<br>
поддержка двух SIM-карт<br>
экран 5", разрешение 1920x1080<br>
камера 13 МП, автофокус, F/2.2</p>
</div>
			<hr width="100px" color=#00fadf>
			Страница<br>
			<a href="smart-S.php">1</a>
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