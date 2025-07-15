<?
if ($_POST['group'] && $_POST['fio'] && $_POST['email']) {
	$group=$_POST['group'];
	$fio=$_POST['fio'];
	$email=$_POST['email'];
	file_put_contents("users.txt", $group.' | '.$fio.' | '.$email."\r\n", FILE_APPEND);
	echo "ok";
}
?>