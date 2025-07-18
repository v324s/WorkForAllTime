<?
include('include/settings.php');
include('include/guard.php');

if ($actionlogin!='success') {
	header('Location: index');
}
$urll='https://api.vk.com/method/users.get?user_ids='.$sess_id.'&name_case=nom&fields=first_name,last_name,bdate,country,crop_photo,city,counters,domain,followers_count&v=5.80&access_token='.$sess_pass;
	$resultt = file_get_contents($urll);
	$resultt = json_decode($resultt, true);
	$us_img5=$resultt['response']['0']['crop_photo']['photo']['sizes']['3']['url'];
?>
<!DOCTYPE html>
<html>
<head>
		<link rel="stylesheet" type="text/css" href="spisok/css/normalize.css" />
		<link rel="stylesheet" type="text/css" href="css/cs-select.css" />
		<link rel="stylesheet" type="text/css" href="css/cs-skin-border.css" />
	<link href="css/cssyanoneKaffeesatz.css" rel="stylesheet">
	<link rel="stylesheet" href="css/owl.carousel.min.css">
	<link rel="stylesheet" href="css/owl.theme.default.min.css">
	<link href="css/style.css" rel="stylesheet">
	<script src="js/jquery-1.4.4.js"></script>
	<script src="js/jquery.maskedinput-1.2.2.js"></script>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>INTERFILM | Профиль</title>
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
		<style type="text/css">
			.podaviname{
				display: inline-block;
			    vertical-align: top;
			    width: 25%;
			    border: 2px solid #10baff;
			    padding: 25px;
			    border-radius: 25px;
			    background-color: #022e65;
			}
			.borderaviprof{
				width: 250px; 
				height: 250px; 
				border-radius: 50%; 
				border:2px solid white;
				margin: 0 auto;
			}
			.avaprof{
				margin-left:2px;
				margin-top:2px;
				width: 246px;
				height: 246px;
				background-repeat: no-repeat;
				background-position: center;
				border-radius: 50%;
				background-size: cover;
			}
			.ifprof{
				text-align: center; 
				font-size: 48px;
				line-height: 70px;
				text-shadow: black 2px 2px 2px;
				overflow: hidden;
				max-width: 100%;
			    width: max-content;
			    margin: 0 auto;
			}
			.funprof{
				    overflow: hidden;
				display: inline-block;
			    vertical-align: middle;
			    width: 63%;
			    border: 2px solid #10baff;
			    padding: 25px;
			    border-radius: 25px;
			    background-color: #022e65;
			    margin-left: 2%;
			    max-height: 593px;
			}
			.icprof{
				background-repeat: no-repeat;
				background-position: center;
				background-size: cover;
			   	height: 40px;
			   	width: 40px;
		        display: inline-block;
		    	vertical-align: middle;
			}
			#zapinprof{
				min-height: 459px;/*214px;*/
			    padding: 10px;
			    text-align: center;
			}
			.actprof{
				padding: 10px;
    			font-size: 30px;
    			border: 2px solid #022e65;
			}
			.actprof:hover{
				cursor: pointer;
				background-color: #043e87;
				border: 2px solid #10baff;
			}
			.menuactprof{
			    border-top: 1px solid #10baff;
				padding-top: 30px;
				padding-bottom: 30px;
			    border-bottom: 1px solid #10baff;
			}
			.resqpr{
				position: absolute;
				font-size: 30px;
				left: 0;
				right: 0;
				bottom: 50%;
			}
			.td{
			    border: 2px solid #10baff;
			    padding: 5px;
			    font-size: 24px;
			    background-color: #043e87;
			}
			td{
				border: 2px solid #10baff;
			    padding: 5px;
			    font-size: 24px;
			}
			table{
				border-collapse: collapse;
	    		text-align: center;
			}
			tbody{
				    overflow-y: scroll;
			    display: block;
			    max-height: 470px;
			}
			.onelvl{
				display: inline-block;
				vertical-align: middle;
			}
			.osnovkaq{
				overflow-y: scroll;
				    max-height: 522px;
			}
			.celblock{
				border: 2px solid #10baff;
			    width: 275px;
			    border-radius: 20px;

			        background-position: center;
    background-size: cover;
    background-repeat: no-repeat;
    position: relative;
    height: 450px;
    width: 329px;
        margin: 5px;
			}
			.obloz{
				background-position: center;
				background-size: cover;
				background-repeat: no-repeat;
				position: relative;
				height: 400px;
			}
			.nizdlyainf{
				    position: absolute;
			    width: 100%;
			    overflow: hidden;
			    bottom: 0;
			        border-radius: 20px;
			}
			.blurka{
				    position: absolute;
    left: 0;
    bottom: -22px;
    filter: blur(3px);
    width: 100%;
			}
			.pismena{
				    position: relative;
    background-color: #000000b5;
			}
			.zagolovok{
				    font-size: 28px;
    padding: 10px;
			}
			.podrobinfa{
				    font-size: 22px;
    padding: 10px 5px;
			}
			.cestatus{
				padding: 20px 0;
    font-size: 30px;
    text-transform: uppercase;
    color: #ff8100;
			}
			.prstfont{
				padding: 10px;
    			font-size: 30px;
			}
		</style>
		<div class="contacts" style="position: relative;">
			<div>
				<div class="podaviname">
					<div class="borderaviprof">
						<div style="background-image: url('<? echo $us_img5; ?>');" class="avaprof"></div>
					</div>
					<div class="ifprof"><? echo $us_imya.' '.$us_fama; ?></div>
					<div class="menuactprof">
						<div class="actprof" id="predseans">
							<div style="background-image: url('img/seans2.png');" class="icprof"></div>
							Предстоящие сеансы
						</div>
						<div class="actprof" id="historyact">
							<div style="background-image: url('img/historyop2.png');" class="icprof"></div>
							История активности
						</div>
					</div>

						<div style="position: relative;height: 54px;    padding-top: 25px;">
						<div class="actprof" style="position: absolute;right: 0;" onclick="window.location.href='index?act=logout';">
							<div style="background-image: url('img/vihod.png');" class="icprof"></div>
							Выйти
						</div>
						</div>
				</div>
				<div class="funprof">
					<div id="zapinprof" style="text-align: center;position: relative;">
						<div class="prstfont">Предстоящие сеансы</div>
						<?
								$statusq='В ожидании';
								$statupd='Подтверждено';
	$searchps=mysqli_query($con,"SELECT * from broni where vkid='$sess_id'");
	$skokres=mysqli_num_rows($searchps);
	$k=0;
	$naidenofilmov=0;
	if ($skokres>0) {
		echo "<div class='osnovkaq'>";
		for ($i=0; $i < $skokres; $i++) { 
			$infa=mysqli_fetch_array($searchps);
			$idfilma=$infa["idfilm"];
			$hsmesto=$infa['mesta'];
			$seydata=date('d.m.Y');

			$time=date('H');
			if ($time=='23') {
				$time='00';
			}else{
				$time=date('H')+1;
			}

			$tim=date('i:s');
			$seytime=$time.':'.$tim;
			$nochdata=date('d.m.Y', time() - 86400);
			if ($seytime[1]==':') {
				$seytime='0'.$seytime;
			}
			#echo $seydata.' - '.$seytime.' ('.$infa['timefilm'].'>)<br>';
			if ($infa['datka']==$seydata && $infa['timefilm']>$seytime && ($infa['status']==$statusq || $infa['status']==$statupd) || $infa['datka']==$nochdata && $infa['timefilm'][0][1]>'00' && $infa['timefilm'][0][1]<'06' && $infa['timefilm']>$seytime && ($infa['status']==$statusq || $infa['status']==$statupd)) {
				$naidenofilmov++;
				if ($k==0) {
					echo "<div>";
				}
				$masmes=explode(', ', $hsmesto);
				$skokmesttam=count($masmes);
				for ($i=0; $i < $skokmesttam ; $i++) { 

					if ($masmes[$i]>0 && $masmes[$i]<12) {
						$ryadmesta=1;
					}elseif ($masmes[$i]>11 && $masmes[$i]<25) {
						$ryadmesta=2;
					}elseif ($masmes[$i]>24 && $masmes[$i]<40) {
						$ryadmesta=3;
					}elseif ($masmes[$i]>39 && $masmes[$i]<55) {
						$ryadmesta=4;
					}elseif ($masmes[$i]>54 && $masmes[$i]<70) {
						$ryadmesta=5;
					}elseif ($masmes[$i]>69 && $masmes[$i]<85) {
						$ryadmesta=6;
					}elseif ($masmes[$i]>84 && $masmes[$i]<100) {
						$ryadmesta=7;
					}elseif ($masmes[$i]>99 && $masmes[$i]<115) {
						$ryadmesta=8;
					}elseif ($masmes[$i]>114 && $masmes[$i]<130) {
						$ryadmesta=9;
					}elseif ($masmes[$i]>129 && $masmes[$i]<145) {
						$ryadmesta=10;
					}elseif ($masmes[$i]>144 && $masmes[$i]<160) {
						$ryadmesta=11;
					}elseif ($masmes[$i]>159 && $masmes[$i]<175) {
						$ryadmesta=12;
					}elseif ($masmes[$i]>174 && $masmes[$i]<190) {
						$ryadmesta=13;
					}
					if (!$mestairyadi) {
						$mestairyadi=$masmes[$i].' ('.$ryadmesta.' ряд)<br>';
					}else{
						$mestairyadi.=$masmes[$i].' ('.$ryadmesta.' ряд)<br>';
					}
				}
				
				$getpodinf=mysqli_query($con,"SELECT * from seyvkino where id='$idfilma'");
				$infafilma=mysqli_fetch_array($getpodinf);
				$oblozka=$infafilma["oblozhka"];
				if ($infa['status']==$statusq) {
					echo '<div style="background-image:url('.$oblozka.')" class="celblock onelvl">
							<div class="nizdlyainf">
								<img src="'.$oblozka.'" class="blurka">
								<div class="pismena">
									<div class="zagolovok">'.$infa['namefilm'].'</div>
									<div class="podrobinfa">';
										if ($skokmesttam>1) {
											echo '<div class="onelvl" style="text-align:right;">Забронированные места - ';
										}else{
											echo '<div class="onelvl" style="text-align:right;">Забронированное место - ';
										}
										
										for ($i=0; $i < $skokmesttam; $i++) { 
											echo '<br>';
										}echo'Начало сеанса - <br>Цена - <br>Код подтверждения - </div>
										<div class="onelvl" style="text-align:left;">'.$mestairyadi.$infa['timefilm'].'<br>'.$infa['summa'].' руб.<br>'.$infa['kod'].'</div>
									</div>
									<div class="cestatus" style="padding-bottom:0px;">'.$infa['status'].'</div>
									<div class="cestatus" style="font-size:18px;padding:0;padding-bottom:20px;">(Подтвердите бронь)</div>
								</div>
						</div>
					</div>';
				}elseif ($infa['status']==$statupd) {
					echo '<div style="background-image:url('.$oblozka.')" class="celblock onelvl">
							<div class="nizdlyainf">
								<img src="'.$oblozka.'" class="blurka">
								<div class="pismena">
									<div class="zagolovok">'.$infa['namefilm'].'</div>
									<div class="podrobinfa">
										<div class="onelvl" style="text-align:right;">Забронированное место - <br>Начало сеанса - <br>Цена - <br>Код подтверждения - </div>
										<div class="onelvl" style="text-align:left;">'.$infa['mesta'].' ('.$ryadmesta.' ряд)<br>'.$infa['timefilm'].'<br>'.$infa['summa'].' руб.<br>'.$infa['kod'].'</div>
									</div>
									<div class="cestatus" style="padding-bottom:0px;color:#04d104;">'.$infa['status'].'</div>
									<div class="cestatus" style="font-size:18px;padding:0;padding-bottom:20px;color:#04d104;">(Ожидайте начала сеанса)</div>
								</div>
						</div>
					</div>';
				}
				$mestairyadi="";
					$k++;
					if ($k==2) {
						echo "</div>";
						$k=0;
					}
			}
		}
		if ($naidenofilmov<1) {
			echo '<div id="zapinprof" style="text-align: center;position: relative;">
							<div class="resqpr">Отсутствуют.</div>
						</div>';
		}
		echo "</div></div>";
	}else{
		echo '<div id="zapinprof" style="text-align: center;position: relative;">
							<div class="resqpr">Отсутствуют.</div>
						</div>'; //Предстоящих сеансов не найдено.
	}
	
						?>
					</div>
				</div>
			</div>
			
				
				<script>
					$('#predseans').click(function () {
						$.ajax({
					    	type: "POST",
						    url: "ajax/getinfprof.php",
					   		data: {
					  			action:'predseans'
						   	},
						   	beforeSend: function () {
								document.getElementById('zapinprof').innerHTML='<div class="resqpr">Загрузка...</div>';
										   	},
						   	success: function(response){
						   		document.getElementById('zapinprof').innerHTML=response;
						   	}
						});
					});
						
					$('#historyact').click( function () {
						$.ajax({
					    	type: "POST",
						    url: "ajax/getinfprof.php",
					   		data: {
					  			action:'historyact'
						   	},
						   	beforeSend: function () {
								document.getElementById('zapinprof').innerHTML='<div class="resqpr">Загрузка...</div>';
										   	},
						   	success: function(response){
						   		document.getElementById('zapinprof').innerHTML=response;
						   	}
						});
					});
					
				</script>
			</div>
		</div>
		<div class="footer">
			<div class="txtfooter">
				Дипломный проект <br>студента Димитровградского Технического Колледжа гр. П-41<br> Гусева Владислава Евгеньевича<br>2019
			</div>
		</div>
	</div>
</section>
<script type="text/javascript">
	window.onload= function () {
		$('#predseans').click();
	}
</script>
<script type="text/javascript" src="js/fixbagmenu.js"></script>
<script type="text/javascript" src="js/getfilm.js"></script>
<script src="js/jquery.min.js"></script>
<script src="js/owl.carousel.min.js"></script>
</body>
</html>