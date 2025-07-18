<?
include "include/settings.php"; 			// подключаем файл PHP




if ($_POST['login'] && $_POST['pass']) { 	// если приняты переменные login и pass (Методом ПОСТ)
	$logg=$_POST['login']; 						// принятые данные login заносим в другую переменную
	$passs=$_POST['pass']; 						// принятые данные pass заносим в другую переменную
	if ($logg==$log) { 							// если принятые данные login совпадают с логином администратора
		if ($passs==$pass) {						// если принятые данные pass совпадают с паролем администратора
			$vhod=true;									// создаем переменную  (тип булеан), которая нам говорит, что вход выполнен
		} else {									// иначе выводим HTML код, где скажет, что пароль неверный
			$error='Неверный пароль';				// переменная с текстом ошибки
													// вывод HTML кода с ошибкой
			echo '<div style="display:flex;height: 100%;">
					<div style="margin:auto;">'.$error.'
						<form method="post" action="admin">
						<input style="color: #000000;padding: 5px;font-size: 16px;" type=text placeholder="login" name=login><br>
						<input style="color: #000000;padding: 5px;font-size: 16px;" type=password placeholder="password" name=pass><br>
						<input style="margin-bottom: 20px;padding: 10px;background-color: #007eff;color: white;border: none;font-size: 16px;margin-top: 10px;
			    width: 209px;" type=submit value=Войти>
						</form>
					</div>
				</div>';
		}
	} else {									// иначе выводим HTML код, где скажет, что логин неверный
		$error='Неверный логин';				// переменная с текстом ошибки
												// вывод HTML кода с ошибкой
	echo '<div style="display:flex;height: 100%;">
			<div style="margin:auto;">'.$error.'
				<form method="post" action="admin">
					<input style="color: #000000;padding: 5px;font-size: 16px;" type=text placeholder="login" name=login><br>
					<input style="color: #000000;padding: 5px;font-size: 16px;" type=password placeholder="password" name=pass><br>
					<input style="margin-bottom: 20px;padding: 10px;background-color: #007eff;color: white;border: none;font-size: 16px;margin-top: 10px;
		    width: 209px;" type=submit value=Войти>
				</form>
			</div>
		</div>';
	}

}else{											// если данные login и pass не приняты, выводим форму авторизации
	echo '<div style="display:flex;height: 100%;">
			<div style="margin:auto;">
				<form method="post" action="admin">
					<input style="color: #000000;padding: 5px;font-size: 16px;" type=text placeholder="login" name=login><br>
					<input style="color: #000000;padding: 5px;font-size: 16px;" type=password placeholder="password" name=pass><br>
					<input style="margin-bottom: 20px;padding: 10px;background-color: #007eff;color: white;border: none;font-size: 16px;margin-top: 10px;
		    width: 209px;" type=submit value=Войти>
				</form>
			</div>
		</div>';
}
if ($_POST['login'] && $_POST['pass'] && $_POST['acttest']!='listtest' && $vhod==true) {		// если приняты данные login и pass и вход был успешным
																// выводим админ-меню
	echo '<!DOCTYPE html>
<html>
<head>
	<title>Админ-панель</title>
	<style type="text/css">
		body{
			font-family: "Comic Sans MS";
		}
		table{
			border-collapse: collapse;
			text-align: center;
		}
		td{
			border: 2px solid;
			padding: 15px;
			font-size: 18px;
		}
	</style>
</head>
<body>';
		$result=mysql_query("select * from svyaz");				// выбираем данные из таблицы svyaz
		$str=mysql_fetch_array($result);						// помещаем данные в массив
$kolvostr=mysql_num_rows($result);								// считаем сколько всего записей
echo '<a href="admin" style="display:block;margin:0 auto;width: 55px;">Выйти</a><br>'; // создаем кнопку "выход"
echo '<div style="text-align:center;margin-bottom:15px;"><form method="post" action="admin"><input type=text hidden name="login" value="'.$_POST['login'].'"><input type=text hidden value="listtest" name="acttest"><input type=password hidden name="pass" value="'.$_POST['pass'].'"><input type=submit value="Результаты теста"></form>
<form method="post" action="admin"><input type=text hidden name="login" value="'.$_POST['login'].'"><input type=password hidden name="pass" value="'.$_POST['pass'].'"><input type=submit value="Обратная связь"></form></div>';
echo '<center>Кол-во сообщений - '.$kolvostr.'</center><br>';	// выводим кол-во записей

																// создаем таблицу с записями
	echo '<center><table>';
	echo '<tr style="background: #00e7ff;">';
	echo '<td>id сообщения</td>';
	echo '<td>id пользователя</td>';
	echo '<td>Имя</td>';
	echo '<td>E-mail для связи</td>';
	echo '<td>Сообщение</td>';
	echo '</tr>';
	
for ($i=$kolvostr; $i > 0; $i--) { 								// создаем цикл, чтобы перебирать массив
	$result=mysql_query("select * from svyaz where id='$i'");	// берем данные из таблицы svyaz где id равен номеру в массиве
	$str=mysql_fetch_array($result);							// помещаем данные в массив
																// выводим данные в таблицу
	echo '<tr>';
	echo '<td>'.$str['id'].'</td>';
	echo '<td>'.$str['iduser'].'</td>';
	echo '<td>'.$str['name'].'</td>';
	echo '<td>'.$str['email'].'</td>';
	echo '<td style="max-width: 270px;">'.$str['message'].'</td>';
	echo '</tr>';
}

	echo '</table></center>
</body>
</html>';
}

if ($_POST['login'] && $_POST['pass'] && $_POST['acttest']=='listtest' && $vhod==true) {
		echo '<!DOCTYPE html>
<html>
<head>
	<title>Админ-панель</title>
	<style type="text/css">
	body{
		font-family: "Comic Sans MS";
	}
		table{
			border-collapse: collapse;
			text-align: center;
		}
		td{
			border: 2px solid;
			padding: 15px;
			font-size: 18px;
		}
	</style>
</head>
<body>';
		$result=mysql_query("select * from users");				// выбираем данные из таблицы svyaz
		$str=mysql_fetch_array($result);						// помещаем данные в массив
$kolvostr=mysql_num_rows($result);								// считаем сколько всего записей
echo '<a href="admin" style="display:block;margin:0 auto;width: 55px;">Выйти</a><br>'; // создаем кнопку "выход"
echo '<div style="text-align:center;margin-bottom:15px;"><form method="post" action="admin"><input type=text hidden name="login" value="'.$_POST['login'].'"><input type=text hidden value="listtest" name="acttest"><input type=password hidden name="pass" value="'.$_POST['pass'].'"><input type=submit value="Результаты теста"></form>
<form method="post" action="admin"><input type=text hidden name="login" value="'.$_POST['login'].'"><input type=password hidden name="pass" value="'.$_POST['pass'].'"><input type=submit value="Обратная связь"></form></div>';
echo '<center>Кол-во сообщений - '.$kolvostr.'</center><br>';	// выводим кол-во записей

																// создаем таблицу с записями
	echo '<center><table>';
	echo '<tr style="background: #00e7ff;">';
	echo '<td>id сообщения</td>';
	echo '<td>Имя пользователя</td>';
	echo '<td>Фамилия пользователя</td>';
	echo '<td>E-mail</td>';
	echo '<td>Телефон</td>';
	echo '<td>Результат теста</td>';
	echo '</tr>';
	
for ($i=$kolvostr; $i > 0; $i--) { 								// создаем цикл, чтобы перебирать массив
	$result=mysql_query("select * from users where id='$i'");	// берем данные из таблицы svyaz где id равен номеру в массиве
	$str=mysql_fetch_array($result);							// помещаем данные в массив
																// выводим данные в таблицу
	echo '<tr>';
	echo '<td>'.$str['id'].'</td>';
	echo '<td>'.$str['name'].'</td>';
	echo '<td>'.$str['famil'].'</td>';
	echo '<td>'.$str['email'].'</td>';
	echo '<td>'.$str['tel'].'</td>';
	if ($str['test']<0) {
		echo '<td>Тест не проходил</td>';
	}else{
		echo '<td>Правильных ответов: '.$str['test'].' из 10</td>';
	}
	echo '</tr>';
}

	echo '</table></center>
</body>
</html>';
}
?>
