<?
	session_start();
	include 'include/settings.php';
	include 'include/cart.php';

	// Получаем id книги
	if ($_GET['book']) {
		$getid=$_GET['book'];
		// Ищем книгу в БД
		$books=mysqli_query($conn,"SELECT * from books where id='$getid'");
		$skokbooks=mysqli_num_rows($books);
		if ($skokbooks==0) {
			// Если книгу не нашли, то отправляем на каталог
			header("Location: katalog");
		}else{
			$book=mysqli_fetch_array($books);

			// Получаем отзывы о книге
			$score=mysqli_query($conn,"SELECT `score` FROM `otzivi` WHERE `bid`='$getid'");
			$countScores=mysqli_num_rows($score);
			
			// Считаем среднюю оценку книги на основе отзывов
			if ($countScores > 0) {
				$tempScore = 0;
				for ($i=0; $i < $countScores; $i++) { 
					$tempArr = mysqli_fetch_assoc($score);
					$tempScore+=$tempArr['score'];
				}
				$globalScore = number_format($tempScore/$countScores, 1);
			}else{
				$globalScore = number_format(0, 1);
			}
		}
	}else{
		// если не получили id книги, отправляем на каталог
		header("Location: katalog");
	}
	

	// Функция обработки нового отзыва
	if ($_GET['book'] && isset($_SESSION['user_id']) && $_POST['otziv'] && $_POST['score']) {
		$bid = $_GET['book'];
		$uid = $_SESSION['user_id'];
		$score = $_POST['score'];
		$time = time();
		isset($_POST['text']) ? $text = $_POST['text'] : false;
		if ($text) {
			$result = mysqli_query($conn,"INSERT INTO otzivi(`bid`,`uid`,`score`,`text`,`time`) VALUES ('$bid','$uid','$score','$text','$time')");
		}else{
			$result = mysqli_query($conn,"INSERT INTO otzivi(`bid`,`uid`,`score`,`time`) VALUES ('$bid','$uid','$score','$time')");
		}
		header('Location: inf?book='.$_GET['book']);
	}
?>	
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Dream Library | <? echo $book['name']; ?></title>
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<style>
		.p-1rem{
			padding: 1rem;
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
				<div>
					<div>
						<div style="display: inline-block;padding-right: 3%;width: 52%;">
							<img style="width: 100%;" src="<? echo $book['img']; ?>">
						</div><div style="display: inline-block;vertical-align: top;width: 45%;">
							<div style="padding: 3%;background-color: #f2f2f2;position: relative;">
								<div class="infname" style="position: relative;z-index: 10;"><? echo $book['name']; ?></div>
								<div class="infavtor" style="position: relative;z-index: 10;"><? echo $book['avtor']; ?></div>
								<div style="position: absolute;z-index: 1;font-size: 3rem;font-weight: bold;color: #c8beff;right: 10px;bottom: 0;opacity: 0.5;">★ <?php echo $globalScore;?></div>
							</div>
							<div>
								<?
								// Выводим данные о книге
								if ($book['izdatelstvo']) {
									?>
										<div class="intstring">
											<div class="infleftstr">Издательство</div><div class="infrightstr"><? echo $book['izdatelstvo']; ?></div>
										</div>
									<?
								}
								if ($book['seria']) {
									?>
										<div class="intstring">
											<div class="infleftstr">Серия</div><div class="infrightstr"><? echo $book['seria']; ?></div>
										</div>
									<?
								}
								if ($book['godidat']) {
									?>
										<div class="intstring">
											<div class="infleftstr">Год издания</div><div class="infrightstr"><? echo $book['godidat']; ?></div>
										</div>
									<?
								}
								if ($book['kolvostr']) {
									?>
										<div class="intstring">
											<div class="infleftstr">Кол-во страниц</div><div class="infrightstr"><? echo $book['kolvostr']; ?></div>
										</div>
									<?
								}
								if ($book['format']) {
									?>
										<div class="intstring">
											<div class="infleftstr">Формат</div><div class="infrightstr"><? echo $book['format']; ?></div>
										</div>
									<?
								}
								if ($book['tipoblozh']) {
									?>
										<div class="intstring">
											<div class="infleftstr">Тип обложки</div><div class="infrightstr"><? echo $book['tipoblozh']; ?></div>
										</div>
									<?
								}
								if ($book['ves']) {
									?>
										<div class="intstring">
											<div class="infleftstr">Вес</div><div class="infrightstr"><? echo $book['ves']; ?></div>
										</div>
									<?
								}
								if ($book['vozogr']) {
									?>
										<div class="intstring">
											<div class="infleftstr">Возрастные ограничения</div><div class="infrightstr"><? echo $book['vozogr']; ?></div>
										</div>
									<?
								}
								if ($book['annotacia']) {
									?>
										<br>
										<div class="intstring">
											<div class="infleftstr">Аннотация</div>
										</div>
										<div class="intstring">
											<div class="infrightstr"><? echo $book['annotacia']; ?></div>
										</div>
									<?
								}
								?>
							</div>
						</div>
					</div>
					<div>
						<div style="padding: 3%;background-color: #f2f2f2;">
							<div class="infname">Отзывы</div>
						</div>
						<div>
						<?php
						// Выводим отзывы о книге
						$otzivi=mysqli_query($conn,"SELECT `otzivi`.`id`, `otzivi`.`bid`, `otzivi`.`uid`, `otzivi`.`score`, `otzivi`.`text`, `otzivi`.`time`, `users`.`first_name`, `users`.`last_name` FROM `otzivi` JOIN `users` ON `users`.`id` = `otzivi`.`uid` WHERE `otzivi`.`bid`='$getid'");
						$countOtzivi=mysqli_num_rows($otzivi);
						if ($countOtzivi>0) {
							
							for ($i=0; $i < $countOtzivi; $i++) { 
								$otziv=mysqli_fetch_assoc($otzivi);
								?>
								<div style="padding: 1rem">
									<div style="padding: 1rem;-webkit-box-shadow: 0px 0px 8px 0px rgba(34, 60, 80, 0.2);-moz-box-shadow: 0px 0px 8px 0px rgba(34, 60, 80, 0.2);box-shadow: 0px 0px 8px 0px rgba(34, 60, 80, 0.2);">
										<div style="color: #09bfff;font-weight: bold;"><? echo $otziv['first_name'].' '.mb_substr($otziv['last_name'], 0, 1).'.'; ?></div>
										<div style="font-size: 20px;font-weight: bold;color: #b6beff;">★ <? echo $otziv['score']; ?></div>
										<div style="padding: 1.5rem 0;"><? echo $otziv['text']; ?></div>
										<div style="color: #b6beff;"><? echo date("d.m.Y", $otziv['time']); ?></div>
									</div>
								</div>
								<?
							}
						}else{
							?>
							<div class="p-1rem"><center>На данную книгу пока нет отзывов</center></div>
							<?
						}

						// Если пользователь авторизован, то выводим ему форму заполнения отзыва
						if (isset($_SESSION['user_id'])) {
							?>
							<div class="textosnovi" style="padding-top: 5%">
								<div style="width: 70%;margin: 0 auto;">
									<div style="text-align: center;font-size: 2rem;margin-top: 0;color: #12bfff;border-bottom: 0.3rem solid #ddbeff;padding: 1%;">Ваш отзыв</div>
								</div>
								<form method="POST" action="inf?book=<? echo $_GET['book']; ?>" style="width: 50%;display: block;margin: 0 auto;margin-top: 2rem;">
									<p>Ваша оценка книге: ★ <font id="userBookScore">5</font></p>
									<input type="range" name="score" style="width:100%" min="1" max="5" value="5" oninput="document.getElementById('userBookScore').innerText = this.value" onchange="document.getElementById('userBookScore').innerText = this.value">
									<textarea name="text" class="oknotextinput" placeholder="Напишите свой отзыв об этой книге" style="width: 96%; height:4rem;border: none;display: block;font-size: 1.2rem;padding: 2%;border-bottom: 0.1rem solid #11bfff;"></textarea>
									<input type="submit" name="otziv" value="Оставить" class="#buttongokatal" style="position: relative;text-align: center;background: linear-gradient(229deg, #09bfff, #f0beff);padding: 1rem;color: white;margin-top: 1.5rem;width: 100%;border: none;letter-spacing: 2px;font-size: 20px;font-weight: 500;border-radius: 10px;">
								</form>
										
							</div>
							<?
						}
						?>
						</div>
					</div>
				</div>
			</div>
		</main><section class="bokblock">
			<div class="infpodcennik">
				<div class="cena" style="font-size: 24px;"><? echo $book['cena']; ?> ₽</div>
				<div class="infbutbuy" style="position: relative;display: flex;" <? echo 'onclick="window.location.href=\'inf?book='.$book['id'].'&addtocart='.$book['id'].'\'"'; ?>><div style="background-image: url('img/ico/wshopping_cart_PNG38.png');width: 36px;height: 36px;margin:auto;background-size: cover;"></div><div style="margin:auto;padding-right: 26%;">Купить</div></div>
				<div class="infbutfav" style="position: relative;display: flex;" <? echo 'onclick="window.location.href=\'inf?book='.$book['id'].'&addtofav='.$book['id'].'\'"'; ?>><div style="margin:auto;">В желаемое</div></div>
			</div>
		</section>
	</section>
	<?
	include 'include/site-footer.php';
	?>
</body>
</html>
