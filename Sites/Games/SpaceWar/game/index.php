<?
	$con=mysqli_connect('127.0.0.1','root','root','gameresults') or die();
	
	// записывает данные в БД и направляет на таблицу
	if ($_GET['nick'] && $_GET['score'] && !$_GET['time'] && !$_GET['date']) {
		$nick=$_GET['nick'];
		$score=$_GET['score'];
		$date=date('d.m.Y');
		$time=date('H')+1;
		$tim=date('i:s');
		$time=$time.':'.$tim;
		$ress=mysqli_query($con,"select * from results where nick='$nick' and score='$score' and date='$date'and time='$time'");
		$dn=mysqli_fetch_array($ress);
		if (!$dn) {
			
		mysqli_query($con,"insert into results (nick,score,date,time) values ('$nick','$score','$date','$time')");
		}
		header("location:index.php?nick=".$nick."&score=".$score."&date=".$date."&time=".$time);
	}elseif ($_GET['nick'] && $_GET['score']=='0' && !$_GET['time'] && !$_GET['date']) {
		header("location:index.php");
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>cavas</title>
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
			margin: 100px auto 0 auto;
			/*border:1px solid white;*/
		}
		.vmcan{

			margin: 100px auto 0 auto;
			border:1px solid white;
			width: 640px;
			height: 480px;
			background-image: url(bg/gameover.png);
		}
		.nick{

			    position: absolute;
    margin-top: 250px;
    border: 2px solid #0523f5;
        margin-left: 5px;
    padding: 5px;
    font-size: 16px;
		}
		.yblock{
			width: 284px;
		    margin: 0 auto;
		    height: 26px;
		    margin-top: 66px;
		    margin-left: 190px;
		}
		.vrblock{
			width: 284px;
		    margin: 0 auto;
		    height: 24px;
		    margin-top: 66px;
		    margin-left: 190px;
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
			width: 51px;
		    height: 23px;
		    text-align: center;
		    font-size: 19px;
		}
		.id{
			float: left;
			width: 51px;
		    height: 26px;
		    text-align: center;
		    font-size: 24px;
		}
		.vnickname{
			float: left;
			width: 155px;
		    height: 23px;
			text-align: center;
			margin-left: 1px;
		    font-size: 19px;
		}
		.nickname{
			float: left;
			width: 155px;
		    height: 26px;
			text-align: center;
			margin-left: 1px;
		    font-size: 21px;
		}
		.vscore{
			float: left;
			width: 76px;
		    height: 23px;
		    margin-left: 1px;
			text-align: center;
		    font-size: 19px;
		}
		.score{
			float: left;
			width: 76px;
		    height: 26px;
		    margin-left: 1px;
			text-align: center;
		    font-size: 23px;
		}
		.stgame{
			    width: 206px;
		    height: 44px;
		    margin: 0 auto;
		    margin-top: 16.5px;
		    margin-left: 237.5px;
		}
		.stgame:hover{
			cursor: pointer;
		}
	</style>
<script type="text/javascript">
		netcanvas=false;
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
			$ress=mysqli_query($con,"select * from results where nick='$nick' and score='$score' and date='$date'and time='$time'");
			$dn=mysqli_fetch_array($ress);
			$zanpos=$dn['id'];
			$zannick=$dn['nick'];
			$nicksc=$dn['score'];
			$rese=mysqli_query($con,"select * from results order by score desc");
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
			$res=mysqli_query($con,"select * from results order by score desc");
				for ($i=1; $i <= 10 ; $i++) { 
					$dan=mysqli_fetch_array($res);
					//echo '<br>'.$i.' - '.$dan['id'].' - '.$dan['nick'].' - '.$dan['score'];
					if ($i==1) {
						echo '<div class="vrblock" style="margin-top:32px;">
							<div class="vid"></div>
							<div class="vnickname">'.$dan['nick'].'</div>
							<div class="vscore">'.$dan['score'].'</div>
						</div>';
					}elseif($i==2 || $i==8){
					echo '<div class="vrblock" style="margin-top:2px;">
						<div class="vid"></div>
						<div class="vnickname">'.$dan['nick'].'</div>
						<div class="vscore">'.$dan['score'].'</div>
					</div>';
					}elseif($i==3){
					echo '<div class="vrblock" style="margin-top:4px;">
						<div class="vid"></div>
						<div class="vnickname">'.$dan['nick'].'</div>
						<div class="vscore">'.$dan['score'].'</div>
					</div>';
					}elseif($i==4 || $i==6 || $i==7 || $i==9){
					echo '<div class="vrblock" style="margin-top:3px;">
						<div class="vid"></div>
						<div class="vnickname">'.$dan['nick'].'</div>
						<div class="vscore">'.$dan['score'].'</div>
					</div>';
					}elseif($i==5 || $i==10){
					echo '<div class="vrblock" style="margin-top:3.5px;">
						<div class="vid"></div>
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
		<input type="text" class="nick" maxlength="12" name="nick" id="nick" value="Player">
	</div>

<canvas id="mycanvas" width="640" height="480"></canvas>';
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
	nick=document.getElementById('nick');
	ctx=canvas.getContext('2d');
	
	var mainInterval;
	gamestart=false; 										// игра началась
	health=3;												// колво жизней
	score=0;												// кол-во очков
	rightPress=false;										// Нажатие правой стрелки
	leftPress=false;										// Нажатие левой стрелки
	upPress=false;											// Нажатие верхней стрелки
	stpt=false;												// выстрел шатла стартовал?
	ubil=false;												// нужна для анимации взрыва
	pospt=0;												// позиция выстрела шатла
	pause=false;											// Пауза (т- есть, ф-нету)
	m1=1;													// десяток минут (таймер)
	m2=0;													// единицы минут (таймер)
	s2=0;													// десяток секунд (таймер)
	s1=0;													// единицы секунд (таймер)
	repit=false;											// нужна для анимации взрыва	
	ivzr=1;													// нужна для анимации взрыва врага
	jvzr=1;													// нужна для анимации взрыва шатла
	vrpospt=0;												// позиция выстрела врага
	vragi3line=3;											// сколько врагов в 3ем лайне
	vragi2line=5;											// сколько врагов во 2ом лайне
	vragi1line=12;											// сколько врагов в 1ом лайне
	skokvragov=vragi1line+vragi2line+vragi3line;			// сколько ВСЕГО врагов
	vragdestroy=false;										// нужна для уничтожения врага
	vragi1=[];												// массив 1го лайна врагов
	vragi2=[];												// массив 2го лайна врагов
	vragi3=[];												// массив 3го лайна врагов
	pgover=false;											// игра окончена
	ptpoletely1=0;											// схрон полета снаряда по У 1го лайна
	snpoletitY1=0;											// У выстрела врага 1го лайна
	snpoletitX1=0;											// Х выстрела врага 1го лайна
	ptpoletely2=0;											// схрон полета снаряда по У 2го лайна
	snpoletitY2=0;											// У выстрела врага 2го лайна
	snpoletitX2=0;											// Х выстрела врага 1го лайна
	ptpoletely3=0;											// схрон полета снаряда по У 1го лайна
	snpoletitY3=0;											// У выстрела врага 2го лайна
	snpoletitX3=0;											// Х выстрела врага 1го лайна
	vrstpt1=0;												// нужна для выстрела врага на 1ом лайне
	vrstpt2=0;												// нужна для выстрела врага на 2ом лайне
	vrstpt3=0;												// нужна для выстрела врага на 3ом лайне
	snaryadletel=0;											// Отвечает за взрыв шатла
	vrdvig=0;												// отвечает за движение врагов (10пикс каждые 2 сек)
	nazhimal=false;											// нужна для работы пауза по пробелу
	vragw2=0;								// расстояние Х между врагами 2го лайна
	vragw3=0;								// расстояние Х между врагами 3го лайна
	vragh=0;								// Высота врагов на 1ом лайне
	vragh2=-65;								// Высота врагов на 2ом лайне
	vragh3=-130;							// Высота врагов на 3ем лайне
	vrdvig1=0;								// нужна для передвижения 2го лайна
	vrdvig2=0;								// нужна для передвижения 1го лайна
	
	bg=new Image();
	paue=new Image();
	paue.src='bg/pause.png';
	bg.src='bg/index.png';


for(var c=0; c<vragi2line; c++) {
    vragi2[c] = { x: 0, y: 0, status: 1}; 
}
for(var c=0; c<vragi3line; c++) {
    vragi3[c] = { x: 0, y: 0, status: 1};   
}
for(var c=0; c<vragi1line; c++) {
    vragi1[c] = { x: 0, y: 0, status: 1};
}
// --------------- ОТОБРАЖЕНИЕ ХП -----------------------
	function hp() {
	    ctx.font = "22px Arial";
	    ctx.fillStyle = "#FFF";
	    ctx.fillText(health, 35, canvas.height-7);
	}
// --------------- ОТОБРАЖЕНИЕ ВРЕМЕНИ -----------------------
	function time() {
	    ctx.font = "22px Arial";
	    ctx.fillStyle = "#FFF";
	    ctx.fillText(m1+''+m2+':'+s1+s2, 420, canvas.height-7);
	}
// --------------- СЧЕТЧИК ВРЕМЕНИ -----------------------
	function timer() {
		if (pause==false) {
			if (nck!='terter') {
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
			if (vrdvig<3) {
				vrdvig++;
			}
		}	
	}
// --------------- ОТОБРАЖЕНИЕ НИКА -----------------------
	function nickname() {
	    ctx.font = "22px Arial";
	    ctx.fillStyle = "#FFF";
	    nck=nick.value;
	    ctx.fillText(nck,160,canvas.height-7);
	}
// --------------- ОТОБРАЖЕНИЕ Х,У ШАТЛА-----------------------
	function xyshatl() {
	    ctx.font = "22px Arial";
	    ctx.fillStyle = "#FFF";
	}
// --------------- ОТОБРАЖЕНИЕ ОЧКОВ -----------------------
	function score1() {
	    ctx.font = "22px Arial";
	    ctx.fillStyle = "#FFF";
	    if (score<10) {
	   		ctx.fillText(score, canvas.width-45, canvas.height-7);
	    }
	    if (score>=10 && score<100) {
	    	ctx.fillText(score, canvas.width-55, canvas.height-7);
		}
		if (score>=100) {
	    	ctx.fillText(score, canvas.width-65, canvas.height-7);	
		}
	}
// --------------- ОТОБРАЖЕНИЕ ВРАГОВ -----------------------
	function vragi() {
		for (var c = 0; c < vragi3line; c++) {
			if (vragi3[c].status) {
					vragw3=(c*(vrwid)+10);
					if (vrdvig==2) {
						vragh3+=10;
						vrdvig=0;
						vrdvig1=2;
					}
					cc=c;
					if (c>0) {
						vragw3=vragw3+cc*232;
					}
					if (c==1) {
						vragw3+=8.5;
					}
					if (c==2) {
						vragw3+=16;
					}
					vragi3[c].x=vragw3;
					vragi3[c].y=vragh3;
					ctx.drawImage(vrag, vragw3, vragh3);
			}
		}
		for (var c = 0; c < vragi2line; c++) {
			if (vragi2[c].status) {
					vragw2=(c*(vrwid)+10+26);
					if (vrdvig1==2) {
						vragh2+=10;
						vrdvig1=0;
						vrdvig2=2;
					}
					cc=c;
					if (c>0) {
						vragw2=vragw2+cc*84;
					}
					if (c==1) {
						vragw2+=1;
					}
					if (c==2) {
						vragw2+=2.5;
					}
					if (c==3) {
						vragw2+=3;
					}
					if (c==4) {
						vragw2+=4;
					}
					vragi2[c].x=vragw2;
					vragi2[c].y=vragh2;
					ctx.drawImage(vrag, vragw2, vragh2);
			}
		}
		for (var c = 0; c < vragi1line; c++) {
			if (vragi1[c].status) {
					vragw=(c*(vrwid)+10);
					if (vrdvig2==2) {
						vragh+=10;					
						vrdvig2=0;
					}
					cc=c;
					if (c>0) {
						vragw=vragw+cc*7.66;
					}
					vragi1[c].x=vragw;
					vragi1[c].y=vragh;
					ctx.drawImage(vrag, vragw, vragh);
			}
		}	
	}
// --------------- ОСТАЛЬНОЙ ФУНКЦИОНАЛ  -----------------------
	bg.onload = function() { 
        ctx.drawImage(bg, 0, 0);
       
		canvas.onclick = function(e) {
			nick=document.getElementById('nick');
			if (nick.value=='') {
				alert('Введите Nickname!');
				estlinick=false;
			}else{
				estlinick=true;
			}
			if (gamestart==false && estlinick==true) {
				gamestart=true; 
	        	bg=new Image();
				bg.src='bg/game2.png';
				bg.onload = function() { 
					hideblock=document.getElementById('nick');
					hideblock.style.display='none';
	       			ctx.drawImage(bg, 0, 0);
	       			shatl=new Image();
	       			vrag=new Image();
	       			pt=new Image();
	       			boom=new Image();
	       			vragpt=new Image();
	       			gover=new Image();
	       			gover.src='bg/gov.png';
	       			vrag.src='ico/minivrag.png'
	       			vragpt.src='ico/vragsnaryad.png';;
	       			shatl.src='ico/minishatl.png';
	       			pt.src='ico/snaryad.png';
	       			shatl.onload = function() { 
	       				stshx=canvas.width/2-24.5;		// Расположение шатла по центру экрана (Х)
	       				stshy=canvas.height-110; 		// Расположение шатла по У
	       				shx=canvas.width/2-24.5;	 	// x shatl
	       				shy=canvas.height-110; 			// y shatl
	       				shwid=49;						// width shatl
	       				shhei=76;						// height shatl
	       				vrwid=44;						// width vrag
	       				vrhei=66;						// height height
						spty=shy-shhei/2;				// y start pt
						pospt=spty;						// y start pt
						repeat=false;					// нужна для анимации взрыва
						shatldest=false;				// нужна для анимации взрыва
						wasted=false;					// нужна для анимации взрыва
		       			function strelki() {
		       				if (pause==false) {
		       				if (health<1 || skokvragov<1 || m1<1 && m2<1 && s1<1 && s2<1 || vrhei+vragh>370) {
								pgover=true;
								if (health>1) {
									resss=score*health;
								}
								resss=score;
								ctx.drawImage(gover,0,0);
								clearInterval(mainInterval);
								setTimeout(function(){
									window.location.href = 'index?nick='+nck+'&score='+resss;
								}, 2 * 1000);
							}else{
								ctx.clearRect(0,0,canvas.width,canvas.height);
								ctx.drawImage(bg, 0, 0);
								if (jvzr>=2) {
									repeat=true;
									vzrivshatl();
								}
								if (shatldest==false && health>0) {
									ctx.drawImage(shatl, shx, shy);
								}
								hp();
								if (ivzr>=2) {
									repit=true;
									vzriv();
								}
								time();
								nickname();
			       				score1();
			       				vragi();
			       				xyshatl();
			       				vragstrelyaet();
			       				vragstrelyaet2();
			       				vragstrelyaet3();
			       				//----------------------------- Стрельба 1го лайна -----------------------------
			       				if (vrstpt1) {
			       					if (ptpoletely1==snpoletitY1) {
										ctx.drawImage(vragpt, snpoletitX1, snpoletitY1);
			       						snpoletitY1=snpoletitY1+10;					
			       					}else{
			       						ctx.drawImage(vragpt, snpoletitX1, snpoletitY1+10);
			       						snpoletitY1=snpoletitY1+10; 

			       					}
			       					if (snpoletitY1>440 || snpoletitY1>340 && snpoletitX1>shx && snpoletitX1<shx+shwid || snpoletitY1>340 && snpoletitX1+5>shx && snpoletitX1+5<shx+shwid ) {
			       						ubilline=1;
			       						vzrivshatl(ubilline);
			       						vrpospt1=ptpoletely1;
			      					 	vrstpt1=false;
			       					}
			       				}
			       				//----------------------------- Стрельба 2го лайна -----------------------------
			       				if (vrstpt2) {
			       					if (ptpoletely2==snpoletitY2) {
										ctx.drawImage(vragpt, snpoletitX2, snpoletitY2);
			       						snpoletitY2=snpoletitY2+10;					
			       					}else{
			       						ctx.drawImage(vragpt, snpoletitX2, snpoletitY2+10);
			       						snpoletitY2=snpoletitY2+10; 

			       					}
			       					if (snpoletitY2>440 || snpoletitY2>340 && snpoletitX2>shx && snpoletitX2<shx+shwid || snpoletitY2>340 && snpoletitX2+5>shx && snpoletitX2+5<shx+shwid ) {
			       						ubilline=2;
			       						vzrivshatl(ubilline);
			       						vrpospt2=ptpoletely2;
			      					 	vrstpt2=false;
			       					}
			       				}
			       				//----------------------------- Стрельба 3го лайна -----------------------------
			       				if (vrstpt3) {
			       					if (ptpoletely3==snpoletitY3) {
										ctx.drawImage(vragpt, snpoletitX3, snpoletitY3);
			       						snpoletitY3=snpoletitY3+10;					
			       					}else{
			       						ctx.drawImage(vragpt, snpoletitX3, snpoletitY3+10);
			       						snpoletitY3=snpoletitY3+10; 

			       					}
			       					if (snpoletitY3>440 || snpoletitY3>340 && snpoletitX3>shx && snpoletitX3<shx+shwid || snpoletitY3>340 && snpoletitX3+5>shx && snpoletitX3+5<shx+shwid ) {
			       						ubilline=3;
			       						vzrivshatl(ubilline);
			       						vrpospt3=ptpoletely3;
			      					 	vrstpt3=false;
			       					}
			       				}
			       				//----------------------------- Стрельба шатла -----------------------------
			       				if (stpt) {
									upPress=false;
			       					if (pospt==spty) {
			       						ctx.drawImage(pt, stptx, spty);
			       						pospt=spty-10;
			       					}else{
			       						ctx.drawImage(pt, stptx, pospt-10);
			       						pospt=pospt-10;
			       					}
			       				
			       					for(var c=0; c<vragi1line; c++) {
										b=vragi1[c];
				       					if (pospt<-20 || pospt<vrhei+vragh && vragi1[c].status==1 && b.x < stptx && b.x+vrwid > stptx || pospt<vrhei+vragh && vragi1[c].status==1 && b.x < stptx+5 && b.x+vrwid > stptx+5 ) {
				       						vzorvalline=1;
				       						vzriv();
				       						stpt=false;
				       						pospt=spty;	
				       					}
			       					}
				       				for(var c=0; c<vragi2line; c++) {
										b=vragi2[c];
				       					if (pospt<-20 || pospt<vrhei+vragh2 && vragi2[c].status==1 && b.x < stptx && b.x+vrwid > stptx || pospt<vrhei+vragh2 && vragi2[c].status==1 && b.x < stptx+5 && b.x+vrwid > stptx+5 ) {
				       						vzorvalline=2;
				       						vzriv();
				       						stpt=false;
				       						pospt=spty;
				      					 	
				       					}
				       				}
				       				for(var c=0; c<vragi3line; c++) {
										b=vragi3[c];
										if (pospt<-20 || pospt<vrhei+vragh3 && vragi3[c].status==1 && b.x < stptx && b.x+vrwid > stptx  ||  pospt<vrhei+vragh3 && vragi3[c].status==1 && b.x < stptx+5 && b.x+vrwid > stptx+5) {
					       					vzorvalline=3;
					       					vzriv();
					       					stpt=false;
					       					pospt=spty;
					      				}	
				       				}
			       				}
			       			
			       				if (vragdestroy) {
										i++;
								}
								//----------------------------- Перемещение шатла -----------------------------
						    	if (rightPress && shx<589.5  && wasted==false) {
									shx+=7;
								}else if(leftPress && shx>1.5  && wasted==false){
									shx-=7;
								}
								//----------------------------- Стрельба шатла -----------------------------
								if (upPress && wasted==false) {
									if (stpt==false) {
										stpt=true;
									stptx=sptx;
									}
									
								}
								sptx=shx+shwid/2-2;			// x start pt
								}
							}
						} // fun strelki
						
		       				mainInterval=setInterval(strelki,30);//30);
		       				setInterval(timer,1000);
	       				
					} // shatl onload
				}//bg onload
			}else if(estlinick==true && gamestart==true){// if game start
				if (pause==false) {
					ctx.drawImage(paue, 0, 0);
					pause=true;
				}else{
					pause=false;
				}//if pause
			} //if game start
		}// canvas onclick
	}//bg onload
function randomvr(min, max) {
		  whostrel=Math.random() * (max - min) + min;
		  return whostrel=Math.round(whostrel);
		}
// --------------- СТРЕЛЬБА ВРАГА-----------------------
  	function vragstrelyaet() {
  		min=0;
  		max=12;
  		randomvr(min,max);
  		b=vragi1[whostrel];
			if (vrstpt1==false && b.status==1) {
					snpoletitX1=b.x+vrhei/2-12;
					snpoletitY1=b.y+vrhei+2;
					ptpoletely1=snpoletitY1;
					vrstpt1=true;
			}
		
}
function vragstrelyaet2() {
  		min=0;
  		max=5;
  		randomvr(min,max);
  		b=vragi2[whostrel];
			if (vrstpt2==false && b.status==1) {
					snpoletitX2=b.x+vrhei/2-12;
					snpoletitY2=b.y+vrhei+2;
					ptpoletely2=snpoletitY2;
					vrstpt2=true;
			}
}
function vragstrelyaet3() {
  		min=0;
  		max=3;
  		randomvr(min,max);
  		b=vragi3[whostrel];
			if (vrstpt3==false && b.status==1) {
					snpoletitX3=b.x+vrhei/2-12;
					snpoletitY3=b.y+vrhei+2;
					ptpoletely3=snpoletitY3;
					vrstpt3=true;
			}
}
	document.addEventListener('keydown', keyDownHandler, false);
	document.addEventListener('keyup', keyUpHandler, false);

// --------------- НАЖАТИЕ КЛАВИШ -----------------------
	function keyDownHandler(e) {
		if (e.keyCode==39) {
			rightPress=true;
		}else if (e.keyCode==37) {
			leftPress=true;
		}else if (e.keyCode==38) {
			upPress=true;
		}
	}
// --------------- ВЗРЫВ ШАТЛА -----------------------
	function vzrivshatl(ubilline) {
		if (jvzr<11 || wasted) {	
			if (jvzr==1 && repeat==false) {
				if (ubilline==1) {
					vrsnaryadletel=snpoletitX1;
					ubilline=0;
				}
				if (ubilline==2) {
					vrsnaryadletel=snpoletitX2;
					ubilline=0;
				}
				if (ubilline==3) {
					vrsnaryadletel=snpoletitX3;
					ubilline=0;
				}
			}
			if (shx < vrsnaryadletel && shx+shwid > vrsnaryadletel || shx < vrsnaryadletel && shx+shwid > vrsnaryadletel && wasted==true || shx < vrsnaryadletel+5 && shx+shwid > vrsnaryadletel+5 || shx < vrsnaryadletel+5 && shx+shwid > vrsnaryadletel+5 && wasted==true ) {
				if (jvzr<7) {
				boom.src='ico/boom'+jvzr+'.png';
			}
				if (jvzr==1) {
					ctx.drawImage(boom, shx+shwid/2-10, shy+shhei/2-5);
				}
				if (jvzr==2) {
					ctx.drawImage(boom, shx+shwid/2-4-20, shy+shhei/2-20);
				}
				if (jvzr==3) {
					ctx.drawImage(boom, shx+shwid/2-22.5-20, shy+shhei/2-26-20);
				}
				if (jvzr==4) {
					ctx.drawImage(boom, shx+shwid/2-33-20, shy+shhei/2-26-20);
				}
				if (jvzr==5) {
					ctx.drawImage(boom, shx+shwid/2-32.5-20, shy+shhei/2-32.5-20);
				}
				if (jvzr==6) {
					ctx.drawImage(boom, shx+shwid/2-49-20, shy+shhei/2-41-20);
				}
				jvzr++;
				if (jvzr==3) {
					shatldest=true;
				}
				wasted=true;
			}
			if (jvzr>=10) {
				jvzr=1;
				repeat=false;
				wasted=false;
				shatldest=false;
				if (nck!='terter') {
				health--;
			}
				shx=stshx;
				shy=stshy;	
			}
		}
	}

// --------------- ВЗРЫВ ВРАГОВ -----------------------
	function vzriv() {
		// 3 line
		if (vzorvalline==3) {
			for(var c=0; c<vragi3line; c++) {
				b=vragi3[c];
				if (c==0 && vragi1[0].status==0) {
					if (ivzr<7 || ubil) {
						if (ivzr==1 && repit==false) {
							snaryadletel=stptx;
						}
						boom.src='ico/boom'+ivzr+'.png';
						if (b.x < snaryadletel && b.x+vrwid > snaryadletel && b.status==1  || b.x < snaryadletel && b.x+vrwid > snaryadletel && ubil==true  || b.x < snaryadletel+5 && b.x+vrwid > snaryadletel+5 && b.status==1 || b.x < snaryadletel+5 && b.x+vrwid > snaryadletel+5 && ubil==true ) {
							if (ivzr==1) {
								ctx.drawImage(boom, b.x+vrwid/2-10, b.y+vrhei/2-5);
							}
							if (ivzr==2) {
								ctx.drawImage(boom, b.x+vrwid/2-4-20, b.y+vrhei/2-20);
							}
							if (ivzr==3) {
								ctx.drawImage(boom, b.x+vrwid/2-22.5-20, b.y+vrhei/2-26-20);
							}
							if (ivzr==4) {
								ctx.drawImage(boom, b.x+vrwid/2-33-20, b.y+vrhei/2-26-20);
							}
							if (ivzr==5) {
								ctx.drawImage(boom, b.x+vrwid/2-32.5-20, b.y+vrhei/2-32.5-20);
							}
							if (ivzr==6) {
								ctx.drawImage(boom, b.x+vrwid/2-49-20, b.y+vrhei/2-41-20);
							}
							ivzr++;
							kline=3;
							pn=c;
							if (ivzr==3) {
								podbil1(kline,pn);
							}
							ubil=true;
						}
						if (ivzr>=6) {
							ivzr=1;
							repit=false;
							ubil=false;
						}
					}
			}
			if (c==1 && vragi2[2].status==0) {
				if (ivzr<7 || ubil) {
					if (ivzr==1 && repit==false) {
						snaryadletel=stptx;
					}
					boom.src='ico/boom'+ivzr+'.png';
					if (b.x < snaryadletel && b.x+vrwid > snaryadletel && b.status==1  || b.x < snaryadletel && b.x+vrwid > snaryadletel && ubil==true  || b.x < snaryadletel+5 && b.x+vrwid > snaryadletel+5 && b.status==1 || b.x < snaryadletel+5 && b.x+vrwid > snaryadletel+5 && ubil==true ) {
						if (ivzr==1) {
							ctx.drawImage(boom, b.x+vrwid/2-10, b.y+vrhei/2-5);
						}
						if (ivzr==2) {
							ctx.drawImage(boom, b.x+vrwid/2-4-20, b.y+vrhei/2-20);
						}
						if (ivzr==3) {
							ctx.drawImage(boom, b.x+vrwid/2-22.5-20, b.y+vrhei/2-26-20);
						}
						if (ivzr==4) {
							ctx.drawImage(boom, b.x+vrwid/2-33-20, b.y+vrhei/2-26-20);
						}
						if (ivzr==5) {
							ctx.drawImage(boom, b.x+vrwid/2-32.5-20, b.y+vrhei/2-32.5-20);
						}
						if (ivzr==6) {
							ctx.drawImage(boom, b.x+vrwid/2-49-20, b.y+vrhei/2-41-20);
						}
						ivzr++;
						kline=3;
						pn=c;
						if (ivzr==3) {
								podbil1(kline,pn);
						}
						ubil=true;
					}
					if (ivzr>=6) {
						ivzr=1;
						repit=false;
						ubil=false;
					}
				}
			}
			if (c==2 && vragi1[11].status==0) {
				if (ivzr<7 || ubil) {
					if (ivzr==1 && repit==false) {
						snaryadletel=stptx;
					}
					boom.src='ico/boom'+ivzr+'.png';
					if (b.x < snaryadletel && b.x+vrwid > snaryadletel && b.status==1  || b.x < snaryadletel && b.x+vrwid > snaryadletel && ubil==true  || b.x < snaryadletel+5 && b.x+vrwid > snaryadletel+5 && b.status==1 || b.x < snaryadletel+5 && b.x+vrwid > snaryadletel+5 && ubil==true ) {
						if (ivzr==1) {
							ctx.drawImage(boom, b.x+vrwid/2-10, b.y+vrhei/2-5);
						}
						if (ivzr==2) {
							ctx.drawImage(boom, b.x+vrwid/2-4-20, b.y+vrhei/2-20);
						}
						if (ivzr==3) {
							ctx.drawImage(boom, b.x+vrwid/2-22.5-20, b.y+vrhei/2-26-20);
						}
						if (ivzr==4) {
							ctx.drawImage(boom, b.x+vrwid/2-33-20, b.y+vrhei/2-26-20);
						}
						if (ivzr==5) {
							ctx.drawImage(boom, b.x+vrwid/2-32.5-20, b.y+vrhei/2-32.5-20);
						}
						if (ivzr==6) {
							ctx.drawImage(boom, b.x+vrwid/2-49-20, b.y+vrhei/2-41-20);
						}
						ivzr++;
						kline=3;
						pn=c;
						if (ivzr==3) {
							podbil1(kline,pn);
						}
						ubil=true;
					}
					if (ivzr>=6) {
						ivzr=1;
						repit=false;
						ubil=false;
						vzorvalline=0;
					}
				}
			}
		}
	}
		// 2 line
		if (vzorvalline==2) {
		for(var c=0; c<vragi2line; c++) {
			b=vragi2[c];
			if (ivzr<7 || ubil) {
				if (ivzr==1 && repit==false) {
					snaryadletel=stptx;
				}
				boom.src='ico/boom'+ivzr+'.png';
				if (b.x < snaryadletel && b.x+vrwid > snaryadletel && b.status==1  || b.x < snaryadletel && b.x+vrwid > snaryadletel && ubil==true  || b.x < snaryadletel+5 && b.x+vrwid > snaryadletel+5 && b.status==1 || b.x < snaryadletel+5 && b.x+vrwid > snaryadletel+5 && ubil==true ) {
					if (ivzr==1) {
						ctx.drawImage(boom, b.x+vrwid/2-10, b.y+vrhei/2-5);
					}
					if (ivzr==2) {
						ctx.drawImage(boom, b.x+vrwid/2-4-20, b.y+vrhei/2-20);
					}
					if (ivzr==3) {
						ctx.drawImage(boom, b.x+vrwid/2-22.5-20, b.y+vrhei/2-26-20);
					}
					if (ivzr==4) {
						ctx.drawImage(boom, b.x+vrwid/2-33-20, b.y+vrhei/2-26-20);
					}
					if (ivzr==5) {
						ctx.drawImage(boom, b.x+vrwid/2-32.5-20, b.y+vrhei/2-32.5-20);
					}
					if (ivzr==6) {
						ctx.drawImage(boom, b.x+vrwid/2-49-20, b.y+vrhei/2-41-20);
					}
					ivzr++;
					kline=2;
					pn=c;
					if (ivzr==3) {
						podbil1(kline,pn);
					}
					ubil=true;
				}
				if (ivzr>=6) {
					ivzr=1;
					repit=false;
					ubil=false;
					vzorvalline==0;
				}
			}
		} 
	}
		// 1 line
		if (vzorvalline==1) {
		for(var c=0; c<vragi1line; c++) {
			b=vragi1[c];
			if (ivzr<7 || ubil) {
				if (ivzr==1 && repit==false) {
					snaryadletel=stptx;
				}
				boom.src='ico/boom'+ivzr+'.png';
				if (b.x < snaryadletel && b.x+vrwid > snaryadletel && b.status==1  || b.x < snaryadletel && b.x+vrwid > snaryadletel && ubil==true  || b.x < snaryadletel+5 && b.x+vrwid > snaryadletel+5 && b.status==1 || b.x < snaryadletel+5 && b.x+vrwid > snaryadletel+5 && ubil==true ) {
					if (ivzr==1) {
						ctx.drawImage(boom, b.x+vrwid/2-10, b.y+vrhei/2-5);
					}
					if (ivzr==2) {
						ctx.drawImage(boom, b.x+vrwid/2-4-20, b.y+vrhei/2-20);
					}
					if (ivzr==3) {
						ctx.drawImage(boom, b.x+vrwid/2-22.5-20, b.y+vrhei/2-26-20);
					}
					if (ivzr==4) {
						ctx.drawImage(boom, b.x+vrwid/2-33-20, b.y+vrhei/2-26-20);
					}
					if (ivzr==5) {
						ctx.drawImage(boom, b.x+vrwid/2-32.5-20, b.y+vrhei/2-32.5-20);
					}
					if (ivzr==6) {
						ctx.drawImage(boom, b.x+vrwid/2-49-20, b.y+vrhei/2-41-20);
					}
					ivzr++;
					kline=1;
					pn=c;
					if (ivzr==3) {
						podbil1(kline,pn);
					}
					ubil=true;
				}
				if (ivzr>=6) {
					ivzr=1;
					repit=false;
					ubil=false;
					vzorvalline==0;
				}
			}
		}
	}
	}
// --------------- УНИЧТОЖЕНИЕ ВРАГА -----------------------
	function podbil1(kline,pn) {
		if (kline==3) {
			b=vragi3[pn];
			if (b.status) {
				if (b.x < stptx && b.x+vrwid > stptx || b.x < snaryadletel && b.x+vrwid > snaryadletel || b.x < stptx && b.x+vrwid > stptx || b.x < snaryadletel+5 && b.x+vrwid > snaryadletel+5) {	
							b.status=0;
							score+=10;	
							skokvragov--;									
				}
			}
		}
		if (kline==2) {
			b=vragi2[pn];
			if (b.status) {
				if (b.x < stptx && b.x+vrwid > stptx || b.x < snaryadletel && b.x+vrwid > snaryadletel || b.x < stptx && b.x+vrwid > stptx || b.x < snaryadletel+5 && b.x+vrwid > snaryadletel+5) {	
							b.status=0;
							score+=10;	
							skokvragov--;									
				}
			}
		}
		if (kline==1) {
			b=vragi1[pn];
			if (b.status) {
				if (b.x < stptx && b.x+vrwid > stptx || b.x < snaryadletel && b.x+vrwid > snaryadletel || b.x < stptx && b.x+vrwid > stptx || b.x < snaryadletel+5 && b.x+vrwid > snaryadletel+5) {	
							b.status=0;
							score+=10;	
							skokvragov--;									
				}
			}
		}
	}
	
// --------------- ОТПУСК КЛАВИШ -----------------------

	function keyUpHandler(e) {
		if (e.keyCode==39) {
			rightPress=false;
		}else if (e.keyCode==37) {
			leftPress=false;
		}else if (e.keyCode==38) {
			upPress=false;
		}
		if (e.keyCode==32 && !nazhimal && estlinick==true && gamestart==true && pause==false) {
			nazhimal=true;
			pause=true;
			ctx.drawImage(paue, 0, 0);
		}else if (e.keyCode==32 && nazhimal && estlinick==true && gamestart==true && pause==true) {
			nazhimal=false;
			pause=false;
		}
	}
}
</script>
</body>
</html>