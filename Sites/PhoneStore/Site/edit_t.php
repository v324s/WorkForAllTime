<?php session_start ();
header('content-type: text/html; charset= utf-8');
if (!$_SESSION['admin']) die ('<a href="admin.php">Нужно пройти авторизацию</a>');
@mysql_connect("localhost","gusev","1") or die("msql con f");
@mysql_select_db("IMT") or die("Msql db sel f");
$result=mysql_query("SELECT * FROM products WHERE id=".$_GET['id']);
while ($row=mysql_fetch_array($result)) {
$id=$_GET['id'];
$section=$row['section'];
echo $section."\r\n";
$name=$row['name'];
echo $name."\r\n";
$link=$row['link'];
$img=$row['img'];
echo $img."\r\n";
$price=$row['price'];
echo " - ".$price."\r\n"." руб.";
}
?>
<html>
<head><title>Редактирование товара</title>
<meta http-equiv="content-type" content="text/html; charset=utf-8">
</head>
<body>
<form action="savert.php" method="get">
<table border="1">
<tr>
<td>Название</td>
<td><input name="nameNew" size="30" value="<? echo $name ?>"></td>
</tr>
<tr>
<td>Секция</td>
<td><input name="SectionNew" size="30" value="<? echo $section ?>"></td>
</tr>
<tr>
<td>Ссылка</td>
<td><input name="linkNew" size="30" value="<? echo $link ?>"></td>
</tr>
<tr>
<td>Цена</td>
<td><input name="priceNew" size="30" value="<? echo $price ?>"></td>
</tr>
</table>
<input type="hidden" name="id" value= "<?=$id?>"><br>
<input type="submit" name="button" value="Сохранить">
</form>
</body>
</html>