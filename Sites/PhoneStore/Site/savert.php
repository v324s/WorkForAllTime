<?php session_start ();
header('content-type: text/html; charset= utf-8');
if (!$_SESSION['admin']) die ('<a href="admin.php">Нужно пройти авторизацию</a>');

$con=mysqli_connect("localhost","root","root","imt") or die("MySQL Connection Failed");
$q_update="UPDATE products SET name='".$_GET['nameNew']."', section='".$_GET['SectionNew']."', link='".$_GET['linkNew']."', price='".$_GET['priceNew']."' WHERE id=".$_GET['id'];
		mysqli_query($con,$q_update);
		if (mysqli_affected_rows()>0)
		{
		echo "Вы изменили запись.";
		}
		else
		{
		echo "ОШИБКА!";
		}
echo '<br><br><a href="adminka.php">Вернуться на главную</a>';
?>		