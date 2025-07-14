<?
include('include/settings.php');
session_start();

if ($_SESSION['sesadm']==$adminlog && $_SESSION['sesadmkey']==$adminpass) {
	$authOK=true;
}else{
	if ($_POST['login']==$adminlog && $_POST['password']==$adminpass) {
		$_SESSION['sesadm'] = $adminlog;
		$_SESSION['sesadmkey'] = $adminpass;
	}else{
		header('location:admin?err=true');
	}
}

// Удаление Пользователя
if ($_GET['act']=='deleteUser' && $_GET['id']) {
	$kogodel=$_GET['id'];
	mysqli_query($conn, "DELETE FROM users WHERE id='$kogodel'");
	header('location: adminka?act=users');
}

// Удаление отзыва
if ($_GET['act']=='deleteOtziv' && $_GET['id']) {
	$kogodel=$_GET['id'];
	mysqli_query($conn, "DELETE FROM otzivi WHERE id='$kogodel'");
	header('location: adminka?act=otzivi');
}

// Удаление книги
if ($_GET['act']=='delete' && $_GET['id']) {
	$kogodel=$_GET['id'];
	mysqli_query($conn, "DELETE FROM books WHERE id='$kogodel'");
	header('location: adminka?act=tovars');
}


if ($_POST['action']=='dobtovar') {
	if (!$_FILES['film']['tmp_name']) {
	}elseif ($_FILES['film']['size']>4*1024*1024) {
		//$er="Файл слишком большой";
	}else{
		switch ($_FILES['film']['type']) {
			case 'image/jpeg':
				$type='jpg';
				$name=uniqid();
				$fullname=$name.'.'.$type;
				$linkimg='img/books/'.$fullname;
				break;
			case 'image/png':
				$type='jpg';
				$name=uniqid();
				$fullname=$name.'.'.$type;
				$linkimg='img/books/'.$fullname;
				break;
			default:
				//$er="Недопустимое расширение файла";
				break;
		}
		if (!move_uploaded_file($_FILES['film']['tmp_name'], $linkimg)) {
			//$er="ошибка загрузки";
		}else{
			//$er="фон обновлен";
		}
	}
	
	$nazvanie=$_POST['nazvanie'];
	$izdat=$_POST['izdat'];
	$seria=$_POST['seria'];
	$godizd=$_POST['godizd'];
	$kolvostr=$_POST['kolvostr'];
	$format=$_POST['format'];
	$tipobl=$_POST['tipobl'];
	$ves=$_POST['vesknigi'];
	$anotac=$_POST['anotac'];
	$vozrogr=$_POST['vozrogr'];
	$cena=$_POST['cena'];
	$avtor=$_POST['avtor'];
	$oblozhka=$linkimg;
	$addtovar=mysqli_query($conn, "INSERT into books(cena,name,avtor,vozogr,izdatelstvo,seria,godidat,kolvostr,format,tipoblozh,ves,annotacia,img) values ('$cena','$nazvanie','$avtor','$vozrogr','$izdat','$seria','$godizd','$kolvostr','$format','$tipobl','$ves','$anotac','$oblozhka')");

}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Dream Library | Администрация</title>
	<style type="text/css">
		body{

			font-family: 'Roboto', sans-serif;
		}
		a{
			text-decoration: none;
		}
		.hrefi{
			    color: white;
			display: block;
			width: min-content;
			padding: 10px;
			border: 2px solid;
			margin-left: 46%;
		}
		.hrefi:hover{
			text-decoration: underline;
			cursor: pointer;
		}
		.hrefit{
			    color: white;
			display: block;
			margin-top: 15px;
			padding: 10px;
			border: 2px solid;
			text-align: center;
		}
		.hrefit:hover{
			text-decoration: underline;
			cursor: pointer;
		}
		.preview-img{
			    width: 100%;
		}
		td{
			    border: 2px solid black;
			    padding: 5px;
		}
		table{
			    border-collapse: collapse;
			text-align: center;
			
			font-size: 1rem;
		}
		.inbm{
			font-size: 26px;
			    padding: 10px;
			    color: white;
		    display: block;
		    border: 2px solid;
		    text-align: center;
		    display: inline-block;
   			vertical-align: middle;
		}
		.inbm:hover{
			text-decoration: underline;
			cursor: pointer;
		}
		.lupa:hover{
			cursor: pointer;
		}
		#harashobut{
			    padding: 10px;
			background-color: #003900;
			border: 2px solid lime;
			color: lime;
			font-size: 24px;
		}
		#harashobut:hover{
			cursor: pointer;
			text-decoration: underline;
			background-color: #004900;
		}
		#deletebut{
			padding: 10px;
			color: red;
			border: 2px solid red;
			background: #370000;
			font-size: 24px;
			margin-top: 15px;
		}
		#deletebut:hover{
			cursor: pointer;
			text-decoration: underline;    
			background: #4c0202;
		}
		#dlyatablic{
			    font-size: 24px;
			margin-top: 10px;
			padding: 10px;
			max-height: 40vh;
			overflow: auto;
		}
		#poverhvseh{
			margin:0;
		}
		.onelvl{
			    display: inline-block;
    		vertical-align: top;
		}
		.settimebll{
			font-size: 28px;
			padding: 10px 20px;
			border-radius: 25px;
		}
		.settimebll:hover{
			background-color: #4d026c;
			cursor: pointer;
		}
		.uploadava:hover{
			cursor: pointer;
			background-color: #d00303;
		}
	</style>
</head>
<body style="background: #fff;height: 100vh;">
	<div class="poverhvseh" id="poverhvseh">
		<div class="borderokna" style="margin:0 auto;">
			<div class="poverhokno" style="height: auto;max-width: max-content;">
				<div class="closeokno" style="margin-top: -40px;" onclick="$('#poverhvseh').css('display','none');document.getElementById('body').style.overflowY='auto';"></div>
				<div id="resultsquerybigwind">
				</div>
			</div>
		</div>
	</div>
	<div style="margin: 0 auto;height: 100%;">
		<div style="width: 200px;height: 100%;display: inline-block;background: linear-gradient(229deg, #09bfff, #f0beff); color: white;font-size: 1.2rem;padding: 3.5% 1%;position: fixed;">
			<a href="admin?act=logout" class="hrefi" style="width: auto;text-align: center;margin-left:50%;">Выйти</a>
			<a href="adminka?act=addtovar" class="hrefit">Добавить товар</a>
			<a href="adminka?act=tovars" class="hrefit">Товары</a>
			<a href="adminka?act=zakazi" class="hrefit">История заказов</a>
			<a href="adminka?act=otzivi" class="hrefit">Отзывы</a>
			<a href="adminka?act=users" class="hrefit">Пользователи</a>
		</div>

		<div style="display: inline-block;width: calc(100% - 7% - 200px);margin-left: 230px;padding: 4% 2%;font-size: 20px;">
			<?
			echo '<div style="text-align: center;">';
			if ($er) {
    			echo $er;
    		}
    		echo '</div>';
			?>

			<div id="chart_div" style="width: 100%;overflow-x: hidden;"> 
				<?
				// Пользователи
				if ($_GET['act']=='users') {
					?>
					<!-- Горизонтальный скролл -->
					<div style="position: fixed;right: 0;padding: 8px 16px;background-color: black;">
						<input type="range" min="0" max="100" step="1" value="0" oninput="document.getElementById('chart_div').scrollTo(this.value+'0',0)">
					</div>
					<!-- --------------------- -->

					<?
					if (isset($_GET['id'])) {
						$qdb = mysqli_query($conn, "SELECT * FROM `users` WHERE `id`=".$_GET['id']);
					}else{
						$qdb = mysqli_query($conn, "SELECT * FROM `users` ORDER BY `id` DESC");
					}
					$countQdb = mysqli_num_rows($qdb);
					?>
					<center>Кол-во пользователей - <? echo $countQdb; ?></center><br>
					<table align="center" border="2px">
						<tr>
							<td>ID</td>
							<td>Дата регистрации</td>
							<td>E-mail</td>
							<td>Имя</td>
							<td>Фамилия</td>
							<td>Отчество</td>
							<td>Телефон</td>
							<td>Город</td>
							<td>Адрес</td>
							<td>Действие</td>
						</tr>
					<?
					for ($i=0; $i < mysqli_num_rows($qdb) ; $i++) { 
						$q = mysqli_fetch_assoc($qdb);
						?>
							<tr>
								<td><? echo $q['id']; ?></td>
								<td><? echo date("d.m.Y H:i", $q['regtime']); ?></td>
								<td><? echo $q['email']; ?></td>
								<td><? echo $q['first_name']; ?></td>
								<td><? echo $q['last_name']; ?></td>
								<td><? echo $q['llast_name']; ?></td>
								<td><? echo $q['tel']; ?></td>
								<td><? echo $q['gorod']; ?></td>	
								<td><? echo $q['address']; ?></td>
								<td><a href="?act=deleteUser&id=<? echo $q['id']; ?>">Удалить</a></td>
							</tr>
						<?
					}
				}
				// Отзывы
				if ($_GET['act']=='otzivi') {
					?>
					<!-- Горизонтальный скролл -->
					<div style="position: fixed;right: 0;padding: 8px 16px;background-color: black;">
						<input type="range" min="0" max="100" step="1" value="0" oninput="document.getElementById('chart_div').scrollTo(this.value+'0',0)">
					</div>
					<!-- --------------------- -->

					<?
					$qdb = mysqli_query($conn, "SELECT * FROM `otzivi` ORDER BY `id` DESC");
					$countQdb = mysqli_num_rows($qdb);
					?>
					<center>Кол-во отзывов - <? echo $countQdb; ?></center><br>
					<table align="center" border="2px">
						<tr>
							<td>ID отзыва</td>
							<td>ID книги</td>
							<td>ID пользователя</td>
							<td>Оценка</td>
							<td>Отзыв</td>
							<td>Дата</td>
							<td>Действие</td>
						</tr>
					<?
					for ($i=0; $i < mysqli_num_rows($qdb) ; $i++) { 
						$q = mysqli_fetch_assoc($qdb);
						?>
							<tr>
								<td><? echo $q['id']; ?></td>
								<td><a href="?act=tovars&id=<? echo $q['bid']; ?>"><? echo $q['bid']; ?></a></td>
								<td><a href="?act=users&id=<? echo $q['uid']; ?>"><? echo $q['uid']; ?></a></td>
								<td>★ <? echo $q['score']; ?></td>
								<td><div style="max-height:300px; overflow-y:auto;"><? echo $q['text']; ?></div></td>
								<td><? echo date("d.m.Y H:i", $q['time']); ?></td>
								<td><a href="?act=deleteOtziv&id=<? echo $q['id']; ?>">Удалить</a></td>
							</tr>
						<?
					}
				}
				// Заказы
				if ($_GET['act']=='zakazi') {
					?>
					<!-- Горизонтальный скролл -->
					<div style="position: fixed;right: 0;padding: 8px 16px;background-color: black;"><input type="range" min="0" max="100" step="1" value="0" oninput="document.getElementById('chart_div').scrollTo(this.value+'0',0)"></div>
					<!-- --------------------- -->
					<?
					$zakazi = mysqli_query($conn, "SELECT `zakazi`.`id`,`zakazi`.`time`,`zakazi`.`uid`,`zakazi`.`gorod`,`zakazi`.`address`,`zakazi`.`cart`,`zakazi`.`price`,`users`.`email`,`users`.`first_name`,`users`.`last_name`,`users`.`llast_name`,`users`.`tel` FROM `zakazi` INNER JOIN `users` ON `zakazi`.`uid` = `users`.`id` ORDER BY `zakazi`.`id` DESC");
					$countZakazi = mysqli_num_rows($zakazi);
					?>
					<center>Кол-во заказов - <? echo $countZakazi; ?></center><br>
					<table align="center" border="2px">
						<tr>
							<td>Номер заказа</td>
							<td>Дата оформления</td>
							<td>ФИО</td>
							<td>Телефон</td>
							<td>E-mail</td>
							<td>Город</td>
							<td>Адрес</td>
							<td>Заказ</td>
							<td>Цена заказа</td>
						</tr>
					<?
					for ($i=0; $i < mysqli_num_rows($zakazi) ; $i++) { 
						$zakaz = mysqli_fetch_assoc($zakazi);
						?>
							<tr>
								<td><? echo $zakaz['id']; ?></td>
								<td><? echo date("d.m.Y H:i", $zakaz['time']); ?></td>
								<td><? echo "{$zakaz['last_name']} {$zakaz['first_name']} {$zakaz['llast_name']}"; ?></td>
								<td><? echo $zakaz['tel']; ?></td>
								<td><? echo $zakaz['email']; ?></td>
								<td><? echo $zakaz['gorod']; ?></td>
								<td><? echo $zakaz['address']; ?></td>
								<td><table border="1px">
									<?
									$cart=json_decode($zakaz['cart']);
									if (count($cart)>0) {
										$number=1;
										foreach ($cart as $k => $v) {
											$result1=mysqli_query($conn, "SELECT * FROM books WHERE id=$v");
											$book=mysqli_fetch_array($result1);
											echo "<tr><td>".$number."</td><td>".'<a href="inf?book='.$book['id'].'" target="_blank">'."(".$book['avtor'].") ".$book['name']."</a></td><tr>";
											$number++;
										}
									}
									?>
								</table></td>
								<td><? echo $zakaz['price']; ?> ₽</td>
							</tr>
						<?
					}
				}
				// Товары
				if ($_GET['act']=='tovars') {
					?>
						<div style="text-align: center;">Товары на сайте</div><br>
						<!-- Горизонтальный скролл -->
						<div style="position: fixed;right: 0;padding: 8px 16px;background-color: black;">
							<input type="range" min="0" max="100" step="1" value="0" oninput="document.getElementById('chart_div').scrollTo(this.value+'0',0)">
						</div>
						<!-- --------------------- -->
					<?
					if (isset($_GET['id'])) {
						$res=mysqli_query($conn, "SELECT * FROM books WHERE `id`=".$_GET['id']);
					}else{
						$res=mysqli_query($conn, "SELECT * FROm books");
					}
					$skokrow=mysqli_num_rows($res);
					?>
						<center>Кол-во товаров - <? echo $skokrow; ?></center><br>
						<div style="width:min-content;margin: 0 auto;margin-top:20px;">
						<table>
								<tr style="background-color: #09bfff;color: white;">
									<td>id
									<td>Изображение
									<td>Название
									<td>Автор
									<td>Возростное ограничение
									<td>Издательство
									<td>Серия
									<td>Год издания
									<td>Кол-во страниц
									<td>Формат
									<td>Тип обложки
									<td>Вес
									<td>Анотация
									<td>Действие
								</tr>
						<?
						if ($skokrow>0) {
							for ($i=0; $i < $skokrow ; $i++) { 
								$books=mysqli_fetch_array($res);
								?>
								<tr>
									<td><? echo $books['id']; ?></td>
									<td><img style="max-height:150px;" src="<? echo $books['img']; ?>"></td>
									<td><? echo $books['name']; ?></td>
									<td><? echo $books['avtor']; ?></td>
									<td><? echo $books['vozogr']; ?></td>
									<td><? echo $books['izdatelstvo']; ?></td>
									<td><? echo $books['seria']; ?></td>
									<td><? echo $books['godidat']; ?></td>
									<td><? echo $books['kolvostr']; ?></td>
									<td><? echo $books['format']; ?></td>
									<td><? echo $books['tipoblozh']; ?></td>
									<td><? echo $books['ves']; ?></td>
									<td><div style="max-height:300px; overflow-y:auto;"><? echo $books['annotacia']; ?></div></td>
									<td><a href="?act=delete&id=<? echo $books['id']; ?>">Удалить</a></td>
								</tr>
								<?
							}
						}
						?>
						</table>
						</div>
						<?
				}
				// Форма добавления товара
				if ($_GET['act']=='addtovar') {
					?>
					<div style="text-align: center;">
						<?
						if ($addtovar) {
							echo 'Товар успешно добавлен';
						}
						?>
					</div>
					<div style="width:min-content;margin: 0 auto;margin-top:20px;">
						<form action="adminka?act=addtovar" method="post" enctype="multipart/form-data">
							<table>
								<tr>
									<td>Цена
									<td><input type="text" name="cena" style="width: 50px;">руб.
								</tr>
								<tr>
									<td>Название
									<td><input type="text" name="nazvanie" placeholder="Название">
								</tr>
								<tr>
									<td>Автор
									<td><input type="text" name="avtor" placeholder="Автор">
								</tr>
								<tr>
									<td>Издательство
									<td><input type="text" name="izdat" placeholder="Издательство">
								</tr>
								<tr>
									<td>Серия
									<td><input type="text" name="seria" placeholder="Серия">
								</tr>
								<tr>
									<td>Год издания
									<td><input type="text" name="godizd" style="width: 30px;">
								</tr>
								<tr>
									<td>Кол-во страниц
									<td><input type="text" name="kolvostr" style="width: 30px;">
								</tr>
								<tr>
									<td>Формат (размер)
									<td><input type="text" name="format" placeholder="Формат">
								</tr>
								<tr>
									<td>Тип обложки
									<td><input type="text" name="tipobl" placeholder="Тип обложки">
								</tr>
								<tr>
									<td>Вес, г
									<td><input type="text" name="vesknigi" style="width: 30px;"> г.
								</tr>
								<tr>
									<td>Аннотация
									<td><textarea style="height: 100px;width: 200px;" placeholder="Аннотация" name="anotac"></textarea>
								</tr>
								<tr>
									<td>Возростное ограничение
									<td><select type="text" name="vozrogr" style="width: 40px;" >
										<option value="0+">0+</option>
										<option value="6+">6+</option>
										<option value="12+">12+</option>
										<option value="14+">14+</option>
										<option value="16+">16+</option>
										<option value="18+">18+</option>
										</select>
								</tr>
								<tr>
									<td>Обложка фильма
									<td><input type="file" id="upfile" onchange="getFileParam();" name="film">
								</tr>
							</table>
							<div style="max-width: 500px;">
								<div id="preview1"></div>
								<div id="file-name1"></div>
								<div id="file-size1"></div>
							</div>
							<input type="hidden" name="action" value="dobtovar">
							<input class="uploadava"  style="margin:0;border: 1px solid #09bfff;padding:2% 5%;    color: white;    background-color: #09bfff;margin-top: 15px;" type="submit"  value="Добавить">
						</form>
						<script type="text/javascript" src="js/prewiev.js"></script>
					</div>
					<?
				}
				?>
			</div>
		</div>
	</div>
</body>
</html>
