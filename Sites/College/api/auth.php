<?
include "../include/settings.php";
session_start();

if ($_POST['login'] && $_POST['pass']) {
	$login=$_POST['login'];
	$pass=$_POST['pass'];
	$querry='SELECT * FROM users WHERE login="'.$login.'"';
	$q=mysqli_query($db,$querry);
	if (mysqli_num_rows($q)>0) {
		$arr=mysqli_fetch_array($q);
		if ($arr['password']==$pass) {
			session_regenerate_id();
			setcookie("log",$login,time()+7200,'/');
			setcookie("pas",md5($pass),time()+7200,'/');
			$_SESSION[$login]=md5($pass);
			echo "ok";
		}else{
			echo "Неверный пароль";
		}
	}else{
		echo "Пользователь с данным логином не найден.";
	}
}
?>