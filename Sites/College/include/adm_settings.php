<?
session_start();
if ($_SESSION[$_COOKIE['log']]!=$_COOKIE['pas'] || isset($_COOKIE['log'])==false || isset($_COOKIE['pas'])==false) {
	exit("Нет доступа");
}
?>