<?
include "../include/settings.php";

if ($_POST['newId']) {
	$querry='SELECT viewers FROM news WHERE id='.$_POST['newId'];
	if ($querry) {
		$h=mysqli_query($db,$querry);
		$h=mysqli_fetch_array($h);
		$k=$h[0]+1;
		$querry='UPDATE news SET viewers='.$k.' WHERE id='.$_POST['newId'];
		$h=mysqli_query($db,$querry);
	}
}
?>