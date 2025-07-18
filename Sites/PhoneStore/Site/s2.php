<?

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

function catalogue() {
	global $con;
	$result=mysqli_query($con,"select * from products where id=2");
	$content="";
		$row=mysqli_fetch_array($result);
		$content=$content."<br>".$row['price']." руб.<br><br>
		<a href=\"s2.php?addtocart=".$row['id']."\">Положить в корзину</a><br><br>";
	return $content;
}
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
echo "<a href=\"s2.php?clear=1\">Очистить корзину</a> <br><br>","<a href=\"cart.php\">Перейти в корзину</a><br><br>";
?>
	</div>
	<div class="soder">
		<h1>Microsoft Lumia 650</h1>
		<hr width="500px" color=#00fadf>
		<br>
			<img class="imgknew" src="s2.jpg">
<?
echo catalogue();
?>
			<p class="PROCH">Коротко о товаре<br><br>
<ul style="text-align: left">
    <li>смартфон, MS Windows 10 Mobile
    <li>экран 5", разрешение 1280x720
    <li>камера 8 МП, автофокус, F/2.2
    <li>память 16 Гб, слот для карты памяти
    <li>3G, 4G LTE, Wi-Fi, Bluetooth, NFC, GPS, ГЛОНАСС
    <li>объем оперативной памяти 1 Гб
    <li>аккумулятор 2000 мА⋅ч
    <li>вес 122 г, ШxВxТ 70.90x142x6.90 мм
    </ul>

			</p>
	</div>
	<div class="podval">
		<p class="podvala">© 2016-2017 «П-21»</p>
		<p class="podvala">Гусев Владислав</p>		
	</div>
	</div>
</body>
</html>