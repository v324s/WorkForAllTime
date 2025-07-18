<?php session_start ();
header('content-type: text/html; charset= utf-8');
if (!$_SESSION['admin']) die ('<a href="admin.php">Нужно пройти авторизацию</a>');
$con=mysqli_connect("localhost","root","root","imt") or die("MySQL Connection Failed");
echo '<a href="vihod.php" align="right">Выйти из админ-панели</a><br><br><br><br>';

echo '<a href="index.php" target=_blank>На главную страницу сайта</a> <br><br>';
echo "<a href=\"adminka.php?swz=1\">История заказов</a> <br><br>";
echo "<a href=\"adminka.php?swt=1\">Просмотреть товар</a><br><br><br><br>";
?>
<?
	function zakazi() {
		global $con;
		$result1=mysqli_query($con,"SELECT * FROM orders");
		$num1=mysqli_num_rows($result1);
		echo "<center>Кол-во заказов - ".$num1."</center><br>";
		echo '<table align="center" border="2px"';
		echo "<tr>";
		echo "<td>Номер заказа</td>";
		echo "<td>Дата оформления</td>";
		echo "<td>ФИО</td>";
		echo "<td>Телефон</td>";
		echo "<td>E-mail</td>";
		echo "<td>Город</td>";
		echo "<td>Адрес</td>";
		echo "<td>Заказ</td>";
		echo "<td>Цена заказа</td>";
		echo "</tr>";
		for ($id=1; $id<=$num1; $id++) { 
			$row=mysqli_fetch_array(mysqli_query($con,"SELECT * FROM orders where id=$id")); 
			echo "<tr><td>".$row['id']."</td>";
			echo "<td>".$row['date']."</td>";
			echo "<td>".$row['FIO']."</td>";
			echo "<td>".$row['TEL']."</td>";
			echo "<td>".$row['Email']."</td>";
			echo "<td>".$row['Gorod']."</td>";
			echo "<td>".$row['Address']."</td>";
			echo "<td>".'<table border="1px">';
							$cart=$row['cart'];
							$cartArr=explode("|", $cart);
							$cartTotalPrice=0;
							if ($cart!="") {
											foreach ($cartArr as $k => $v) {
											$result1=mysqli_query($con,"SELECT * FROM products WHERE id=$v");
											$row=mysqli_fetch_array($result1);
											$number=$k+1;
											echo "<tr><td>".$number."</td><td>".'<a href="'.$row['link'].'" target="_blank">'."(".$row['section'].") ".$row['name'].'</a></td><td>'.$row['price']." py6.</td></tr>";
											$cartTotalPrice=$cartTotalPrice+$row['price'];
																		}
											}	
			echo '</table>'."</td><td>".$cartTotalPrice." py6.</td></tr>";
		}
	}

	if (@$_GET['swt']) {
		$result=mysqli_query($con,"SELECT * FROM products");
		$num=mysqli_num_rows($result);
		echo "<center>Кол-во товаров в таблице - ".$num."</center><br>";
		echo '<table align="center" border=2px>';
			echo "<tr>";
			echo "<td>id</td>";
			echo "<td>Название товара</td>";
			echo "<td>Секция</td>";
			echo "<td>Ссылка</td>";
			echo "<td>Изображение</td>";
			echo "<td>Цена</td>";
			echo "<td>Редактирование</td>";
			echo "</tr>";
		while ($stroka=mysqli_fetch_array($result)) {
		echo "<tr>";
		echo "<td>". $stroka['id']."</td>";
		echo "<td>". $stroka['name']."</td>";
		echo "<td>". $stroka['section']."</td>";
		echo "<td>". $stroka['link']."</td>";
		echo "<td>". $stroka['img']."</td>";
		echo "<td>". $stroka['price']."</td>";
		echo "<td><a href='edit_t.php?id=".$stroka['id']."'>Редактировать</a></td>";
		echo "</tr>";
		}
		echo "</table>";
	}
	if (@$_GET['swz']) {
		echo zakazi();
	}
?>