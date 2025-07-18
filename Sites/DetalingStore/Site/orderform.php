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
	$cart="";
	if (@$_COOKIE['cart']) { $cart=$_COOKIE['cart'];}
	$cartArr=explode("|",$cart);
	if ($cart=="") {
		return '<hr width="500px" color=#00fadf>'."<h1>Корзина пуста</h1>";
	}
	else {
		$cartCount=count($cartArr);
		$cartTotalPrice=0;
		foreach ($cartArr as $k => $v) {
			$result=mysqli_query($con,"select * from products where id='$v'");
			$row=mysqli_fetch_array($result);
			$number=$k+1;
			$content=$content.'<div class="news-s">'.$row['img'].'<h3>'.$row['name'].'</h3><br><br><h3>'.$row['price']." руб</h3></div>";
			$cartTotalPrice=$cartTotalPrice+$row['price'];
		}
		$content=$content."<br><br>".'<hr width="500px" color=#00fadf>'."<h1>Всего: ".$cartTotalPrice." руб.</h1>";
		$content=$content."<a href=\"orderform.php\">Оформить заказ</a>\n";
	}
	return $content;
}
$cartCount=cartStatus();
?>
<html>
<head>
     <title>Оформление заказа</title>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
</head>
<body>
<h1>ОФОРМЛЕНИЕ ЗАКАЗА</h1>
		<hr width="500px" color=#00fadf>
					<br>
<form id="orderform" name="orderform" method="post" action="order.php">
	<input type="text" name="fio" id="fio" size="30" placeholder="ФИО">
	<br><br>
	<input type="text" name="tel" id="tel" size="11" placeholder="Телефон" value="+7">
	<br><br>
	<input type="text" name="email" id="email" size="30" placeholder="E-mail">
	<br><br>
	<input type="submit" name="submit" id="submit" value="Оформить">
</form>
</body>
</html>