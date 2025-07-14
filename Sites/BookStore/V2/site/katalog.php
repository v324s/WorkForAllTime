<?
	session_start();
	include 'include/settings.php';
	include 'include/cart.php';
	// if ($_GET['addtocart'] && isset($_SESSION['user_id'])) {
	// 	header('Location: katalog');
	// }elseif ($_GET['addtocart'] && !isset($_SESSION['user_id'])) {
	// 	header('Location: profile');
	// }


?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Dream Library | Каталог</title>
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<style>
		select {
			-webkit-box-shadow: 0px 0px 8px 0px rgba(34, 60, 80, 0.4);-moz-box-shadow: 0px 0px 8px 0px rgba(34, 60, 80, 0.4);box-shadow: 0px 0px 8px 0px rgba(34, 60, 80, 0.4);
			background-color: white; 
			border: none; 
			padding: 1em;
			font-size: 14px;
			cursor: pointer;
			width: 200px; 
		}
	</style>
</head>
<body>
	<?
	include 'include/site-header.php';
	?>
	<section style="position: relative;">
		<section class="bokblock">
		</section><main class="osnovcontent">
			<div class="osnovapodbooks">
				<div class="namepage">Каталог</div>
				<?
				if ($_GET['sort'] && $_GET['search'] == false) {
					switch ($_GET['sort']) {
						case 'aya':
							$selectedoption = '<option disabled="" selected="">По алфавиту А-Я</option>';
							$books=mysqli_query($conn,"SELECT * from books order by name");
							break;
						case 'yaa':
							$selectedoption = '<option disabled="" selected="">По алфавиту Я-А</option>';
							$books=mysqli_query($conn,"SELECT * from books order by name desc");
							break;
						case 'godup':
							$selectedoption = '<option disabled="" selected="">По году выхода (по возрастанию)</option>';
							$books=mysqli_query($conn,"SELECT * from books order by godidat");
							break;
						case 'goddown':
							$selectedoption = '<option disabled="" selected="">По году выхода (по убыванию)</option>';
							$books=mysqli_query($conn,"SELECT * from books order by godidat desc");
							break;
						case 'cenaup':
							$selectedoption = '<option disabled="" selected="">По цене (по возрастанию)</option>';
							$books=mysqli_query($conn,"SELECT * from books order by cena");
							break;
						case 'cenadown':
							$selectedoption = '<option disabled="" selected="">По цене (по убыванию)</option>';
							$books=mysqli_query($conn,"SELECT * from books order by cena desc");
							break;
					}
					$skokbooks=mysqli_num_rows($books);
				}elseif ($_GET['search']) {
					$search = $_GET['search'];
					$books=mysqli_query($conn,"SELECT * FROM books WHERE `name` LIKE LOWER(CONCAT('%', '$search' , '%')) OR `annotacia` LIKE LOWER(CONCAT('%', '$search' , '%'))");
					$skokbooks=mysqli_num_rows($books);
				}else{
					$books=mysqli_query($conn,"SELECT * from books order by id desc");
					$skokbooks=mysqli_num_rows($books);
				}
				?>
				<div class="dlyafiltra">
					<div style="display:flex">
						<div style="margin:auto">
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
					</div>
					<div>
						<form method="GET" style="-webkit-box-shadow: 0px 0px 8px 0px rgba(34, 60, 80, 0.4);-moz-box-shadow: 0px 0px 8px 0px rgba(34, 60, 80, 0.4);box-shadow: 0px 0px 8px 0px rgba(34, 60, 80, 0.4);">
							<div style="display:flex">
								<?
								if ($_GET['search']) {
									echo '<input type="text" style="margin:auto;border: none;padding: 1em;" name="search" placeholder="Поиск" value="'.$_GET['search'].'">';
								}else{
									echo '<input type="text" style="margin:auto;border: none;padding: 1em;"  name="search" placeholder="Поиск">';
								}
								?>
								<div style="margin:auto;display:flex;padding: 0.7em;background-color: #24bfff;">
									<input type="submit" value="" style="margin:auto;background-image:url('img/ico/lupa.svg');width: 20px;height: 20px;background-color: #24bfff;background-position: center;background-repeat: no-repeat;background-size: contain;border: none;">
								</div>
							</div>
						</form>
					</div>
					<div style="display:flex">
						<div style="display: inline-block; margin:auto">Найдено <b><? echo $skokbooks; ?></b> товаров(-а)
						</div>
					</div>
				</div>
				<div style="text-align: center">
				<?
				for ($i=0; $i < $skokbooks; $i++) { 
					$book=mysqli_fetch_array($books);
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
