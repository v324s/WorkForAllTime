<?
include('include/settings.php');
include('include/guard.php');
?>
<!DOCTYPE html>
<html>
<head>
	<link href="css/cssyanoneKaffeesatz.css" rel="stylesheet">
	<link rel="stylesheet" href="css/owl.carousel.min.css">
	<link rel="stylesheet" href="css/owl.theme.default.min.css">
	<link href="css/style.css" rel="stylesheet">
	<script src="js/jquery-1.4.4.js"></script>
	<script src="js/jquery.maskedinput-1.2.2.js"></script>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>INTERFILM | Главная</title>
</head>
<body id="body">
	<?	
		if ($actionlogin!='success') {
			include('include/vhod.php');
		}
	?>
<div class="poverhvseh" id="poverhvseh">
	<div class="borderokna" style="margin:0 auto;">
		<div class="poverhokno" style="height: auto;max-width: max-content;">
			<div class="closeokno" style="margin-top: -40px;" onclick="$('#poverhvseh').css('display','none');document.getElementById('body').style.overflowY='auto';"></div>
			<div id="resultsquery">
			</div>
		</div>
	</div>
</div>
<section class="body">
	<!-- SODERZH -->
	<div class="soderj">
		<?
				include('include/shapka.php');
			?>
		<div class="contacts">
			<div class="logoincont"></div>
			<div class="conthr"></div>
			<div>
				<div class="strokaincont">
					<div class="icocall"></div>
					<div class="txtcont">+7 (999) 123-45-81</div>
				</div>
				<div class="strokaincont">
					<div class="icopos"></div>
					<div class="txtcont">ул. Победы 32-А, Торговый Комплекс "Западный", 4 этаж</div>
				</div>
				<div class="strokaincont">
					<div class="icotime"></div>
					<div class="txtcont">ГРАФИК РАБОТЫ: ежедневно с 10:00 до 03:00</div>
				</div>
				<div class="strokaincont">
					<div class="icomail"></div>
					<div class="txtcont">interfilm@ya.ru</div>
				</div>
			</div>
			<center><img src="img/kino.jpg" class="image" id="img1" onclick="gobig(id);"><br>
			<img src="img/holl.jpg" class="image" id="img2" onclick="gobig(id);"><br>
			<img src="img/mesta.jpg" class="image" id="img3" onclick="gobig(id);"></center>
		</div>
		<div class="footer">
			<div class="txtfooter">
				Дипломный проект <br>студента Димитровградского Технического Колледжа гр. П-41<br> Гусева Владислава Евгеньевича<br>2019
			</div>
		</div>
	</div>
</section>
<script type="text/javascript">
	function gobig(id) {
		$('#poverhvseh').css('display','block');
		$('#poverhvseh').css('overflow-y','auto');
		srcimg=$('#'+id).attr('src');
		$('#body').css('overflow-y','hidden');
		document.getElementById('resultsquery').innerHTML='<img src="'+srcimg+'" class="image" id="img1" style="width:100%;">';
	}
	
</script>
<script type="text/javascript" src="js/fixbagmenu.js"></script>
<script type="text/javascript" src="js/getfilm.js"></script>
<script src="js/jquery.min.js"></script>
<script src="js/owl.carousel.min.js"></script>
</body>
</html>