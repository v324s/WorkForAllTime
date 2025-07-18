<?
include('../include/settings.php');

if ($_POST['login'] && $_POST['pass']) {
	$login=$_POST['login'];
	$pass=$_POST['pass'];
	$res=mysqli_quer($con,"SELECT * from userskinotea where login='$login'");
		if (mysqli_num_rows($res)>0) {
			$res=mysqli_quer($con,"SELECT * from userskinotea where login='$login' and pass='$pass'");
			if (mysqli_num_rows($res)>0) {
				$zaloguser=mysqli_fetch_array($res);
				session_start($zaloguser['id']);
				setcookie('img',$zaloguser['img']);
				setcookie('simg',$zaloguser['simg']);
				setcookie('sesid',$zaloguser['id']);
				setcookie('login',$zaloguser['login']);
				setcookie('pass',$zaloguser['pass']);
				echo "Вы успешно авторизированы.";
			}else{
				echo "Неверный пароль.";
			}
		}else{
			echo 'Аккаунт с таким логином не найден.';
		}
}
?>