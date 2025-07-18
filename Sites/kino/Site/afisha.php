<?
include('include/settings.php');
include('include/guard.php');


function chopotime($kinotime,$iidd,$iii){
	$timeH=date('H')+1;
	$timeM=date('i');
	$timeandkino=$timeH.':'.$timeM;
	$kinotimeH=$kinotime['0'].$kinotime['1'];
	$kinotimeM=$kinotime['3'].$kinotime['4'];
	$timeM30=$timeM+30;
	$timeH1=$timeH;
	if ($timeH==23 && $timeM30>59) {
		$timeH1=00;
		$timeM30-=60;
	}
	if ($timeM30>59) {
		$timeM30-=60;
		$timeH1++;
	}
	if (($timeH>$kinotimeH && $kinotimeH!='00' && $kinotimeH!='01' && $kinotimeH!='02' && $kinotimeH!='03') || /*($timeH+1==$kinotimeH && $timeM30>60 && $timeM30-60>$kinotimeM) ||*/ ($timeH1==$kinotimeH && $timeM30>$kinotimeM) || ($timeH==$kinotimeH && $timeM>$kinotimeM) || ($timeH==$kinotimeH && $timeH1==$kinotimeH && $timeM30<$kinotimeM)) {
		echo '<div time="'.$kinotime.'" style="color: #696969;border: 2px solid #696969;font-size: 28px;display: block;padding: 10px 20px;border-radius: 25px;margin: 10px 10px;">'.$kinotime.'</div>';
	}else{
		echo '<div style="margin: 10px 10px;display: block;" class="settimebl" id="afitime_'.$iii.'_'.$iidd.'" time="'.$kinotime.'" kid="'.$iidd.'" onclick="afisettimefilm(id);">'.$kinotime.'</div>';
	}
}
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
	<title>INTERFILM | Афиша</title>
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

				$res=mysqli_query($con,"SELECT * from seyvkino");
				$skokrow=mysqli_num_rows($res);
			?>
		<div style="background-image: url('img/afish.jpg');height: 150px;background-size: cover;background-position: center;background-repeat: no-repeat;background-attachment: fixed;text-align: center; font-size: 48px;line-height: 150px;text-shadow: black 2px 2px 2px;">АФИША</div>
		<div class="contacts" style="position: relative;min-height: 700px;">
			<div id="forqueryfilms">
			<?
				$timmme=date('H')+2;
				$timmm=date('i');
				if ($skokrow>0) {
					for ($j=0; $j < $skokrow ; $j++) { 
						$svkino=mysqli_fetch_array($res);
						echo '<div class="afiblock">
									<div class="afiimg" onclick="podrobneeava(id);" id="avafilma_'.$svkino['id'].'" filmaida="'.$svkino['id'].'" style="background-image:url('.$svkino['oblozhka'].')"></div>
									<div class="afiop">
										<div style="width: max-content;display: inline-block;">
											<div class="nzavfilm" onclick="podrobnee(id);" id="zagol_'.$svkino['id'].'" filmaida="'.$svkino['id'].'">'.$svkino['nazvanie'].'</div>
											<div class="zhanrofilm">'.$svkino['zhanr'].'</div>
										</div>
										<div class="ogrvozr" style="right: 0;top: 0;display: inline-block;position: absolute;">'.$svkino['vozr_ogr'].'</div>
										<div style="margin-top: 20px;font-size:18px;">'.$svkino['opisanie'].'</div>
									</div>
									<div style="display:inline-block;vertical-align: middle;">';

										for ($i=0; $i < $svkino['skok_time'] ; $i++) { 
											if ($i==0) {
												chopotime($svkino['time_one'],$svkino['id'],$i);
											}elseif ($i==1) {
												chopotime($svkino['time_two'],$svkino['id'],$i);
											}elseif ($i==2) {
												chopotime($svkino['time_three'],$svkino['id'],$i);
											}elseif ($i==3) {
												chopotime($svkino['time_four'],$svkino['id'],$i);
											}elseif ($i==4) {
												chopotime($svkino['time_five'],$svkino['id'],$i);
											}
										}
									echo '</div>
								</div>';
					}
				}
			?>
			</div>
			<div class="afiblock" style="position: absolute; right: 20px; top:20px;">
				<div class="blocksearch">
					<style type="text/css">
						.blocksearch{
							    width: 250px;
						}
						input[type=checkbox] {
						  display: none;
						}
						.checkbox .sellab:before {
						  border-radius: 3px;
						}
						.sellab:before {
						    content: "";
						    display: inline-block;
						    width: 18px;
						    height: 18px;
						    margin-right: 10px;
						    left: 0;
						    vertical-align: middle;
						    background-color: #173084;
    						border: 2px solid #10baff;
						}
						input[type=checkbox]:checked + label:before {
						  text-align: center;
						    line-height: 15px;
						    content: '\2713';
							color: #00d0ff;
							font-size: 1.5em;
							text-shadow: 1px 1px 1px rgba(0, 0, 0, .2);
						}
						.labelkacheka{
							padding: 5px 0;
							display: block;
						}
						.checkbox{
							border: 2px solid #10baff;
    						padding: 15px 25px;
    						    background: #023b82;
						}
						.zagvozr{
							    font-size: 26px;
    text-align: left;
    padding: 10px;
    background-color: #10baff;

						}
						.zagvozr:hover{
							cursor: pointer;
						}
						.zagvozr:after{
							font-family: 'icomoon';
    						content: '\e000';
    						    right: 30px;
    						    position: absolute;
						}
						.open:after{
							font-family: 'icomoon';
    						content: '\e000';
    						    right: 30px;
    						    position: absolute;
    						        transform: rotate(180deg);
						}
						.checkbox{
							display: none;
						}
						.butsearch{
							    text-align: center;
    font-size: 26px;
    padding: 10px;
    /* background-color: aquamarine; */
    /*background: linear-gradient(90deg, #1d3895 -10%, #10baff);*/
    margin-top: 20px;
    border: 2px solid #10baff;
						}
						.butsearch:hover{
							cursor: pointer;
							background-color: #084592;
						}
					</style>
					<div id="zagvozogr" class="zagvozr">Возростное ограничение</div>
					<div id="blockcheck" class="checkbox">
						<span class="labelkacheka">
						  <input class="labelkacheka" id="check1" type="checkbox" name="check" value="0+">
						  <label class="sellab" for="check1" style="font-size: 22px;">0+</label>
						</span>
						<span class="labelkacheka">
						  <input id="check2" type="checkbox" name="check" value="6+">
						  <label class="sellab" for="check2" style="font-size: 22px;">6+</label>
						</span>
						<span class="labelkacheka">
						  <input id="check3" type="checkbox" name="check" value="12+">
						  <label class="sellab" for="check3" style="font-size: 22px;">12+</label>
						</span>
						<span class="labelkacheka">
						  <input id="check4" type="checkbox" name="check" value="16+">
						  <label class="sellab" for="check4" style="font-size: 22px;">16+</label>
						</span>
						<span class="labelkacheka">
						  <input id="check5" type="checkbox" name="check" value="18+">
						  <label class="sellab" for="check5" style="font-size: 22px;">18+</label>
						</span>
					</div>

					<div id="zagzhanr" class="zagvozr" style="margin-top: 2px;">Жанр</div>
					<div id="blockcheckzh" class="checkbox">
						<span class="labelkacheka">
						  <input id="zh1" type="checkbox" name="check" value="Боевик">
						  <label class="sellab" for="zh1" style="font-size: 22px;">Боевик</label>
						</span>
						<span class="labelkacheka">
						  <input id="zh2" id="check1" type="checkbox" name="check" value="Драма">
						  <label class="sellab" for="zh2" style="font-size: 22px;">Драма</label>
						</span>
						<span class="labelkacheka">
						  <input id="zh3" type="checkbox" name="check" value="Комедия">
						  <label class="sellab" for="zh3" style="font-size: 22px;">Комедия</label>
						</span>
						<span class="labelkacheka">
						  <input id="zh4" type="checkbox" name="check" value="Мультфильм">
						  <label class="sellab" for="zh4" style="font-size: 22px;">Мультфильм</label>
						</span>
						<span class="labelkacheka">
						  <input id="zh5" type="checkbox" name="check" value="Мюзикл">
						  <label class="sellab" for="zh5" style="font-size: 22px;">Мюзикл</label>
						</span>
						<span class="labelkacheka">
						  <input id="zh6" type="checkbox" name="check" value="Приключения">
						  <label class="sellab" for="zh6" style="font-size: 22px;">Приключения</label>
						</span>
						<span class="labelkacheka">
						  <input id="zh7" type="checkbox" name="check" value="Триллер">
						  <label class="sellab" for="zh7" style="font-size: 22px;">Триллер</label>
						</span>
						<span class="labelkacheka">
						  <input id="zh8" type="checkbox" name="check" value="Ужасы">
						  <label class="sellab" for="zh8" style="font-size: 22px;">Ужасы</label>
						</span>
						<span class="labelkacheka">
						  <input id="zh9" type="checkbox" name="check" value="Фэнтези">
						  <label class="sellab" for="zh9" style="font-size: 22px;">Фэнтези</label>
						</span>
					</div>

					<div class="butsearch" onclick="kzapvoz();">Поиск</div>

				</div>
				
				<script>
					kzaprosuvoz=[];
					kzaprosuzhanr=[];

					function kzapvoz() {
						for (i=1; i <= 5; i++) {
							if ($('#check'+i).prop('checked')==true) {
								kzaprosuvoz.push($('#check'+i).val());
							}
						}
						for (i=1; i <= 8; i++) {
							if ($('#zh'+i).prop('checked')==true) {
								kzaprosuzhanr.push($('#zh'+i).val());
							}
						}
							console.log(kzaprosuvoz+'\n'+kzaprosuzhanr);
						if (kzaprosuvoz.length>0) {
							if (kzaprosuzhanr.length>0) {
								$.ajax({
							    	type: "POST",
								    url: "ajax/getfilminfo.php",
							   		data: {
							  			vozrasti:kzaprosuvoz,
							  			zhanri:kzaprosuzhanr
								   	},
								   	beforeSend: function () {
										document.getElementById('forqueryfilms').innerHTML='<div style="text-align:center;">Загрузка...</div>';
												   	},
								   	success: function(response){
								   		document.getElementById('forqueryfilms').innerHTML=response;
								   	}
								 });
							}else{
								$.ajax({
							    	type: "POST",
								    url: "ajax/getfilminfo.php",
							   		data: {
							  			vozrasti:kzaprosuvoz
								   	},
								   	beforeSend: function () {
										document.getElementById('forqueryfilms').innerHTML='<div style="text-align:center;">Загрузка...</div>';
												   	},
								   	success: function(response){
								   		document.getElementById('forqueryfilms').innerHTML=response;
								   	}
								 });
							}
						}else{
							if (kzaprosuzhanr.length>0) {
								$.ajax({
							    	type: "POST",
								    url: "ajax/getfilminfo.php",
							   		data: {
							  			zhanri:kzaprosuzhanr
								   	},
								   	beforeSend: function () {
										document.getElementById('forqueryfilms').innerHTML='<div style="text-align:center;">Загрузка...</div>';
												   	},
								   	success: function(response){
								   		document.getElementById('forqueryfilms').innerHTML=response;
								   	}
								 });
							}else{
								$.ajax({
							    	type: "POST",
								    url: "ajax/getfilminfo.php",
							   		data: {
							  			afisha:'getafifilms'
								   	},
								   	beforeSend: function () {
										document.getElementById('forqueryfilms').innerHTML='<div style="text-align:center;">Загрузка...</div>';
												   	},
								   	success: function(response){
								   		document.getElementById('forqueryfilms').innerHTML=response;
								   	}
								 });
							}
						}
						
						kzaprosuvoz=[];
						kzaprosuzhanr=[];
					}

					vozorg=false;
					$('#zagvozogr').click(function () {
						if (vozorg==true) {
							$(this).removeClass('open');
							$('#blockcheck').slideUp();
							vozorg=false;
						}else if(vozorg==false) {
							$(this).toggleClass('open');
							$('#blockcheck').slideDown();
							vozorg=true;
					}});

					boolzhanr=false;
					$('#zagzhanr').click(function () {
						if (boolzhanr==true) {
							$(this).removeClass('open');
							$('#blockcheckzh').slideUp();
							boolzhanr=false;
						}else if(boolzhanr==false) {
							$(this).toggleClass('open');
							$('#blockcheckzh').slideDown();
							boolzhanr=true;
					}});
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
	perim1=0;
	perim2=0;
	perim3=0;
	function gobig1() {
		if (perim1==0) {
			perim1++;
			$('#img1').css('width','100%');
			$('#img1').css('transition','0.5s');
		}else{
			perim1--;
			$('#img1').css('width','51%');
			$('#img1').css('transition','0.5s');
		}
	}
	function gobig2() {
		if (perim2==0) {
			perim2++;
			$('#img2').css('width','100%');
			$('#img2').css('transition','0.5s');
		}else{
			perim2--;
			$('#img2').css('width','51%');
			$('#img2').css('transition','0.5s');
		}
	}
	function gobig3() {
		if (perim3==0) {
			perim3++;
			$('#img3').css('width','100%');
			$('#img3').css('transition','0.5s');
		}else{
			perim3--;
			$('#img3').css('width','51%');
			$('#img3').css('transition','0.5s');
		}
	}
</script>
<script type="text/javascript" src="js/fixbagmenu.js"></script>
<script type="text/javascript" src="js/getfilm.js"></script>
<script src="js/jquery.min.js"></script>
<script src="js/owl.carousel.min.js"></script>
</body>
</html>