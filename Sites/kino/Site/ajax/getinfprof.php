<?
include('../include/settings.php');
include('../include/guard.php');

if ($_POST['action']=='keycode' && $_POST['key']) {
	$tekdate=date('d.m.Y');
	$timeHH=date('H')+1;
	if ($timeHH=='24') {
		$timeHH='00';
	}
	$mint=date('i');
	$tim=date('i:s');
	$tektime=$timeHH.':'.$tim;
	$keycode=$_POST['key'];
	$nochdata=date('d.m.Y', time() - 86400);
	$searchps=mysqli_query($con,"SELECT * from broni where kod='$keycode'");
	$skokres=mysqli_num_rows($searchps);
	echo '<style type="text/css"> td{color:white;font-size:22px;}</style>';
	if ($skokres>0) {
		echo '<table style="margin:0 auto;">
				<tr style="background: #b400ff;">
					<td width=150>Забронировал (id)
					<td width=150>Забронированные места
					<td width=150>Фильм
					<td width=150>Время сеанса
					<td width=150>Код
					<td width=150>Сумма
					<td width=150>Статус
				</tr>';
		for ($i=0; $i < $skokres ; $i++) { 
			$zapisi=mysqli_fetch_array($searchps);
			#if ($zapisi['datka']==$tekdate || $zapisi['datka']==$nochdata && $zapisi['timefilm'][0][1]>'00' && $zapisi['timefilm'][0][1]<'06' ) {
				if (($i%2)==0) {
					echo "<tr style='background: #2e0141;'>";
				}else{
					echo "<tr style='background: #41025c;'>";
				}
				echo '<td>'.$zapisi['vkid'].'
					  <td>'.$zapisi['mesta'].'
					  <td>'.$zapisi['namefilm'].'
					  <td>'.$zapisi['datka'].'<br>'.$zapisi['timefilm'].'
					  <td>'.$zapisi['kod'].'
					  <td>'.$zapisi['summa'];
				if ($zapisi['status']=='В ожидании') {
					echo '<td style="color:#ff8100;">'.$zapisi['status'];
				}elseif ($zapisi['status']=='Подтверждено') {
					echo '<td style="color:#04d104;">'.$zapisi['status'];
				}elseif ($zapisi['status']=='Удалено') {
					echo '<td style="color:red;">'.$zapisi['status'];
				}
				echo '</tr>';
			#}
		}
		echo '</table>';
		echo '<div style="margin: 0 auto;text-align: center;padding: 10px;"><div id="harashobut" style="display: inline-block;text-align: center;width: 30%;" paramka="'.$zapisi['id'].'" onclick="kcpodtvrj('.$zapisi['id'].');">Подтвердить</div><div id="deletebut" style="display: inline-block;text-align: center;width: 30%;margin-left: 3%;margin-top:0;" paramka="'.$zapisi['id'].'" onclick="kcdelka('.$zapisi['id'].');">Удалить</div></div>';
		
	}
}
if ($_POST['action']=='podtv' && $_POST['film'] && $_POST['time'] && $_POST['mesta']) {
	$namfilm=$namfilm.' ('.$vozogr.')';
	$status="Подтверждено";
	$sess_id=$_COOKIE['user_id'];
	$podtime=$_POST['time'];
	$timses=$podtime[0].$podtime[1];
	$datka=date('d.m.Y');
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
	$newmesta=$_POST['mesta'];
	$arrmes=explode(', ', $newmesta);
	$skokmestzabr=count($arrmes);
		$gencen=$gencen*$skokmestzabr;
	$idfilm=$_POST['film'];
	$res=mysqli_query($con,"SELECT * from seyvkino where id='$idfilm'");
	$skokrow=mysqli_num_rows($res);
	$sess_id='Оператор';
	if ($skokrow==1) {
		$infokino=mysqli_fetch_array($res);
		$namfilm=$infokino["nazvanie"].' ('.$infokino["vozr_ogr"].')';

		#'$sess_id'
											# H 64 MM 85 SS
											# H 6M 8M 4S 4S
											# H 6M M5 SS 
		#$kod=$timeHH.$sess_id[0].$tim[0].$tim[1].$sess_id[3].$tim[3].$tim[4];
		mysqli_query($con,"INSERT into broni(vkid,datka,vremya,mesta,idfilm,namefilm,timefilm,summa,status) values ('$sess_id','$datka','$tektime','$newmesta','$idfilm','$namfilm','$podtime','$gencen','$status')");
		echo '<div class="goodbron">Вы успешно забронировали место</div>';
	}
}

if ($_POST['action']=='nadopod' && $_POST['film'] && $_POST['time'] && $_POST['mesta']) {
		$idselfilm=$_POST['film'];
	$heseltime=$_POST['time'];
	$hsmesto=$_POST['mesta'];
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
							$mestairyadi=$hsmesto[$i][0].' ('.$ryadmesta.' ряд)<br>';
						}else{
							if (!$mestairyadi) {
								$mestairyadi=$hsmesto[$i][0].' ('.$ryadmesta.' ряд)<br>';
							}else{
								$mestairyadi.=$hsmesto[$i][0].' ('.$ryadmesta.' ряд)<br>';
							}
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
					if (!$mestairyadi) {
								$mestairyadi=$hsmesto[$i][0].' ('.$ryadmesta.' ряд)<br>';
							}
				}
		echo '<div style="width: max-content;margin: 0 auto;margin-top: 20px;">
				<div class="stupenbuytic" style="background-color: #105fff">Подтверждение</div>
			</div>';
		echo '<div class="podrobinfa" style="padding: 20px 0 0;">
					<div class="onelvl" style="font-size:24px;color:white;text-align:right;">Название фильма: <br>
																	  Дата сеанса: <br>
																	 Время сеанса: <br>';
										if ($skokmestzabr>1) {
											echo 'Забронированные места: <br>';
										}else{
											echo 'Забронированное место: <br>';
										}
										
										for ($i=0; $i < $skokmestzabr; $i++) { 
											echo '<br>';
										}
																	echo 'Цена:</div>';
#$mestairyadi
			echo'	<div class="onelvl" style="font-size:24px;color:white;text-align:left;">'.$infokino['nazvanie'].'<br>'.$dayseans.' '.$messeans.'<br>'.$heseltime.'<br>'.$mestairyadi.'<br>'.$gencen.' руб.</div>
									</div>';
				
				
				if ($skokmestzabr>1) {
					echo'<div id="gopodtvrzh" kid="'.$idselfilm.'" ktime="'.$heseltime.'" mesta="'.$dlyaknopki.'" onclick="podtverzhad(id);" class="buyticket">Подтвердить</div>';
				}else{
					echo'<div id="gopodtvrzh" kid="'.$idselfilm.'" ktime="'.$heseltime.'" mesta="'.$hsmesto[0][0].'" onclick="podtverzhad(id);" class="buyticket">Подтвердить</div>';
				}
	}
	}

if ($_POST['action']=='shema' && $_POST['film'] && $_POST['time']) {
	$afilmid=$_POST['film'];
	$afilmtime=$_POST['time'];
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
	echo '
	<div id="blockbuyticket">
				<div style="width: max-content;margin: 0 auto;margin-top: 20px;">
				<div class="stupenbuytic" style="background-color: #105fff">Выбор места</div>
				</div>';
	echo '<style type="text/css">
		td{border: none;
    padding: 0;font-family: "Yanone Kaffeesatz", sans-serif;font-size: 16px;}
		}
.blockintable {
    width: 25px;
    height: 25px;
    text-align: center;
    line-height: 25px;
    color: white;
    background-color: #737373;
}
#dlyatablic{
	    overflow: inherit!important;
	        max-height: none!important;
}
		</style>
	<table style="BACKGROUND-COLOR: #2f2f2f;margin: 15px auto 0;border: none;border-collapse: inherit;">
				<tr style="height: 2px;">
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
								echo '<td><label><div id="mes_'.$mesto.'" mid="'.$mesto.'" class="blockintable" kid="'.$afilmid.'" tfilm="'.$afilmtime.'" onclick="setmestoop(id);">'.$mesto.'</div></label>';
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
		echo '<div id="zabronirovat" kid="'.$afilmid.'" ktime="'.$afilmtime.'" onclick="bronmestaadmin(id);" class="buyticket">Забронировать место</div>';
	}
	echo '</div>';
}
if ($_POST['action']=='getinffilm' && $_POST['sfilm'] && $_POST['stime']) {
	$skoroFilmId=$_POST['sfilm'];
	$slotpodtimeII=$_POST['stime'];
	$newreq=mysqli_query($con,"SELECT * from seyvkino where id='$skoroFilmId'");
		$newfilminf=mysqli_fetch_array($newreq);

		echo '<div>
				<div style="position: relative;min-height:400px;height: 80vh;display: flex;overflow: overlay;background: url('.$newfilminf['oblozhka'].');
    background-position: center;">';
					/*<img src="'.$newfilminf['oblozhka'].'" style="position: absolute;width: 100%;top: -370px;filter: blur(3px);">*/
			echo'		<div id="temniyfon" style="text-align: center;margin: auto;background: #000000e6;color: white;width: 100%;height: 100%;position: absolute;">
						<div style="height:49px;padding:20px;">
								<div class="inbm" id="shemazala" style="float: left;" kid="'.$skoroFilmId.'" ktime="'.$slotpodtimeII.'" onclick="shemazala(id);">Схема кинозала</div>
								<div id="bronpolz" class="inbm" style="float: right;" kid="'.$skoroFilmId.'" ktime="'.$slotpodtimeII.'" onclick="broninasea(id);">Бронирования пользователей</div>
						</div>';
						echo "<div>";
							for ($i=0; $i < $newfilminf['skok_time'] ; $i++) { 
											if ($i==0) {
												if ($newfilminf['time_one']==$slotpodtimeII) {
													echo '<div style="margin: 10px 10px;display: inline-block;color: #2d003f;border: 2px solid #2d003f;background-color: #b600ff;" class="settimebll" id="afitime_'.$i.'_'.$newfilminf['id'].'" time="'.$newfilminf['time_one'].'" kid="'.$newfilminf['id'].'" onclick="adsetfilm(id);">'.$newfilminf['time_one'].'</div>';
												}else{
													echo '<div style="margin: 10px 10px;display: inline-block;color: #b400ff;border: 2px solid #b400ff;background-color: #2d003f;" class="settimebll" id="afitime_'.$i.'_'.$newfilminf['id'].'" time="'.$newfilminf['time_one'].'" kid="'.$newfilminf['id'].'" onclick="adsetfilm(id);">'.$newfilminf['time_one'].'</div>';
												}
											}elseif ($i==1) {
												if ($newfilminf['time_two']==$slotpodtimeII) {
													echo '<div style="margin: 10px 10px;display: inline-block;color: #2d003f;border: 2px solid #2d003f;background-color: #b600ff;" class="settimebll" id="afitime_'.$i.'_'.$newfilminf['id'].'" time="'.$newfilminf['time_two'].'" kid="'.$newfilminf['id'].'" onclick="adsetfilm(id);">'.$newfilminf['time_two'].'</div>';
												}else{
													echo '<div style="margin: 10px 10px;display: inline-block;color: #b400ff;border: 2px solid #b400ff;background-color: #2d003f;" class="settimebll" id="afitime_'.$i.'_'.$newfilminf['id'].'" time="'.$newfilminf['time_two'].'" kid="'.$newfilminf['id'].'" onclick="adsetfilm(id);">'.$newfilminf['time_two'].'</div>';
												}
											}elseif ($i==2) {
												if ($newfilminf['time_three']==$slotpodtimeII) {
													echo '<div style="margin: 10px 10px;display: inline-block;color: #2d003f;border: 2px solid #2d003f;background-color: #b600ff;" class="settimebll" id="afitime_'.$i.'_'.$newfilminf['id'].'" time="'.$newfilminf['time_three'].'" kid="'.$newfilminf['id'].'" onclick="adsetfilm(id);">'.$newfilminf['time_three'].'</div>';
												}else{
													echo '<div style="margin: 10px 10px;display: inline-block;color: #b400ff;border: 2px solid #b400ff;background-color: #2d003f;" class="settimebll" id="afitime_'.$i.'_'.$newfilminf['id'].'" time="'.$newfilminf['time_three'].'" kid="'.$newfilminf['id'].'" onclick="adsetfilm(id);">'.$newfilminf['time_three'].'</div>';
												}
											}elseif ($i==3) {
												if ($newfilminf['time_four']==$slotpodtimeII) {
													echo '<div style="margin: 10px 10px;display: inline-block;color: #2d003f;border: 2px solid #2d003f;background-color: #b600ff;" class="settimebll" id="afitime_'.$i.'_'.$newfilminf['id'].'" time="'.$newfilminf['time_four'].'" kid="'.$newfilminf['id'].'" onclick="adsetfilm(id);">'.$newfilminf['time_four'].'</div>';
												}else{
													echo '<div style="margin: 10px 10px;display: inline-block;color: #b400ff;border: 2px solid #b400ff;background-color: #2d003f;" class="settimebll" id="afitime_'.$i.'_'.$newfilminf['id'].'" time="'.$newfilminf['time_four'].'" kid="'.$newfilminf['id'].'" onclick="adsetfilm(id);">'.$newfilminf['time_four'].'</div>';
												}
											}elseif ($i==4) {
												if ($newfilminf['time_five']==$slotpodtimeII) {
													echo '<div style="margin: 10px 10px;display: inline-block;color: #2d003f;border: 2px solid #2d003f;background-color: #b600ff;" class="settimebll" id="afitime_'.$i.'_'.$newfilminf['id'].'" time="'.$newfilminf['time_five'].'" kid="'.$newfilminf['id'].'" onclick="adsetfilm(id);">'.$newfilminf['time_five'].'</div>';
												}else{
													echo '<div style="margin: 10px 10px;display: inline-block;color: #b400ff;border: 2px solid #b400ff;background-color: #2d003f;" class="settimebll" id="afitime_'.$i.'_'.$newfilminf['id'].'" time="'.$newfilminf['time_five'].'" kid="'.$newfilminf['id'].'" onclick="adsetfilm(id);">'.$newfilminf['time_five'].'</div>';
												}
											}
										}
										echo "</div>";
					echo '<div style="font-size: 30px;padding: 20px;">'.$newfilminf['nazvanie'].' ('.$newfilminf['vozr_ogr'].')</div>
						<div style="font-size: 26px;padding: 10px;">Начало сеанса в '.$slotpodtimeII.'</div>
						<div style="width: 90%;margin: 0 auto;">
							
							<div id="dlyatablic" >
							</div>
						</div>
					</div>	
				</div>
			</div>';
}
if ($_POST['action']=='getlistfilms') {
	$res=mysqli_query($con,"SELECT * from seyvkino");
	$skokrow=mysqli_num_rows($res);
	$timmme=date('H')+2;
				$timmm=date('i');
				if ($skokrow>0) {
					for ($j=0; $j < $skokrow ; $j++) { 
						$svkino=mysqli_fetch_array($res);
						echo '<div class="afiblock" style="background-color: #21002f;border: 2px solid #b400ff;">
									<div class="afiimg" onclick="podrobneeava(id);" id="avafilma_'.$svkino['id'].'" filmaida="'.$svkino['id'].'" style="background-image:url('.$svkino['oblozhka'].')"></div>
									<div class="afiop">
										<div style="width: max-content;display: inline-block;">
											<div class="nzavfilm" onclick="podrobnee(id);" id="zagol_'.$svkino['id'].'" filmaida="'.$svkino['id'].'">'.$svkino['nazvanie'].'</div>
											<div class="zhanrofilm" style="color: #b400ff;">'.$svkino['zhanr'].'</div>
										</div>
										<div class="ogrvozr" style="right: 0;top: 0;display: inline-block;position: absolute;">'.$svkino['vozr_ogr'].'</div>
										<div style="margin-top: 20px;font-size:18px;color: white;">'.$svkino['opisanie'].'</div>
									</div>
									<div style="display:inline-block;vertical-align: middle;">';

										for ($i=0; $i < $svkino['skok_time'] ; $i++) { 
											if ($i==0) {
												echo '<div style="margin: 10px 10px;display: block;color: #b400ff;border: 2px solid #b400ff;background-color: #2d003f;" class="settimebll" id="afitime_'.$i.'_'.$svkino['id'].'" time="'.$svkino['time_one'].'" kid="'.$svkino['id'].'" onclick="adsetfilm(id);">'.$svkino['time_one'].'</div>';
											}elseif ($i==1) {
												echo '<div style="margin: 10px 10px;display: block;color: #b400ff;border: 2px solid #b400ff;background-color: #2d003f;" class="settimebll" id="afitime_'.$i.'_'.$svkino['id'].'" time="'.$svkino['time_two'].'" kid="'.$svkino['id'].'" onclick="adsetfilm(id);">'.$svkino['time_two'].'</div>';
											}elseif ($i==2) {
												echo '<div style="margin: 10px 10px;display: block;color: #b400ff;border: 2px solid #b400ff;background-color: #2d003f;" class="settimebll" id="afitime_'.$i.'_'.$svkino['id'].'" time="'.$svkino['time_three'].'" kid="'.$svkino['id'].'" onclick="adsetfilm(id);">'.$svkino['time_three'].'</div>';
											}elseif ($i==3) {
												echo '<div style="margin: 10px 10px;display: block;color: #b400ff;border: 2px solid #b400ff;background-color: #2d003f;" class="settimebll" id="afitime_'.$i.'_'.$svkino['id'].'" time="'.$svkino['time_four'].'" kid="'.$svkino['id'].'" onclick="adsetfilm(id);">'.$svkino['time_four'].'</div>';
											}elseif ($i==4) {
												echo '<div style="margin: 10px 10px;display: block;color: #b400ff;border: 2px solid #b400ff;background-color: #2d003f;" class="settimebll" id="afitime_'.$i.'_'.$svkino['id'].'" time="'.$svkino['time_five'].'" kid="'.$svkino['id'].'" onclick="adsetfilm(id);">'.$svkino['time_five'].'</div>';
											}
										}
									echo '</div>
								</div>';
					}
				}
}
if ($_POST['action']=='getlistbroney') {
	$tekdate=date('d.m.Y');
	$timeHH=date('H')+1;
	if ($timeHH=='24') {
		$timeHH='00';
	}
	$mint=date('i');
	$tim=date('i:s');
	$tektime=$timeHH.':'.$tim;
	$nochdata=date('d.m.Y', time() - 86400);
	$searchps=mysqli_query($con,"SELECT * from broni");
	$skokres=mysqli_num_rows($searchps);
	echo '<style type="text/css"> td{color:white;font-size:22px;}</style>';
	if ($skokres>0) {
		echo '<table style="margin:0 auto;">
				<tr style="background: #b400ff;">
					<td width=150>Забронировал (id)
					<td width=150>Забронированные места
					<td width=150>Фильм
					<td width=150>Время сеанса
					<td width=150>Код
					<td width=150>Сумма
					<td width=150>Статус
				</tr>';
		for ($i=0; $i < $skokres ; $i++) { 
			$zapisi=mysqli_fetch_array($searchps);
			$zapisiti=substr($zapisi['timefilm'], 0,2);
			if ($zapisi['datka']==$tekdate || $zapisi['datka']==$nochdata && $zapisiti>'00' && $zapisiti<'06' ) {
				if (($i%2)==0) {
					echo "<tr style='background: #2e0141;'>";
				}else{
					echo "<tr style='background: #41025c;'>";
				}
				echo '<td>'.$zapisi['vkid'].'
					  <td>'.$zapisi['mesta'].'
					  <td>'.$zapisi['namefilm'].'
					  <td>'.$zapisi['datka'].'<br>'.$zapisi['timefilm'].'
					  <td>'.$zapisi['kod'].'
					  <td>'.$zapisi['summa'];
				if ($zapisi['status']=='В ожидании') {
					echo '<td style="color:#ff8100;">'.$zapisi['status'];
				}elseif ($zapisi['status']=='Подтверждено') {
					echo '<td style="color:#04d104;">'.$zapisi['status'];
				}elseif ($zapisi['status']=='Удалено') {
					echo '<td style="color:red;">'.$zapisi['status'];
				}
				echo '</tr>';
			}
		}
		echo '</table>';
		
	}
}
if ($_POST['action']=='getbroni' && $_POST['film'] && $_POST['time']) {
	$tekdate=date('d.m.Y');
	$timeHH=date('H')+1;
	if ($timeHH=='24') {
		$timeHH='00';
	}
	$mint=date('i');
	$tim=date('i:s');
	$tektime=$timeHH.':'.$tim;
	$skoroFilmId=$_POST['film'];
	$slotpodtimeII=$_POST['time'];
		$nadostatus='В ожидании';
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
	
}
if ($_POST['action']=='skoroseans') {
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
		$newreq=mysqli_query($con,"SELECT * from seyvkino where id='$skoroFilmId'");
		$newfilminf=mysqli_fetch_array($newreq);
		$nadostatus='В ожидании';
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
	}
}
if ($_POST['action']=='delete' && $_POST['itm']!='') {
	$itemz=$_POST['itm'];
	$qd=mysqli_query($con,"SELECT * from broni where id='$itemz'");
	$getidus=mysqli_fetch_array($qd);
	$newstatus="Удалено";
			$datka=date('d.m.Y');

			$time=date('H');
			if ($time=='23') {
				$time='00';
			}else{
				$time=date('H')+1;
			}

			$tim=date('i:s');
			$tektime=$time.':'.$tim;
	mysqli_query($con,"UPDATE broni SET status='$newstatus' where id='$itemz'");
	$text = "\r\n".$datka." (".$tektime.")||Удаление бронирования оператором||||".$getidus['namefilm']."||".$getidus['timefilm']."||".$getidus['summa'];
	$fp = fopen("../userhis/".$getidus['vkid'].".txt", "a");
	fwrite($fp, $text);
	fclose($fp);
	echo "Бронирование пользователя удалено.";
}
if ($_POST['action']=='podtver' && $_POST['itm']!='') {
	$itemz=$_POST['itm'];
	$qd=mysqli_query($con,"SELECT * from broni where id='$itemz'");
	$getidus=mysqli_fetch_array($qd);
	$newstatus="Подтверждено";
			$datka=date('d.m.Y');

			$time=date('H');
			if ($time=='23') {
				$time='00';
			}else{
				$time=date('H')+1;
			}

			$tim=date('i:s');
			$tektime=$time.':'.$tim;
	mysqli_query($con,"UPDATE broni SET status='$newstatus' where id='$itemz'");
	$text = "\r\n".$datka." (".$tektime.")||Подтверждение бронирования оператором||||".$getidus['namefilm']."||".$getidus['timefilm']."||".$getidus['summa'];
	$fp = fopen("../userhis/".$getidus['vkid'].".txt", "a");
	fwrite($fp, $text);
	fclose($fp);
	echo "Бронирование пользователя подтверждено.";
}

if ($_POST['action']=='dohodpredned') {
	function getdohod($datka)
	{
		$q=mysqli_query($con,"SELECT * from broni where datka='$datka'");
		$numrov=mysqli_num_rows($q);
		if ($numrov>0) {
			for ($i=0; $i < $numrov ; $i++) { 
				$inf=mysqli_fetch_array($q);
				if ($inf['status']=='Подтверждено') {
					if (!$podverz) {
						$podverz=$inf['summa'];
					}else{
						$podverz+=$inf['summa'];
					}
				}
				if ($inf['status']=='Удалено' || $inf['status']=='В ожидании' || $inf['status']=='Подтверждено') {
					if (!$ozhid) {
						$ozhid=$inf['summa'];
					}else{
						$ozhid+=$inf['summa'];
					}
				}
			}
		}else{
			$podverz=0;
			$ozhid=0;
		}
		if (!$podverz) {
			$podverz=0;
		}
		if (!$ozhid) {
			$podverz=0;
		}
		return array($podverz, $ozhid);
	}
	$nomdnyaned=date('N'); //1-пн, 7-вс
	$j=0;
	while ( $nomdnyaned > 0) {
		$nomdnyaned--;
		$j++;
	}
	for ($i=7; $i > 0 ; $i--) { 
		if ($i>$nomdnyaned) {
			$predday=86400*$j;
			$datka=date('d.m.Y', time()-$predday);
			if ($i==7) {
				// вс
				list($podverz, $ozhid) =getdohod($datka);
				$mvs=array('plan' => $ozhid, 
						   'fact' => $podverz);
			}
			if ($i==6) {
				// сб
				list($podverz, $ozhid) =getdohod($datka);
				$msb=array('plan' => $ozhid, 
						   'fact' => $podverz);
			}
			if ($i==5) {
				// пт
				list($podverz, $ozhid) =getdohod($datka);
				$mpt=array('plan' => $ozhid, 
						   'fact' => $podverz);
			}
			if ($i==4) {
				// чт
				list($podverz, $ozhid) =getdohod($datka);
				$mct=array('plan' => $ozhid, 
						   'fact' => $podverz);
			}
			if ($i==3) {
				// ср
				list($podverz, $ozhid) =getdohod($datka);
				$msr=array('plan' => $ozhid, 
						   'fact' => $podverz);
			}
			if ($i==2) {
				// вт
				list($podverz, $ozhid) =getdohod($datka);
				$mvt=array('plan' => $ozhid, 
						   'fact' => $podverz);
			}
			if ($i==1) {
				// пн
				list($podverz, $ozhid) =getdohod($datka);
				$mpn=array('plan' => $ozhid, 
						   'fact' => $podverz);
			}
			$j++;
		}	
	}		
	$dohodar=array($mvs,$msb,$mpt,$mct,$msr,$mvt,$mpn);
	$jsondoh=json_encode($dohodar);
	print_r($jsondoh);
}
if ($_POST['action']=='dohodned') {
	$nomdnyaned=date('N'); //1-пн, 7-вс
	
	function getdohod($datka)
	{
			$q=mysqli_query($con,"SELECT * from broni where datka='$datka'");
		$numrov=mysqli_num_rows($q);
		if ($numrov>0) {
			for ($i=0; $i < $numrov ; $i++) { 
				$inf=mysqli_fetch_array($q);
				if ($inf['status']=='Подтверждено') {
					if (!$podverz) {
						$podverz=$inf['summa'];
					}else{
						$podverz+=$inf['summa'];
					}
				}
				if ($inf['status']=='Удалено' || $inf['status']=='В ожидании' || $inf['status']=='Подтверждено') {
					if (!$ozhid) {
						$ozhid=$inf['summa'];
					}else{
						$ozhid+=$inf['summa'];
					}
				}
			}
		}else{
			$podverz=0;
			$ozhid=0;
		}
		if (!$podverz) {
			$podverz=0;
		}
		if (!$ozhid) {
			$ozhid=0;
		}
		return array($podverz, $ozhid);
	}
	$j=1;
	for ($i=7; $i > 0 ; $i--) { 
		if ($i>$nomdnyaned) {
			if ($i==7) {
				// вс
				$mvs=array('plan' => 0, 
						   'fact' => 0);
			}
			if ($i==6) {
				// сб
				$msb=array('plan' => 0, 
						   'fact' => 0);
			}
			if ($i==5) {
				// пт
				$mpt=array('plan' => 0, 
						   'fact' => 0);
			}
			if ($i==4) {
				// чт
				$mct=array('plan' => 0, 
						   'fact' => 0);
			}
			if ($i==3) {
				// ср
				$msr=array('plan' => 0, 
						   'fact' => 0);
			}
			if ($i==2) {
				// вт
				$mvt=array('plan' => 0, 
						   'fact' => 0);
			}
			//if ($i==1) {
				// пн
			//}
		}elseif ($i==$nomdnyaned){
			$seydata=date('d.m.Y');
			if ($i==7) {
				// вс
				list($podverz, $ozhid) =getdohod($seydata);
				$mvs=array('plan' => $ozhid, 
						   'fact' => $podverz);
			}
			if ($i==6) {
				// сб
				list($podverz, $ozhid) =getdohod($seydata);
				$msb=array('plan' => $ozhid, 
						   'fact' => $podverz);
			}
			if ($i==5) {
				// пт
				list($podverz, $ozhid) =getdohod($seydata);
				$mpt=array('plan' => $ozhid, 
						   'fact' => $podverz);
			}
			if ($i==4) {
				// чт
				list($podverz, $ozhid) =getdohod($seydata);
				$mct=array('plan' => $ozhid, 
						   'fact' => $podverz);
			}
			if ($i==3) {
				// ср
				list($podverz, $ozhid) =getdohod($seydata);
				$msr=array('plan' => $ozhid, 
						   'fact' => $podverz);
			}
			if ($i==2) {
				// вт
				list($podverz, $ozhid) =getdohod($seydata);
				$mvt=array('plan' => $ozhid, 
						   'fact' => $podverz);
			}
			if ($i==1) {
				// пн
				list($podverz, $ozhid) =getdohod($seydata);
				$mpn=array('plan' => $ozhid, 
						   'fact' => $podverz);
			}
		}elseif ($i<$nomdnyaned) {
			$predday=86400*$j;
			$datka=date('d.m.Y', time()-$predday);
			if ($i==6) {
				// сб
				list($podverz, $ozhid) =getdohod($datka);
				$msb=array('plan' => $ozhid, 
						   'fact' => $podverz);
			}
			if ($i==5) {
				// пт
				list($podverz, $ozhid) =getdohod($datka);
				$mpt=array('plan' => $ozhid, 
						   'fact' => $podverz);
			}
			if ($i==4) {
				// чт
				list($podverz, $ozhid) =getdohod($datka);
				$mct=array('plan' => $ozhid, 
						   'fact' => $podverz);
			}
			if ($i==3) {
				// ср
				list($podverz, $ozhid) =getdohod($datka);
				$msr=array('plan' => $ozhid, 
						   'fact' => $podverz);
			}
			if ($i==2) {
				// вт
				list($podverz, $ozhid) =getdohod($datka);
				$mvt=array('plan' => $ozhid, 
						   'fact' => $podverz);
			}
			if ($i==1) {
				// пн
				list($podverz, $ozhid) =getdohod($datka);
				$mpn=array('plan' => $ozhid, 
						   'fact' => $podverz);
			}
			$j++;
		}		
		
	}
$dohodar=array($mvs,$msb,$mpt,$mct,$msr,$mvt,$mpn);
$jsondoh=json_encode($dohodar);
print_r($jsondoh);
}

if ($_POST['action']=='predseans') {
	$statusq='В ожидании';
								$statupd='Подтверждено';
	$k=0;
	$naidenofilmov=0;
	$searchps=mysqli_query($con,"SELECT * from broni where vkid='$sess_id'");
	$skokres=mysqli_num_rows($searchps);
	echo '<div class="prstfont">Предстоящие сеансы</div>';
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
			#|| $infa['datka']==$seydata && $infa['timefilm']<$seytime && $infa['timefilm'][0][1]>='00' && $infa['timefilm'][0][1]<'06' && $seytime[0][1]>'03' && ($infa['status']==$statusq || $infa['status']==$statupd)

			$timfil2sym=substr($infa['timefilm'], 0,2);
			$seytim2sym=substr($seytime, 0,2);
			
			if ($infa['datka']==$seydata && $infa['timefilm']>$seytime && ($infa['status']==$statusq || $infa['status']==$statupd) || $infa['datka']==$nochdata && $timfil2sym>='00' && $timfil2sym<'06' && $infa['timefilm']>$seytime && ($infa['status']==$statusq || $infa['status']==$statupd) || $infa['datka']==$seydata && $infa['timefilm']<$seytime && $timfil2sym>='00' && $timfil2sym<'06' && $seytim2sym>'03' && ($infa['status']==$statusq || $infa['status']==$statupd)) {
				$naidenofilmov++;
			if ($k==0) {
				echo "<div>";
			}
			$hsmesto=explode(', ', $hsmesto);
			$skokmestzabr=count($hsmesto);
			#print_r($hsmesto);
			#echo "$skokmestzabr";
				if ($skokmestzabr>1) {
					for ($i=0; $i < $skokmestzabr ; $i++) { 

						if ($hsmesto[$i]>0 && $hsmesto[$i]<12) {
							$ryadmesta=1;
						}elseif ($hsmesto[$i]>11 && $hsmesto[$i]<25) {
							$ryadmesta=2;
						}elseif ($hsmesto[$i]>24 && $hsmesto[$i]<40) {
							$ryadmesta=3;
						}elseif ($hsmesto[$i]>39 && $hsmesto[$i]<55) {
							$ryadmesta=4;
						}elseif ($hsmesto[$i]>54 && $hsmesto[$i]<70) {
							$ryadmesta=5;
						}elseif ($hsmesto[$i]>69 && $hsmesto[$i]<85) {
							$ryadmesta=6;
						}elseif ($hsmesto[$i]>84 && $hsmesto[$i]<100) {
							$ryadmesta=7;
						}elseif ($hsmesto[$i]>99 && $hsmesto[$i]<115) {
							$ryadmesta=8;
						}elseif ($hsmesto[$i]>114 && $hsmesto[$i]<130) {
							$ryadmesta=9;
						}elseif ($hsmesto[$i]>129 && $hsmesto[$i]<145) {
							$ryadmesta=10;
						}elseif ($hsmesto[$i]>144 && $hsmesto[$i]<160) {
							$ryadmesta=11;
						}elseif ($hsmesto[$i]>159 && $hsmesto[$i]<175) {
							$ryadmesta=12;
						}elseif ($hsmesto[$i]>174 && $hsmesto[$i]<190) {
							$ryadmesta=13;
						}
						if ($i==0) {
							$mestairyadi=$hsmesto[$i].' ('.$ryadmesta.' ряд)<br>';
						}else{
							if (!$mestairyadi) {
								$mestairyadi=$hsmesto[$i].' ('.$ryadmesta.' ряд)<br>';
							}else{
								$mestairyadi.=$hsmesto[$i].' ('.$ryadmesta.' ряд)<br>';
							}
						}
					}
				}else{
					if ($hsmesto[0]>0 && $hsmesto[0]<12) {
							$ryadmesta=1;
						}elseif ($hsmesto[0]>11 && $hsmesto[0]<25) {
							$ryadmesta=2;
						}elseif ($hsmesto[0]>24 && $hsmesto[0]<40) {
							$ryadmesta=3;
						}elseif ($hsmesto[0]>39 && $hsmesto[0]<55) {
							$ryadmesta=4;
						}elseif ($hsmesto[0]>54 && $hsmesto[0]<70) {
							$ryadmesta=5;
						}elseif ($hsmesto[0]>69 && $hsmesto[0]<85) {
							$ryadmesta=6;
						}elseif ($hsmesto[0]>84 && $hsmesto[0]<100) {
							$ryadmesta=7;
						}elseif ($hsmesto[0]>99 && $hsmesto[0]<115) {
							$ryadmesta=8;
						}elseif ($hsmesto[0]>114 && $hsmesto[0]<130) {
							$ryadmesta=9;
						}elseif ($hsmesto[0]>129 && $hsmesto[0]<145) {
							$ryadmesta=10;
						}elseif ($hsmesto[0]>144 && $hsmesto[0]<160) {
							$ryadmesta=11;
						}elseif ($hsmesto[0]>159 && $hsmesto[0]<175) {
							$ryadmesta=12;
						}elseif ($hsmesto[0]>174 && $hsmesto[0]<190) {
							$ryadmesta=13;
						}
						#if (!$mestairyadi) {
								$mestairyadi=$hsmesto[0].' ('.$ryadmesta.' ряд)';
						#	}
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

									if ($skokmestzabr>1) {
											echo '<div class="onelvl" style="text-align:right;vertical-align: top;">Забронированные места - ';
										}else{
											echo '<div class="onelvl" style="text-align:right;vertical-align: top;">Забронированное место - <br>Начало сеанса - <br>Цена - <br>Код подтверждения - </div>
										<div class="onelvl" style="text-align:left;">'.$mestairyadi;
										}
										
										for ($i=0; $i < $skokmestzabr; $i++) { 
											echo '<br>';
										}
										if ($skokmestzabr>1) {
											echo 'Начало сеанса - <br>Цена - <br>Код подтверждения - </div>
										<div class="onelvl" style="text-align:left;">'.$mestairyadi;
										}

								echo $infa['timefilm'].'<br>'.$infa['summa'].' руб.<br>'.$infa['kod'].'</div>
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
									<div class="podrobinfa">';

									if ($skokmestzabr>1) {
											echo '<div class="onelvl" style="text-align:right;vertical-align: top;">Забронированные места - ';
										}else{
											echo '<div class="onelvl" style="text-align:right;vertical-align: top;">Забронированное место - <br>Начало сеанса - <br>Цена - <br>Код подтверждения - </div>
										<div class="onelvl" style="text-align:left;">'.$mestairyadi;
										}
										
										for ($i=0; $i < $skokmestzabr; $i++) { 
											echo '<br>';
										}
										if ($skokmestzabr>1) {
											echo 'Начало сеанса - <br>Цена - <br>Код подтверждения - </div>
										<div class="onelvl" style="text-align:left;">'.$mestairyadi;
										}

								echo $infa['timefilm'].'<br>'.$infa['summa'].' руб.<br>'.$infa['kod'].'</div>
									</div>
									<div class="cestatus" style="padding-bottom:0px;color:#04d104;">'.$infa['status'].'</div>
									<div class="cestatus" style="font-size:18px;padding:0;padding-bottom:20px;color:#04d104;">(Ожидайте начала сеанса)</div>
								</div>
						</div>
					</div>';
				}
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
		echo "</div>";
		echo "</div>";
	}else{
		echo '<div id="zapinprof" style="text-align: center;position: relative;">
							<div class="resqpr">Отсутствуют.</div>
						</div>';
	}
	echo "<div style='padding: 5px;text-align: center;'>Для подтверждения бронирования необходимо произвести оплату.</div>";
	//echo "<div style='padding: 5px;'>Для подтверждения бронирования необходимо произвести оплату.</div>";
}
if ($_POST['action']=='historyact') {
	echo '<div class="prstfont">История активности</div>';
	$file_name = '../userhis/'.$sess_id.'.txt';
    $data = file($file_name); //massive
    $skokstr=count($data);//strok
    echo '<table>
    		<thead>
    		<tr style="background-color: #10baff;color: white;display:block;">
    			<td style="width: 102px;">Дата (Время)
    			<td style="width: 189px;">Действие
    			<td style="width: 53px;">Кол-во мест
    			<td style="width: 160px;">Название сеанса
    			<td style="width: 54px;">Время сеанса
    			<td>Общая стоимость
    		</td>
    		</tr>
    		</thead>';
    for ($i=$skokstr; $i >= 0 ; $i--) { 
    	$value = explode( "||", $data[$i]);
    	$co=count($value);
    	if ($value[0]!='') {
	    	echo '<tr>';
	    	for ($ik=0; $ik < $co ; $ik++) { 
	    		if ($ik==0) {
	    			echo '<td class="td" style="width: 102px;">'.$value[$ik];
	    		}elseif($ik==1){
	    			echo '<td class="td" style="width: 189px;">'.$value[$ik];
	    		}elseif ($ik==2) {
	    			echo '<td class="td" style="width: 53px;">'.$value[$ik];
	    		}elseif ($ik==3) {
	    			echo '<td class="td" style="width: 160px;">'.$value[$ik];
	    		}elseif ($ik==4) {
	    			echo '<td class="td" style="width: 54px;">'.$value[$ik];
	    		}elseif ($ik==5){
	    			echo '<td class="td" style="width: 73px;">'.$value[$ik];
	    		}
	    	}
	    	echo '</tr>';
    	}
    }/*
    foreach ($data as $value) {
    	$value = explode( "||", $value);
    	$co=count($value);
    	echo '<tr>';
    	for ($i=0; $i < $co ; $i++) { 
    		echo '<td class="td">'.$value[$i];
    	}
    	echo '</tr>';
    }*/
    echo '</table>';
}
?>