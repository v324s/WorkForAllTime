<?
include('include/settings.php');
include('include/guard.php');

if ($_GET['act']=='logout') {
	$idses=$_COOKIE['sesid'];
	setcookie('acctoken','');
	setcookie('code','');
	setcookie('user_id','');
	header('location:index');
}
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
	<script type="text/javascript">
		gnslide=true;
	</script>
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
		<div class="seyvkino">
			<?
				include('include/shapka.php');
			?>
	
			<div class="dlyazagsvk">
				<div class="zagolovoksvk">сейчас в кино</div>
			</div>
			<div class="podcarusel">
				<div class="owl-carousel content-list">
					<?
						$res=mysqli_query($con,"SELECT * from seyvkino");
						$skokrow=mysqli_num_rows($res);
						if ($skokrow>0) {
							for ($i=0; $i < $skokrow ; $i++) { 
								$svkino=mysqli_fetch_array($res);
								echo '<div class="item itemfilm" onmouseover="gnslide=false;" onmouseout="gnslide=true;" style="background-image:url('.$svkino['oblozhka'].')">
										<div style="overflow: hidden;bottom:-4px;width:100%;position: absolute;">
										<img src="'.$svkino['oblozhka'].'" style="width: 100%;position: absolute;left: 0;bottom: 1px;filter: blur(3px);">
										<div class="overlay" style="z-index: 1;position: relative;background-color:#000000b5">
											<div class="infaofilmesvk">
												<div class="nazvaniesvk">'.$svkino['nazvanie'].'</div>
												<div class="zhanrsvk">'.$svkino['zhanr'].'</div>
											</div>
											<div class="actionfilmsvk">
												<div class="podrobsvk" onclick="podrob(id);" id="'.$svkino['id'].'">подробнее</div>
												<div class="buyticketsvk" onclick="buytick(id);" id="'.$svkino['id'].'">купить билеты</div>
											</div>
										</div>
										</div>
									</div>';
							}
						}
					?>
				</div>
			</div>
		</div>
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
		</div>
		<div class="footer">
			<div class="txtfooter">
				Дипломный проект <br>студента Димитровградского Технического Колледжа гр. П-41<br> Гусева Владислава Евгеньевича<br>2019
			</div>
		</div>
	</div>
</section>
<script type="text/javascript" src="js/fixbagmenu.js"></script>
<script type="text/javascript" src="js/getfilm.js"></script>
<script src="js/jquery.min.js"></script>
<script src="js/owl.carousel.min.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		$('.owl-carousel').owlCarousel({
    loop:true,
    margin:5,
    nav:true,
    responsive:{
        0:{
            items:1
        },
        600:{
            items:3
        },
        1000:{
            items:5
        }
    }
});
		function gonextslide() {
			if (gnslide==true) {
				but=document.getElementsByClassName('owl-next');
				$(but).click();
			}
		}
		setInterval(gonextslide,3000);
	});
	</script>
	<?
		if ($_GET['act']=='login') {
			echo '<script type="text/javascript">voyti();</script>';
		}
	?>
</body>
</html>