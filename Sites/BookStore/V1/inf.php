<?
	include 'include/settings.php';
	include 'include/cart.php';
	if ($_GET['book']) {
		$getid=$_GET['book'];
		$books=mysql_query("SELECT * from books where id='$getid'");
		$skokbooks=mysql_num_rows($books);
		if ($skokbooks==0) {
			header("Location: katalog");
		}else{
			$book=mysql_fetch_array($books);
		}
	}
	if ($_GET['addtocart']) {
		header('Location: inf?book='.$_GET['book']);
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link href="fonts/css.css" rel="stylesheet">
	<title>Книжный дизайн | <? echo $book['name']; ?></title>
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
			<div class="osnovapodbooks">
				<div>
					<div>
						<div style="display: inline-block;padding-right: 3%;width: 52%;">
							<img style="width: 100%;" src="<? echo $book['img']; ?>">
						</div><div style="display: inline-block;vertical-align: top;width: 45%;">
							<div style="padding: 3%;background-color: #f2f2f2;">
								<div class="infname"><? echo $book['name']; ?></div>
								<div class="infavtor"><? echo $book['avtor']; ?></div>
							</div>
							<div>
								<?
								if ($book['izdatelstvo']) {
									echo '<div class="intstring">
											<div class="infleftstr">Издательство</div><div class="infrightstr">'.$book['izdatelstvo'].'</div>
										  </div>';
								}
								if ($book['seria']) {
									echo '<div class="intstring">
											<div class="infleftstr">Серия</div><div class="infrightstr">'.$book['seria'].'</div>
										  </div>';
								}
								if ($book['godidat']) {
									echo '<div class="intstring">
											<div class="infleftstr">Год издания</div><div class="infrightstr">'.$book['godidat'].'</div>
										  </div>';
								}
								if ($book['kolvostr']) {
									echo '<div class="intstring">
											<div class="infleftstr">Кол-во страниц</div><div class="infrightstr">'.$book['kolvostr'].'</div>
										  </div>';
								}
								if ($book['format']) {
									echo '<div class="intstring">
											<div class="infleftstr">Формат</div><div class="infrightstr">'.$book['format'].'</div>
										  </div>';
								}
								if ($book['tipoblozh']) {
									echo '<div class="intstring">
											<div class="infleftstr">Тип обложки</div><div class="infrightstr">'.$book['tipoblozh'].'</div>
										  </div>';
								}
								if ($book['ves']) {
									echo '<div class="intstring">
											<div class="infleftstr">Вес</div><div class="infrightstr">'.$book['ves'].'</div>
										  </div>';
								}
								if ($book['vozogr']) {
									echo '<div class="intstring">
											<div class="infleftstr">Возрастные ограничения</div><div class="infrightstr">'.$book['vozogr'].'</div>
										  </div>';
								}
								if ($book['annotacia']) {
									echo '<br><div class="intstring">
											<div class="infleftstr">Аннотация</div>
										  </div>
										  <div class="intstring">
											<div class="infrightstr">'.$book['annotacia'].'</div>
										  </div>';
								}
								?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</main><section class="bokblock">
			<div class="infpodcennik">
				<div class="cena" style="font-size: 24px;"><? echo $book['cena']; ?> ₽</div>
				<div class="infbutbuy" style="position: relative;display: flex;" <? echo 'onclick="window.location.href=\'inf?book='.$book['id'].'&addtocart='.$book['id'].'\'"'; ?>><div style="background-image: url('img/ico/wshopping_cart_PNG38.png');width: 36px;height: 36px;margin:auto;background-size: cover;"></div><div style="margin:auto;padding-right: 26%;">Купить</div></div>
			</div>
		</section>
	</section>
	<?
	include 'include/site-footer.php';
	?>
</body>
</html>