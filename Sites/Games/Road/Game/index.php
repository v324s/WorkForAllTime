<?
	$con=mysqli_connect('127.0.0.1','root','root','gameresults') or die();

	function setRandomSessid() {
		$_SESSION['sessid'] = md5(date('d.m.Y H:i:s').rand(1, 1000000));
	}
	/* создаем сессию в начале скрипта */

	if ($_GET['act']=='saveres' && $_GET['ses']==$_SESSION['sessid'] && $_GET['nick'] && $_GET['score']) {
		if ($_GET['ses']==$_SESSION['sessid']) {
			setRandomSessid();
			header("location:index.php?nick=".$_GET['nick']."&score=".$_GET['score']);
		}		
	}
	// записывает данные в БД и направляет на таблицу
	if ($_GET['nick'] && $_GET['score'] && !$_GET['time'] && !$_GET['date']) {
		$nick=$_GET['nick'];
		$score=$_GET['score'];
		$date=date('d.m.Y');
		$time=date('H')+1;
		$tim=date('i:s');
		$time=$time.':'.$tim;
		$ress=mysqli_query($con,"select * from resultsroad where nick='$nick' and score='$score' and date='$date'and time='$time'");
		$dn=mysqli_num_rows($ress);
		if ($dn==0 && !$bilres) {
			mysqli_query($con,"insert into resultsroad (nick,score,date,time) values ('$nick','$score','$date','$time')");
		}
		header("location:index.php?nick=".$nick."&score=".$score."&date=".$date."&time=".$time);
	}elseif ($_GET['nick'] && $_GET['score']=='0' && !$_GET['time'] && !$_GET['date']) {
		header("location:index.php");
	}
		setRandomSessid();
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>VKatafalku</title>
	<style type="text/css">
		body{
			color: white;
			background-color: black;
		}
		*{
			padding: 0;
			margin: 0;
		}
		canvas{
			background-color: #eee;
			display: block;
			margin: 10px auto 0 auto;
		}
		.nick{
			position: absolute;
		    margin-top: 250px;
		    border: 2px solid #fff;
		    margin-left: -32px;
		    padding: 5px;
		    font-size: 22px;
		    color: white;
		    background-color: #000488;
		}
		.bnick{
			    width: 209px;
			    margin: 0 auto;
		}
		.selectcar{
			width: 71px;
			height: 153px;
			position: absolute;
		}
		.selectcar:hover{
			background-color: #505050;
			cursor: pointer;
		}
		.selectedcars{
			width: 71px;
			height: 153px;
			position: absolute;
			padding: 4px;
			background-color: #ffeb0029;
			border: 2px solid #ffeb004f;
		}
		#pink{
			background-image: url(ico/pinkcar.png);
			margin-top: 370px;
   			margin-left: -78.5px;
   			background-repeat: no-repeat;
		    padding: 4px;
		    background-position: center;
		}
		#blue{
			background-image: url(ico/bluecar.png);
			margin-top: 370px;
    		margin-left: 21.5px;
    		background-repeat: no-repeat;
		    padding: 4px;
		    background-position: center;
		}
		#red{
			background-image: url(ico/redcar.png);
			margin-top: 370px;
    		margin-left: 121.5px;
    		background-repeat: no-repeat;
		    padding: 4px;
		    background-position: center;
		}
		#orange{
			background-image: url(ico/orangecar.png);
			margin-top: 370px;
  			margin-left: 211.5px;
  			background-repeat: no-repeat;
		    padding: 4px;
		    background-position: center;
		}
		.nachatigry {
		  position: absolute;
		  margin-top: 546px;
		  margin-left: -25px;
		  width: 268px;
		  height: 62px;
		}
		.nachatigry:hover{
			cursor: pointer;
		}






		
		.vmcan{

			margin: 10px auto 0 auto;
			border:1px solid white;
			width: 1024px;
			height: 768px;
			background-image: url(bg/finish.png);
		}
		.yblock{
		    width: 450px;
		    margin: 0 auto;
		    height: 26px;
		    margin-top: 256px;
		    margin-left: 301px;
		    border: 2px solid white;
		}
		.vrblock{
		    width: 450px;
		    margin: 0 auto;
		    height: 24px;
		    margin-top: 66px;
		    margin-left: 301px;
		    border: 2px solid white;
		}
		.bnick{
			    width: 209px;
			    margin: 0 auto;
		}
		.xyshatl{
			    width: 209px;
			    margin: 0 auto;
		}
		.vid{
		    float: left;
		    height: 23px;
		    width: 51px;
		    text-align: center;
		    font-size: 19px;
		    border-right: 2px solid white;
		}
		.id{
			float: left;
		    width: 51px;
		    height: 26px;
		    text-align: center;
		    font-size: 24px;
		    border-right: 2px solid white;
		}
		.vnickname{
		    float: left;
		    width: 225px;
		    height: 23px;
		    text-align: center;
		    margin-left: 1px;
		    font-size: 19px;
		    border-right: 2px solid white;;
		}
		.nickname{
			float: left;
		    width: 225px;
		    height: 26px;
		    text-align: center;
		    margin-left: 1px;
		    font-size: 21px;
		    border-right: 2px solid white;
		}
		.vscore{
		    float: left;
		    width: 168px;
		    height: 23px;
		    margin-left: 1px;
		    text-align: center;
		    font-size: 19px;
		}
		.score{
			float: left;
		    width: 168px;
		    height: 26px;
		    margin-left: 1px;
		    text-align: center;
		    font-size: 23px;
		}
		.stgame{
		    width: 268px;
		    height: 62px;
		    margin: 0 auto;
		    margin-top: 48.5px;
		    margin-left: 392.5px;
		}
		.stgame:hover{
			cursor: pointer;
		}
	</style>
	<script type="text/javascript">
		netcanvas=false;
		sessia="<?echo $_SESSION['sessid'];?>";
	</script>
</head>
<body>
	<?
		// таблица с результатами
		if ($_GET['nick'] && $_GET['score'] && $_GET['time'] && $_GET['date']) {
			$nick=$_GET['nick'];
			$score=$_GET['score'];
			$date=$_GET['date'];
			$time=$_GET['time'];
			$ress=mysqli_query($con,"select * from resultsroad where nick='$nick' and score='$score' and date='$date'and time='$time'");
			$dn=mysqli_fetch_array($ress);
			$zanpos=$dn['id'];
			$zannick=$dn['nick'];
			$nicksc=$dn['score'];
			$rese=mysqli_query($con,"select * from resultsroad order by score desc");
			$nrbd=mysqli_num_rows($rese);
			for ($i=1; $i <= $nrbd ; $i++) { 
				$dn=mysqli_fetch_array($rese);
				if ($dn['nick']==$nick && $dn['score']==$score && $dn['date']==$date && $dn['time']==$time && !$uzhebil) {
					$uzhebil=true;
					echo '<div class="vmcan" id="gameres">
							<div class="yblock">
								<div class="id">'.$i.'</div>
								<div class="nickname">'.$dn['nick'].'</div>
								<div class="score">'.$dn['score'].'</div>
							</div>';
					}
				}
			$res=mysqli_query($con,"select * from resultsroad order by score desc");
				for ($i=1; $i <= 10 ; $i++) { 
					$dan=mysqli_fetch_array($res);
					//echo '<br>'.$i.' - '.$dan['id'].' - '.$dan['nick'].' - '.$dan['score'];
					if ($i==1) {
						echo '<div class="vrblock" style="margin-top:50px;">
							<div class="vid">'.$i.'</div>
							<div class="vnickname">'.$dan['nick'].'</div>
							<div class="vscore">'.$dan['score'].'</div>
						</div>';
					}elseif($i>1){
					echo '<div class="vrblock" style="margin-top:-2px;">
						<div class="vid">'.$i.'</div>
						<div class="vnickname">'.$dan['nick'].'</div>
						<div class="vscore">'.$dan['score'].'</div>
					</div>';
					}
				}
			echo '<div class="stgame" id="stgame" onclick="gonastart()"></div>';
			echo '</div>
			<script type="text/javascript">
		netcanvas=true;
	</script>';

		}
		// если не передано переменных, то рисуем канавс с игрой
		if (!$_GET['nick'] && !$_GET['score'] && !$_GET['time'] && !$_GET['date']) {
			echo '<div id="putnick" class="bnick">
		<input type="text" class="nick" maxlength="10" name="nick" id="nick" value="Player">
		<div class="selectcar" id="pink" onclick="selectcarpink();"></div>
		<div class="selectcar" id="blue" onclick="selectcarblue();"></div>
		<div class="selectcar" id="red" onclick="selectcarred();"></div>
		<div class="selectcar" id="orange" onclick="selectcarorange();"></div>
		<div class="nachatigry" id="startgame" onclick="gamestart();"></div>
	</div>
<canvas id="mycanvas" width="1024" height="768"></canvas>';
		}
	?>
	<?
	// Если переданы все переменные, скрипт, который позволит играть еще
	if ($_GET['nick'] && $_GET['score'] && $_GET['time'] && $_GET['date']) {
		echo '
	<script type="text/javascript">
		function gonastart() {
			window.location.href="index";
			netcanvas=true;
		}
	</script>';}
		// НАЧИНКА \/
	?>
	
<script type="text/javascript">
	if (!netcanvas) {
		canvas=document.getElementById('mycanvas');
		ctx=canvas.getContext('2d');
		i=1;
		score=0;
		m1=1;
		m2=0;
		s1=0;
		s2=0;
		pgover=false;	
		userselcar=false;
		govbg=new Image();
		startbg=new Image();
		pausebg=new Image();
		redcarbg=new Image();
		statusgamebg=new Image();
		bluecarbg=new Image();
		orangecarbg=new Image();
		startbg1=new Image();
		startbg2=new Image();
		startbg3=new Image();
		pinkcarbg=new Image();
		useracarbg=new Image();
		repairbg=new Image();
		benzbg=new Image();
		gracarbgred=new Image();
		gracarbgblue=new Image();
		gracarbgpink=new Image();
		gracarbgorange=new Image();
		gracarbgorange.src='ico/orangecar.png';
		gracarbgpink.src='ico/pinkcar.png';
		gracarbgblue.src='ico/bluecar.png';
		gracarbgred.src='ico/redcar.png';
		repairbg.src='ico/repair.png';
		benzbg.src='ico/kanistra.png';
		pinkcarbg.src='ico/pinkcar.png';
		orangecarbg.src='ico/orangecar.png';
		bluecarbg.src='ico/bluecar.png';
		redcarbg.src='ico/redcar.png';
		pausebg.src='bg/pause.png';
		statusgamebg.src='bg/status1.png';
		startbg.src='bg/starter.png';
		govbg.src='bg/gov.png';
		startbg.onload=function () {
		ctx.drawImage(startbg, 0, 0);
		var mainInterval, mainInterval2;
	}
	userselectcar=0;
	divpinkcar=document.getElementById('pink');
	divbluecar=document.getElementById('blue');
	divredcar=document.getElementById('red');
	divorangecar=document.getElementById('orange');

	function selectcarpink() {
			if (divbluecar.className=='selectedcars') {
				divbluecar.className='selectcar';
			}
			if (divredcar.className=='selectedcars') {
				divredcar.className='selectcar';
			}
			if (divorangecar.className=='selectedcars') {
				divorangecar.className='selectcar';
			}
			divpinkcar.className='selectedcars';
			userselectcar=1;
			userselcar=true;
	}
	function selectcarblue() {
			if (divpinkcar.className=='selectedcars') {
				divpinkcar.className='selectcar';
			}
			if (divredcar.className=='selectedcars') {
				divredcar.className='selectcar';
			}
			if (divorangecar.className=='selectedcars') {
				divorangecar.className='selectcar';
			}
			divbluecar.className='selectedcars';
			userselectcar=2;
			userselcar=true;
	}
	function selectcarred() {
			if (divpinkcar.className=='selectedcars') {
				divpinkcar.className='selectcar';
			}
			if (divbluecar.className=='selectedcars') {
				divbluecar.className='selectcar';
			}
			if (divorangecar.className=='selectedcars') {
				divorangecar.className='selectcar';
			}
			divredcar.className='selectedcars';
			userselectcar=3;
			userselcar=true;
	}
	function selectcarorange() {
			if (divpinkcar.className=='selectedcars') {
				divpinkcar.className='selectcar';
			}
			if (divbluecar.className=='selectedcars') {
				divbluecar.className='selectcar';
			}
			if (divredcar.className=='selectedcars') {
				divredcar.className='selectcar';
			}
			divorangecar.className='selectedcars';
			userselectcar=4;
			userselcar=true;
	}

	widthcar=71;
	heightcar=153;
	xusercar=451.5;
	yusercar=576;
	globalpause=false;
	function drawusercar() {
		if (userselectcar==1) { //pink
			useracarbg.src='ico/pinkcar.png';
			ctx.drawImage(useracarbg,xusercar,yusercar);
		}else if (userselectcar==2) {//blue
			useracarbg.src='ico/bluecar.png';
			ctx.drawImage(useracarbg,xusercar,yusercar);
		}else if (userselectcar==3) {//red
			useracarbg.src='ico/redcar.png';
			ctx.drawImage(useracarbg,xusercar,yusercar);
		}else if (userselectcar==4) {//orange
			useracarbg.src='ico/orangecar.png';
			ctx.drawImage(useracarbg,xusercar,yusercar);
		}
	}
	function gamestart(){
		usernickname=document.getElementById('nick');
		if (usernickname.value=='' || !userselcar) {
			if (usernickname.value=='') {
				alert('Введите nickname!');
			}
			if (!userselcar) {
				alert('Выберите машину!');
			}
		}else{
			estlinick=true;
			gamestarted=true;
			pause=false;
			startbg1.src='bg/DOROGAA1.png';
			startbg2.src='bg/DOROGAA2.png';
			startbg3.src='bg/DOROGAA3.png';
			//startbg.src='bg/dorogagif.gif';
			document.getElementById('putnick').style.display='none';
			canvas.onclick=function () {
				if (estlinick && gamestarted && pause==false) {
					pause=true;
					ctx.drawImage(pausebg, 0, 0);
				}else if (estlinick && gamestarted && pause){
					pause=false;
				}
			}
			if (globalpause==false) {
				function doroga() {
					console.log('interval');
					if (estlinick && pause==false && userselcar && gamestarted) {
						ctx.clearRect(0,0,canvas.width,canvas.height);
						dvizhdorogi();
						ctx.drawImage(statusgamebg,0,0);
						statainstatus();
						drawusercar();
						dvizheniemashini();
					}
				}
				mainInterval2=setInterval(doroga,10);
				setInterval(timer,1000);
				setInterval(spawngracar,1000);
				mainInterval=setInterval(gameover,10);
			}
		}
	}
		function dvizhdorogi() {
			if (i==1) {
				ctx.drawImage(startbg1,0,0);
				i++;
			}else if (i==2) {
				ctx.drawImage(startbg2,0,0);
				i++;
			}else if (i==3) {
				ctx.drawImage(startbg3,0,0);
				i=1;
			}
		}
		
	document.addEventListener('keydown', keyDownHandler, false);
	document.addEventListener('keyup', keyUpHandler, false);
rightPress=false;
leftPress=false;
upPress=false;
downPress=false;
	function keyDownHandler(e) {
		if (e.keyCode==39) {
			rightPress=true;
		}else if (e.keyCode==37) {
			leftPress=true;
		}else if (e.keyCode==38) {
			upPress=true;
		}else if (e.keyCode==40) {
			downPress=true;
		}
	}

	function keyUpHandler(e) {
		if (e.keyCode==39) {
			rightPress=false;
		}else if (e.keyCode==37) {
			leftPress=false;
		}else if (e.keyCode==38) {
			upPress=false;
		}else if (e.keyCode==40) {
			downPress=false;
		}
}
function gameover() {
		if (stateheight<0 || fuelheight<0 || m1<1 && m2<1 && s1<1 && s2<1) {
			pgover=true;
			globalpause=true;
			pause=true;
			nck=usernickname.value;
			ctx.drawImage(govbg,0,0);
			clearInterval(mainInterval);
			clearInterval(mainInterval2);
			setTimeout(function(){
				window.location.href = 'index?act=saveres&ses='+sessia+'&nick='+nck+'&score='+score;
			}, 1 * 1000);
		}
	}
	function dvizheniemashini() {
		if (rightPress && xusercar<611.5) {
			if (rightPress && xusercar<611.5 && upPress) {
				xusercar+=4;
			}else{
				xusercar+=2;
			}
		}else if(leftPress && xusercar>289.5){
			if (leftPress && xusercar>289.5 && upPress) {
				xusercar-=4;
			}else{
				xusercar-=2;
			}
		}
		if(upPress){
			ygcmili=0;
			if (yusercar>4) {
				yusercar-=1;
			}
			while(ygcmili<4){
				ygcmili+=0.000015;
			}
			
			if (gracar1postavlena) {
				ygcar1+=ygcmili;
			}
			if (gracar2postavlena) {
				ygcar2+=ygcmili;
			}
			if (gracar3postavlena) {
				ygcar3+=ygcmili;
			}
			if (gracar4postavlena) {
				ygcar4+=ygcmili;
			}
			if (gracar5postavlena) {
				ygcar5+=ygcmili;
			}
			if (gracar6postavlena) {
				ygcar6+=ygcmili;
			}
			if (gracar7postavlena) {
				ygcar7+=ygcmili;
			}
			if (gracar8postavlena) {
				ygcar8+=ygcmili;
			}

			if (gracar9postavlena) {
				ygcar9+=ygcmili;
			}
			if (gracar10postavlena) {
				ygcar10+=ygcmili;
			}
			if (gracar11postavlena) {
				ygcar11+=ygcmili;
			}
			if (gracar12postavlena) {
				ygcar12+=ygcmili;
			}
			if (spawntools==true){
  				ytoolsk+=ygcmili;
  			}
  			if (spawnfuel==true){
  				yfuelk+=ygcmili;
  			}
  		
		}else if(downPress){
			ygcmili=0;
			if (yusercar<610) {
				yusercar+=1;
			}
			while(ygcmili<2){
				ygcmili+=0.000015;
			}
			
			if (gracar1postavlena) {
				ygcar1-=ygcmili;
			}
			if (gracar2postavlena) {
				ygcar2-=ygcmili;
			}
			if (gracar3postavlena) {
				ygcar3-=ygcmili;
			}
			if (gracar4postavlena) {
				ygcar4-=ygcmili;
			}
			if (gracar5postavlena) {
				ygcar5-=ygcmili;
			}
			if (gracar6postavlena) {
				ygcar6-=ygcmili;
			}
			if (gracar7postavlena) {
				ygcar7-=ygcmili;
			}
			if (gracar8postavlena) {
				ygcar8-=ygcmili;
			}
			if (gracar9postavlena) {
				ygcar9-=ygcmili;
			}
			if (gracar10postavlena) {
				ygcar10-=ygcmili;
			}
			if (gracar11postavlena) {
				ygcar11-=ygcmili;
			}
			if (gracar12postavlena) {
				ygcar12-=ygcmili;
			}
  			if (spawntools==true){
  				ytoolsk-=ygcmili-0.5;
  			}
  			if (spawnfuel==true){
  				yfuelk-=ygcmili-0.5;
  			}
		}
		
	}
	function statainstatus() {
		if (!upPress && !downPress && yusercar<610) {
			yusercar+=0.2;
		}
		nickname();
		scoreschet();
		statefuel();
		statestate();
		time();
		newfuel();
		newtools();
		dvizhcar();
		collisioncar();
	}
	function collisioncar() {
			//xgcar1,ygcar1
			//yusercar
			//	widthcar=71;
			//heightcar=153;
			//xusercar
		
		if (gracar1postavlena==true) {
			ygcar1=Math.round(ygcar1);
			yusercar=Math.round(yusercar);
			if (xusercar<xgcar1 && xusercar+widthcar>xgcar1 && xgcar1+widthcar>xusercar+widthcar || xusercar==xgcar1 && xusercar+widthcar==xgcar1+widthcar || xusercar>xgcar1 && xusercar+widthcar>xgcar1+widthcar && xgcar1+widthcar>xusercar) {

				if (ygcar1+heightcar>yusercar+1 && yusercar>ygcar1) {
					if (usninaval!='terter') {
						stateheight-=30;
						ystate+=30;
					}
					gracar1postavlena=false;
				}
				if (ygcar1+1<yusercar+heightcar && yusercar<ygcar1) {
					if (usninaval!='terter') {
						stateheight-=30;
						ystate+=30;
					}
					gracar1postavlena=false;
				}
				
				
			}
		}
		if (gracar2postavlena==true) {
			ygcar2=Math.round(ygcar2);
			yusercar=Math.round(yusercar);
			if (xusercar<xgcar2 && xusercar+widthcar>xgcar2 && xgcar2+widthcar>xusercar+widthcar || xusercar==xgcar2 && xusercar+widthcar==xgcar2+widthcar || xusercar>xgcar2 && xusercar+widthcar>xgcar2+widthcar && xgcar2+widthcar>xusercar) {

				if (ygcar2+heightcar>yusercar+1 && yusercar>ygcar2) {
					if (usninaval!='terter') {
						stateheight-=30;
						ystate+=30;
					}
					gracar2postavlena=false;
				}
				if (ygcar2+1<yusercar+heightcar && yusercar<ygcar2) {
					if (usninaval!='terter') {
						stateheight-=30;
						ystate+=30;
					}
					gracar2postavlena=false;
				}	
			}
		}
		if (gracar3postavlena==true) {
			ygcar3=Math.round(ygcar3);
			yusercar=Math.round(yusercar);
			if (xusercar<xgcar3 && xusercar+widthcar>xgcar3 && xgcar3+widthcar>xusercar+widthcar  || xusercar==xgcar3 && xusercar+widthcar==xgcar3+widthcar || xusercar>xgcar3 && xusercar+widthcar>xgcar3+widthcar && xgcar3+widthcar>xusercar) {

				if (ygcar3+heightcar>yusercar+1 && yusercar>ygcar3) {
					if (usninaval!='terter') {
						stateheight-=30;
						ystate+=30;
					}
					gracar3postavlena=false;
				}
				if (ygcar3+1<yusercar+heightcar && yusercar<ygcar3) {
					if (usninaval!='terter') {
						stateheight-=30;
						ystate+=30;
					}
					gracar3postavlena=false;
				}
			}
		}
		if (gracar4postavlena==true) {
			ygcar4=Math.round(ygcar4);
			yusercar=Math.round(yusercar);
			if (xusercar<xgcar4 && xusercar+widthcar>xgcar4 && xgcar4+widthcar>xusercar+widthcar || xusercar==xgcar4 && xusercar+widthcar==xgcar4+widthcar || xusercar>xgcar4 && xusercar+widthcar>xgcar4+widthcar && xgcar4+widthcar>xusercar) {

				if (ygcar4+heightcar>yusercar+1 && yusercar>ygcar4) {
					if (usninaval!='terter') {
						stateheight-=30;
						ystate+=30;
					}
					gracar4postavlena=false;
				}
				if (ygcar4+1<yusercar+heightcar && yusercar<ygcar4) {
					if (usninaval!='terter') {
						stateheight-=30;
						ystate+=30;
					}
					gracar4postavlena=false;
				}
			}
		}
		if (gracar5postavlena==true) {
			ygcar5=Math.round(ygcar5);
			yusercar=Math.round(yusercar);
			if (xusercar<xgcar5 && xusercar+widthcar>xgcar5 && xgcar5+widthcar>xusercar+widthcar || xusercar==xgcar5 && xusercar+widthcar==xgcar5+widthcar || xusercar>xgcar5 && xusercar+widthcar>xgcar5+widthcar && xgcar5+widthcar>xusercar) {

				if (ygcar5+heightcar>yusercar+1 && yusercar>ygcar5) {
					if (usninaval!='terter') {
						stateheight-=30;
						ystate+=30;
					}
					gracar5postavlena=false;
				}
				if (ygcar5+1<yusercar+heightcar && yusercar<ygcar5) {
					if (usninaval!='terter') {
						stateheight-=30;
						ystate+=30;
					}
					gracar5postavlena=false;
				}
			}
		}
		if (gracar6postavlena==true) {
			ygcar6=Math.round(ygcar6);
			yusercar=Math.round(yusercar);
			if (xusercar<xgcar6 && xusercar+widthcar>xgcar6 && xgcar6+widthcar>xusercar+widthcar || xusercar==xgcar6 && xusercar+widthcar==xgcar6+widthcar || xusercar>xgcar6 && xusercar+widthcar>xgcar6+widthcar && xgcar6+widthcar>xusercar) {

				if (ygcar6+heightcar>yusercar+1 && yusercar>ygcar6) {
					if (usninaval!='terter') {
						stateheight-=30;
						ystate+=30;
					}
					gracar6postavlena=false;
				}
				if (ygcar6+1<yusercar+heightcar && yusercar<ygcar6) {
					if (usninaval!='terter') {
						stateheight-=30;
						ystate+=30;
					}
					gracar6postavlena=false;
				}
			}
		}
		if (gracar7postavlena==true) {
			ygcar7=Math.round(ygcar7);
			yusercar=Math.round(yusercar);
			if (xusercar<xgcar7 && xusercar+widthcar>xgcar7 && xgcar7+widthcar>xusercar+widthcar || xusercar==xgcar7 && xusercar+widthcar==xgcar7+widthcar || xusercar>xgcar7 && xusercar+widthcar>xgcar7+widthcar && xgcar7+widthcar>xusercar) {

				if (ygcar7+heightcar>yusercar+1 && yusercar>ygcar7) {
					if (usninaval!='terter') {
						stateheight-=30;
						ystate+=30;
					}
					gracar7postavlena=false;
				}
				if (ygcar7+1<yusercar+heightcar && yusercar<ygcar7) {
					if (usninaval!='terter') {
						stateheight-=30;
						ystate+=30;
					}
					gracar7postavlena=false;
				}
			}
		}
		if (gracar8postavlena==true) {
			ygcar8=Math.round(ygcar8);
			yusercar=Math.round(yusercar);
			if (xusercar<xgcar8 && xusercar+widthcar>xgcar8 && xgcar8+widthcar>xusercar+widthcar || xusercar==xgcar8 && xusercar+widthcar==xgcar8+widthcar || xusercar>xgcar8 && xusercar+widthcar>xgcar8+widthcar && xgcar8+widthcar>xusercar) {

				if (ygcar8+heightcar>yusercar+1 && yusercar>ygcar8) {
					if (usninaval!='terter') {
						stateheight-=30;
						ystate+=30;
					}
					gracar8postavlena=false;
				}
				if (ygcar8+1<yusercar+heightcar && yusercar<ygcar8) {
					if (usninaval!='terter') {
						stateheight-=30;
						ystate+=30;
					}
					gracar8postavlena=false;
				}
			}
		}
		if (gracar9postavlena==true) {
			ygcar9=Math.round(ygcar9);
			yusercar=Math.round(yusercar);
			if (xusercar<xgcar9 && xusercar+widthcar>xgcar9 && xgcar9+widthcar>xusercar+widthcar || xusercar==xgcar9 && xusercar+widthcar==xgcar9+widthcar || xusercar>xgcar9 && xusercar+widthcar>xgcar9+widthcar && xgcar9+widthcar>xusercar) {

				if (ygcar9+heightcar>yusercar+1 && yusercar>ygcar9) {
					if (usninaval!='terter') {
						stateheight-=30;
						ystate+=30;
					}
					gracar9postavlena=false;
				}
				if (ygcar9+1<yusercar+heightcar && yusercar<ygcar9) {
					if (usninaval!='terter') {
						stateheight-=30;
						ystate+=30;
					}
					gracar9postavlena=false;
				}
			}
		}
		if (gracar10postavlena==true) {
			ygcar10=Math.round(ygcar10);
			yusercar=Math.round(yusercar);
			if (xusercar<xgcar10 && xusercar+widthcar>xgcar10 && xgcar10+widthcar>xusercar+widthcar || xusercar==xgcar10 && xusercar+widthcar==xgcar10+widthcar || xusercar>xgcar10 && xusercar+widthcar>xgcar10+widthcar && xgcar10+widthcar>xusercar) {

				if (ygcar10+heightcar>yusercar+1 && yusercar>ygcar10) {
					if (usninaval!='terter') {
						stateheight-=30;
						ystate+=30;
					}
					gracar10postavlena=false;
				}
				if (ygcar10+1<yusercar+heightcar && yusercar<ygcar10) {
					if (usninaval!='terter') {
						stateheight-=30;
						ystate+=30;
					}
					gracar10postavlena=false;
				}
			}
		}
		if (gracar11postavlena==true) {
			ygcar11=Math.round(ygcar11);
			yusercar=Math.round(yusercar);
			if (xusercar<xgcar11 && xusercar+widthcar>xgcar11 && xgcar11+widthcar>xusercar+widthcar || xusercar==xgcar11 && xusercar+widthcar==xgcar11+widthcar || xusercar>xgcar11 && xusercar+widthcar>xgcar11+widthcar && xgcar11+widthcar>xusercar) {

				if (ygcar11+heightcar>yusercar+1 && yusercar>ygcar11) {
					if (usninaval!='terter') {
						stateheight-=30;
						ystate+=30;
					}
					gracar11postavlena=false;
				}
				if (ygcar11+1<yusercar+heightcar && yusercar<ygcar11) {
					if (usninaval!='terter') {
						stateheight-=30;
						ystate+=30;
					}
					gracar11postavlena=false;
				}
			}
		}
		if (gracar12postavlena==true) {
			ygcar12=Math.round(ygcar12);
			yusercar=Math.round(yusercar);
			if (xusercar<xgcar12 && xusercar+widthcar>xgcar12 && xgcar12+widthcar>xusercar+widthcar || xusercar==xgcar12 && xusercar+widthcar==xgcar12+widthcar|| xusercar>xgcar12 && xusercar+widthcar>xgcar12+widthcar && xgcar12+widthcar>xusercar) {

				if (ygcar12+heightcar>yusercar+1 && yusercar>ygcar12) {
					if (usninaval!='terter') {
						stateheight-=30;
						ystate+=30;
					}
					gracar12postavlena=false;
				}
				if (ygcar12+1<yusercar+heightcar && yusercar<ygcar12) {
					if (usninaval!='terter') {
						stateheight-=30;
						ystate+=30;
					}
					gracar12postavlena=false;
				}
			}
		}
		if (yusercar>canvas.height) {
			xusercar=451.5;
			yusercar=576;
		}
	}
	function randomspawncar(min, max) {
		  spawncarin=Math.random() * (max - min) + min;
		  return spawncarin=Math.round(spawncarin);
	}
	function randomhowcar(otsuda, dosuda) {
		  howcar=Math.random() * (max - min) + min;
		  return howcar=Math.round(howcar);
	}
	gracar1postavlena=false;
	gracar2postavlena=false;
	gracar3postavlena=false;
	gracar4postavlena=false;
	gracar5postavlena=false;
	gracar6postavlena=false;
	gracar7postavlena=false;
	gracar8postavlena=false;
	gracar9postavlena=false;
	gracar10postavlena=false;
	gracar11postavlena=false;
	gracar12postavlena=false;
	function dvizhcar() {
		if (gracar1postavlena) {
			ygcar1+=3;
			ctx.drawImage(gracarbgpink,xgcar1,ygcar1);
			if (ygcar1>canvas.height) {
				gracar1postavlena=false;
				score+=150;
			}
		}
		if (gracar5postavlena) {
			ygcar5+=3;
			ctx.drawImage(gracarbgpink,xgcar5,ygcar5);
			if (ygcar5>canvas.height) {
				gracar5postavlena=false;
				score+=150;
			}
		}
		if (gracar9postavlena) {
			ygcar9+=3;
			ctx.drawImage(gracarbgpink,xgcar9,ygcar9);
			if (ygcar9>canvas.height) {
				gracar9postavlena=false;
				score+=150;
			}
		}
		if (gracar2postavlena) {
			ygcar2+=3;
			ctx.drawImage(gracarbgblue,xgcar2,ygcar2);
			if (ygcar2>canvas.height) {
				gracar2postavlena=false;
				score+=150;
			}
		}
		if (gracar6postavlena) {
			ygcar6+=3;
			ctx.drawImage(gracarbgblue,xgcar6,ygcar6);
			if (ygcar6>canvas.height) {
				gracar6postavlena=false;
				score+=150;
			}
		}
		if (gracar10postavlena) {
			ygcar10+=3;
			ctx.drawImage(gracarbgblue,xgcar10,ygcar10);
			if (ygcar10>canvas.height) {
				gracar10postavlena=false;
				score+=150;
			}
		}
		if (gracar3postavlena) {
			ygcar3+=3;
			ctx.drawImage(gracarbgred,xgcar3,ygcar3);
			if (ygcar3>canvas.height) {
				gracar3postavlena=false;
				score+=150;
			}
		}
		if (gracar7postavlena) {
			ygcar7+=3;
			ctx.drawImage(gracarbgred,xgcar7,ygcar7);
			if (ygcar7>canvas.height) {
				gracar7postavlena=false;
				score+=150;
			}
		}
		if (gracar11postavlena) {
			ygcar11+=3;
			ctx.drawImage(gracarbgred,xgcar11,ygcar11);
			if (ygcar11>canvas.height) {
				gracar11postavlena=false;
				score+=150;
			}
		}
		if (gracar4postavlena) {
			ygcar4+=3;
			ctx.drawImage(gracarbgorange,xgcar4,ygcar4);
			if (ygcar4>canvas.height) {
				gracar4postavlena=false;
				score+=150;
			}
		}
		if (gracar8postavlena) {
			ygcar8+=3;
			ctx.drawImage(gracarbgorange,xgcar8,ygcar8);
			if (ygcar8>canvas.height) {
				gracar8postavlena=false;
				score+=150;
			}
		}
		if (gracar12postavlena) {
			ygcar12+=3;
			ctx.drawImage(gracarbgorange,xgcar12,ygcar12);
			if (ygcar12>canvas.height) {
				gracar12postavlena=false;
				score+=150;
			}
		}
	}
	function spawngracar() {
		if (pause==false) {
		carwid=71;
		carhei=153;
		ygracar=-155;
		min=1;
		max=4;
		randomspawncar(min,max);
			otsuda=1;
			dosuda=4;
			randomhowcar(otsuda, dosuda);
			if (howcar==userselectcar) {
				randomhowcar(otsuda, dosuda);
			}else{
			if (spawncarin==1) {
				xgracar=319;
			}
			if (spawncarin==2) {
				xgracar=403;
			}
			if (spawncarin==3) {
				xgracar=503;
			}
			if (spawncarin==4) {
				xgracar=589;
			}
			if (howcar==1 && gracar1postavlena==false) {
				gracar1postavlena=true;
				ctx.drawImage(gracarbgpink,xgracar,ygracar);
				ygcar1=ygracar;
				xgcar1=xgracar;
			}else
			if (howcar==2 && gracar2postavlena==false) {
				gracar2postavlena=true;
				ctx.drawImage(gracarbgblue,xgracar,ygracar);
				ygcar2=ygracar;
				xgcar2=xgracar;
			}else
			if (howcar==3 && gracar3postavlena==false) {
				gracar3postavlena=true;
				ctx.drawImage(gracarbgred,xgracar,ygracar);
				ygcar3=ygracar;
				xgcar3=xgracar;
			}else
			if (howcar==4 && gracar4postavlena==false) {
				gracar4postavlena=true;
				ctx.drawImage(gracarbgorange,xgracar,ygracar);
				ygcar4=ygracar;
				xgcar4=xgracar;
			}else
			if (howcar==1 && gracar5postavlena==false) {
				gracar5postavlena=true;
				ctx.drawImage(gracarbgpink,xgracar,ygracar);
				ygcar5=ygracar;
				xgcar5=xgracar;
			}else
			if (howcar==2 && gracar6postavlena==false) {
				gracar6postavlena=true;
				ctx.drawImage(gracarbgblue,xgracar,ygracar);
				ygcar6=ygracar;
				xgcar6=xgracar;
			}else
			if (howcar==3 && gracar7postavlena==false) {
				gracar7postavlena=true;
				ctx.drawImage(gracarbgred,xgracar,ygracar);
				ygcar7=ygracar;
				xgcar7=xgracar;
			}else
			if (howcar==4 && gracar8postavlena==false) {
				gracar8postavlena=true;
				ctx.drawImage(gracarbgorange,xgracar,ygracar);
				ygcar8=ygracar;
				xgcar8=xgracar;
			}else
			if (howcar==1 && gracar9postavlena==false) {
				gracar9postavlena=true;
				ctx.drawImage(gracarbgpink,xgracar,ygracar);
				ygcar9=ygracar;
				xgcar9=xgracar;
			}else
			if (howcar==2 && gracar10postavlena==false) {
				gracar10postavlena=true;
				ctx.drawImage(gracarbgblue,xgracar,ygracar);
				ygcar10=ygracar;
				xgcar10=xgracar;
			}else
			if (howcar==3 && gracar11postavlena==false) {
				gracar11postavlena=true;
				ctx.drawImage(gracarbgred,xgracar,ygracar);
				ygcar11=ygracar;
				xgcar11=xgracar;
			}else
			if (howcar==4 && gracar12postavlena==false) {
				gracar12postavlena=true;
				ctx.drawImage(gracarbgorange,xgracar,ygracar);
				ygcar12=ygracar;
				xgcar12=xgracar;
			}

		}
	}
	}
	function nickname() {
	    ctx.font = "28px Arial";
	    ctx.fillStyle = "Yellow";
	    usninaval=usernickname.value;
	    xnick=0;
	    if (usninaval.length==10) {xnick=810;}
	    if (usninaval.length==9) {xnick=818;}
	    if (usninaval.length==8) {xnick=828;}
	    if (usninaval.length==7) {xnick=836;}
	    if (usninaval.length==6) {xnick=844;}
	    if (usninaval.length==5) {xnick=852;}
	    if (usninaval.length==4) {xnick=860;}
	    if (usninaval.length==3) {xnick=868;}
	    if (usninaval.length==2) {xnick=876;}
	    if (usninaval.length==1) {xnick=884;}
	    ctx.fillText(usernickname.value,xnick,canvas.height-55); 
	}
	function scoreschet() {
		xxscore=0;
	    ctx.font = "38px Arial";
	    ctx.fillStyle = "#3ed801";
	    sscore=score;
	    if (sscore.toString().length==9) {xscore=798;}
	    if (sscore.toString().length==8) {xscore=808;}
	    if (sscore.toString().length==7) {xscore=823;}
	    if (sscore.toString().length==6) {xscore=832;}
	    if (sscore.toString().length==5) {xscore=840;}
	    if (sscore.toString().length==4) {xscore=853;}
	    if (sscore.toString().length==3) {xscore=860;}
	    if (sscore.toString().length==2) {xscore=873;}
	    if (sscore.toString().length==1) {xscore=884;}
	    ctx.fillText(score,xscore,140);
	    score++; 
	}
	fuelwidth=84;
	fuelheight=184;
	xfuel=909;
	yfuel=319;
	function statefuel() {
			if (fuelheight>0) {
				fuelheight-=0.05;
				yfuel+=0.05;
			}
			ctx.beginPath();
            ctx.rect(xfuel, yfuel, fuelwidth, fuelheight);
            if (fuelheight<=184) {ctx.fillStyle = "#33cc00";}
            if (fuelheight<=160) {ctx.fillStyle = "#66cc00";}
            if (fuelheight<=136) {ctx.fillStyle = "#99cc00";}
            if (fuelheight<=112) {ctx.fillStyle = "#cccc00";}
            if (fuelheight<=88) {ctx.fillStyle = "#cc9900";}
            if (fuelheight<=64) {ctx.fillStyle = "#cc6600";}
            if (fuelheight<=40) {ctx.fillStyle = "#cc3300";}
            if (fuelheight<=14) {ctx.fillStyle = "#cc0000";}
            ctx.fill();
            ctx.closePath();
	}
	statewidth=84;
	stateheight=184;
	xstate=791;
	ystate=319;
	function statestate() {
			if (stateheight>0) {
				stateheight-=0.02;
				ystate+=0.02;
			}
			ctx.beginPath();
            ctx.rect(xstate, ystate, statewidth, stateheight);
            if (stateheight<=184) {ctx.fillStyle = "#33cc00";}
            if (stateheight<=160) {ctx.fillStyle = "#66cc00";}
            if (stateheight<=136) {ctx.fillStyle = "#99cc00";}
            if (stateheight<=112) {ctx.fillStyle = "#cccc00";}
            if (stateheight<=88) {ctx.fillStyle = "#cc9900";}
            if (stateheight<=64) {ctx.fillStyle = "#cc6600";}
            if (stateheight<=40) {ctx.fillStyle = "#cc3300";}
            if (stateheight<=14) {ctx.fillStyle = "#cc0000";}
            ctx.fill();
            ctx.closePath();
	}
	function time() {
	    ctx.font = "38px Arial";
	    ctx.fillStyle = "#00b2cc";
	    ctx.fillText(m1+''+m2+':'+s1+s2, 847, 250);
	}
	function timer() {
		if (pause==false) {
			if (usninaval!='terter') {
				if (s2==0) {
					if (s1==0) {
						if (m1==1) {
							m1--;
							m2=9;
							s1=5
							s2=9;
						}else{
							m2--;
							s1=5
							s2=9;
						}
						
					}else{
						s1--;
						s2=9;
					}
				}else{
					s2--;
				}
			}
		}
	}

	function randomvr(min, max) {
		  spawnin=Math.random() * (max - min) + min;
		  return spawnin=Math.round(spawnin);
		}
		function randomfuel(min, max) {
		  spawninf=Math.random() * (max - min) + min;
		  return spawninf=Math.round(spawninf);
		}
spawntools=false;
posstate1=stateheight/2; //92
posstate2=posstate1/2; //46
posstate3=posstate2/2; //23
function newtools() {
	skokstate=Math.round(stateheight);
	if ((skokstate==posbenz1 || skokstate==posbenz2 || skokstate==posbenz3) && spawntools==false) {
		min=300;
  		max=600;
  		ytoolsk=-50;
  		randomvr(min,max);
  		widtools=42;
  		heitools=48;
  		x1tools=spawnin;
  		x2tools=spawnin+widtools;

  		ctx.drawImage(repairbg,spawnin,ytoolsk);
  		spawntools=true;
	}
	if (spawntools==true) {
		ytoolsk+=2;
		ctx.drawImage(repairbg,spawnin,ytoolsk);
		if (xusercar<x1tools && xusercar+widthcar>x2tools && ytoolsk>yusercar && yusercar+heightcar>ytoolsk+heitools) {
			spawntools=false;
			stateheight+=60;
			ystate-=60;
			score+=350;
		}
		if (ytoolsk>canvas.height) {
			spawntools=false;
		}
	}
}

spawnfuel=false;
posbenz1=fuelheight/2; //92
posbenz2=posbenz1/2; //46
posbenz3=posbenz2/2; //23
function newfuel() {
	skokbenza=Math.round(fuelheight);
	if ((skokbenza==posbenz1 || skokbenza==posbenz2 || skokbenza==posbenz3) && spawnfuel==false) {
		min=300;
  		max=600;
  		yfuelk=-50;
  		randomfuel(min,max);
  		widfuel=42;
  		heifuel=48;
  		x1fuel=spawninf;
  		x2fuel=spawninf+widfuel;

  		ctx.drawImage(benzbg,spawninf,yfuelk);
  		spawnfuel=true;
	}
	if (spawnfuel==true) {
		yfuelk+=2;
		ctx.drawImage(benzbg,spawninf,yfuelk);
		if (xusercar<x1fuel && xusercar+widthcar>x2fuel && yfuelk>yusercar && yusercar+heightcar>yfuelk+heifuel) {
			spawnfuel=false;
			fuelheight+=60;
			yfuel-=60;
			score+=150;
		}
		if (yfuelk>canvas.height) {
			spawnfuel=false;
		}
	}
}
}

</script>
</body>
</html>