<?
include('../include/settings.php');
include('../include/guard.php');

// ЗАНЕСЕНИЕ В БД И ОТЧЕТ В ПРОФИЛЬ

function bronka($namfilm,$vozogr,$tim,$newmesta,$podtime,$gencen,$idfilm,$datka,$tektime,$timeHH)
{
	global $con;
	$namfilm=$namfilm.' ('.$vozogr.')';
	$status="В ожидании";
	$sess_id=$_COOKIE['user_id'];
										# H 64 MM 85 SS
										# H 6M 8M 4S 4S
										# H 6M M5 SS 
	$kod=$timeHH.$sess_id[0].$tim[0].$tim[1].$sess_id[3].$tim[3].$tim[4];
	mysqli_query($con,"UPDATE seyvkino SET slots_one='$newmesta' WHERE id='$idfilm'");
	mysqli_query($con,"INSERT into broni(vkid,datka,vremya,mesta,idfilm,namefilm,timefilm,kod,summa,status) values ('$sess_id','$datka','$tektime','$newmesta','$idfilm','$namfilm','$podtime','$kod','$gencen','$status')");
	echo '<div class="goodbron">Вы успешно забронировали место</div>';
	$cennik=''.$gencen;
	$skokmestovzabr=explode(', ', $newmesta);
	$skoktammestzab=count($skokmestovzabr);
	$text = "\r\n".$datka." (".$tektime.")||Бронирование места||".$skoktammestzab."||".$namfilm."||".$podtime."||".$cennik;
	$fp = fopen("../userhis/".$sess_id.".txt", "a");
	fwrite($fp, $text);
	fclose($fp);
}

function tichopotime($kinotime,$iidd,$iii){
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
		echo '<div time="'.$kinotime.'" style="color: #696969;border: 2px solid #696969;font-size: 28px;display: inline-block;padding: 10px 20px;border-radius: 25px;margin: 10px 10px;">'.$kinotime.'</div>';
	}else{
		echo '<div class="settimebl" id="time_'.$iii.'" time="'.$kinotime.'" kid="'.$iidd.'" onclick="settimefilm(id);">'.$kinotime.'</div>';
	}
}

/*function chopotime($kinotime,$iidd,$iii){
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
	if (($timeH>$kinotimeH && $kinotimeH!='00' && $kinotimeH!='01' && $kinotimeH!='02' && $kinotimeH!='03') || /*($timeH+1==$kinotimeH && $timeM30>60 && $timeM30-60>$kinotimeM) ||*//*($timeH1==$kinotimeH && $timeM30>$kinotimeM) || ($timeH==$kinotimeH && $timeM>$kinotimeM) || ($timeH==$kinotimeH && $timeH1==$kinotimeH && $timeM30<$kinotimeM)) {
		echo '<div time="'.$kinotime.'" style="color: #696969;border: 2px solid #696969;font-size: 28px;display: block;padding: 10px 20px;border-radius: 25px;margin: 10px 10px;">'.$kinotime.'</div>';
	}else{
		echo '<div class="settimebl" id="time_'.$iii.'" time="'.$kinotime.'" kid="'.$iidd.'" onclick="settimefilm(id);">'.$kinotime.'</div>';
	}
}*/
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

// СОРТИРОВКА ЕСЛИ ЗАДАН ЖАНР

if ($_POST['zhanri']!='' && $_POST['vozrasti']=='') {
	$selectedzhanri=$_POST['zhanri'];
	$skokelmass=count($selectedzhanri);
	$res=mysqli_query($con,"SELECT * from seyvkino");
	$skokrow=mysqli_num_rows($res);
	$timmme=date('H')+2;
	$timmm=date('i');
	if ($skokrow>0) {
		for ($j=0; $j < $skokrow ; $j++) { 
			$antidubl='';
			$svkino=mysqli_fetch_array($res);
			for ($i=0; $i < $skokelmass; $i++) { 
				if (preg_match('/'.$selectedzhanri[$i].'/', $svkino['zhanr'])) {
					if (preg_match('/'.$svkino['id'].'/', $antidubl)) {
						// uzhe bil tut
					}else{
					$antidubl+=' '.$svkino['id'];
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

										for ($ij=0; $ij < $svkino['skok_time'] ; $ij++) { 
											if ($ij==0) {
												chopotime($svkino['time_one'],$svkino['id'],$ij);
											}elseif ($ij==1) {
												chopotime($svkino['time_two'],$svkino['id'],$ij);
											}elseif ($ij==2) {
												chopotime($svkino['time_three'],$svkino['id'],$ij);
											}elseif ($ij==3) {
												chopotime($svkino['time_four'],$svkino['id'],$ij);
											}elseif ($ij==4) {
												chopotime($svkino['time_five'],$svkino['id'],$ij);
											}
										}
									echo '</div>
								</div>';
								$estrus = true;
					}
				}
			}
		}
	}
		if (!$estrus) {
			echo '<div style="text-align:center;font-size:1.6em;">Результатов не найдено.</div>';
		}
		
	
	
}

// СОРТИРОВКА ЕСЛИ ЗАДАН ВОЗРАСТ

if ($_POST['vozrasti']!='' && $_POST['zhanri']=='') {
	$selectedvozr=$_POST['vozrasti'];
	$skokelmass=count($selectedvozr);
	$res=mysqli_query($con,"SELECT * from seyvkino");
	$skokrow=mysqli_num_rows($res);
	$timmme=date('H')+2;
	$timmm=date('i');
	if ($skokrow>0) {
		for ($j=0; $j < $skokrow ; $j++) { 
			$antidubl='';
			$svkino=mysqli_fetch_array($res);
			for ($i=0; $i < $skokelmass; $i++) { 
				if ($selectedvozr[$i]==$svkino['vozr_ogr']) {
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

										for ($ij=0; $ij < $svkino['skok_time'] ; $ij++) { 
											if ($ij==0) {
												chopotime($svkino['time_one'],$svkino['id'],$ij);
											}elseif ($ij==1) {
												chopotime($svkino['time_two'],$svkino['id'],$ij);
											}elseif ($ij==2) {
												chopotime($svkino['time_three'],$svkino['id'],$ij);
											}elseif ($ij==3) {
												chopotime($svkino['time_four'],$svkino['id'],$ij);
											}elseif ($ij==4) {
												chopotime($svkino['time_five'],$svkino['id'],$ij);
											}
										}
									echo '</div>
								</div>';
					$estrus = true;
					
				}
			}
		}
	}
	if ($estrus==false) {
		echo '<div style="text-align:center;font-size:1.6em;">Результатов не найдено.</div>';
	}
}

//СОРТИРОВКА ЕСЛИ ЗАДАН ВОЗРАСТ И ЖАНР

if ($_POST['vozrasti']!='' && $_POST['zhanri']!='') {
	$selectedzhanri=$_POST['zhanri'];
	$selectedvozr=$_POST['vozrasti'];
	$skokelmassv=count($selectedvozr);
	$skokelmassz=count($selectedzhanri);
	$res=mysqli_query($con,"SELECT * from seyvkino");
	$skokrow=mysqli_num_rows($res);
	$timmme=date('H')+2;
	$timmm=date('i');
	if ($skokrow>0) {
		for ($j=0; $j < $skokrow ; $j++) { 
			$antidubl='';
			$svkino=mysqli_fetch_array($res);
			for ($i=0; $i < $skokelmassz; $i++) { 
				if (preg_match('/'.$selectedzhanri[$i].'/', $svkino['zhanr'])) {
					if (preg_match('/'.$svkino['id'].'/', $antidubl)) {
						// uzhe bil tut
					}else{
						for ($i=0; $i < $skokelmassv; $i++) { 
							if ($selectedvozr[$i]==$svkino['vozr_ogr']) {
							$antidubl+=' '.$svkino['id'];
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

										for ($ij=0; $ij < $svkino['skok_time'] ; $ij++) { 
											if ($ij==0) {
												chopotime($svkino['time_one'],$svkino['id'],$ij);
											}elseif ($ij==1) {
												chopotime($svkino['time_two'],$svkino['id'],$ij);
											}elseif ($ij==2) {
												chopotime($svkino['time_three'],$svkino['id'],$ij);
											}elseif ($ij==3) {
												chopotime($svkino['time_four'],$svkino['id'],$ij);
											}elseif ($ij==4) {
												chopotime($svkino['time_five'],$svkino['id'],$ij);
											}
										}
									echo '</div>
								</div>';
								$estrus = true;
					}}}
				}
			}
		}
	}
	if ($estrus==false) {
		echo '<div style="text-align:center;font-size:1.6em;">Результатов не найдено.</div>';
	}
}

// ПОЛУЧЕНИЕ СПИСКА АФИША

if ($_POST['afisha']=='getafifilms') {
	$res=mysqli_query($con,"SELECT * from seyvkino");
	$skokrow=mysqli_num_rows($res);
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
}

// ПЕРЕД ЗАНЕСЕНИЕМ БРОНИ В БД

if ($_POST['podfilm'] && $_POST['podtime'] && $_POST['podmesto']) {
	$podfilm=$_POST['podfilm'];
	$podtime=$_POST['podtime'];
	$podmesto=$_POST['podmesto'];
	$timses=$podtime[0].$podtime[1];
	$tekdate=date('d.m.Y');
		$timeHH=date('H')+1;
		if ($timeHH=='24') {
			$timeHH='00';
		}
		$tim=date('i:s');
	$tektime=$timeHH.':'.$tim;
	if ($timses>'09') {
		$gencen=200;
	}
	if ($timses>'12') {
		$gencen=250;
	}
	if ($timses>'16') {
		$gencen=300;
	}
	if ($timses>'22') {
		$gencen=150;
	}
	if ($timses<'04') {
		$gencen=150;
	}
	$skokzapat=substr_count($podmesto, ',');
	if ($skokzapat>0) {
		$skokzapat++;
		$gencen=$gencen*$skokzapat;
	}
	$res=mysqli_query($con,"SELECT * from seyvkino where id='$podfilm'");
	$skokrow=mysqli_num_rows($res);
	if ($skokrow==1) {
		$infokino=mysqli_fetch_array($res);
		if ($podtime==$infokino['time_one']) {
			if ($infokino['slots_one']!='') {
				$oldmesta=$infokino['slots_one'];
				$newmesta=$oldmesta.'|'.$podmesto;
			}else{
				$newmesta=$podmesto;
			}
			bronka($infokino["nazvanie"],$infokino['vozr_ogr'],$tim,$podmesto,$podtime,$gencen,$infokino['id'],$tekdate,$tektime,$timeHH);
		}elseif ($podtime==$infokino['time_two']) {
			if ($infokino['slots_two']!='') {
				$oldmesta=$infokino['slots_two'];
				$newmesta=$oldmesta.'|'.$podmesto;
			}else{
				$newmesta=$podmesto;
			}
			bronka($infokino["nazvanie"],$infokino['vozr_ogr'],$tim,$podmesto,$podtime,$gencen,$infokino['id'],$tekdate,$tektime,$timeHH);
		}elseif ($podtime==$infokino['time_three']) {
			if ($infokino['slots_three']!='') {
				$oldmesta=$infokino['slots_three'];
				$newmesta=$oldmesta.'|'.$podmesto;
			}else{
				$newmesta=$podmesto;
			}
			bronka($infokino["nazvanie"],$infokino['vozr_ogr'],$tim,$podmesto,$podtime,$gencen,$infokino['id'],$tekdate,$tektime,$timeHH);
		}elseif ($podtime==$infokino['time_four']) {
			if ($infokino['slots_four']!='') {
				$oldmesta=$infokino['slots_four'];
				$newmesta=$oldmesta.'|'.$podmesto;
			}else{
				$newmesta=$podmesto;
			}
			bronka($infokino["nazvanie"],$infokino['vozr_ogr'],$tim,$podmesto,$podtime,$gencen,$infokino['id'],$tekdate,$tektime,$timeHH);
		}elseif ($podtime==$infokino['time_five']) {
			if ($infokino['slots_five']!='') {
				$oldmesta=$infokino['slots_five'];
				$newmesta=$oldmesta.'|'.$podmesto;
			}else{
				$newmesta=$podmesto;
			}
			bronka($infokino["nazvanie"],$infokino['vozr_ogr'],$tim,$podmesto,$podtime,$gencen,$infokino['id'],$tekdate,$tektime,$timeHH);
		}else{
			echo '<div class="goodbron" style="color:red;">Ошибка.</div>';
		}
	}
}

// РИСУЕМ КИНОЗАЛ афиши

if ($_POST['afishafilmid'] && $_POST['afishafilmtime']) {
	if ($actionlogin=='success') {
		
		$afilmid=$_POST['afishafilmid'];
		$afilmtime=$_POST['afishafilmtime'];
		$res=mysqli_query($con,"SELECT * from seyvkino where id='$afilmid'");
		$skokrow=mysqli_num_rows($res);
		$tekdate=date('d.m.Y');
			$timeHH=date('H')+1;
			if ($timeHH=='24') {
				$timeHH='00';
			}
			$tim=date('i:s');
			$tektime=$timeHH.':'.$tim;
			$nochdata=date('d.m.Y', time() - 86400);
		if ($skokrow>0) {
			$res=mysqli_query($con,"SELECT * from broni where idfilm='$afilmid'");
			$skokrow=mysqli_num_rows($res);
			for ($ji=0; $ji < $skokrow ; $ji++) { 
				$infokino=mysqli_fetch_array($res);
				if ($tekdate==$infokino['datka'] || $nochdata==$infokino['datka'] && $infokino['timefilm'][0][1]>'00' && $infokino['timefilm'][0][1]<'06') {
					
					$arrmest=explode(', ',$infokino['mesta']);
					if (!$arrmesta) {
						$arrmesta=array_merge($arrmest);
					}else{
						$arrmesta=array_merge($arrmesta,$arrmest);
					}
				}
					
			}
		echo '<div id="blockbuyticket">
					<div style="width: max-content;margin: 0 auto;margin-top: 20px;">
					<div class="stupenbuytic" style="background-color: #105fff">Выбор места</div>
					<div class="stupenbuytic" style="background-color: #2f2f2f">Подтверждение</div>
					</div>';
		echo '<table style="BACKGROUND-COLOR: #2f2f2f;margin: 15px auto 0;border: none;">
					<tr>
						<td>
						<td>
						<td>
						<td>
						<td colspan="15" style="background:white;">
						<td>
						<td>
						<td>
						<td>
					</tr>';
					echo '<tr>';
					for ($i=1; $i <= 22; $i++) { 
						echo '<td style="width:25px;height:25px;">';
					}
					echo '</tr>';
					$mesto=0;
					for ($i=1; $i <= 13; $i++) { 
						echo '<tr>';
						echo '<td style="text-align: center;color: #777676;">'.$i.'</td>';
						for ($j=1; $j <= 22; $j++) { 
							
							if ($j==1 || $j==22 || $j==4 || $j==8 || $j==14 || $j==18 || $j==21 || $j==2 && $i==1 || $j==3 && $i==1 || $j==20 && $i==1 || $j==21 && $i==1 || $j==2 && $i==2 || $j==20 && $i==2 || $i==1 && $j==19) {
								echo '<td></td>';
							}else{
								$mesto++;
								if ($arrmesta) {
									foreach ($arrmesta as $k => $v) {
										if ($v==$mesto) {
											echo '<td><label><div style="background: #1b1b1b;color:#737373;" class="blockintable">'.$mesto.'</div></label>';
											$bilvmas=$mesto;
										}
									}
								}
								
								if ($bilvmas!=$mesto) {
									echo '<td><label><div id="'.$mesto.'" class="blockintable" kid="'.$afilmid.'" tfilm="'.$afilmtime.'" onclick="setmesto(id);">'.$mesto.'</div></label>';
								}
								
							}
						
							
						}
						echo '<td style="text-align: center;color: #777676;">'.$i.'</td>';
						echo '</tr>';
					}
					echo '<tr>';
					for ($i=1; $i <= 22; $i++) { 
						echo '<td style="width:25px;height:25px;">';
					}
					echo '</tr>';
				echo '<tr>';
				echo '<td colspan="4">';
				echo '<td style="background:#737373;height:25px;width:25px;">';
				echo '<td colspan="4"  color="white">Свободное место';
				echo '<td style="background:#0594bf;height:25px;width:25px;">';
				echo '<td colspan="4"  color="white">Выбранное место';
				echo '<td style="background:#1b1b1b;height:25px;width:25px;">';
				echo '<td colspan="4" color="white">Занятое место';
				echo '</tr>';
			echo '</table>';
			echo '<div id="'.$afilmid.'" stime="'.$afilmtime.'" onclick="bronmesta(id);" class="buyticket">Забронировать место</div>';
		}
		echo '</div>';
	}else{
		echo '
			<div class="oknozag">войти через</div>
			<div class="oknohr"></div>
			<div class="resultquerry" id="resultquery"></div>
				<div class="autorizesite">
					<div onclick="loginmenya();" class="oknobutton">
						<div style="background: url(../img/vk.png);background-position: center;width:50px;height:50px;    margin-left: 40px;background-size: cover;margin-left: 40px;display: inline-block;"></div>
						<div style="display: inline-block;position: absolute;line-height: 55px;margin-left: 20px;">ВОЙТИ ЧЕРЕЗ ВК</div>
					</div>
				</div>';
	}
}

//ИНФА О ПОДТВЕРЖДЕНИИ

if ($_POST['idfilm'] && $_POST['seltime'] && $_POST['hsmesto']) {
	$idselfilm=$_POST['idfilm'];
	$heseltime=$_POST['seltime'];
	$hsmesto=$_POST['hsmesto'];
	$res=mysqli_query($con,"SELECT * from seyvkino where id='$idselfilm'");
	$skokrow=mysqli_num_rows($res);
	
	$timehour=$heseltime['0'].$heseltime['1'];
	if ($timehour>'09') {
		$gencen=200;
	}
	if ($timehour>'12') {
		$gencen=250;
	}
	if ($timehour>'16') {
		$gencen=300;
	}
	if ($timehour>'22') {
		$gencen=150;
	}
	if ($timehour<'04') {
		$gencen=150;
	}
	if ($skokrow==1) {
		$infokino=mysqli_fetch_array($res);
		$dayseans=date('j');
		$messeans=date('M');
		if ($messeans=='Jan') {
			$messeans='января';
		}elseif ($messeans=='Feb') {
			$messeans='февраля';
		}elseif ($messeans=='Mar') {
			$messeans='марта';
		}elseif ($messeans=='Apr') {
			$messeans='апреля';
		}elseif ($messeans=='May') {
			$messeans='мая';
		}elseif ($messeans=='Jun') {
			$messeans='июня';
		}elseif ($messeans=='Jul') {
			$messeans='июля';
		}elseif ($messeans=='Aug') {
			$messeans='августа';
		}elseif ($messeans=='Sep') {
			$messeans='сентября';
		}elseif ($messeans=='Oct') {
			$messeans='октября';
		}elseif ($messeans=='Nov') {
			$messeans='ноября';
		}elseif ($messeans=='Dec') {
			$messeans='декабря';
		}
		echo '<div style="width: max-content;margin: 0 auto;margin-top: 20px;">
				<div class="stupenbuytic cupoint" id="goseltime" kiid="'.$idselfilm.'" onclick="buytickininfo(id);" style="background-color: #2f2f2f">Выбор времени</div>
				<div class="stupenbuytic cupoint" id="govibmest" kid="'.$idselfilm.'" time="'.$heseltime.'" onclick="settimefilm(id);" style="background-color: #2f2f2f">Выбор места</div>
				<div class="stupenbuytic" style="background-color: #105fff">Подтверждение</div>
			</div>';
		echo '<div>
				<table style="BACKGROUND-COLOR: #2f2f2f;margin: 15px auto 0;border: none;padding: 20px;">
				<tr>
					<td style="text-align: right;font-size: 24px;width: 265px;color: #c3c3c3;">Название фильма:
					<td style="font-size: 24px;">'.$infokino['nazvanie'].'
				</tr>
				<tr>
					<td style="text-align: right;font-size: 24px;color: #c3c3c3;">Дата сеанса:
					<td style="font-size: 24px;">'.$dayseans.' '.$messeans.'
				</tr>
				<tr>
					<td style="text-align: right;font-size: 24px;color: #c3c3c3;">Время сеанса:
					<td style="font-size: 24px;">'.$heseltime.'
				</tr>';
				$skokmestzabr=count($hsmesto);
				$gencen=$gencen*$skokmestzabr;
				if ($skokmestzabr>1) {
					for ($i=0; $i < $skokmestzabr ; $i++) { 
						if (!$dlyaknopki) {
							$dlyaknopki=$hsmesto[$i][0];
						}else{
							$dlyaknopki.=', '.$hsmesto[$i][0];
						}

						if ($hsmesto[$i][0]>0 && $hsmesto[$i][0]<12) {
							$ryadmesta=1;
						}elseif ($hsmesto[$i][0]>11 && $hsmesto[$i][0]<25) {
							$ryadmesta=2;
						}elseif ($hsmesto[$i][0]>24 && $hsmesto[$i][0]<40) {
							$ryadmesta=3;
						}elseif ($hsmesto[$i][0]>39 && $hsmesto[$i][0]<55) {
							$ryadmesta=4;
						}elseif ($hsmesto[$i][0]>54 && $hsmesto[$i][0]<70) {
							$ryadmesta=5;
						}elseif ($hsmesto[$i][0]>69 && $hsmesto[$i][0]<85) {
							$ryadmesta=6;
						}elseif ($hsmesto[$i][0]>84 && $hsmesto[$i][0]<100) {
							$ryadmesta=7;
						}elseif ($hsmesto[$i][0]>99 && $hsmesto[$i][0]<115) {
							$ryadmesta=8;
						}elseif ($hsmesto[$i][0]>114 && $hsmesto[$i][0]<130) {
							$ryadmesta=9;
						}elseif ($hsmesto[$i][0]>129 && $hsmesto[$i][0]<145) {
							$ryadmesta=10;
						}elseif ($hsmesto[$i][0]>144 && $hsmesto[$i][0]<160) {
							$ryadmesta=11;
						}elseif ($hsmesto[$i][0]>159 && $hsmesto[$i][0]<175) {
							$ryadmesta=12;
						}elseif ($hsmesto[$i][0]>174 && $hsmesto[$i][0]<190) {
							$ryadmesta=13;
						}
						if ($i==0) {
							echo '<tr>
								<td style="text-align: right;font-size: 24px;color: #c3c3c3;">Забронированные места:
								<td style="font-size: 24px;">'.$hsmesto[$i][0].' ('.$ryadmesta.' ряд)
							</tr>';
						}else{
							echo '<tr>
							<td style="text-align: right;font-size: 24px;color: #c3c3c3;">
								<td style="font-size: 24px;">'.$hsmesto[$i][0].' ('.$ryadmesta.' ряд)
							</tr>';
						}
					}
				}else{
					if ($hsmesto[0][0]>0 && $hsmesto[0][0]<12) {
							$ryadmesta=1;
						}elseif ($hsmesto[0][0]>11 && $hsmesto[0][0]<25) {
							$ryadmesta=2;
						}elseif ($hsmesto[0][0]>24 && $hsmesto[0][0]<40) {
							$ryadmesta=3;
						}elseif ($hsmesto[0][0]>39 && $hsmesto[0][0]<55) {
							$ryadmesta=4;
						}elseif ($hsmesto[0][0]>54 && $hsmesto[0][0]<70) {
							$ryadmesta=5;
						}elseif ($hsmesto[0][0]>69 && $hsmesto[0][0]<85) {
							$ryadmesta=6;
						}elseif ($hsmesto[0][0]>84 && $hsmesto[0][0]<100) {
							$ryadmesta=7;
						}elseif ($hsmesto[0][0]>99 && $hsmesto[0][0]<115) {
							$ryadmesta=8;
						}elseif ($hsmesto[0][0]>114 && $hsmesto[0][0]<130) {
							$ryadmesta=9;
						}elseif ($hsmesto[0][0]>129 && $hsmesto[0][0]<145) {
							$ryadmesta=10;
						}elseif ($hsmesto[0][0]>144 && $hsmesto[0][0]<160) {
							$ryadmesta=11;
						}elseif ($hsmesto[0][0]>159 && $hsmesto[0][0]<175) {
							$ryadmesta=12;
						}elseif ($hsmesto[0][0]>174 && $hsmesto[0][0]<190) {
							$ryadmesta=13;
						}
					echo '<tr>
								<td style="text-align: right;font-size: 24px;color: #c3c3c3;">Забронированное место:
								<td style="font-size: 24px;">'.$hsmesto[0][0].' ('.$ryadmesta.' ряд)
							</tr>';
				}
				
				if ($skokmestzabr>1) {
					echo'<tr>
							<td style="text-align: right;font-size: 24px;color: #c3c3c3;">Цена:
							<td style="font-size: 24px;">'.$gencen.' руб.
						</tr>
						<tr>
						<td style="width:25px;height:25px;">
						</tr>
						<tr>
							<td colspan="2" style="font-size: 24px;color: #848484;">Ваша бронь будет автоматически снята за 30 минут до начала сеанса.
						</tr>
						</table>
					</div>
								<div id="gopodtvrzh" filmec="'.$idselfilm.'" sstime="'.$heseltime.'" zabmesto="'.$dlyaknopki.'" onclick="podtverzhdenie(id);" class="buyticket">Подтвердить</div>
					';
				}else{
					echo'<tr>
						<td style="text-align: right;font-size: 24px;color: #c3c3c3;">Цена:
						<td style="font-size: 24px;">'.$gencen.' руб.
						</tr>
						<tr>
						<td style="width:25px;height:25px;">
						</tr>
						<tr>
							<td colspan="2" style="font-size: 24px;color: #848484;">Ваша бронь будет автоматически снята за 30 минут до начала сеанса.
						</tr>
						</table>
					</div>
								<div id="gopodtvrzh" filmec="'.$idselfilm.'" sstime="'.$heseltime.'" zabmesto="'.$hsmesto[0][0].'" onclick="podtverzhdenie(id);" class="buyticket">Подтвердить</div>
					';
				}
	}
}

// РИСУЕМ КИНОЗАЛ

if ($_POST['filmidd'] && $_POST['filmtime']) {
	$filmid=$_POST['filmidd'];
	$filmtime=$_POST['filmtime'];
	$res=mysqli_query($con,"SELECT * from seyvkino where id='$filmid'");
	$skokrow=mysqli_num_rows($res);
		$tekdate=date('d.m.Y');
		$timeHH=date('H')+1;
		if ($timeHH=='24') {
			$timeHH='00';
		}
		$tim=date('i:s');
		$tektime=$timeHH.':'.$tim;
		$nochdata=date('d.m.Y', time() - 86400);
	if ($skokrow>0) {
		$res=mysqli_query($con,"SELECT * from broni where idfilm='$filmid'");
		$skokrow=mysqli_num_rows($res);
		for ($ji=0; $ji < $skokrow ; $ji++) { 
			$infokino=mysqli_fetch_array($res);
			if ($tekdate==$infokino['datka'] || $nochdata==$infokino['datka'] && $infokino['timefilm'][0][1]>'00' && $infokino['timefilm'][0][1]<'06') {
				
				$arrmest=explode(', ',$infokino['mesta']);
				if (!$arrmesta) {
					$arrmesta=array_merge($arrmest);
				}else{
					$arrmesta=array_merge($arrmesta,$arrmest);
				}
			}
				
		}
		/*$infokino=mysqli_fetch_array($res);
		if ($filmtime==$infokino['time_one']) {
			$zanmesta=$infokino['slots_one'];
			$arrmesta=explode('|',$zanmesta);
		}elseif ($filmtime==$infokino['time_two']) {
			$zanmesta=$infokino['slots_two'];
			$arrmesta=explode('|',$zanmesta);
		}elseif ($filmtime==$infokino['time_three']) {
			$zanmesta=$infokino['slots_three'];
			$arrmesta=explode('|',$zanmesta);
		}elseif ($filmtime==$infokino['time_four']) {
			$zanmesta=$infokino['slots_four'];
			$arrmesta=explode('|',$zanmesta);
		}elseif ($filmtime==$infokino['time_five']) {
			$zanmesta=$infokino['slots_five'];
			$arrmesta=explode('|',$zanmesta);
		}*/
		echo '<div style="width: max-content;margin: 0 auto;margin-top: 20px;">
				<div class="stupenbuytic cupoint" id="goseltime" kiid="'.$filmid.'" onclick="buytickininfo(id);" style="background-color: #2f2f2f">Выбор времени</div>
				<div class="stupenbuytic" style="background-color: #105fff">Выбор места</div>
				<div class="stupenbuytic" style="background-color: #2f2f2f">Подтверждение</div>
			</div>';
		echo '<table style="BACKGROUND-COLOR: #2f2f2f;margin: 15px auto 0;border: none;">
				<tr>
					<td>
					<td>
					<td>
					<td>
					<td colspan="15" style="background:white;">
					<td>
					<td>
					<td>
					<td>
				</tr>';
				echo '<tr>';
				for ($i=1; $i <= 22; $i++) { 
					echo '<td style="width:25px;height:25px;">';
				}
				echo '</tr>';
				$mesto=0;
				for ($i=1; $i <= 13; $i++) { 

					echo '<tr>';
					echo '<td style="text-align: center;color: #777676;">'.$i.'</td>';
					for ($j=1; $j <= 22; $j++) { 
						
						if ($j==1 || $j==22 || $j==4 || $j==8 || $j==14 || $j==18 || $j==21 || $j==2 && $i==1 || $j==3 && $i==1 || $j==20 && $i==1 || $j==21 && $i==1 || $j==2 && $i==2 || $j==20 && $i==2 || $i==1 && $j==19) {
							echo '<td></td>';
						}else{
							$mesto++;
							if ($arrmesta) {
								foreach ($arrmesta as $k => $v) {
									if ($v==$mesto) {
										echo '<td><label><div style="background: #1b1b1b;color:#737373;" class="blockintable">'.$mesto.'</div></label>';
										$bilvmas=$mesto;
									}
								}
							}
							
							if ($bilvmas!=$mesto) {
								echo '<td><label><div id="'.$mesto.'" class="blockintable" kid="'.$filmid.'" tfilm="'.$filmtime.'" onclick="setmesto(id);">'.$mesto.'</div></label>';
							}
						}
					
						
					}
					echo '<td style="text-align: center;color: #777676;">'.$i.'</td>';
					echo '</tr>';
				}
				echo '<tr>';
				for ($i=1; $i <= 22; $i++) { 
					echo '<td style="width:25px;height:25px;">';
				}
				echo '</tr>';
			echo '<tr>';
			echo '<td colspan="4">';
			echo '<td style="background:#737373;height:25px;width:25px;">';
			echo '<td colspan="4"  color="white">Свободное место';
			echo '<td style="background:#0594bf;height:25px;width:25px;">';
			echo '<td colspan="4"  color="white">Выбранное место';
			echo '<td style="background:#1b1b1b;height:25px;width:25px;">';
			echo '<td colspan="4" color="white">Занятое место';
			echo '</tr>';
		echo '</table>';
		echo '<div id="'.$filmid.'" stime="'.$filmtime.'" onclick="bronmesta(id);" class="buyticket">Забронировать место</div>';
	}
}

// ОКНО С ВЫБОРОМ ВРЕМЯ ПРИ НАЖАТИИ НА КНОПКУ КУПИТЬ БИЛЕТЫ

if ($_POST['buytifilm']) {
	if ($userlogined==false) {	
				echo '<div onclick="loginmenya();" class="oknobutton">
						<div style="background: url(../img/vk.png);background-position: center;width:50px;height:50px;    margin-left: 40px;background-size: cover;margin-left: 40px;display: inline-block;"></div>
						<div style="display: inline-block;position: absolute;line-height: 55px;margin-left: 20px;">ВОЙТИ ЧЕРЕЗ ВК</div>
					</div>';
			}else{
	$buyidinf=$_POST['buytifilm'];
		$res=mysqli_query($con,"SELECT * from seyvkino where id='$buyidinf'");
		$skokrow=mysqli_num_rows($res);
		if ($skokrow==1) {
			$svkino=mysqli_fetch_array($res);
			echo '<div id="blockbuyticket"><div style="width: max-content;margin: 0 auto;margin-top: 20px;">
				<div class="stupenbuytic" style="background-color: #105fff">Выбор времени</div>
				<div class="stupenbuytic" style="background-color: #2f2f2f">Выбор места</div>
				<div class="stupenbuytic" style="background-color: #2f2f2f">Подтверждение</div>
			</div>';
			echo '<div style="width: max-content;margin: 0 auto;margin-top: 20px;">';
			$timmme=date('H')+2;
			$timmm=date('i');
			$timeandkino=$timmme.':'.$timmme;
			for ($i=0; $i < $svkino['skok_time'] ; $i++) { 
				
				if ($i==0) {
					tichopotime($svkino['time_one'],$buyidinf,$i);
				}elseif ($i==1) {
					tichopotime($svkino['time_two'],$buyidinf,$i);
				}elseif ($i==2) {
					tichopotime($svkino['time_three'],$buyidinf,$i);
				}elseif ($i==3) {
					tichopotime($svkino['time_four'],$buyidinf,$i);
				}elseif ($i==4) {
					tichopotime($svkino['time_five'],$buyidinf,$i);
				}
				
			}
			echo '</div></div>';
		}
	}
}

// ВЫБОР ВРЕМЕНИ

if ($_POST['buyfilminf']) {
		$buyidinf=$_POST['buyfilminf'];
		$res=mysqli_query($con,"SELECT * from seyvkino where id='$buyidinf'");
		$skokrow=mysqli_num_rows($res);
		if ($skokrow==1) {
			$svkino=mysqli_fetch_array($res);
			echo '<div style="width: max-content;margin: 0 auto;margin-top: 20px;">
				<div class="stupenbuytic" style="background-color: #105fff">Выбор времени</div>
				<div class="stupenbuytic" style="background-color: #2f2f2f">Выбор места</div>
				<div class="stupenbuytic" style="background-color: #2f2f2f">Подтверждение</div>
			</div>';
			echo '<div style="width: max-content;margin: 0 auto;margin-top: 20px;">';
			$timmme=date('H')+1;
			$timmm=date('i');
			$timeandkino=$timmme.':'.$timmme;
			for ($i=0; $i < $svkino['skok_time'] ; $i++) { 
				
				if ($i==0) {
					tichopotime($svkino['time_one'],$buyidinf,$i);
				}elseif ($i==1) {
					tichopotime($svkino['time_two'],$buyidinf,$i);
				}elseif ($i==2) {
					tichopotime($svkino['time_three'],$buyidinf,$i);
				}elseif ($i==3) {
					tichopotime($svkino['time_four'],$buyidinf,$i);
				}elseif ($i==4) {
					tichopotime($svkino['time_five'],$buyidinf,$i);
				}
				
			}
			echo '</div>';
		}
}

// ПОДРОБНАЯ ИНФА О ФИЛЬМЕ

if ($_POST['inffilm']) {
		$id=$_POST['inffilm'];
		$res=mysqli_query($con,"SELECT * from seyvkino where id='$id'");
		$skokrow=mysqli_num_rows($res);
		if ($skokrow==1) {
			$svkino=mysqli_fetch_array($res);
			echo '<div>
			<div style="width:800px">
					<div class="nazviphoto">
						<div>
							<div style="display:inline-block;width: 350px;">
								<div class="nzavfilm">'.$svkino['nazvanie'].'</div>
								<div class="zhanrofilm">'.$svkino['zhanr'].'</div>
							</div>
							<div class="ogrvozr">'.$svkino['vozr_ogr'].'</div>
						</div>
						<div class="imginffilm" style="background:url('.$svkino['oblozhka'].');"></div>
					</div>
					<div class="infofilme">';
						if ($svkino['prodolzh']) {
							echo '<div><font color="#9ea0a0">Продолжительность: </font>'.$svkino['prodolzh'].' мин.</div>';
						}
						if ($svkino['roli']) {
							echo '<div><font color="#9ea0a0">В ролях: </font>'.$svkino['roli'].'</div>';
						}
						if ($svkino['opisanie']) {
							echo '<br><br><div>'.$svkino['opisanie'].'</div>';
						}
					echo '</div>
					</div>
			';

						if ($svkino['trayler']) {
							echo '<div style="background:url(img/blue.jpg);background-attachment: fixed;padding: 30px;margin-top: 20px;"><div style="text-align:center;color:white; font-size:36px;">ТРЕЙЛЕР</div><div style="text-align:center;padding: 20px;"><iframe width="560" height="315" src="https://www.youtube.com/embed/'.$svkino['trayler'].'" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe></div></div>';
						}
			if ($userlogined==true) {	
				echo '<div id="blockbuyticket">
						<div id="nadoseltime" kiid="'.$id.'" onclick="buytickininfo(id);" class="buyticket">Купить билеты</div>
					</div>';
			}else{
				echo '<div id="blockbuyticket">
						<a href="http://kinotea/?act=login" class="buyticket" style="display:block;">Купить билеты</a>
				</div>
				<script>
				function buytickininfo(id) {
					window.location.href="http://kinotea/?act=login";
				}
				</script>
				';
			}
		}
}
?>