<?php session_start ();
header('content-type: text/html; charset= utf-8');
if (!$_SESSION['admin']) die ('<a href="admin.php">Нужно пройти авторизацию</a>');
session_destroy ();?>
<html>
<head>
<title>Административная панель</title>
<style type= «text/css»>#wrap{width: 100%;height: 100%;}.loginbox1{width: 300px;padding: 4px;border: 1px solid #777;background-color: #777;color: white;font-weight: bold;}.loginbox2{width: 300px;padding: 4px;border: 1px solid #777;color: #777;}</style>
<meta http-equiv="content-type" content="text/html; charset=utf-8">
</head>
<body>
<center>
<table cellpadding= «0» cellspacing= «0» id= «wrap»><tr><td align= «center»>
<table cellpadding= «0» cellspacing= «0»><tr><td class= «loginbox1» align= «center»>Выход выполнен</td></tr><tr><td class= «loginbox2» align= «center»><a href=admin.php>Вернуться в админку</a></td></tr><tr><td><a href=index.php>Вернуться на главную</a></td></tr>
</table></td></tr>
</table>
</center>
</body>
</html>