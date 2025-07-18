<?php
$con=mysqli_connect('localhost','root','root','imavto') or die("MySQL Connection Failed");

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
	$result=mysqli_query($con,"select * from products");
	$content="";
		$row=mysqli_fetch_array($result);
		$content=$content."<br>".$row['price']." руб.<br><br>
		<a href=\"index.php?addtocart=".$row['id']."\">Положить в корзину</a><br><br>";
	return $content;
}
?>
<html>
<head>
	<title>Интернет-магазин автозапчастей</title>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
</head>
<body align="center">
	<h1>АВТОЗАПЧАСТИ</h1>
	<hr>
	<?
echo "Кол-во товаров в карзине: ".$cartCount."шт.<br><br><br>";
echo "<a href=\"index.php?clear=1\">Очистить корзину</a> <br><br>","<a href=\"cart.php\">Перейти в корзину</a><br>";
?>
	<hr>
	<br><br>
	<?
	$result=mysqli_query($con,"SELECT * FROM products");
		echo "<center>Товар в ассортименте:</center><br>";
		echo '<table border=1px>';
			echo "<tr>";
			echo "<td>Изображение</td>";
			echo "<td>Название товара</td>";
			echo "<td>Категория</td>";
			echo "<td>Цена</td>";
			echo "<td>Действие</td>";
			echo "</tr>";
		while ($row=mysqli_fetch_array($result)) {
		echo "<tr>";
		echo '<td><img src="'.$row['img'].'"></td>';
		echo "<td>". $row['name']."</td>";
		echo "<td>". $row['kateg']."</td>";
		echo "<td>". $row['price']."</td>";
		echo "<td><a href=\"index.php?addtocart=".$row['id']."\">Положить в корзину</a></td>";
		echo "</tr>";
		}
		echo "</table>";
	?>
</body>
</html>