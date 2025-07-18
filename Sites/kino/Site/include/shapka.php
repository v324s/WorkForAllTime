<div class="bigshapka">
				<div class="logovshapke"></div>
				<div class="navi">
					<a href="index"><div class="nav glavnaya">главная</div></a>
					<a href="afisha"><div class="nav afisha">афиша</div></a>
					<a href="okino"><div class="nav okino">о кинотеатре</div></a>
				</div>
				<div class="formaction" style="position: relative;">
				<?
				
					
						if ($userlogined) {
							echo '<div class="spisokaction-logined">
									<a href="profile" style="display:flex;"><div class="butprofile" style="margin: auto;">Профиль</div></a>
									<a href="index?act=logout" style="display:flex;"><div class="butprofile" style="margin: auto;background-image:url(img/vihod.png);width: 50px;background-position: center;background-repeat: no-repeat;"></div></a>
								  </div>';
							if ($sess_img==false) {
								echo '<div class="avashapka"></div>';
							}else{
								echo '<div class="bordershapkiava">
										<div class="avashapka" style="background: url('.$sess_img.');margin:0;width:50px;height:50px;border:1px solid black;"></div>
									</div>';
							}
						}else{
							echo '<div class="spisokaction">
									<div class="actvhod" onclick="voyti()">войти</div>
								  </div>
								  <div class="avashapka" style="position: absolute;right: 128px;"></div>';
						}
					?>
				</div>
			</div>