<?
include "../include/settings.php";
include "../include/adm_settings.php";

if ($_POST['familiya'] && $_POST['imya'] && $_POST['otch'] &&  $_POST['dolzh'] && $_POST['tel'] && $_POST['email'] && $_POST['class']) {
	$querry='INSERT INTO sveden_structure SET role="'.$_POST['class'].'", familiya="'.$_POST['familiya'].'", imya="'.$_POST['imya'].'", otch="'.$_POST['otch'].'", dolzhnost="'.$_POST['dolzh'].'", tel="'.$_POST['tel'].'", email="'.$_POST['email'].'", photo="'.$_POST['src_img'].'"';
	$h=mysqli_query($db,$querry);
	echo "Человек добавлен";
}
?>