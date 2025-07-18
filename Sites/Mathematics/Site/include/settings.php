<?
header('content-type: text/html; charset= utf-8'); // назначаем кодировку

$host='127.0.0.1'; 		// localhost
$bdlogin='root'; 		// Логин к базе данеых
$bdpass='root';			// Пароль к базе данных
$bdname='matematika';	// Имя базы данных
$log='admin';			// логин к админке
$pass='admin';			// пароль к админке

$con=mysqli_connect($host,$bdlogin,$bdpass,$bdname) or die(); // подключаемся к базе данных

if ($_COOKIE['lgn'] && $_COOKIE['psw']) {
	$clgn=$_COOKIE['lgn'];
	$cpsw=$_COOKIE['psw'];
	$rsq=mysqli_query($con,"SELECT * from users where id='$clgn'");
	$autuser=mysqli_fetch_array($rsq);	
	if ($autuser['pass']==$cpsw) {
		$userloginulsya=true;
	}else{
		$userloginulsya=false;
	}
}
?>