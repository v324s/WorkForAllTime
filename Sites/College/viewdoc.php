
<!DOCTYPE html>
<html lang="ru">
<head>
	<?
include('include/head.php');
	?>
	<title>ОГБПОУ "ДМК" | Привет</title>
</head>
<body>
	<div class='bg-for-big-menu'></div>
	<div class='body'>
		<div class='big-menu'></div>
		<div id='kostil-for-header' style='width: 100%;height: 0px;'></div>
		<?
include('include/page-header.php');
		?>
		<section>

				<embed src="<? echo $_GET['urldoc']; ?>" style="width: 100%;height: 82vh;" />
			</section>
		</section>
		<?
			include ('include/page-footer.php');
		?>
	</div>
</body>
</html>
