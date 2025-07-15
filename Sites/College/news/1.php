
<!DOCTYPE html>
<html lang="ru">
<head>
	<?
include('../include/head_1lvl.php');
	?>
	<title>ОГБПОУ "ДМК" | Привет</title>
	<script type="text/javascript">
		newId=1;
	</script>
	<script type="text/javascript" src="../js/addViewNew.js"></script>
</head>
<body>
	<div class='bg-for-big-menu'></div>
	<div class='body'>
		<div class='big-menu'></div>
		<div id='kostil-for-header' style='width: 100%;height: 0px;'></div>
		<?
include('../include/page-header_1lvl.php');
		?>
		<section>
			<section class="sp-title">
				<div class="sp-title_container">
					<p class="sp-title_p">
						<span><strong>Навигация</strong></span><br>
						<span><strong><a class="footer-a" href="../index.php">Главная</a> <i class="fa fa-angle-right" aria-hidden="true"></i> <a class="footer-a" href="../news.php">Новости</a> <i class="fa fa-angle-right" aria-hidden="true"></i> Продление дистанта</strong></span>
					</p>
				</div>
			</section>
			<section>
				<article class='art-body'>
					<head>
						<h3>Продление дистанта</h3>
						<div>
							<div><i class="fa fa-eye" aria-hidden="true"></i><span id="countViewers"></span></div>
							<div><i class="fa fa-calendar" aria-hidden="true"></i><span id="addDate"></span></div>
						</div>
					</head>
					<section>ДРАТУТИ</section>
				</article>
				<?
				include ('../include/page-links-inf-res.php');
				?>
			</section>
			<script type="text/javascript" src="../js/getDopInfoNew.js"></script>
		</section>
		<?
			include ('../include/page-footer.php');
		?>
	</div>
</body>
</html>
