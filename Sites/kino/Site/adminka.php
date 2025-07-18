<?
include('include/settings.php');
include('include/guard.php');

if ($_COOKIE['sesadm']==$adminlog && $_COOKIE['sesadmkey']==$adminpass) {
	$vsenishtyak=true;
}else{
	if ($_POST['login']==$adminlog && $_POST['password']==$adminpass) {
		setcookie('sesadm',$adminlog);
		setcookie('sesadmkey',$adminpass);
	}else{
		header('location:admin?err=true');
	}
}
if ($_GET['act']=='delete' && $_GET['id']) {
	$kogodel=$_GET['id'];
	mysqli_query($con,"DELETE FROM seyvkino WHERE id='$kogodel'");
	header('location: adminka?act=vkino');
}
if (!$_FILES['fl']['tmp_name']) {
}elseif ($_FILES['fl']['size']>2*1024*1024) {
	$er="Файл слишком большой";
}else{
	switch ($_FILES['fl']['type']) {
		case 'image/jpeg':
			$type='jpg';
			$name='page-bg';
			$fullname=$name.'.'.$type;
			$linkimg='img/'.$fullname;
			break;
		case 'image/png':
			$type='jpg';
			$name='page-bg';
			$fullname=$name.'.'.$type;
			$linkimg='img/'.$fullname;
			break;
		default:
			$er="Недопустимое расширение файла";
			break;
	}
	if (!move_uploaded_file($_FILES['fl']['tmp_name'], $linkimg)) {
		$er="ошибка загрузки";
	}else{
		$er="фон обновлен";
	}
}

if ($_POST['action']=='dobsyevkino') {
	if (!$_FILES['film']['tmp_name']) {
}elseif ($_FILES['film']['size']>2*1024*1024) {
	//$er="Файл слишком большой";
}else{
	switch ($_FILES['film']['type']) {
		case 'image/jpeg':
			$type='jpg';
			$name=uniqid();
			$fullname=$name.'.'.$type;
			$linkimg='img/films/'.$fullname;
			break;
		case 'image/png':
			$type='jpg';
			$name=uniqid();
			$fullname=$name.'.'.$type;
			$linkimg='img/films/'.$fullname;
			break;
		default:
			//$er="Недопустимое расширение файла";
			break;
	}
	if (!move_uploaded_file($_FILES['film']['tmp_name'], $linkimg)) {
		//$er="ошибка загрузки";
	}else{
		//$er="фон обновлен";
	}
}
	
	$nazvanie=$_POST['nazvanie'];
	$zhanr=$_POST['zhanr'];
	$vozrogr=$_POST['vozrogr'];
	$prodolzh=$_POST['prodolzh'];
	$roli=$_POST['roli'];
	$opisanie=$_POST['opisanie'];
	$trayler=$_POST['trayler'];
	$timeseans=$_POST['timeseans'];
	$arrsea=explode(' ',$timeseans);
	$vsegotime=0;
	foreach ($arrsea as $k => $v) {
		$vsegotime++;
		if ($k==0) {
			$time_one=$v;
		}elseif ($k==1) {
			$time_two=$v;
		}elseif ($k==2) {
			$time_three=$v;
		}elseif ($k==3) {
			$time_four=$v;
		}elseif ($k==4) {
			$time_five=$v;
		}
	}
	$oblozhka=$linkimg;
	if ($time_five) {
		$addfilm=mysqli_query($con,"INSERT into seyvkino(nazvanie,zhanr,vozr_ogr,prodolzh,roli,opisanie,trayler,time_seans,oblozhka,skok_time,time_one,time_two,time_three,time_four,time_five) values ('$nazvanie','$zhanr','$vozrogr','$prodolzh','$roli','$opisanie','$trayler','$timeseans','$oblozhka','$vsegotime','$time_one','$time_two','$time_three','$time_four','$time_five')");
	}elseif ($time_four) {
		$addfilm=mysqli_query($con,"INSERT into seyvkino(nazvanie,zhanr,vozr_ogr,prodolzh,roli,opisanie,trayler,time_seans,oblozhka,skok_time,time_one,time_two,time_three,time_four) values ('$nazvanie','$zhanr','$vozrogr','$prodolzh','$roli','$opisanie','$trayler','$timeseans','$oblozhka','$vsegotime','$time_one','$time_two','$time_three','$time_four')");
	}elseif ($time_three) {
		$addfilm=mysqli_query($con,"INSERT into seyvkino(nazvanie,zhanr,vozr_ogr,prodolzh,roli,opisanie,trayler,time_seans,oblozhka,skok_time,time_one,time_two,time_three) values ('$nazvanie','$zhanr','$vozrogr','$prodolzh','$roli','$opisanie','$trayler','$timeseans','$oblozhka','$vsegotime','$time_one','$time_two','$time_three')");
	}elseif ($time_two) {
		$addfilm=mysqli_query($con,"INSERT into seyvkino(nazvanie,zhanr,vozr_ogr,prodolzh,roli,opisanie,trayler,time_seans,oblozhka,skok_time,time_one,time_two) values ('$nazvanie','$zhanr','$vozrogr','$prodolzh','$roli','$opisanie','$trayler','$timeseans','$oblozhka','$vsegotime','$time_one','$time_two')");
	}elseif ($time_one) {
		$addfilm=mysqli_query($con,"INSERT into seyvkino(nazvanie,zhanr,vozr_ogr,prodolzh,roli,opisanie,trayler,time_seans,oblozhka,skok_time,time_one) values ('$nazvanie','$zhanr','$vozrogr','$prodolzh','$roli','$opisanie','$trayler','$timeseans','$oblozhka','$vsegotime','$time_one')");
	}
	header('location: adminka?act=vkino');
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
	<script type="text/javascript" src="js/getfilm.js"></script>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>INTERFILM | Администрация</title>
	<style type="text/css">
		.hrefi{
			    color: white;
    display: block;
    width: min-content;
    padding: 10px;
    border: 2px solid;
    margin-left: 60%;
		}
		.hrefi:hover{
			text-decoration: underline;
			cursor: pointer;
		}
		.hrefit{
			    color: white;
    display: block;
    margin-top: 15px;
    padding: 10px;
    border: 2px solid;
        text-align: center;
		}
		.hrefit:hover{
			text-decoration: underline;
			cursor: pointer;
		}
		.preview-img{
			    width: 100%;
		}
		td{
			    border: 2px solid black;
			    padding: 5px;
		}
		table{
			    border-collapse: collapse;
    text-align: center;
		}
		.inbm{
			font-size: 26px;
			    padding: 10px;
			    color: white;
		    display: block;
		    border: 2px solid;
		    text-align: center;
		    display: inline-block;
    vertical-align: middle;
		}
		.inbm:hover{
			text-decoration: underline;
			cursor: pointer;
		}
		.lupa:hover{
			cursor: pointer;
		}
		#harashobut{
			    padding: 10px;
    background-color: #003900;
    border: 2px solid lime;
    color: lime;
    font-size: 24px;
		}
		#harashobut:hover{
			cursor: pointer;
    text-decoration: underline;
    background-color: #004900;
		}
		#deletebut{
    padding: 10px;
    color: red;
    border: 2px solid red;
    background: #370000;
    font-size: 24px;
    margin-top: 15px;
		}
		#deletebut:hover{
			cursor: pointer;
    text-decoration: underline;    
    background: #4c0202;
		}
		#dlyatablic{
			    font-size: 24px;
    margin-top: 10px;
    padding: 10px;
    max-height: 40vh;
    overflow: auto;
		}
		#poverhvseh{
			margin:0;
		}
		.onelvl{
			    display: inline-block;
    vertical-align: top;
		}
		.settimebll{
			font-size: 28px;
    padding: 10px 20px;
    border-radius: 25px;
		}
		.settimebll:hover{
			background-color: #4d026c;
			cursor: pointer;
		}
	</style>
	<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
</head>
<body style="background: #fff;height: 100vh;">
	<div class="poverhvseh" id="poverhvseh">
	<div class="borderokna" style="margin:0 auto;">
		<div class="poverhokno" style="height: auto;max-width: max-content;">
			<div class="closeokno" style="margin-top: -40px;" onclick="$('#poverhvseh').css('display','none');document.getElementById('body').style.overflowY='auto';"></div>
			<div id="resultsquerybigwind">
			</div>
		</div>
	</div>
</div>
	<div style="    width: 1200px;
    margin: 0 auto;
    height: 100%;">
		<div style="    width: 200px;
    height: 100%;
    display: inline-block;
    background-color: #b400ff;
    color: white;
    font-size: 28px;
    padding: 15px;
    position: fixed;">
		<a href="admin?act=logout" class="hrefi">Выйти</a>
		<a href="adminka?act=changefon" class="hrefit">Изменить фон сайта</a>
		<a href="adminka?act=addfilm" class="hrefit">Добавить фильм</a>
		<a href="adminka?act=vkino" class="hrefit">Сейчас в кино</a>
		<a href="adminka?act=users" class="hrefit">Пользователи</a>
		<a href="adminka?act=operator" class="hrefit">Меню оператора</a>
		<a href="adminka?act=graf" class="hrefit">График дохода</a>
		</div>

		<script type="text/javascript">
	function kcdelka(idstroki) {
		if (confirm("Удалить бронирование пользователя?")) {
			$.ajax({
			    	type: "POST",
				    url: "ajax/getinfprof.php",
			   		data: {
			  			action:'delete',
			  			itm:idstroki
				   	},
				   	success: function(response){
				   		alert(response);
				   		keycode();
				   	}
				});
		}
	}

	function delka(idstroki) {
		if (confirm("Удалить бронирование пользователя?")) {
			$.ajax({
			    	type: "POST",
				    url: "ajax/getinfprof.php",
			   		data: {
			  			action:'delete',
			  			itm:idstroki
				   	},
				   	success: function(response){
				   		alert(response);
				   		skoroseanslist();
				   	}
				});
		}
	}
	function loadbronki() {
		$("#bronpolz").click();
	}
	function kcpodtvrj(idstroki) {
		if (confirm("Подтвердить бронирование пользователя?")) {
			$.ajax({
			    	type: "POST",
				    url: "ajax/getinfprof.php",
			   		data: {
			  			action:'podtver',
			  			itm:idstroki
				   	},
				   	success: function(response){
				   		alert(response);
				   		keycode();
				   	}
				});
		}
	}
	function podtvrj(idstroki) {
		if (confirm("Подтвердить бронирование пользователя?")) {
			$.ajax({
			    	type: "POST",
				    url: "ajax/getinfprof.php",
			   		data: {
			  			action:'podtver',
			  			itm:idstroki
				   	},
				   	success: function(response){
				   		alert(response);
				   		skoroseanslist();
				   	}
				});
		}
	}
	function spisokbroney() {
		$.ajax({
			    	type: "POST",
				    url: "ajax/getinfprof.php",
			   		data: {
			  			action:'getlistbroney'
				   	},
				   	success: function(response){
				   		document.getElementById('dlyavsyakihzaprosov').innerHTML=response;
				   	}
				});
	}
	function adsetfilm(id) {
		sfilmtime=$('#'+id).attr('time');
		sfilmidd=$('#'+id).attr('kid');
		$.ajax({
			    	type: "POST",
				    url: "ajax/getinfprof.php",
			   		data: {
			  			action:'getinffilm',
			  			sfilm:sfilmidd,
			  			stime:sfilmtime
				   	},
				   	success: function(response){
				   		document.getElementById('dlyavsyakihzaprosov').innerHTML=response;
				   		loadbronki();
				   	}
				});
	}
	function spisokfilms() {
		$.ajax({
			    	type: "POST",
				    url: "ajax/getinfprof.php",
			   		data: {
			  			action:'getlistfilms'
				   	},
				   	success: function(response){
				   		document.getElementById('dlyavsyakihzaprosov').innerHTML=response;
				   	}
				});
	}
	function keycode() {
		code=$('#kodpodtv').val();
		$.ajax({
			    	type: "POST",
				    url: "ajax/getinfprof.php",
			   		data: {
			  			action:'keycode',
			  			key:code
				   	},
				   	success: function(response){
				   		document.getElementById('dlyavsyakihzaprosov').innerHTML=response;
				   	}
				});
	}
	$('#bronpolz').click(function () {
		skoroseanslist();
	});
	function skoroseanslist() {
		$.ajax({
			    	type: "POST",
				    url: "ajax/getinfprof.php",
			   		data: {
			  			action:'skoroseans'
				   	},
				   	success: function(response){
				   		document.getElementById('dlyatablic').innerHTML=response;
				   		document.getElementById('temniyfon').style.height='100%';
				   	}
				});
	}
	function seavblvr() {
		window.location.href='adminka?act=operator';
	}
	function podtverzhad(item) {
		filmaid=$('#'+item).attr('kid');
		filmatime=$('#'+item).attr('ktime');
		fmesta=$('#'+item).attr('mesta');
		$.ajax({
	    	type: "POST",
		    url: "ajax/getinfprof.php",
	   		data: {
	  			action:'podtv',
	  			film:filmaid,
	  			time:filmatime,
	  			mesta:fmesta
		   	},
		   	success: function(response){
		   		shemazala('shemazala');
		   		document.getElementById('poverhvseh').style.display='block';
		   		document.getElementById('resultsquerybigwind').innerHTML=response;
		   	}
		});
	}
	function bronmestaadmin(item) {
		filmaid=$('#'+item).attr('kid');
		filmatime=$('#'+item).attr('ktime');
		$.ajax({
	    	type: "POST",
		    url: "ajax/getinfprof.php",
	   		data: {
	  			action:'nadopod',
	  			film:filmaid,
	  			time:filmatime,
	  			mesta:mesta
		   	},
		   	success: function(response){

		   		document.getElementById('poverhvseh').style.display='block';
		   		document.getElementById('resultsquerybigwind').innerHTML=response;
		   	}
		});
	}
	var mesta=[];
	var numstrmass;
	function setmestoop(idd) {
	mestobilovibrano=false;
	id=$('#'+idd).attr('mid');
	for (var i=0; i < mesta.length; i++) {
		if (mesta[i][0]==id){
			mestobilovibrano=true;
			numstrmass=i;
		}
	}
	if (mestobilovibrano==true) {
		document.getElementById('mes_'+mesta[numstrmass][0]).style.background='#737373';
		mesta.splice(numstrmass, 1);
	}else{
			filmtime=$('#'+idd).attr('tfilm');
			cemesto=$('#'+idd).attr('mid');
			filmidd=$('#'+idd).attr('kid');
			infamesta=[cemesto,filmidd,filmtime];
			mesta.push(infamesta);
			//$('#'+mesto_1).css('background','#737373');
			document.getElementById(idd).style.background='#0594bf';
		
	}
}
	function shemazala(item){
		mesta=[];
		filmaid=$('#'+item).attr('kid');
		filmatime=$('#'+item).attr('ktime');
		$.ajax({
	    	type: "POST",
		    url: "ajax/getinfprof.php",
	   		data: {
	  			action:'shema',
	  			film:filmaid,
	  			time:filmatime
		   	},
		   	success: function(response){
		   		document.getElementById('dlyatablic').innerHTML=response;
		   		document.getElementById('temniyfon').style.height='auto';
		   	}
		});
	}
	function broninasea(item){
		filmaid=$('#'+item).attr('kid');
		filmatime=$('#'+item).attr('ktime');
		$.ajax({
	    	type: "POST",
		    url: "ajax/getinfprof.php",
	   		data: {
	  			action:'getbroni',
	  			film:filmaid,
	  			time:filmatime
		   	},
		   	success: function(response){
		   		document.getElementById('dlyatablic').innerHTML=response;
		   		if (response=="<div style='padding: 25px;font-size: 24px;color: red;'>Бронирования пользователей,ожиданиющие подтверждения, на данный сеанс отсутствуют.</div>") {
		   			document.getElementById('temniyfon').style.height='100%';
		   		}else{
		   			/* document.getElementById('temniyfon').style.height='auto'; */
		   			document.getElementById('temniyfon').style.height='100%';
		   		}
		   	}
		});
	}

</script>
		<div style="display: inline-block;
    width: 900px;
    background-color: #e6e6e6;
    margin-left: 230px;
    padding: 20px;
    font-size: 20px;">
			<?
			echo '<div style="text-align: center;">';
			if ($er) {
    			echo $er;
    		}
    		echo '</div>';
				if ($_GET['act']=='changefon') {
	echo '<div style="width:min-content;margin: 0 auto;margin-top:20px;">
		<form action="adminka?act=changefon" method="post" enctype="multipart/form-data">
								<label>
								<input type="file" id="upfile" onchange="getFileParam();" name="fl">
								</label>
								<div style="max-width: 500px;">
								<div id="preview1"></div>
								<div id="file-name1"></div>
								<div id="file-size1"></div>
								</div>
								<input style="margin:0;border: 1px solid #b400ff;    color: white;    background-color: #b400ff;margin-top: 15px;" type="submit" class="uploadava" value="Загрузить">
							
		</form>
		<script type="text/javascript" src="js/prewiev.js"></script>
		</div>
	';
}
if ($_GET['act']=='graf') {
	echo '<div style="background: #b400ff;padding: 20px;">';
?>
<script type="text/javascript">
	dohodnedel();
	dohodprednedel();

	google.charts.load('current', {'packages':['corechart']});
      
 function dohodprednedel() {
      	$.ajax({
	    	type: "POST",
		    url: "ajax/getinfprof.php",
	   		data: {
	  			action:'dohodpredned'
		   	},
		   	success: function(response){
		   		massivkapred=JSON.parse(response);
      			google.charts.setOnLoadCallback(drawChartpred);
		   	}
		});
      }

      function dohodnedel() {
      	$.ajax({
	    	type: "POST",
		    url: "ajax/getinfprof.php",
	   		data: {
	  			action:'dohodned'
		   	},
		   	success: function(response){
		   		massivka=JSON.parse(response);
		   		google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);
		   	}
		});
      }

      function drawChartpred() {
        var data = google.visualization.arrayToDataTable([
          ['День', 'Плановый', 'Фактический'],
          ['Понедельник',  massivkapred[6]['plan'],      massivkapred[6]['fact']],
          ['Вторник',  massivkapred[5]['plan'],      massivkapred[5]['fact']],
          ['Среда',  massivkapred[4]['plan'],      massivkapred[4]['fact']],
          ['Четверг',  massivkapred[3]['plan'],      massivkapred[3]['fact']],
          ['Пятница',  massivkapred[2]['plan'],      massivkapred[2]['fact']],
          ['Суббота',  massivkapred[1]['plan'],      massivkapred[1]['fact']],
          ['Воскресенье',  massivkapred[0]['plan'],      massivkapred[0]['fact']]
        ]);

        var options = {
          title: 'Доход за предыдущую неделю',
          hAxis: {title: 'Неделя',  titleTextStyle: {color: '#333'}},
          vAxis: {minValue: 0}
        };

        var chart = new google.visualization.AreaChart(document.getElementById('pred_div'));
        chart.draw(data, options);
      }

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['День', 'Плановый', 'Фактический'],
          ['Понедельник',  massivka[6]['plan'],      massivka[6]['fact']],
          ['Вторник',  massivka[5]['plan'],      massivka[5]['fact']],
          ['Среда',  massivka[4]['plan'],      massivka[4]['fact']],
          ['Четверг',  massivka[3]['plan'],      massivka[3]['fact']],
          ['Пятница',  massivka[2]['plan'],      massivka[2]['fact']],
          ['Суббота',  massivka[1]['plan'],      massivka[1]['fact']],
          ['Воскресенье',  massivka[0]['plan'],      massivka[0]['fact']]
        ]);

        var options = {
          title: 'Доход за эту неделю',
          hAxis: {title: 'Неделя',  titleTextStyle: {color: '#333'}},
          vAxis: {minValue: 0}
        };

        var chart = new google.visualization.AreaChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }
</script>
<div id="chart_div" style="width: 100%; height: 500px;"></div>	
	</div>
	<div style="background: #b400ff;padding: 20px;">
		<div id="pred_div" style="width: 100%; height: 500px;"></div>	
<?

	echo '</div>';
}
if ($_GET['act']=='operator') {
	echo '<div style="background: #b400ff;padding: 20px;">
			<div class="inbm" onclick="spisokfilms();">Сегодня в кино</div>
			<div class="inbm" onclick="spisokbroney();">Список бронирований</div>
			<div class="inbm" onclick="seavblvr();">Сеанс в ближайшее время</div>
			<div style="float:right;">
					<input class="putkod" type="text" id="kodpodtv" autocomplete="off" placeholder="Код подтверждения"><span style="color: white;padding: 5px;" class="lupa" onclick="keycode();">&#128269;</span>
			</div>
		</div>';
	echo "<div id='dlyavsyakihzaprosov'>";
	$tekdate=date('d.m.Y');
		$timeHH=date('H')+1;
		if ($timeHH=='24') {
			$timeHH='00';
		}
		$mint=date('i');
		$tim=date('i:s');
	$tektime=$timeHH.':'.$tim;
	$res=mysqli_query($con,"SELECT * from seyvkino");
	$skokrow=mysqli_num_rows($res);
	$rezit='';
	$rezjt='';
	$rezidf='';
	$reztif='';
	#$timeHH='11';
	#$mint='10';
	if ($skokrow>0) {
		for ($i=0; $i < $skokrow; $i++) { 
			$skorofilm=mysqli_fetch_array($res);
			for ($ii=11; $ii <= 19 ; $ii++) { 
				# 11,13,15,17,19
				$hourTime=$skorofilm[$ii][0].$skorofilm[$ii][1];
				if ($skorofilm[$ii]!='' && $hourTime>=$timeHH) {			// если есть время  и часы >= текчасов
					if ($hourTime==$timeHH) {								// если часы == тек часов
						$minTime=$skorofilm[$ii][3].$skorofilm[$ii][4];
						if ($mint<$minTime) {
							if (!$slotpodtimeII) {
								$slotpodtimeII=$skorofilm[$ii];
								$skoroFilmId=$skorofilm['id'];
							}else{
								if ($slotpodtimeII>$skorofilm[$ii]){
									$slotpodtimeII=$skorofilm[$ii];
									$skoroFilmId=$skorofilm['id'];
								}
							}
						}
					}else{													// если часы != тек часов
						if (!$slotpodtimeII) {
								$slotpodtimeII=$skorofilm[$ii];
								$skoroFilmId=$skorofilm['id'];
							}else{
								if ($slotpodtimeII>$skorofilm[$ii]){
									$slotpodtimeII=$skorofilm[$ii];
									$skoroFilmId=$skorofilm['id'];
								}
							}
					}
					
				}
				$ii++;
			}
			
		}
		if (!$skoroFilmId && !$slotpodtimeII) {
			$res=mysqli_query($con,"SELECT * from seyvkino");
			while ($timeHH<'24') {
				$timeHH++;
			}
			if ($timeHH=='24') {
				$timeHH='00';
			}
			$mint='00';
			$tektime=$timeHH.':'.$tim;
			for ($i=0; $i < $skokrow; $i++) { 
				$skorofilm=mysqli_fetch_array($res);
				for ($ii=11; $ii <= 19 ; $ii++) { 
					# 11,13,15,17,19
					$hourTime=$skorofilm[$ii][0].$skorofilm[$ii][1];
					if ($skorofilm[$ii]!='' && $hourTime>=$timeHH) {			// если есть время  и часы >= текчасов
						if ($hourTime==$timeHH) {								// если часы == тек часов
							$minTime=$skorofilm[$ii][3].$skorofilm[$ii][4];
							if ($mint<$minTime) {
								if (!$slotpodtimeII) {
									$slotpodtimeII=$skorofilm[$ii];
									$skoroFilmId=$skorofilm['id'];
								}else{
									if ($slotpodtimeII>$skorofilm[$ii]){
										$slotpodtimeII=$skorofilm[$ii];
										$skoroFilmId=$skorofilm['id'];
									}
								}
							}
						}else{													// если часы != тек часов
							if (!$slotpodtimeII) {
									$slotpodtimeII=$skorofilm[$ii];
									$skoroFilmId=$skorofilm['id'];
								}else{
									if ($slotpodtimeII>$skorofilm[$ii]){
										$slotpodtimeII=$skorofilm[$ii];
										$skoroFilmId=$skorofilm['id'];
									}
								}
						}
						
					}
					$ii++;
				}
				
			}
		}
		#echo $skoroFilmId.'('.$slotpodtimeII.')';
		$newreq=mysqli_query($con,"SELECT * from seyvkino where id='$skoroFilmId'");
		$newfilminf=mysqli_fetch_array($newreq);

		echo '<div>
				<div style="position: relative;min-height:400px;height: 80vh;display: flex;overflow: overlay;background: url('.$newfilminf['oblozhka'].');
    background-position: center;">';
					/*<img src="'.$newfilminf['oblozhka'].'" style="position: absolute;width: 100%;top: -370px;filter: blur(3px);">*/
			echo'		<div id="temniyfon" style="text-align: center;margin: auto;background: #000000e6;color: white;width: 100%;height: 100%;position: absolute;">
						<div style="height:49px;padding:20px;">
								<div class="inbm" id="shemazala" style="float: left;" kid="'.$skoroFilmId.'" ktime="'.$slotpodtimeII.'" onclick="shemazala(id);">Схема кинозала</div>
								<div id="bronpolz" class="inbm" style="float: right;" onclick="skoroseanslist();">Бронирования пользователей</div>
						</div>
						<div style="font-size: 30px;padding: 20px;">'.$newfilminf['nazvanie'].' ('.$newfilminf['vozr_ogr'].')</div>
						<div style="font-size: 26px;padding: 10px;">Начало сеанса в '.$slotpodtimeII.'</div>
						<div style="width: 90%;margin: 0 auto;">
							
							<div id="dlyatablic" >';
							$getinftekse=mysqli_query($con,"SELECT * from broni where timefilm='$slotpodtimeII' and idfilm='$skoroFilmId' and datka='$tekdate' and status='$nadostatus'");
							$rinftekse=mysqli_num_rows($getinftekse);
							if ($rinftekse>0) {
								echo '<table style="margin:0 auto;">
									<tr style="background: #b400ff;">
										<td width=150>Забронированные места
										<td width=150>Код
										<td width=150>Сумма
										<td width=150>Действие
									</tr>';
								for ($i=0; $i < $rinftekse ; $i++) { 
									$zapisi=mysqli_fetch_array($getinftekse);
									if (($i%2)==0) {
										echo "<tr style='background: #2e0141;'>";
									}else{
										echo "<tr style='background: #41025c;'>";
									}
									echo '	<td>'.$zapisi['mesta'].'
											<td>'.$zapisi['kod'].'
											<td>'.$zapisi['summa'].'
											<td><div id="harashobut" paramka="'.$zapisi['id'].'" onclick="podtvrj('.$zapisi['id'].');">Подтвердить</div><div id="deletebut" paramka="'.$zapisi['id'].'" onclick="delka('.$zapisi['id'].');">Удалить</div>
											</tr>';
									}
								echo '</table>';
							}else{
								echo "<div style='padding: 25px;font-size: 24px;color: red;'>Бронирования пользователей,ожиданиющие подтверждения, на данный сеанс отсутствуют.</div>";
							}
							
		echo				'</div>
						</div>
					</div>	
				</div>
			</div>';

	}
	echo "</div>";
	echo '<script type="text/javascript">
				skoroseanslist();
				</script>';
} ?>

<?

if ($_GET['act']=='vkino') {
	echo '<div style="text-align: center;"><a href="?act=addfilm">Добавить фильм</a></div>';
	echo '<div style="text-align: center;">';
			if ($addfilm) {
    			echo 'Сейчас в кино';
    		}
    echo '</div>';
    $res=mysqli_query($con,"SELECT * from seyvkino");
	$skokrow=mysqli_num_rows($res);
	echo '<div style="text-align: center;">';
			echo "Фильмов сейчас в кино - ".$skokrow;
    echo '</div>';
	echo '<div style="width:min-content;margin: 0 auto;margin-top:20px;">
		<table>
				<tr style="background-color: #b400ff;color: white;">
					<td>id
					<td>Название
					<td>Жанр
					<td>Возростное ограничение
					<td>Продолжительность
					<td>Трейлер
					<td>Время сеансов
					<td>Обложка
					<td>Действие
				</tr>';
	if ($skokrow>0) {
		for ($i=0; $i < $skokrow ; $i++) { 
			$svkino=mysqli_fetch_array($res);
			echo '<tr>
						<td>'.$svkino['id'].'
						<td>'.$svkino['nazvanie'].'
						<td>'.$svkino['zhanr'].'
						<td>'.$svkino['vozr_ogr'].'
						<td>'.$svkino['prodolzh'].'
						<td>'.$svkino['trayler'].'
						<td>'.$svkino['time_seans'].'
						<td><img style="width: 200px;" src="'.$svkino['oblozhka'].'">
						<td><a href="?act=delete&id='.$svkino['id'].'">Удалить</a>
				</td>
			';
		}
	}
	echo '
		</table>
		</div>
	';
	}

if ($_GET['act']=='addfilm') {
	echo '<div style="text-align: center;">';
			if ($addfilm) {
    			echo 'Фильм успешно добавлен';
    		}
    		echo '</div>';
	echo '<div style="width:min-content;margin: 0 auto;margin-top:20px;">
		<form action="adminka?act=vkino" method="post" enctype="multipart/form-data">
		<table>
			<tr>
				<td>Название
				<td><input type="text" name="nazvanie" placeholder="Название">
			</tr>
			<tr>
				<td>Жанр
				<td><input type="text" name="zhanr" placeholder="Жанр">
			</tr>
			<tr>
				<td>Возростное ограничение
				<td><select type="text" name="vozrogr" style="width: 40px;" >
					<option value="0+">0+</option>
					<option value="6+">6+</option>
					<option value="12+">12+</option>
					<option value="14+">14+</option>
					<option value="16+">16+</option>
					<option value="18+">18+</option>
					</select>
			</tr>
			<tr>
				<td>Продолжительность
				<td><input type="text" name="prodolzh" style="width: 30px;"> мин.
			</tr>
			<tr>
				<td>В ролях
				<td><textarea name="roli" placeholder="В ролях"></textarea>
			</tr>
			<tr>
				<td>Описание
				<td><textarea style="height: 100px;width: 200px;" placeholder="Описание" name="opisanie"></textarea>
			</tr>
			<tr>
				<td>Код трейлера на youtube
				<td><input type="text" name="trayler" placeholder="Код трейлера на youtube">
			</tr>
			<tr>
				<td>Время сеансов (13:20 18:40)
				<td><input type="text" name="timeseans" placeholder="13:20 18:40 22:10">
			</tr>
			<tr>
				<td>Обложка фильма
				<td><input type="file" id="upfile" onchange="getFileParam();" name="film">
			</tr>
			</table>
								<div style="max-width: 500px;">
								<div id="preview1"></div>
								<div id="file-name1"></div>
								<div id="file-size1"></div>
								</div>
								<input type="hidden" name="action" value="dobsyevkino">
								<input style="margin:0;border: 1px solid #b400ff;    color: white;    background-color: #b400ff;margin-top: 15px;" type="submit" class="uploadava" value="Добавить">
							
		</form>
		<script type="text/javascript" src="js/prewiev.js"></script>
		</div>
	';
}
if ($_GET['act']=='users') {
	echo '<div style="text-align: center;">Список пользователей</div>';
	$res=mysqli_query($con,"SELECT * from userskinoteavk");
	$skokrow=mysqli_num_rows($res);
	echo '<div style="width:min-content;margin: 0 auto;margin-top:20px;">
		<table>
				<tr style="background-color: #b400ff;color: white;">
					<td>id
					<td>Страница ВК
					<td>idvk
					<td>имя
					<td>фамилия
					<td>др
					<td>фото
					<td>дата/время регистрации
				</tr>';
	if ($skokrow>0) {
		for ($i=0; $i < $skokrow ; $i++) { 
			$users=mysqli_fetch_array($res);
			$lenstr=mb_strlen ($users['vkdr'], 'UTF-8');
			if ($lenstr==10) {
				$drgod=$users['vkdr'][6].$users['vkdr'][7].$users['vkdr'][8].$users['vkdr'][9];
				$tekgod=date('Y');
				$drmes=$users['vkdr'][3].$users['vkdr'][4];
				$tekmes=date('n');
				$drday=$users['vkdr'][1].$users['vkdr'][2];
				$tekday=date('j');
				if ($tekmes<$drmes) {
					$skoklet=$tekgod-$drgod-1;
				}
				if ($tekmes==$drmes) {
					if ($tekday<$drday) {
						$skoklet=$tekgod-$drgod-1;
					}
					if ($tekday==$drday) {
						$skoklet=$tekgod-$drgod;
					}
					if ($tekday>$drday) {
						$skoklet=$tekgod-$drgod;
					}
				}
				if ($tekmes>$drmes) {
					$skoklet=$tekgod-$drgod;
				}
			}
			if ($lenstr==9) {
				$shoce=$users['vkdr'][1];
				if ($shoce=='.') {
					$drgod=$users['vkdr'][5].$users['vkdr'][6].$users['vkdr'][7].$users['vkdr'][8];
					$tekgod=date('Y');
					$drmes=$users['vkdr'][2].$users['vkdr'][3];
					$tekmes=date('n');
					$drday=$users['vkdr'][0];
					$tekday=date('j');
					if ($tekmes<$drmes) {
						$skoklet=$tekgod-$drgod-1;
					}
					if ($tekmes==$drmes) {
						if ($tekday<$drday) {
							$skoklet=$tekgod-$drgod-1;
						}
						if ($tekday==$drday) {
							$skoklet=$tekgod-$drgod;
						}
						if ($tekday>$drday) {
							$skoklet=$tekgod-$drgod;
						}
					}
					if ($tekmes>$drmes) {
						$skoklet=$tekgod-$drgod;
					}
				}else{
					$drgod=$users['vkdr'][5].$users['vkdr'][6].$users['vkdr'][7].$users['vkdr'][8];
					$tekgod=date('Y');
					$drmes=$users['vkdr'][3];
					$tekmes=date('n');
					$drday=$users['vkdr'][0].$users['vkdr'][1];
					$tekday=date('j');
					if ($tekmes<$drmes) {
						$skoklet=$tekgod-$drgod-1;
					}
					if ($tekmes==$drmes) {
						if ($tekday<$drday) {
							$skoklet=$tekgod-$drgod-1;
						}
						if ($tekday==$drday) {
							$skoklet=$tekgod-$drgod;
						}
						if ($tekday>$drday) {
							$skoklet=$tekgod-$drgod;
						}
					}
					if ($tekmes>$drmes) {
						$skoklet=$tekgod-$drgod;
					}
				}
			}
			if ($lenstr==8) {
				$drgod=$users['vkdr'][4].$users['vkdr'][5].$users['vkdr'][6].$users['vkdr'][7];
				$tekgod=date('Y');
				$drmes=$users['vkdr'][2];
				$tekmes=date('n');
				$drday=$users['vkdr'][0];
				$tekday=date('j');
				if ($tekmes<$drmes) {
					$skoklet=$tekgod-$drgod-1;
				}
				if ($tekmes==$drmes) {
					if ($tekday<$drday) {
						$skoklet=$tekgod-$drgod-1;
					}
					if ($tekday==$drday) {
						$skoklet=$tekgod-$drgod;
					}
					if ($tekday>$drday) {
						$skoklet=$tekgod-$drgod;
					}
				}
				if ($tekmes>$drmes) {
					$skoklet=$tekgod-$drgod;
				}
			}
			echo '<tr>
						<td>'.$users['id'].'
						<td><a href="http://vk.com/id'.$users['vkid'].'">http://vk.com/id'.$users['vkid'].'</a>
						<td>'.$users['vkid'].'
						<td>'.$users['vkname'].'
						<td>'.$users['vkfamil'].'
						<td>'.$users['vkdr'].'<br>'.$skoklet.' лет (год)
						<td><img src="'.$users['vkimg'].'">
						<td>'.$users['reg_date'].'<br>'.$users['reg_time'].'
				</td>
			';
		}
	}
	echo '
		</table>
		</div>
	';
}
			?>
		</div>
	</div>
</body>
</html>