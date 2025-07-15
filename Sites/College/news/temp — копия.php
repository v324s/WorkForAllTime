
<!DOCTYPE html>
<html lang="ru">
<head>
	<?
include('../include/head_1lvl.php');
	?>
	<title>ОГБПОУ "ДМК" | Привет</title>
</head>
<body>
	<div class='bg-for-big-menu'></div>
	<div class='body'>
		<div class='big-menu'></div>
		<div id='kostil-for-header' style='width: 100%;height: 0px;'></div>
		<?
include('../include/page-header.php');
		?>
		<section>
			<section class='sp-title'>
				<div class='sp-title_container'>
					<p class='sp-title_p'>
						<span><strong>Областное государственное бюджетное профессиональное образовательное учреждение</strong></span><br>
						<span><strong>«Димитровградский музыкальный колледж»</strong></span>
					</p>
				</div>
			</section>
			<section>
				<h3>Продление дистанта</h3>
				<article class='art-body'>ДРАТУТИ
				</article>
				<?
				include ('../include/page-links-inf-res.php');
				?>
			</section>
			<script type="text/javascript">
				$.post('../api/addViewNew.php',{newsId:1},function (e){console.log(e)});
			</script>
		</section>
		<?
			include ('../include/page-footer.php');
		?>
	</div>
</body>
</html>
