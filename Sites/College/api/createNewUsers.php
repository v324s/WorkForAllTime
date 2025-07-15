<?
include "../include/settings.php";
include "../include/adm_settings.php";

if ($_POST['login'] && $_POST['password'] && $_POST['familiya'] && $_POST['imya'] && $_POST['otch'] && $_POST['permission']) {
	$rd=date('d.m.Y');
	$rt=date('H:i');
	$querry='INSERT INTO users SET login="'.$_POST['login'].'", password="'.$_POST['password'].'", user_familiya="'.$_POST['familiya'].'", user_imya="'.$_POST['imya'].'", user_otch="'.$_POST['otch'].'", reg_date="'.$rd.'", reg_time="'.$rt.'", permission='.$_POST['permission'];
	$h=mysqli_query($db,$querry);
	echo "Пользователь успешно создан";
}
?>