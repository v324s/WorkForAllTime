<?
include "../include/settings.php";
include "../include/adm_settings.php";

$querry='SELECT * FROM users';
$h=mysqli_query($db,$querry);
echo "<table>
			<tr>
				<td>id
				<td>Логин
				<td>Пароль
				<td>Фамилия
				<td>Имя
				<td>Отчество
				<td>Дата регистрации
				<td>Время регистрации
				<td>Права
			</tr>";
for ($i=0; $i < mysqli_num_rows($h); $i++) {
	$arr=mysqli_fetch_array($h);
	echo "	<tr>
				<td>".$arr['id']."
				<td>".$arr['login']."
				<td>".$arr['password']."
				<td>".$arr['user_familiya']."
				<td>".$arr['user_imya']."
				<td>".$arr['user_otch']."
				<td>".$arr['reg_date']."
				<td>".$arr['reg_time']."
				<td>".$arr['permission']."
			</tr>";
}
echo "</table>";
?>