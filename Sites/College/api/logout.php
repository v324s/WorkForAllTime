<?
include "../include/settings.php";
session_start();

if ($_POST['action']=='logout') {
	$_SESSION[$_COOKIE['log']]='';
	setcookie('log','',time()-86400,'/');
	setcookie('pas','',time()-86400,'/');
	session_destroy();
	echo "ok";
}
?>