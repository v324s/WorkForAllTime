<?
include "../include/settings.php";

if ($_POST['newId']) {
	$querry='SELECT viewers,add_date FROM news WHERE id='.$_POST['newId'];
	if ($querry) {
		$h=mysqli_query($db,$querry);
		$h=mysqli_fetch_array($h);
		$h=json_encode($h);
		echo $h;
	}
}
?>