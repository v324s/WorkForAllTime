<?
include "../include/settings.php";
include "../include/adm_settings.php";
session_start();

$querry='SELECT * FROM pages';
$h=mysqli_query($db,$querry);
echo mysqli_num_rows($h);
?>