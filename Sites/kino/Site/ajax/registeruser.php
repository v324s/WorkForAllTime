<?
include('../include/settings.php');

if ($_POST['name'] && $_POST['famil'] && $_POST['otch'] && $_POST['login'] && $_POST['email'] && $_POST['tel'] && $_POST['pass']) {
	$name=$_POST['name'];
	$fam=$_POST['famil'];
	$otch=$_POST['otch'];
	$log=$_POST['login'];
	$email=$_POST['email'];
	$tel=$_POST['tel'];
	$pass=$_POST['pass'];
	$regdate=date('d.m.Y');
		$time=date('H')+1;
		$tim=date('i:s');
	$regtime=$time.':'.$tim;
	$status='active';
	$skokmoney='150';
	mysqli_query($con,"INSERT into userskinotea(name,famil,otch,email,tel,login,pass,regdate,regtime,status,skokmoney) values ('$name','$fam','$otch','$email','$tel','$log','$pass','$regdate','$regtime','$status','$skokmoney')");
	echo 'Вы успешно зарегистрированы.';
}

if ($_POST['chlogin']) {
	$chlogin=$_POST['chlogin'];
	$sym=strlen($chlogin);
	if ($sym>4) {
		$res=mysqli_query($con,"SELECT * from userskinotea where login='$chlogin'");
		if (mysqli_num_rows($res)==0) {
			echo 'Логин свободен.';
		}else{
			echo 'Логин занят.';
		}
	}else{
		echo 'Логин короткий.';
	}
}
if ($_POST['telephone']) {
	$tel=$_POST['telephone'];
	$sym=strlen($tel);
	$res=mysqli_query($con,"SELECT * from userskinotea where tel='$tel'");
	if (mysqli_num_rows($res)>0) {
		echo 'Аккаунт с таким номером телефона уже существует.';
	}
}
?>