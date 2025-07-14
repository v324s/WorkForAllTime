<?
include('include/settings.php');
session_start();

if ($_GET['act']=='logout') {
	$idses=$_COOKIE['sesid'];
	unset($_SESSION['sesadm']);
	unset($_SESSION['sesadmkey']);
	// header('location:admin');
	header('location:profile');
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
	<title>Dream Library | Меню администратора</title>
</head>
<body style="background: #fff;height: 100vh; display:flex;">
	<div class="poverhvseh" style="display: flex;margin: auto;">
		<div class="borderokna">
		<div class="poverhokno">
			<h2 class="oknozag" style="text-align: center;">Авторизация</h2>
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
						<input type="submit" name="vhod" value="Войти" class="oknobutton" style="position: relative;text-align: center;background-color: #09bfff;padding: 8%;color: white;margin-top: 15%;border-radius: 4px;width: 100%;border: none;">
					</form>
				</div>
		</div>
		</div>
</div>
</body>
</html>
