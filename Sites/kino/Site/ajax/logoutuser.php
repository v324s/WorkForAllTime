<?
include('../include/settings.php');

session_start();
if ($_POST['loguot']=='true') {
	$idses=$_COOKIE['sesid'];
	session_destroy();
	setcookie('img','');
	setcookie('sesid','');
	setcookie('login','');
	setcookie('pass','');
}
?>