<?
header('content-type: text/html; charset= utf-8'); // назначаем кодировку

$host='127.0.0.1'; 		// localhost
$bdlogin='db_login'; 		// Логин к базе данеых
$bdpass='db_pass';			// Пароль к базе данных
$bdname='db_name';	// Имя базы данных
$adminlog='admin';			// логин к админке
$adminpass='admin';			// пароль к админке

$conn = mysqli_connect($host,$bdlogin,$bdpass) or die(); // подключаемся к базе данных
mysqli_select_db($conn, $bdname) or die(); // выбираем базу данных
?>
