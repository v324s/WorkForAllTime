<?php
session_start ();
header('content-type: text/html; charset= utf-8');
if (!empty ($_SESSION['admin'])){
	if ($_SESSION['admin']){exit;}}
$_SESSION['admin'] = false;
$admlog='admin';
$admpass='admin';

function NeVoshel (){
			echo '<html>
				<head>
				<title>Админ-панель</title>
				<meta http-equiv="content-type" content="text/html; charset=utf-8">
				<style type=text/css>
					body{
						background-color: #fff;}
					div{
						background: url(bg.jpg); 
						background-position: top; 
						background-repeat:no-repeat; 
						height: auto; 
						width: auto;}
					#wrap{
						width: 100%;
						height: 100%;}
					#wraptd{
						padding: 20px;}
					.loginbox1{
						font-size: 30px;
						font-weight: bold; 
						width: 300px;
						padding: 4px;
						border: 3px solid #000;
						background-color: rgba(0%,0%,100%,0.5);
						color: white;
						font-weight: bold;}
					.loginbox2{
						width: 300px;
						padding: 4px;
						border: 3px solid #000;
						color: #0000ff; 
						background-color: rgba(0%,0%,0%,0.5);}
					.loginbox22 {
						height: 35px; 
						font-size: 19px; 
						font-weight: bold; 
						width: 200px;
						margin: 3px 0;
						border: solid 3px #000; 
						color: #0000ff;}
					.button{ 
					    color: #000;
					    transition: 0.2s;
					    height: 35px; 
						font-size: 19px; 
						font-weight: bold; 
						width: 200px;
						margin: 3px 0;
						border: solid 3px #000;}
					.button:hover{
					  background: rgba(255,255,255,.2);}
					.button:active{
					  background: rgba(0%,0%,100%,0.5); }</style>
				</head>
				<body>
				<center>
				<div><br><br><br><br>
				<table cellpadding=0 cellspacing=0 id=wrap>
				<tr>
					<td align=center id=wraptd>
						<table cellpadding=0 cellspacing=0>
						<tr>
							<td class=loginbox1 align=center>Вход в админку</td>
						</tr>
						<tr>
							<td class=loginbox2 align=center>
							<form action=admin.php method=post>
								<input class=loginbox22 type=text name=login placeholder="Логин"><br>
								<input class=loginbox22 type=password name=password placeholder="Пароль"><br>
								<input class="button" type=submit value=Войти>
							</form>
							</td>
						</tr>
						</table>
					</td>
				</tr>
				</table>
				</div>
				</center>
				</body>
				</html>';
			exit;}
			if (!$_POST) NeVoshel ();
			if (!$_POST['login']) NeVoshel ();
			if (!$_POST['password']) NeVoshel ();
			if ($_POST['login']!= $admlog) NeVoshel ();
			if ($_POST['password']!= $admpass) NeVoshel ();
			$_SESSION['admin'] = true;
			?>

			<html>
			<head>
			<title>Админ-панель</title>
			<style type=text/css>
				#wrap{
					width: 100%;
					height: 100%;}
				.loginbox1{
					width: 300px;
					padding: 4px;
					border: 1px solid #777;
					background-color: #777;
					color: white;
					font-weight: bold;}
				.loginbox2{
					width: 300px;
					padding: 4px;
					border: 1px solid #777;
					color: #777;}
			</style>
			<meta http-equiv="content-type" content="text/html; charset=utf-8">
			<meta http-equiv="Refresh" content="1; URL=adminka.php">
			</head>
			<body>
			<center>
			<table cellpadding=0 cellspacing=0 id=wrap>
			<tr>
				<td align=center>
					<table cellpadding=0 cellspacing=0>
					<tr>
						<td class=loginbox1 align=center>Вход выполнен</td>
					</tr>
					</table>
				</td>
			</tr>
			</table>
			</center>
			</body>
			</html>