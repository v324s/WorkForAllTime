<?
include "include/settings.php";				// подключаем ПХП файл


	
	
if ($_POST['name'] && $_POST['email'] && $_POST['msg']) {		//если приняты данные
	$name = $_POST['name'];										// заполняем переменную данными
	$email = $_POST['email'];									// заполняем переменную данными
	$msg = $_POST['msg'];										// заполняем переменную данными
	$iduser = $_POST['iduser'];									// заполняем переменную данными
	$ttry=mysql_query("INSERT into svyaz (iduser,name,email,message) values ('$iduser','$name','$email','$msg')");		//заполняем таблицу данными
	if ($ttry) {								// если запрос прошел успешно
		$itogpost='Сообщение отправлено.';		// пишем текст итога
	}
}else{
	$errorpost='Нужно заполнить все поля.';		//пишем текст ошибки
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="initial-scale=1.0, width=device-width"> 
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.10/jquery.mask.js">
    </script>
     <link rel="stylesheet" type="text/css" href="css/style.css?v=1">
    <title>ЭУП - Математика || Обратная связь</title>
</head>
<body>
	<header>
		<div class="logo" onclick="window.location.href='index';"></div>
		<?
		$id = $_COOKIE['lgn'];											// заносим данные из кук в переменную
		$pass = $_COOKIE['psw'];										// заносим данные из кук в переменную
		if (isset($_COOKIE['lgn']) && isset($_COOKIE['psw'])) {			// если есть куки логина и ключа пользователя
			$res=mysql_query("SELECT * FROM users where id='$id'");		// делаем запрос в БД к таблице users где id пользователя равен id авторизированного пользователя
			$user=mysql_fetch_array($res);								// помещаем данные в массив
			echo '<div class="formact"><div class="actvh">'.$user['name'].' '.$user['famil'].'</div><a href="index?log=out"><div class="actreg">Выйти</div></a></div>';				     // если все успешно,выводим данные о пользователе 
		}else{															// если нет, то предлагаем войти или зарегистрироваться
		echo '
		<div class="formact">
			<a href="login"><div class="actvh">Войти</div></a>
			<a href="register"><div class="actreg">Регистрация</div></a>
		</div>';}
		?>
	</header>
	<div class="edin">
		<?
		include "include/mobmenu.php"; // подключаем файл ПХП
		include "include/mimenu.php";  // подключаем файл ПХП
		?>
		<section class="soderzh" id="glavnaya">
			<div class="zagolovok">
				<div class="menumini" id="openmenu"></div>
				<div id="titlezag" style="width:80%; margin: 0 auto;"><div style="margin-top: 15px;">Обратная связь</div></div>
			</div>
			<?
				include "include/soderzh.php";
			?>
			<div class="titlee">
				<?
				if ($errorpost) {					//если есть ошибка
					echo $errorpost.'<br><br>';		//выводим текст ошибки
				}
				if ($itogpost) {					//если есть итог
					echo $itogpost.'<br><br>';		//выводим текст итога
				}
				?>
				<form action="svyaz" method="post">
					<input type="text" class="inputtext" placeholder="Имя" name="name"><br>
					<input type="email" class="inputtext" name="email" placeholder="E-mail"><br>
					<textarea class="inputtext" placeholder="Сообщение" style="height: 70px;" name="msg"></textarea>
					<? echo '<input type="hidden" name="iduser" value="'.$_COOKIE['lgn'].'">'; ?>
					<input type="submit" class="butreg" name="gologin" value="Отправить">
				</form>
			</div>
		</section>
	</div>
	<footer>
		Корчагин Виталий - 2019 - Димитровград.
	</footer>
	<script type="text/javascript" src="js/pagescripts.js?v=1"></script>
<script type="text/javascript" src="js/screenwid.js?v=2"></script>
</body>
</html>