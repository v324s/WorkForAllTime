<?
include "../include/settings.php";
include "../include/adm_settings.php";
session_start();

if ($_GET['dir']){
	$dirs=scandir($_GET['dir']);
	print_r($dirs);
}
?>