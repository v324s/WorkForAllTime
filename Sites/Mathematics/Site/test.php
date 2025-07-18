<?
include "include/settings.php";				// подключаем файл PHP
session_start();							// начинаем сессию
?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="initial-scale=1.0, width=device-width"> 
    <script src="js/jquery.min.js"></script> 
    <script src="js/simpletest1.js"></script>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <title>ЭУП - Математика</title>
    <style type="text/css">
    	.zavertest{
    		    margin: 0 auto;
    display: block;
    padding: 10px;
    border: none;
    background-color: #007eff;
    color: white;
    font-size: 19px;
    	}
    	.zavertest:hover{
    		cursor: pointer;
    	}
    </style>
</head>
<body>
	<header>
		<div class="logo" onclick="window.location.href='index';"></div>
		<?
		$id = $_COOKIE['lgn'];										// заносим данные из кук в переменную
		$pass = $_COOKIE['psw'];									// заносим данные из кук в переменную
		if (isset($_COOKIE['lgn']) && isset($_COOKIE['psw'])) {		// если есть куки логина и ключа пользователя
			$res=mysql_query("SELECT * FROM users where id='$id'"); // делаем запрос в БД к таблице users где id пользователя равен id авторизированного пользователя
			$user=mysql_fetch_array($res);							// помещаем данные в массив
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
		include "include/mobmenu.php";				// подключаем файл PHP
		include "include/mimenu.php";				// подключаем файл PHP
		?>
		<section class="soderzh" id="glavnaya">
			<div class="zagolovok">
				<div class="menumini" id="openmenu"></div>
				<div id="titlezag" style="width:80%; margin: 0 auto;">
					<div style="margin-top: 15px;">Тест</div>
				</div>
				<script type="text/javascript">
					function testzanovo() {
						$('.blktest').css('display','block');
						$('#viprohotest').css('display','none');
					}
				</script>
			</div>
			<?
				include "include/soderzh.php";		// подключаем файл PHP
			?>
			<div class="titlee" style="width: 95%; text-align: left;">
				<?
					if ($userloginulsya==true):
						if ($autuser['test']>-1) {
							echo '<style type="text/css">.test{display:none;}</style>';
							echo '<div id="viprohotest" style="background: #007eff;padding: 25px 0;text-align: center;color: white;font-size: 24px;"><div>Вы уже проходили тест<br><font style="font-size: 19px;">правильных ответов: '.$autuser['test'].' из 10</font></div><br><div onclick="testzanovo();" style="margin-top: 20px;font-size: 16px;">Пройти заново</div></div>';
						}
				?>
					<div class="test blktest" id="page7.simpletest" style="clear:both;">
<div class="question" style="padding-top: 10px; padding-bottom: 10px;" id="Q0">
<div style="clear:both;"><strong>1) К задуманному числу прибавили 7, полученное число разделили на 5, в результате получили
10. Найти задуманное число. </strong></div>
<input type="hidden" id="Q0_h" value="" />
<div style="width: 100px; text-align: left;">
<label><input class="button" id="submit_test" type="radio" onClick="I('Q0_h').value=this.value;" name="Q0-var" value="A0" /> а) 50</label><br />
<label><input class="button" id="submit_test" type="radio" onClick="I('Q0_h').value=this.value;" name="Q0-var" value="A1" /> б) 43</label><br />
<label><input class="button" id="submit_test" type="radio" onClick="I('Q0_h').value=this.value;" name="Q0-var" value="A2" /> в) 42</label><br />
</div>
</div><div class="question" style="padding-top: 10px; padding-bottom: 10px;" id="Q1">
<div style="clear:both;"><strong>2) Найти разность между наименьшим трехзначным числом, кратным 3 и наименьшим простым
двузначным числом.</strong></div>
<div style="width: 100px; text-align: left;">
<input type="hidden" id="Q1_h" value="" />
<label><input class="button" id="submit_test" type="radio" onClick="I('Q1_h').value=this.value;" name="Q1-var" value="A0" /> а) 88</label><br />
<label><input class="button" id="submit_test" type="radio" onClick="I('Q1_h').value=this.value;" name="Q1-var" value="A1" /> б) 988</label><br />
<label><input class="button" id="submit_test" type="radio" onClick="I('Q1_h').value=this.value;" name="Q1-var" value="A2" /> в) 91</label><br />
</div></div><div class="question" style="padding-top: 10px; padding-bottom: 10px;" id="Q2">
<div style="clear:both;"><strong>3) Какое целое число нужно умножить на дробь 6/7 , чтобы полученное число было больше 6, но
меньше 7 ?<br/></strong></div>
<div style="width: 100px; text-align: left;">
<input type="hidden" id="Q2_h" value="" />
<label><input class="button" id="submit_test" type="radio" onClick="I('Q2_h').value=this.value;" name="Q2-var" value="A0" /> а) 8</label><br />
<label><input class="button" id="submit_test" type="radio" onClick="I('Q2_h').value=this.value;" name="Q2-var" value="A1" /> б) 6</label><br />
<label><input class="button" id="submit_test" type="radio" onClick="I('Q2_h').value=this.value;" name="Q2-var" value="A2" /> в) 9</label><br />
</div></div><div class="question" style="padding-top: 10px; padding-bottom: 10px;" id="Q3">
<div style="clear:both;"><strong>4) Каким числом надо заменить m, чтобы число 3 было решением уравнения 5(m − x) = 2 − 6x<br/></strong></div>
<div style="width: 100px; text-align: left;">
<input type="hidden" id="Q3_h" value="" />
<label><input class="button" id="submit_test" type="radio" onClick="I('Q3_h').value=this.value;" name="Q3-var" value="A0" /> а) -6.1</label><br />
<label><input class="button" id="submit_test" type="radio" onClick="I('Q3_h').value=this.value;" name="Q3-var" value="A1" /> б) -0.2</label><br />
<label><input class="button" id="submit_test" type="radio" onClick="I('Q3_h').value=this.value;" name="Q3-var" value="A2" /> в) 3</label><br />
</div></div><div class="question" style="padding-top: 10px; padding-bottom: 10px;" id="Q4">
<div style="clear:both;"><strong>5) Найти сумму всех правильных дробей со знаменателем 7. </strong></div>
<div style="width: 100px; text-align: left;">
<input type="hidden" id="Q4_h" value="" />
<label><input class="button" id="submit_test" type="radio" onClick="I('Q4_h').value=this.value;" name="Q4-var" value="A0" /> а) 6</label><br />
<label><input class="button" id="submit_test" type="radio" onClick="I('Q4_h').value=this.value;" name="Q4-var" value="A1" /> б) 3.5</label><br />
<label><input class="button" id="submit_test" type="radio" onClick="I('Q4_h').value=this.value;" name="Q4-var" value="A2" /> в) 3</label><br />
</div></div><div class="question" style="padding-top: 10px; padding-bottom: 10px;" id="Q5">
<div style="clear:both;"><strong>6) Какое число надо приписать справа к числу 47, чтобы полученное четырехзначное число
делилось на 3? 
</strong></div>
<div style="width: 100px; text-align: left;">
<input type="hidden" id="Q5_h" value="" />
<label><input class="button" id="submit_test" type="radio" onClick="I('Q5_h').value=this.value;" name="Q5-var" value="A0" /> а) 83</label><br />
<label><input class="button" id="submit_test" type="radio" onClick="I('Q5_h').value=this.value;" name="Q5-var" value="A1" /> б) 62</label><br />
<label><input class="button" id="submit_test" type="radio" onClick="I('Q5_h').value=this.value;" name="Q5-var" value="A2" /> в) 31</label><br />
<label><input class="button" id="submit_test" type="radio" onClick="I('Q5_h').value=this.value;" name="Q5-var" value="A3" /> г) 50</label><br />
</div></div><div class="question" style="padding-top: 10px; padding-bottom: 10px;" id="Q6">
<div style="clear:both;"><strong>7) Меньшая сторона и меньшая высота параллелограмма равны соответственно 17 см и 15 см,
а разность между большей диагональю и большей стороной 11 см. Определить меньшую
диагональ параллелограмма.</strong></div><div style="width: 100px; text-align: left;">
<input type="hidden" id="Q6_h" value="" />
<label><input class="button" id="submit_test" type="radio" onClick="I('Q6_h').value=this.value;" name="Q6-var" value="A0" /> а) 15</label><br />
<label><input class="button" id="submit_test" type="radio" onClick="I('Q6_h').value=this.value;" name="Q6-var" value="A1" /> б) 25</label><br />
<label><input class="button" id="submit_test" type="radio" onClick="I('Q6_h').value=this.value;" name="Q6-var" value="A2" /> в) 20</label><br />
</div></div><div class="question" style="padding-top: 10px; padding-bottom: 10px;" id="Q7">
<div style="clear:both;"><strong>8) Длины сторон треугольника соотносятся как 3:4:5, а периметр равен 24 см. Найти длину меньшей стороны треугольника </strong></div><div style="width: 100px; text-align: left;">
<input type="hidden" id="Q7_h" value="" />
<label><input class="button" id="submit_test" type="radio" onClick="I('Q7_h').value=this.value;" name="Q7-var" value="A0" /> а) 12</label><br />
<label><input class="button" id="submit_test" type="radio" onClick="I('Q7_h').value=this.value;" name="Q7-var" value="A1" /> б) 10</label><br />
<label><input class="button" id="submit_test" type="radio" onClick="I('Q7_h').value=this.value;" name="Q7-var" value="A2" /> в) 6</label><br>
<label><input class="button" id="submit_test" type="radio" onClick="I('Q7_h').value=this.value;" name="Q7-var" value="A3" /> г) 8</label><br />
</div></div><div class="question" style="padding-top: 10px; padding-bottom: 10px;" id="Q8">
<div style="clear:both;"><strong>9) Длины сторон треугольника соотносятся как 3:4:5, а периметр равен 24 см. Найти радиус описанной окружности треугольника</strong></div><div style="width: 100px; text-align: left;">
<input type="hidden" id="Q8_h" value="" />
<label><input class="button" id="submit_test" type="radio" onClick="I('Q8_h').value=this.value;" name="Q8-var" value="A0" /> а) 5</label><br />
<label><input class="button" id="submit_test" type="radio" onClick="I('Q8_h').value=this.value;" name="Q8-var" value="A1" /> б) 15</label><br />
<label><input class="button" id="submit_test" type="radio" onClick="I('Q8_h').value=this.value;" name="Q8-var" value="A2" /> в) 25</label><br />
</div></div><div class="question" style="padding-top: 10px; padding-bottom: 10px;" id="Q9">
<div style="clear:both;"><strong>10) 4 оператора, работающих с одинаковой производительностью, печатают 240 страниц
за 4 дня. Сколько операторов смогут напечатать 270 страниц за 3 дня</strong></div><div style="width: 100px; text-align: left;">
<input type="hidden" id="Q9_h" value="" />
<label><input class="button" id="submit_test" type="radio" onClick="I('Q9_h').value=this.value;" name="Q9-var" value="A0" /> а) 10</label><br />
<label><input class="button" id="submit_test" type="radio" onClick="I('Q9_h').value=this.value;" name="Q9-var" value="A1" /> б) 7</label><br />
<label><input class="button" id="submit_test" type="radio" onClick="I('Q9_h').value=this.value;" name="Q9-var" value="A2" /> в) 6</label><br />
<label><input class="button" id="submit_test" type="radio" onClick="I('Q7_h').value=this.value;" name="Q7-var" value="A3" /> г) 3</label><br />
</div></div><div id="test_result" style="clear:both"><input class="zavertest" type="submit" onclick="checkTest();" value="Завершить тест" /></div><br>
</div>
<? endif;
if ($userloginulsya==false) {
	echo '<div style="text-align:center;margin-top: 55px;">Чтобы пройти тест необходимо <a href="register" style="color: #007eff;">зарегистрироваться</a> и <a href="login" style="color: #007eff;">войти</a> на сайт.</div>';
}
?>
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