<?php
$con=mysqli_connect('localhost','root','root','imavto') or die("MySQL Connection Failed");
header('content-type: text/html; charset= utf-8');
function order() {
	$fio=@$_POST['fio'];
	$tel=@$_POST['tel'];
	$email=@$_POST['email'];
	$cart="";
	if (@$_COOKIE['cart']) { $cart=$_COOKIE['cart']; }
	$date=date("y-m-d");
	mysqli_query($con,"insert into orders(date, FIO, TEL, Email, cart) values('$date','$fio','$tel','$email','$cart')");
	return "Ваш заказ поступил на сервер.";
setcookie("cart","");
$cart="";
}
?>
<html>
<head>
	<title>Спасибо за заказ!</title>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
</head>
<body>
<?
echo order();
?>
<br><br>
<a href="index.php">На главную</a>
</body>
</html>