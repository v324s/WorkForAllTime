<?
include "include/settings.php";				//подключаем ПХП файл

if ($_POST['name'] && $_POST['famil'] && $_POST['email'] && $_POST['tel'] && $_POST['pass1'] && $_POST['pass2']) { 		// если приняты даннеые
	$regname=$_POST['name'];						// помещаем в переменную данные
	$regfamil=$_POST['famil'];						// помещаем в переменную данные
	$regemail=$_POST['email'];						// помещаем в переменную данные
	$regtel=$_POST['tel'];							// помещаем в переменную данные
	$regpass1=$_POST['pass1'];						// помещаем в переменную данные
	$regpass2=$_POST['pass2'];						// помещаем в переменную данные
	$nachtest=-1;									// помещаем в переменную данные
	if ($regpass1==$regpass2) {						// если пароль совпадаем с паролем подтверждения
		$res=mysql_query("SELECT * FROM users WHERE email='$regemail'");		// берем данные в таблице  users где email равен с введенным емайлом 
		$skoknum=mysql_num_rows($res);											// берем колво строк запроса (1=нашлась 1 строка,0 нет резальтатов)
		if ($skoknum>0) {														// если нашлась одна строка
			$erroremail='Такой e-mail уже используется другим аккаунтом.';		// указываем ошибку
		}else{						
			$res=mysql_query("SELECT * FROM users WHERE tel='$regtel'");		// берем данные в таблице  users где телефон равен с введенным телефон 
			$skoknum=mysql_num_rows($res);										// берем колво строк запроса (1=нашлась 1 строка,0 нет резальтатов)
			if ($skoknum>0) {													// если нашлась одна строка
				$errortel='Такой телефон уже используется другим аккаунтом.';	// указываем ошибку
			}else{
				mysql_query("INSERT into users(name,famil,email,tel,pass,test) values ('$regname','$regfamil','$regemail','$regtel','$regpass1','$nachtest')");		//заполняем таблицу новыми данными
				$resultslog='Вы успешно зарегистрированы.';			// пишем текст в переменную, что пользователь зарегистрирован
			}
		}
	}else{
		$erroremail='Введенные пароли не совпадают.';				// указываем текст ошибки
	}
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="initial-scale=1.0, width=device-width">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="js/jquery.mask.js">
    </script>
    <link rel="stylesheet" type="text/css" href="css/style.css?v=1">
    <title>ЭУП - Математика || Регистрация</title>
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
				<div id="titlezag" style="width:80%; margin: 0 auto;"><div style="margin-top: 15px;">РЕГИСТРАЦИЯ</div></div>
			</div>
			<?
				include "include/soderzh.php";
			?>
			<div class="titlee">
				<?
				if ($resultslog) {				//если есть положительный результат регистрации
					echo $resultslog.'<br><br>';//выводим текст результата
				}
				if ($errortel) {				// если есть ошибки
					echo $errortel.'<br><br>';	// выводим текст ошибки
				}
				if ($erroremail) {				// если есть ошибки
					echo $erroremail.'<br><br>';// выводим текст ошибки
				}
				?>
				<form action="register" method="post">
					<input type="text" class="inputtext" name="name" placeholder="Имя"><br>
					<input type="text" class="inputtext" name="famil" placeholder="Фамилия"><br>
					<input type="email" class="inputtext" name="email" placeholder="E-mail"><br>
					<input type="password" class="inputtext" name="pass1" placeholder="Пароль"><br>
					<input type="password" class="inputtext" name="pass2" placeholder="Повторите пароль"><br>
					<input type="text" class="inputtext" name="tel" id="tel" placeholder=""><br>
					<input type="submit" class="butreg" name="goregister" value="Зарегистрироваться">
				</form>
			</div>
		</section>
	</div>
	<footer>
		Корчагин Виталий - 2019 - Димитровград.
	</footer>
	<script type="text/javascript">
		$(function($) { 
		$('#tel').mask('+7 (999) 999-99-99',{placeholder: '+7 (___) ___-__-__'});
		
	});
	</script>
	<script type="text/javascript" src="js/pagescripts.js?v=1"></script>
	<script type="text/javascript" src="js/screenwid.js?v=2"></script>
</body>
</html>