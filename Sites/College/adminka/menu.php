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
	<title>ДМК | Меню администратора</title>
	<style type="text/css">
		button{
			display: block;
		}
		body{
			margin: 0;
			padding: 0;
			display: block;
			height: auto;
			width: auto;
		}
		.flex{
			display: flex;
		}
		.adm-menu{
			width: 15%;
			height: 100vh;
			background-color: var(--black);
		}
		.adm-main{
			width: 85%;
			height: 100vh;
			background-color: var(--gray-light);
		}
	</style>
</head>
<body>
	<div class="flex">
		<div class="adm-menu">
			<button id="but_loguot">Выйти</button>
			<button>Главная</button>
			<button id="but_users">Пользователи</button>
			<button>Меню/разделы</button>
			<button id="but_pages">Страницы</button>
			<button id="but_news">Новости</button>
		</div>
		<div class="adm-main">
			<h1 id="razd_header"></h1>
			<nav id="razd_buttons"></nav>
			<content id="razd_title"></content>
			<main id="razd_body"></main>
		</div>
	</div>
	<script type="text/javascript">
		$('#but_loguot').click(function (){
			$.post('../api/logout.php',{action:"logout"},function (e){
				e=="ok" ? window.location.href="index.php" : console.log(e);
			})
		})
		$('#but_users').click(function (){
			$('#razd_header').text('Пользователи');
			$('#razd_buttons').html('<button onclick="createNewUsers()">Создать нового пользователя</button><button onclick="deleteUsers()">Удалить пользователя</button>');
			$.get('../api/countUsers.php',function(e){$('#razd_title').text('Всего пользователей: '+e)});
			$.get('../api/getUsers.php',function(e){$('#razd_body').html(e)})
		})
		$('#but_pages').click(function (){
			$('#razd_header').text('Страницы');
			$('#razd_buttons').html('<button onclick="createNewPage()">Создать новую страницу</button><button onclick="deletePage()">Удалить страницу</button>');
			$.get('../api/countPages.php',function(e){$('#razd_title').text('Всего страниц: '+e)});
			$.get('../api/getPages.php',function(e){$('#razd_body').html(e)})
		})

		$('#but_news').click(function (){
			$('#razd_header').text('Новости');
			$('#razd_buttons').html('<button onclick="createNews()">Создать новость</button><button onclick="deleteNews()">Удалить новость</button>');
		})

		function createNewUsers() {
			let login = prompt("Логин нового пользователя", '');
			let pass = prompt("Пароль нового пользователя", '');
			let fami = prompt("Фамилия нового пользователя", '');
			let imya = prompt("Имя нового пользователя", '');
			let otch = prompt("Отчество нового пользователя", '');
			let perm = prompt("Права нового пользователя (1-админ, 2-модератор, 3-копирайтер)", '');
			$.post('../api/createNewUsers.php',{login:login, password:pass, familiya:fami, imya:imya, otch:otch, permission:perm},function (e){alert(e)});
			$('#but_users').click();
		}

		function createNewPage(){
			$('#razd_title').text('Создание страницы');
			$.get('../api/formCreatePage.php',function(e){$('#razd_body').html(e)})
		}

		function createNews(){
			$('#razd_title').text('Создание новости');
			$.get('../api/formCreateNews.php',function(e){$('#razd_body').html(e)})
		}

		function deleteUsers() {
			let id = prompt("Для удаления пользователя введите его id", '');
			$.post('../api/deleteUsers.php',{id:id},function (e){alert(e)});
			$('#but_users').click();
		}
	</script>
</body>
</html>