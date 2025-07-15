<?
include "../include/settings.php";
include "../include/adm_settings.php";

if ($_POST['id']) {

$querry='SELECT * FROM users WHERE id='.$_POST['id'];
$h=mysqli_query($db,$querry);
$arr=mysqli_fetch_array($h);
echo "            id - ".$arr['id']."
     Логин - ".$arr['login']."
Фамилия - ".$arr['user_familiya']."
        Имя - ".$arr['user_imya']."
Отчество - ".$arr['user_otch']."
     Права - ".$arr['permission'];

}
?>