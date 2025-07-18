<?
include "include/settings.php";	//подключаем пхп файл
session_start();				//начинаем сессию
?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="initial-scale=1.0, width=device-width">
    <script src="js/jquery.min.js"></script>     
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <title>ЭУП - Математика</title>
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
		include "include/mobmenu.php";
		include "include/mimenu.php";
		?>
		<section class="soderzh" id="glavnaya">
			<div class="zagolovok">
				<div class="menumini" id="openmenu"></div>
				<div id="titlezag" style="width:80%; margin: 0 auto;">
					Раздел 3. Дифференциальное исчисление
				</div>		
			</div>
			<?
				include "include/soderzh.php";
			?>
			<embed src="docs/3_razdel.pdf"></embed>
		</section>
	</div>
	<footer>
		Корчагин Виталий - 2019 - Димитровград.
	</footer>
	<script type="text/javascript" src="js/pagescripts.js?v=1"></script>
	<script type="text/javascript" src="js/screenwids.js?v=1"></script>
</body>
</html>