<?
include('include/settings.php');
include('include/guard.php');


if ($_POST['chpass']) {
	$chpass=$_POST['chpass'];
	$resk=mysqli_query($con,"SELECT * from userskinotea where id='$sess_id'");
	$userpass=mysqli_fetch_array($resk);
	if ($userpass['pass']==$chpass) {
		echo 'Пароль верный.';
	}else{
		echo 'Неверный пароль.';
	}
	
}

if ($_POST['npass1'] && $_POST['npass2']) {
	$npass1=$_POST['npass1'];
	$npass2=$_POST['npass2'];
	$sym=strlen($npass1);
	if ($sym>5) {
		if ($npass1==$npass2) {
			mysqli_query($con,"UPDATE userskinotea set pass='$npass1' where id='$sess_id'");
			setcookie('pass',$npass1);
			echo "Пароль успешно изменен.";
		}else{
			echo "Новые пароли не совпадают.";
		}
	}else{
		echo "Новый пароль слишком короткий.";
	}
}
?>