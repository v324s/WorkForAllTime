<?
	include 'include/settings.php';
	include 'include/cart.php';
	if ($_GET['addtocart']) {
		header('Location: katalog');
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link href="fonts/css.css" rel="stylesheet">
	<title>Книжный дизайн | Каталог</title>
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
				<div class="namepage">Каталог</div>
				<?
				if ($_GET['sort']) {
					switch ($_GET['sort']) {
						case 'aya':
							$selectedoption = '<option disabled="" selected="">По алфавиту А-Я</option>';
							$books=mysql_query("SELECT * from books order by name");
							break;
						case 'yaa':
							$selectedoption = '<option disabled="" selected="">По алфавиту Я-А</option>';
							$books=mysql_query("SELECT * from books order by name desc");
							break;
						case 'godup':
							$selectedoption = '<option disabled="" selected="">По году выхода (по возрастанию)</option>';
							$books=mysql_query("SELECT * from books order by godidat");
							break;
						case 'goddown':
							$selectedoption = '<option disabled="" selected="">По году выхода (по убыванию)</option>';
							$books=mysql_query("SELECT * from books order by godidat desc");
							break;
						case 'cenaup':
							$selectedoption = '<option disabled="" selected="">По цене (по возрастанию)</option>';
							$books=mysql_query("SELECT * from books order by cena");
							break;
						case 'cenadown':
							$selectedoption = '<option disabled="" selected="">По цене (по убыванию)</option>';
							$books=mysql_query("SELECT * from books order by cena desc");
							break;
					}
					$skokbooks=mysql_num_rows($books);
				}else{
					$books=mysql_query("SELECT * from books order by id desc");
					$skokbooks=mysql_num_rows($books);
				}
				?>
				<div class="dlyafiltra">
					<div>
						<select id="sortuse" onchange="window.location.href=this.value">
							<?
							if ($selectedoption){
								echo $selectedoption;
							}else{
								echo '<option disabled="" selected="">Недавно добавленные</option>';
							}
							?>		
							<option value="katalog">Недавно добавленные</option>
							<option value="katalog?sort=aya">По алфавиту А-Я</option>
							<option value="katalog?sort=yaa">По алфавиту Я-А</option>
							<option value="katalog?sort=godup">По году выхода (по возрастанию)</option>
							<option value="katalog?sort=goddown">По году выхода (по убыванию)</option>
							<option value="katalog?sort=cenaup">По цене (по возрастанию)</option>
							<option value="katalog?sort=cenadown">По цене (по убыванию)</option>
						</select>
					</div>
					<div style="display: inline-block;">Найдено <b><? echo $skokbooks; ?></b> товаров(-а)
					</div>
				</div>
				<?
				for ($i=0; $i < $skokbooks; $i++) { 
					$book=mysql_fetch_array($books);
					echo '<div class="blockbook">
							<div>
								<a href="inf?book='.$book['id'].'">
								<div class="imgbook" style="background-image:url('.$book["img"].');">
								</div>
								<div class="infabook">
									<div class="namebook" style="color:black;">'.$book["name"].'
									</div>
									<div class="avtorbook">'.$book["avtor"].'
									</div>
								</div>
								</a>
								<div class="podcenandbut">
									<div class="podcenu">
										<div class="cena">'.$book["cena"].' ₽</div>
									</div>
									<div>
										<div class="butbuy" onclick="window.location.href=\'katalog?addtocart='.$book['id'].'\';">Купить</div>
									</div>
								</div>
							</div>
						  </div>';
				}
				?>
			</div>
		</main><section class="bokblock">
			<div class="podfilter">
				
			</div>
		</section>
	</section>
	<?
	include 'include/site-footer.php';
	?>
</body>
</html>