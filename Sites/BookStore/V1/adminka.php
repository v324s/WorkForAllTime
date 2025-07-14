<?
include('include/settings.php');

if ($_COOKIE['sesadm']==$adminlog && $_COOKIE['sesadmkey']==$adminpass) {
	$vsenishtyak=true;
}else{
	if ($_POST['login']==$adminlog && $_POST['password']==$adminpass) {
		setcookie('sesadm',$adminlog);
		setcookie('sesadmkey',$adminpass);
	}else{
		header('location:admin?err=true');
	}
}

if ($_GET['act']=='delete' && $_GET['id']) {
	$kogodel=$_GET['id'];
	mysql_query("DELETE FROM books WHERE id='$kogodel'");
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
	$addtovar=mysql_query("INSERT into books(cena,name,avtor,vozogr,izdatelstvo,seria,godidat,kolvostr,format,tipoblozh,ves,annotacia,img) values ('$cena','$nazvanie','$avtor','$vozrogr','$izdat','$seria','$godizd','$kolvostr','$format','$tipobl','$ves','$anotac','$oblozhka')");

	/*if ($time_five) {
		$addfilm=mysql_query("INSERT into seyvkino(nazvanie,zhanr,vozr_ogr,prodolzh,roli,opisanie,trayler,time_seans,oblozhka,skok_time,time_one,time_two,time_three,time_four,time_five) values ('$nazvanie','$zhanr','$vozrogr','$prodolzh','$roli','$opisanie','$trayler','$timeseans','$oblozhka','$vsegotime','$time_one','$time_two','$time_three','$time_four','$time_five')");
	}elseif ($time_four) {
		$addfilm=mysql_query("INSERT into seyvkino(nazvanie,zhanr,vozr_ogr,prodolzh,roli,opisanie,trayler,time_seans,oblozhka,skok_time,time_one,time_two,time_three,time_four) values ('$nazvanie','$zhanr','$vozrogr','$prodolzh','$roli','$opisanie','$trayler','$timeseans','$oblozhka','$vsegotime','$time_one','$time_two','$time_three','$time_four')");
	}elseif ($time_three) {
		$addfilm=mysql_query("INSERT into seyvkino(nazvanie,zhanr,vozr_ogr,prodolzh,roli,opisanie,trayler,time_seans,oblozhka,skok_time,time_one,time_two,time_three) values ('$nazvanie','$zhanr','$vozrogr','$prodolzh','$roli','$opisanie','$trayler','$timeseans','$oblozhka','$vsegotime','$time_one','$time_two','$time_three')");
	}elseif ($time_two) {
		$addfilm=mysql_query("INSERT into seyvkino(nazvanie,zhanr,vozr_ogr,prodolzh,roli,opisanie,trayler,time_seans,oblozhka,skok_time,time_one,time_two) values ('$nazvanie','$zhanr','$vozrogr','$prodolzh','$roli','$opisanie','$trayler','$timeseans','$oblozhka','$vsegotime','$time_one','$time_two')");
	}elseif ($time_one) {
		$addfilm=mysql_query("INSERT into seyvkino(nazvanie,zhanr,vozr_ogr,prodolzh,roli,opisanie,trayler,time_seans,oblozhka,skok_time,time_one) values ('$nazvanie','$zhanr','$vozrogr','$prodolzh','$roli','$opisanie','$trayler','$timeseans','$oblozhka','$vsegotime','$time_one')");
	}*/
	//header('location: adminka?act=addtovar');
}
?>
<!DOCTYPE html>
<html>
<head>
	<link href="css/cssyanoneKaffeesatz.css" rel="stylesheet">
	<link rel="stylesheet" href="css/owl.carousel.min.css">
	<link rel="stylesheet" href="css/owl.theme.default.min.css">
	<link href="css/style.css" rel="stylesheet">
	<script src="js/jquery-1.4.4.js"></script>
	<script src="js/jquery.maskedinput-1.2.2.js"></script>
	<script type="text/javascript" src="js/getfilm.js"></script>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Книжный дизайн | Администрация</title>
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
	<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
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
	<div style="    width: 1200px;
    margin: 0 auto;
    height: 100%;">
		<div style="    width: 200px;
    height: 100%;
    display: inline-block;
    background-color: black; /*#b400ff;*/
    color: white;
    font-size: 28px;
    padding: 3.5% 1%;
    position: fixed;">
		<a href="admin?act=logout" class="hrefi">Выйти</a>
		<a href="adminka?act=addtovar" class="hrefit">Добавить товар</a>
		<a href="adminka?act=tovars" class="hrefit">Товары</a>
		<a href="adminka?act=zakazi" class="hrefit">История заказов</a>
		</div>

		<div style="display: inline-block;
    width: 900px;
    background-color: #e6e6e6;
    margin-left: 230px;
    padding: 4% 2%; /*20px;*/
    font-size: 20px;">
			<?
			echo '<div style="text-align: center;">';
			if ($er) {
    			echo $er;
    		}
    		echo '</div>';

?>

<div id="chart_div" style="width: 100%;overflow-x: hidden;"> 
	<?
	if ($_GET['act']=='zakazi') {
		echo '<div style="position: fixed;right: 0;padding: 8px 16px;background-color: black;"><input type="range" min="0" max="100" step="1" value="0" oninput="document.getElementById(\'chart_div\').scrollTo(this.value+\'0\',0)"></div>';
		$result1=mysql_query("SELECT * FROM zakazi");
		$num1=mysql_num_rows($result1);
		echo "<center>Кол-во заказов - ".$num1."</center><br>";
		echo '<table align="center" border="2px"';
		echo "<tr>";
		echo "<td>Номер заказа</td>";
		echo "<td>Дата оформления</td>";
		echo "<td>ФИО</td>";
		echo "<td>Телефон</td>";
		echo "<td>E-mail</td>";
		echo "<td>Город</td>";
		echo "<td>Адрес</td>";
		echo "<td>Заказ</td>";
		echo "<td>Цена заказа</td>";
		echo "</tr>";
		for ($id=$num1; $id>=1; $id--) { 
			$row=mysql_fetch_array(mysql_query("SELECT * FROM zakazi where id=$id")); 
			echo "<tr><td>".$row['id']."</td>";
			echo "<td>".$row['datazakaza']."</td>";
			echo "<td>".$row['fio']."</td>";
			echo "<td>".$row['tel']."</td>";
			echo "<td>".$row['email']."</td>";
			echo "<td>".$row['gorod']."</td>";
			echo "<td>".$row['address']."</td>";
			echo "<td>".'<table border="1px">';
							$cart=$row['cart'];
							$cartArr=explode("|", $cart);
							$cartTotalPrice=0;
							if ($cart!="") {
											foreach ($cartArr as $k => $v) {
											$result1=mysql_query("SELECT * FROM books WHERE id=$v");
											$row=mysql_fetch_array($result1);
											$number=$k+1;
											echo "<tr><td>".$number."</td><td>".'<a href="inf?book='.$row['id'].'" target="_blank">'."(".$row['avtor'].") ".$row['name'].'</a></td><td>'.$row['cena']." py6.</td></tr>";
											$cartTotalPrice=$cartTotalPrice+$row['cena'];
																		}
											}	
			echo '</table>'."</td><td>".$cartTotalPrice." py6.</td></tr>";
		}
	}
	if ($_GET['act']=='tovars') {
		echo '<div style="text-align: center;">Товары на сайте</div>';
		echo '<div style="position: fixed;right: 0;padding: 8px 16px;background-color: black;"><input type="range" min="0" max="100" step="1" value="0" oninput="document.getElementById(\'chart_div\').scrollTo(this.value+\'0\',0)"></div>';
		$res=mysql_query("SELECT * from books");
		$skokrow=mysql_num_rows($res);
		echo '<div style="width:min-content;margin: 0 auto;margin-top:20px;">
			<table>
					<tr style="background-color: #b400ff;color: white;">
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
					</tr>';
		if ($skokrow>0) {
			for ($i=0; $i < $skokrow ; $i++) { 
				$books=mysql_fetch_array($res);
				echo '<tr>
						<td>'.$books['id'].'
						<td><img style="max-height:300px;" src="'.$books['img'].'">
						<td>'.$books['name'].'
						<td>'.$books['avtor'].'
						<td>'.$books['vozogr'].'
						<td>'.$books['izdatelstvo'].'
						<td>'.$books['seria'].'
						<td>'.$books['godidat'].'
						<td>'.$books['kolvostr'].'
						<td>'.$books['format'].'
						<td>'.$books['tipoblozh'].'
						<td>'.$books['ves'].'
						<td><div style="max-height:300px; overflow-y:auto;">'.$books['annotacia'].'</div>
						<td><a href="?act=delete&id='.$books['id'].'">Удалить</a>
				</td>';			
			}
		}
		echo '
		</table>
		</div>';
	}
	if ($_GET['act']=='addtovar') {
	echo '<div style="text-align: center;">';
			if ($addtovar) {
    			echo 'Товар успешно добавлен';
    		}
    		echo '</div>';
	echo '<div style="width:min-content;margin: 0 auto;margin-top:20px;">
		<form action="adminka?act=addtovar" method="post" enctype="multipart/form-data">
		<table>
			<tr>
				<td>Цена
				<td><input type="text" name="cena" style="width: 30px;">
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
				<td>Формат
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
								<input class="uploadava"  style="margin:0;border: 1px solid #ff0303;padding:2% 5%;    color: white;    background-color: #ff0303;margin-top: 15px;" type="submit"  value="Добавить">
							
		</form>
		<script type="text/javascript" src="js/prewiev.js"></script>
		</div>
	';
}
	?>
</div>	
	</div>
</body>
</html>