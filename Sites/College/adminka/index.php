<?
session_start();
if ($_SESSION[$_COOKIE['log']]==$_COOKIE['pas'] && isset($_COOKIE['log']) && isset($_COOKIE['pas'])) {
	header('Location: menu.php');
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="../css/reset.css">
	<link rel="stylesheet" type="text/css" href="../css/main.css">
	<link rel="stylesheet" type="text/css" href="../css/admin.css">
	<link rel="stylesheet" type="text/css" href="../fonts/font-awesome/css/font-awesome.min.css">
	<link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&display=swap" rel="stylesheet">
	<script src="../js/jquery.min.js"></script>
	<title>ДМК | Админ</title>
</head>
<body>
	<div class="body" onload="$('#response').css('width',$('#'))">
		<section>
			<div class="zagolovok">Авторизация</div>
			<div class="form_auth">
				<input type="text" class="input_txt" id="login" placeholder="Логин">
				<input type="password" class="input_txt" id="password" placeholder="Пароль">
				<input type="button" class="input_btn" id="act_login" value="Войти">
			</div>
			<div id="response"></div>
		</section>
	</div>
	<script type="text/javascript">
		$("#act_login").click(function () {
			let login = $('#login').val();
			let password = $('#password').val();
			console.log(login+" | "+password);
			$.post('../api/auth.php',{login:login, pass:password},function (e) {
				e=="ok" ? window.location.href="menu.php" : $('#response').text(e);
			})
		});
	</script>
</body>
</html>