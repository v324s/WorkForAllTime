<?php
header('content-type: text/html; charset= utf-8');
$con=mysqli_connect('localhost','root','root','imavto') or die("msql con f");

echo "<a href=\"adminka.php?orders=en\">История заказов</a> <br><br>";

if ($_GET['orders']) {
	$resp=mysqli_query($con,"SELECT * from orders");
	$content="";
	for ($i; $i<mysqli_num_rows($resp); $i++) {
		$rowp=mysqli_fetch_array($resp);
		$content=$content.'<hr width="500px"><br><br><strong>'.$rowp['fio'].'</strong><br>Дата оформления заказа: '.$rowp['date'].'<br>Заказ №'.$rowp['id'].'<br>'.$rowp['tel'].'<br>'.$rowp['email'].'<br><strong>Заказ: </strong><br>';
		$cart=$rowp['cart'];
		$cartArr=explode("|",$cart);
		if ($cart!="") {
			foreach ($cartArr as $k => $v) {
				$result=mysqli_query($con,"SELECT * from products where id='$v'");
				$row=mysqli_fetch_array($result);
				$number=$k+1;
				$content=$content.$number." - ".$row['name']." - ".$row['price']." руб.<br>";
			}
		}
	}
	return $content;
}

?>