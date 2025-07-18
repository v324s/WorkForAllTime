<?
include('include/settings.php');
include('include/guard.php');

if ($_GET['act']=='logout') {
	$idses=$_COOKIE['sesid'];
	setcookie('sesadm','');
	setcookie('sesadmkey','');
	header('location:admin');
}
if ($_GET['err']=='true') {
	$txt='Неверный логин/пароль.';
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
	
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>INTERFILM | Администрация</title>
</head>
<body style="background: #fff;height: 100%;">
	<div class="poverhvseh" style="display: flex;margin: 0;">
		<div class="borderokna">
		<div class="poverhokno">
			<div class="oknozag">вход</div>
			<div class="oknohr"></div>
			<div class="resultquerry">
				<?
					if ($txt) {
						echo $txt;
					}
				?>
			</div>
				<div class="autorizesite">
					<form method="POST" action="adminka">
						<input type="text" name="login" class="oknotextinput" placeholder="Логин"><br>
						<input type="password" name="password" class="oknotextinput" style="margin-top: 10px;" placeholder="Пароль"><br>
						<input type="submit" name="vhod" value="Войти" class="oknobutton">
					</form>
				</div>
		</div>
		</div>
</div>
</body>
</html>