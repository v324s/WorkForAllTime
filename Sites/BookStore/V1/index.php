<?
	include 'include/settings.php';
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link href="fonts/css.css" rel="stylesheet">
	<title>Книжный дизайн</title>
	<link rel="stylesheet" type="text/css" href="css/main.css">
</head>
<body>
	<?
	include 'include/site-header.php';
	?>
	<section style="position: relative;">
		<section class="bokblock">
			<?
			include 'include/site-ads.php';
			?>
		</section><main class="osnovcontent">
			<div class="textosnovi" style="padding-top: 5%">
				<center><h3>Книжный интернет-магазин «Книжный дизайн»</h3></center>
				<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;«Книжный дизайн» – крупный интернет-магазин книг, успешно работающий в Димитровграде и других регионах России. В нём вы можете заказывать книги в любое время 24 часа в сутки.<br>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;В интернет-магазине «Книжный дизайн» вы найдёте книги на любой вкус, для этого мы сделали удобный каталог, тематические подборки и специальные акции.
	Уверены, вам понравится наш книжный интернет-магазин. Добро пожаловать!</p>
				<div class="marginbuton">
					<div id="buttongokatal" onclick="window.location.href='katalog';">Перейти к каталогу</div>
				</div>
			</div>
		</main><section class="bokblock"></section>
	</section>
	<?
	include 'include/site-footer.php';
	?>
</body>
</html>