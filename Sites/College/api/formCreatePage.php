<?
include "../include/settings.php";
include "../include/adm_settings.php";
session_start();
?>
<div>Имя файла <input type="text" id="filename" value="file.php"></div>
<div>Название страницы <input type="text" id="namepage"></div>
<div><span id="domen"><? echo domen ?>file.php</span></div>
<div id="domen_folders" onload="$.get('../api/getFolders.php',{dir:<? echo domen ?>}, function (e) {$(this).html(e)})"></div>
