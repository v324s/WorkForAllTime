<?
include "include/settings.php"; 			// подключаем файл PHP


	
	
if ($_POST['login'] && $_POST['pass']) {							// если приняты переменные login и pass (Методом ПОСТ)
	$login = $_POST['login'];										// принятые данные login заносим в другую переменную
	$pass = $_POST['pass'];											// принятые данные pass заносим в другую переменную
	$result=mysqli_query($con,"select * from users where email='$login'");// берем данные из таблицы users где email равен введенному логину
	if (mysqli_num_rows($result)>0) {								// если результат запроса имеет строку (если 0 строк, то запрос не выполнен, если 1 то все ок), то...
		$user=mysqli_fetch_array($result);							// помещаем данные в массив
		if ($pass == $user['pass']){								// если принятые данные pass совпадают с паролем пользователяв БД
			session_start();										// начинаем сессию
			$id=$user['id'];										// объявляем переменную с ID пользователя
			$_SESSION[$id] = true;									
			$idses = session_id();									// помещаем в переменную id сессии
			setcookie("lgn","$id");									// создаем куки с id пользователя
			setcookie("psw","$pass");								// создаем куки с ключем пользователя
			header('Refresh: 0; URL=/index');						// перенаправляем пользователя на главную страницу
		}else{
			$itogpass = 'Пароль введен неверно.';					// текст ошибки
		}
	}else{
		$itoglog = 'E-mail введен неверно, либо аккаунта с данной почтой не существует.'; // текст ошибки
	}
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
    <title>ЭУП - Математика || Авторизация</title>
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
				<div id="titlezag" style="width:80%; margin: 0 auto;"><div style="margin-top: 15px;">ВХОД</div></div>
			</div>
			<?
				include "include/soderzh.php";
			?>
			<div class="titlee">
				<?
				if ($itoglog) {					// если есть ошибка
					echo $itoglog.'<br><br>';	// выводим текст ошибки
				}
				if ($itogpass) {				// если есть ошибка
					echo $itogpass.'<br><br>';	// выводим текст ошибки
				}
				?>
				<form action="login" method="post">
					<input type="email" class="inputtext" name="login" placeholder="E-mail"><br>
					<input type="password" class="inputtext" placeholder="Пароль" name="pass"><br>
					<input type="submit" class="butreg" name="gologin" value="Войти">
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