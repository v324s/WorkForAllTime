<?
include "include/settings.php";				// подключаем файл PHP
session_start();							// старутем сессию

if ($_POST['restest']) {
	$restest=$_POST['restest'];
	mysql_query("UPDATE users set test='$restest' where id='$clgn'");// берем данные из таблицы users где email равен введенному логину
}
?>