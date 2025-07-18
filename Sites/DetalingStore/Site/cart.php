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
function cart() {
	global $con;
	$cart="";
	if (@$_COOKIE['cart']) { $cart=$_COOKIE['cart'];}
	$cartArr=explode("|",$cart);
	if ($cart=="") {
		return "<h1>Корзина пуста</h1>";
	}
	else {
		$cartCount=count($cartArr);
		$cartTotalPrice=0;
		foreach ($cartArr as $k => $v) {
			$result=mysqli_query($con,"select * from products where id='$v'");
			$row=mysqli_fetch_array($result);
			$number=$k+1;
			$content=$content.'<img src="'.$row['img'].'"><h3>'.$row['name'].'</h3><h3>'.$row['price']." руб</h3></div>";
			$cartTotalPrice=$cartTotalPrice+$row['price'];
		}
		$content=$content."<br><br>".'<hr width="500px">'."<h1>Всего: ".$cartTotalPrice." руб.</h1>";
		$content=$content."<a href=\"orderform.php\">Оформить заказ</a>\n";
	}
	return $content;
}
$cartCount=cartStatus();
?>
<html>
<head>
	<title>Корзина</title>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
</head>
<body>
<?
echo cart();
?>
</body>
</html>