<?
header('content-type: text/html; charset= utf-8');

$host='127.0.0.1'; 		// localhost
$bdlogin='root'; 		// Логин к базе данеых
$bdpass='root';			// Пароль к базе данных
$bdname='kinotea';	// Имя базы данных
$adminlog='admin';			// логин к админке
$adminpass='admin';			// пароль к админке

$con=mysqli_connect($host,$bdlogin,$bdpass,$bdname) or die();

?>