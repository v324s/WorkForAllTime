<?
include "include/settings.php";				// подключаем файл PHP
session_start();							// начинаем сессию
if ($_GET['log']=='out') {					// если приходит ГЕТ запрос на выход пользователя
	session_destroy();						// уничтожаем сессию
	setcookie("lgn","");					// чистим куки
	setcookie("psw","");					// чистим куки
	setcookie("PHPSESSID","");				// чистим куки
	header('Refresh: 0; URL=/index');		// отправляем на главную страницу
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="initial-scale=1.0, width=device-width"> 
    <script src="js/jquery.min.js"></script> 
    <link rel="stylesheet" type="text/css" href="css/style.css?v=1">
    <title>ЭУП - Математика</title>
    <style type="text/css">
    	#bg_popup{    background-color: rgba(0, 0, 0, 0.8);
    display: none;
    position: fixed;
    z-index: 99999;
    top: 0;
    right: 0;
    bottom: 0;
    left: 0;
}
	#popup{
		    background: #fff;
    width: 60%;
    margin: 15% auto;
    padding: 5px 20px 13px 20px;
    border: 2px solid #0061a6;
    position: relative;
    box-shadow: 0px 0px 20px #000;
	}
	.infoblocka{
		width: 80%;
    margin: 0 auto;
	}
	.gorab{
    margin: 0 auto;
    display: block;
    background-color: #01458c;
    cursor: pointer;
        padding: 20px;
    color: white;
    width: max-content;
	}
	.gorab:hover{
		background-color: #007EFF;
	}
    </style>
</head>
<body>
	<header>
		<script type="text/javascript">
			    var delay_popup = 0;
			    setTimeout("document.getElementById('bg_popup').style.display='block'", delay_popup);
			
		</script> 
				<div id="bg_popup">
							<div id="popup" style="text-align: center;">
								<div class="infoblocka">
								Министерство образования и науки Ульяновской области<br>
								Областное государственное бюджетное профессиональное образовательное учреждение<br>
								«Димитровградский технический колледж»<br>
								(ОГБПОУ «ДТК»)<br><br><br>
								<h1>Электронное учебное пособие по дисциплине "Математика"</h1>
								Преподаватели: Храмкова О.Ю., Силуянов А.А.<br>
								<br><br>
								<div class="gorab" onclick="document.getElementById('bg_popup').style.display='none'; return false;"><div class="rab">Начать работу</div></div>
								</div>
							</div>
				</div>  
		<div class="logo" onclick="window.location.href='index';"></div>
		<?
		$id = $_COOKIE['lgn'];										// заносим данные из кук в переменную
		$pass = $_COOKIE['psw'];									// заносим данные из кук в переменную
		if (isset($_COOKIE['lgn']) && isset($_COOKIE['psw'])) {		// если есть куки логина и ключа пользователя
			$res=mysqli_query($con,"SELECT * FROM users where id='$id'"); // делаем запрос в БД к таблице users где id пользователя равен id авторизированного пользователя
			$user=mysqli_fetch_array($res);							// помещаем данные в массив
			echo '<div class="formact"><div class="actvh">'.$user['name'].' '.$user['famil'].'</div><a href="index?log=out"><div class="actreg">Выйти</div></a></div>';				 // если все успешно,выводим данные о пользователе 
		}else{														// если нет, то предлагаем войти или зарегистрироваться
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
				<div id="titlezag" style="width:80%; margin: 0 auto;"><div style="margin-top: 15px;">ГЛАВНАЯ</div></div>
			</div>
			<?
				include "include/soderzh.php";
			?>
			<div class="titlee" id="embd">Учебное пособие по дисциплине "Математика". Краткий курс и тестовые задания.</div>
		</section>
	</div>
	<footer>
		Гусев Владислав - 2019 - Димитровград.
	</footer>
	<script type="text/javascript" src="js/pagescripts.js?v=1"></script>
	<script type="text/javascript" src="js/screenwid.js?v=2"></script>
</body>
</html>