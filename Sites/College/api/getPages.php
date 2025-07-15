<?
include "../include/settings.php";
include "../include/adm_settings.php";

$querry='SELECT * FROM pages';
$h=mysqli_query($db,$querry);
echo "<table>
			<tr>
				<td>id
				<td>Имя файла
				<td>Название
				<td>Ссылка
				<td>Создал
				<td>Дата создания
				<td>время создания
			</tr>";
for ($i=0; $i < mysqli_num_rows($h); $i++) {
	$arr=mysqli_fetch_array($h);
	echo "	<tr>
				<td>".$arr['id']."
				<td>".$arr['name']."
				<td>".$arr['title']."
				<td><a target='_blank' href=".domen.$arr['link'].">".$arr['link']."</a>
				<td onclick='$.post(\"".domen."/api/getUserById.php\",{id:".$arr['creator_id']."},function(e){alert(e)})'>".$arr['creator_id']."
				<td>".$arr['creat_date']."
				<td>".$arr['creat_time']."
			</tr>";
}
echo "</table>";
?>