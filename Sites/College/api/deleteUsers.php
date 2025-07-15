<?
include "../include/settings.php";
include "../include/adm_settings.php";

if ($_POST['id']) {
	$querry='DELETE FROM users WHERE id="'.$_POST['id'].'"';
	$h=mysqli_query($db,$querry);
	echo "Пользователь успешно удален";
}
?>