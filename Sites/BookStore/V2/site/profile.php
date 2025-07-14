<?
session_start();

include 'include/settings.php';
include 'include/cart.php';

if ($_GET['act']=='logout') {
	unset($_SESSION['user_id']);
	unset($_SESSION['user_email']);
	unset($_SESSION['user_pass']);
	unset($_SESSION['user_fname']);
	unset($_SESSION['user_lname']);
	unset($_SESSION['user_llname']);
	unset($_SESSION['sesadm']);
	unset($_SESSION['sesadmkey']);
	header('location:profile');
}


$err = '';
if (count($_POST)>0) {
	// Функция смены адреса пользователя
	if ($_POST['changeAddr'] && isset($_SESSION['user_id'])) {
		if ($_POST['gorod'] && $_POST['address']) {
			$uid = $_SESSION['user_id'];
			$gorod = $_POST['gorod'];
			$address = $_POST['address'];
			$res=mysqli_query($conn,"UPDATE `users` SET `gorod`='".$gorod."', `address`='".$address."' WHERE `id`='".$uid."'");
			if ($res) {
				$err = 'Адрес успешно изменен';
				$_GET['act'] = 'changeAddress';
			}
		}
	}

	// Функция смены пароля пользователя
	if ($_POST['changePass'] && isset($_SESSION['user_id'])) {
		if ($_POST['password'] != $_POST['password2']) {
			$err = 'Введенные новые пароли не совпадают';
			$_GET['act'] = 'changePassword';
		}
		if ($_POST['password'] && $_POST['password2'] && $_POST['oldPassword'] && !$err) {
			$uid = $_SESSION['user_id'];
			$oldPass = $_POST['oldPassword'];
			$newPass = $_POST['password'];
			$res=mysqli_query($conn,"SELECT `id` from users WHERE `id`='".$uid."' AND `pass`='".md5($oldPass)."'");
			$acc = mysqli_fetch_assoc($res);
			if ($acc != null) {
				$res=mysqli_query($conn,"UPDATE `users` SET `pass`='".md5($newPass)."' WHERE `id`='".$uid."'");
				if ($res) {
					$err = 'Пароль успешно изменен';
					$_GET['act'] = 'changePassword';
				}
			}else{
				$err = 'Неверный старый пароль';
				$_GET['act'] = 'changePassword';
			}
		}
	}

	// Функция регистрации пользовательского аккаунта
	if ($_POST['register']) {
		if ($_POST['password'] != $_POST['password2']) {
			$err = 'Введенные пароли не совпадают';
			$_GET['form'] = 'registration';
		}
		if ($err == '' && $_POST['email'] && $_POST['password'] && $_POST['first_name'] && $_POST['last_name'] && $_POST['gorod'] && $_POST['tel'] && $_POST['address']) {
			$res=mysqli_query($conn,"SELECT `id` from users WHERE `email`='".$_POST['email']."'");
			$acc = mysqli_fetch_assoc($res);
			
			if ($acc != null) {
				$err = 'На указанный E-mail уже зарегистрированы';
				$_GET['form'] = 'registration';
			}else{
				$res=mysqli_query($conn,"INSERT INTO `users` (`email`,`first_name`,`last_name`,`llast_name`,`tel`,`gorod`,`address`,`pass`,`regtime`) VALUES ('".$_POST['email']."','".$_POST['first_name']."','".$_POST['last_name']."','".$_POST['llast_name']."','".$_POST['tel']."','".$_POST['gorod']."','".$_POST['address']."','".md5($_POST['password'])."','".time()."')");
				if ($res) {
					$err = 'Регистрация успешно завершена';
				}else{
					$err = 'Регистарция не удалась';
					$_GET['form'] = 'registration';
				}
			}
		}
	}

	// Функция входа пользователя в аккаунт
	if ($_POST['login']) {
		if ($_POST['email'] && $_POST['password']) {
			if ($_POST['email']==$adminlog) {
				if ($_POST['password']==$adminpass) {
					$_SESSION['sesadm'] = $adminlog;
					$_SESSION['sesadmkey'] = $adminpass;
					header('location:adminka');
				}else{
					$err = 'Неверный пароль';
				}
			}else{
				$res=mysqli_query($conn,"SELECT `id` from users WHERE `email`='".$_POST['email']."'");
				$acc = mysqli_fetch_assoc($res);
				if ($acc != null) {
					$res=mysqli_query($conn,"SELECT * from users WHERE `email`='".$_POST['email']."' AND `pass`='".md5($_POST['password'])."'");
					$acc = mysqli_fetch_assoc($res);
					if ($acc != null) {
						$_SESSION['user_id'] = $acc['id'];
						$_SESSION['user_email'] = $_POST['email'];
						$_SESSION['user_pass'] = md5($_POST['password']);

						$_SESSION['user_fname'] = $acc['first_name'];
						$_SESSION['user_lname'] = $acc['last_name'];
						$_SESSION['user_llname'] = $acc['llast_name'];
						header('location:profile');
					}else{
						$err = 'Неверный пароль';
					}
				}else{
					$err = 'Указанный E-mail в системе не зарегистрирован';
				}
			}
		}else{
			$err = 'Для входа введите E-mail и пароль';
		}
	}
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Dream Library</title>
	<link rel="stylesheet" type="text/css" href="css/main.css">
    <script src="js/jquery.min.js"></script>
    <script src="js/jquery.inputmask.bundle.js"></script>
	<style>
    .valid {
        color: green;
    }
    .valid::before {
        content: '✅ ';
    }
    .invalid {
        color: red;
    }
    .invalid::before {
        content: '❌ ';
    }
</style>
</head>
<body>
	<?
	include 'include/site-header.php';
	?>
	<section style="position: relative;">
		<section class="bokblock">
			
		</section><main class="osnovcontent">
			<div class="textosnovi" style="padding-top: 5%">
				<?php
					if (isset($_SESSION['user_id']) == false && !isset($_GET['form'])) {
						?>
							<div style="display: flex;width: 70%;margin: 0 auto;">
								<div style="width: 50%;text-align: center;font-size: 2rem;margin-top: 0;color: #12bfff;border-bottom: 0.3rem solid #ddbeff;padding: 1%;"><a href="profile" style="font-size: 2rem;margin-top: 0;color: #12bfff;">Авторизация</a></div>
								<div style="width: 50%;text-align: center;font-size: 2rem;margin-top: 0;color: #12bfff;padding: 1%;"><a href="?form=registration" style="font-size: 2rem;margin-top: 0;color: #12bfff;">Регистрация</a></div>
							</div>
							<?php
								if ($err != '') {
									?>
									<center><h3 style="font-size: 1rem;margin-top: 1rem;color: #ff2976;"><? print_r($err); ?></h3></center>
									<?php
								}
							?>
							<!-- <center><h3 style="font-size: 2rem;margin-top: 0;color: #12bfff;">Авторизация</h3></center> -->
							<form method="POST" action="profile" style="width: 50%;display: block;margin: 0 auto;margin-top: 2rem;">
								<input type="text" name="email" class="oknotextinput" placeholder="E-mail" style="width: 96%;border: none;display: block;font-size: 1.2rem;padding: 2%;border-bottom: 0.1rem solid #11bfff;"><br>
								<input type="password" name="password" class="oknotextinput" placeholder="Пароль" style="width: 96%;border: none;display: block;font-size: 1.2rem;padding: 2%;border-bottom: 0.1rem solid #11bfff;" ><br>
								<input type="submit" name="login" value="Войти" class="#buttongokatal" style="position: relative;text-align: center;background: linear-gradient(229deg, #09bfff, #f0beff);padding: 1.5rem;color: white;margin-top: 1.5rem;width: 100%;border: none;letter-spacing: 2px;font-size: 20px;font-weight: 500;border-radius: 10px;">
							</form>
						<?
					}elseif ($_GET['form'] == 'registration') {
						?>
							<div style="display: flex;width: 70%;margin: 0 auto;">
								<div style="width: 50%;text-align: center;font-size: 2rem;margin-top: 0;color: #12bfff;padding: 1%;"><a href="profile" style="font-size: 2rem;margin-top: 0;color: #12bfff;">Авторизация</a></div>
								<div style="width: 50%;text-align: center;font-size: 2rem;margin-top: 0;color: #12bfff;border-bottom: 0.3rem solid #ddbeff;padding: 1%;"><a href="?form=registration" style="font-size: 2rem;margin-top: 0;color: #12bfff;">Регистрация</a></div>
							</div>
							<?php
								if ($err != '') {
									?>
									<center><h3 style="font-size: 1rem;margin-top: 1rem;color: #ff2976;"><? print_r($err); ?></h3></center>
									<?php
								}
							?>
							
							<form id="registrationForm" method="POST" action="profile" style="width: 50%;display: block;margin: 0 auto;margin-top: 2rem;">
								<input required type="email" name="email" class="oknotextinput" placeholder="E-mail" style="width: 96%;border: none;display: block;font-size: 1.2rem;padding: 2%;border-bottom: 0.1rem solid #11bfff;" required minlength="5"><br>
								<input required type="password" name="password" id="password" class="oknotextinput" placeholder="Пароль" style="width: 96%;border: none;display: block;font-size: 1.2rem;padding: 2%;border-bottom: 0.1rem solid #11bfff;" minlength="8"><br>
								<div id="passwordRequirements" style="display: none;">
									<ul>
										<li id="hasDigit" class="invalid">Хоть 1 цифра</li>
										<li id="hasLowerCase" class="invalid">Хоть 1 строчная буква</li>
										<li id="hasUpperCase" class="invalid">Хоть 1 заглавная буква</li>
										<li id="hasSpecialChar" class="invalid">Хоть 1 спец.символ: !@#$%^&*</li>
										<li id="isLongEnough" class="invalid">Должен содержать не менее 8 символов</li>
									</ul>
								</div>
								<input required type="password" name="password2" id="password2" class="oknotextinput" placeholder="Повторите пароль" style="width: 96%;border: none;display: block;font-size: 1.2rem;padding: 2%;border-bottom: 0.1rem solid #11bfff;" min="8"><br>
								<div id="passwordMismatch" style="display: none; color: red;padding-bottom: 1rem;">Введенные пароли не совпадают</div>
								<input required type="text" name="first_name" id="regipt_first_name" class="oknotextinput" placeholder="Имя" style="width: 96%;border: none;display: block;font-size: 1.2rem;padding: 2%;border-bottom: 0.1rem solid #11bfff;" minlength="2"><br>
								<input required type="text" name="last_name"id="regipt_last_name" class="oknotextinput" placeholder="Фамилия" style="width: 96%;border: none;display: block;font-size: 1.2rem;padding: 2%;border-bottom: 0.1rem solid #11bfff;" minlength="2"><br>
								<input type="text" name="llast_name" id="regipt_llast_name" class="oknotextinput" placeholder="Отчество" style="width: 96%;border: none;display: block;font-size: 1.2rem;padding: 2%;border-bottom: 0.1rem solid #11bfff;" minlength="2"><br>

								<input id="order__tel" style="width: 96%;border: none;display: block;font-size: 1.2rem;padding: 2%;border-bottom: 0.1rem solid #11bfff;" class="oknotextinput" inputmode="numeric" data-plugin-inputmask="mask_tel" style="margin-top: 0;letter-spacing: 0.15rem;" name="tel" type="text" placeholder="+7(___)___-__-__" minlength="16" maxlength="16" required><br>

								<input required type="text" name="gorod" id="regipt_gorod" class="oknotextinput" placeholder="Город" style="width: 96%;border: none;display: block;font-size: 1.2rem;padding: 2%;border-bottom: 0.1rem solid #11bfff;" minlength="2"><br>
								<input required type="text" name="address" id="regipt_address" class="oknotextinput" placeholder="Адрес" style="width: 96%;border: none;display: block;font-size: 1.2rem;padding: 2%;border-bottom: 0.1rem solid #11bfff;" minlength="2"><br>
								<input type="submit" name="register" value="Зарегистрироваться" style="position: relative;text-align: center;background: linear-gradient(229deg, #09bfff, #f0beff);padding: 1.5rem;color: white;margin-top: 1.5rem;width: 100%;border: none;letter-spacing: 2px;font-size: 20px;font-weight: 500;border-radius: 10px;">
							</form>
						<?
					}elseif ($_GET['act'] == 'changePassword' && isset($_SESSION['user_id'])) {
						?>
							<div style="width: 70%;margin: 0 auto;">
								<div style="text-align: center;font-size: 2rem;margin-top: 0;color: #12bfff;border-bottom: 0.3rem solid #ddbeff;padding: 1%;">Изменение пароля</div>
							</div>
							<?php
								if ($err != '') {
									?>
									<center><h3 style="font-size: 1rem;margin-top: 1rem;color: #ff2976;"><? print_r($err); ?></h3></center>
									<?php
								}
							?>
							
							<form id="formNewPass" method="POST" action="profile" style="width: 50%;display: block;margin: 0 auto;margin-top: 2rem;">
								<input required type="password" name="oldPassword" class="oknotextinput" placeholder="Старый пароль" style="width: 96%;border: none;display: block;font-size: 1.2rem;padding: 2%;border-bottom: 0.1rem solid #11bfff;" ><br>
								<input required type="password" name="password" id="password" class="oknotextinput" placeholder="Новый пароль" style="width: 96%;border: none;display: block;font-size: 1.2rem;padding: 2%;border-bottom: 0.1rem solid #11bfff;" minlength="8"><br>
								<div id="passwordRequirements" style="display: none;">
									<ul>
										<li id="hasDigit" class="invalid">Хоть 1 цифра</li>
										<li id="hasLowerCase" class="invalid">Хоть 1 строчная буква</li>
										<li id="hasUpperCase" class="invalid">Хоть 1 заглавная буква</li>
										<li id="hasSpecialChar" class="invalid">Хоть 1 спец.символ: !@#$%^&*</li>
										<li id="isLongEnough" class="invalid">Должен содержать не менее 8 символов</li>
									</ul>
								</div>
								<input required type="password" name="password2" id="password2" class="oknotextinput" placeholder="Повторите пароль" style="width: 96%;border: none;display: block;font-size: 1.2rem;padding: 2%;border-bottom: 0.1rem solid #11bfff;" ><br>
								<div id="passwordMismatch" style="display: none; color: red;padding-bottom: 1rem;">Введенные пароли не совпадают</div>
								<input type="submit" name="changePass" value="Изменить" style="position: relative;text-align: center;background: linear-gradient(229deg, #09bfff, #f0beff);padding: 1.5rem;color: white;margin-top: 1.5rem;width: 100%;border: none;letter-spacing: 2px;font-size: 20px;font-weight: 500;border-radius: 10px;">
							</form>
						<?
					}elseif ($_GET['act'] == 'changeAddress' && isset($_SESSION['user_id'])) {
						$uid = $_SESSION['user_id'];
						$res=mysqli_query($conn,"SELECT * from users WHERE `id`='".$uid."'");
						$acc = mysqli_fetch_assoc($res);
						?>
							<div style="width: 70%;margin: 0 auto;">
								<div style="text-align: center;font-size: 2rem;margin-top: 0;color: #12bfff;border-bottom: 0.3rem solid #ddbeff;padding: 1%;">Изменение адреса</div>
							</div>
							<?php
								if ($err != '') {
									?>
									<center><h3 style="font-size: 1rem;margin-top: 1rem;color: #ff2976;"><? print_r($err); ?></h3></center>
									<?php
								}
							?>

							<form name="orderform" method="post" action="profile" style="width: 50%;display: block;margin: 0 auto;margin-top: 2rem;">
								<input type="text" name="gorod" id="gorod" size="30" placeholder="Город" value="<?php echo $acc['gorod']; ?>" style="width: 96%; border: none;display: block;font-size: 1.2rem;padding: 2%;border-bottom: 0.1rem solid #11bfff;" required="">
								<br>
								<input type="text" name="address" id="address" size="30" placeholder="Адрес" value="<?php echo $acc['address']; ?>" style="width: 96%; border: none;display: block;font-size: 1.2rem;padding: 2%;border-bottom: 0.1rem solid #11bfff;" required="">
								<br>
								<input type="submit" name="changeAddr" id="submit" style="position: relative;text-align: center;background: linear-gradient(229deg, #09bfff, #f0beff);padding: 1rem;color: white;width: 100%;border: none;letter-spacing: 2px;font-size: 20px;font-weight: 500;border-radius: 10px;" value="Изменить">
							</form>
						<?
					}elseif (isset($_SESSION['user_id'])) {
						
						$uid = $_SESSION['user_id'];
						$res=mysqli_query($conn,"SELECT * from users WHERE `id`='".$uid."'");
						$acc = mysqli_fetch_assoc($res);
						
						$otzivi=mysqli_query($conn,"SELECT `id` from otzivi WHERE `uid`='".$uid."'");
						$countOtzivi = mysqli_num_rows($otzivi);

						
						$priceOrders=mysqli_query($conn,"SELECT `price` from zakazi WHERE `uid`='".$uid."'");
						$countOrders = mysqli_num_rows($priceOrders);
						if ($countOrders > 0) {
							$totalPriceOrders = 0;
							for ($i=0; $i < $countOrders ; $i++) { 
								$prices=mysqli_fetch_assoc($priceOrders);
								$totalPriceOrders+=$prices['price'];
							}
						}else{
							$totalPriceOrders = 0;
						}
						?>

						<div class="dlyafiltra">
							<div>
								<p><b><? echo "{$_SESSION['user_lname']} {$_SESSION['user_fname']} {$_SESSION['user_llname']}" ?></b></p>
							</div>
							<div>
								<a href="?act=changePassword" style="color: #36beff;">Изменить пароль</a>
							</div>
							<div>
								<a href="?act=logout" style="color: #36beff;">Выйти</a>
							</div>
						</div>

						<style>
							.userStatistic tr td:first-child {
								border-left: 0.1rem solid #36beff;
								border-right: 0.1rem solid #36beff;
							}
							.userStatistic tr td:not(:first-child):not(:last-child) {
								border-right: 0.1rem solid #36beff;
							}
							.userStatistic tr td:last-child {
								border-right: 0.1rem solid #36beff;
							}
							.userStatistic thead tr td{
								font-size: 0.8rem;
							}
							.userStatistic tbody tr td{
								font-size: 1.3rem;
							}
						</style>
						<div style="padding-bottom: 2rem;">
							<table class="userStatistic" style="width: 98%;margin: 0 auto;text-align: center;border-spacing: 0;">
								<thead>
									<tr>
										<td>Дата регистрации</td>
										<td>Кол-во заказов</td>
										<td>Сумма заказов</td>
										<td>Оставленных отзывов</td>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td><?php echo date("d.m.Y",$acc['regtime']); ?></td>
										<td><?php echo $countOrders; ?></td>
										<td><?php echo $totalPriceOrders; ?> ₽</td>
										<td><?php echo $countOtzivi; ?></td>
									</tr>
								</tbody>
							</table>
						</div>
						
						<div class="dlyafiltra">
							<div>
								<p><b>Адрес доставки</b></p>
							</div>
							<div>
								<a href="?act=changeAddress" style="color: #36beff;">Изменить</a>
							</div>
						</div>
						<div style="padding-bottom: 2rem;">
							<table class="userStatistic" style="width: 98%;margin: 0 auto;text-align: center;border-spacing: 0;">
								<tbody>
									<tr>
										<td><? echo $acc['gorod'].', '.$acc['address']; ?></td>
									</tr>
								</tbody>
							</table>
						</div>
						
						<div class="dlyafiltra">
							<div>
								<p><b>Корзина</b></p>
							</div>
							<div>
								<a href="korzina" style="color: #36beff;">Подробнее</a>
							</div>
						</div>


						<div class="dlyafiltra">
							<div>
								<p><b>Желаемое</b></p>
							</div>
							<div>
								<a href="korzina?get=favorite" style="color: #36beff;">Подробнее</a>
							</div>
						</div>

						<div class="dlyafiltra">
							<div>
								<p><b>История заказов</b></p>
							</div>
							<div>
								<a href="korzina?get=history" style="color: #36beff;">Подробнее</a>
							</div>
						</div>

						<?
					}
				?>
				
			</div>
		</main><section class="bokblock"></section>
	</section>
	<?
	include 'include/site-footer.php';
	?>
	<script>
		var mask_tel = {"mask":"+7(999)999-99-99"};
		$("#order__tel").inputmask(mask_tel);


		passwordInput = document.getElementById('password');
		passwordRequirements = document.getElementById('passwordRequirements');
		passwordMismatch = document.getElementById('passwordMismatch');
		password2Input = document.getElementById('password2');

		passwordInput.addEventListener('focus', function() {
			passwordRequirements.style.display = 'block';
		});

		passwordInput.addEventListener('input', function() {
			const password = passwordInput.value;

			const hasUpperCase = /[A-Z]/.test(password);
			const hasLowerCase = /[a-z]/.test(password);
			const hasDigit = /\d/.test(password);
			const hasSpecialChar = /[!@#$%^&*]/.test(password);
			const isLongEnough = password.length >= 8;

			document.getElementById('hasDigit').className = hasDigit ? 'valid' : 'invalid';
			document.getElementById('hasLowerCase').className = hasLowerCase ? 'valid' : 'invalid';
			document.getElementById('hasUpperCase').className = hasUpperCase ? 'valid' : 'invalid';
			document.getElementById('hasSpecialChar').className = hasSpecialChar ? 'valid' : 'invalid';
			document.getElementById('isLongEnough').className = isLongEnough ? 'valid' : 'invalid';
		});

		password2Input.addEventListener('input', function() {
			if (passwordInput.value !== password2Input.value) {
				passwordMismatch.style.display = 'block';
			} else {
				passwordMismatch.style.display = 'none';
			}
		});


		

		// Форма регистрации
		document.getElementById('registrationForm').addEventListener('submit', function(event) {

			// -----------
			// Пароль
			// -----------

            password = document.getElementById('password').value;
            
            // Регулярные выражения для проверки пароля
            hasUpperCase = /[A-Z]/.test(password);
            hasLowerCase = /[a-z]/.test(password);
            hasDigit = /\d/.test(password);
            hasSpecialChar = /[!@#$%^&*]/.test(password);
            isLongEnough = password.length >= 8;


			// -----------
			// Номер телефона
			// -----------

			telRegex = /\+7\(\d{3}\)\d{3}-\d{2}-\d{2}/;


			// -----------
			// Остальные инпуты
			// -----------
			
			const firstName = document.getElementById('regipt_first_name').value;
			const lastName = document.getElementById('regipt_last_name').value;
			const gorod = document.getElementById('regipt_gorod').value;

			// Регулярное выражение для проверки только букв (русские и английские)
			const lettersRegex = /^[A-Za-zА-Яа-яЁё-]+$/;

			// -----------
            // Проверка всех требований
			// -----------
            if (!(hasUpperCase && hasLowerCase && hasDigit && hasSpecialChar && isLongEnough)) {
                alert('Пароль не соответствует требованиям:\n' +
                      '- Должен содержать хотя бы одну большую букву\n' +
                      '- Должен содержать хотя бы одну маленькую букву\n' +
                      '- Должен содержать хотя бы одну цифру\n' +
                      '- Должен содержать хотя бы один специальный символ: !@#$%^&*\n' +
                      '- Должен содержать не менее 8 символов');
                event.preventDefault(); 
            }else if (passwordInput.value !== password2Input.value) {
				alert('Повторный пароль указан неверно');
                event.preventDefault(); 
			}else if ($('#order__tel').val() == '' || $('#order__tel').val() == '+7(___)___-__-__' && error == false) {
				alert('Вы не ввели номер телефона');
                event.preventDefault(); 
			}else if (!telRegex.test($('#order__tel').val())) {
				alert('Вы ввели номер телефона некорректно');
                event.preventDefault(); 
            }else if (!(lettersRegex.test(firstName) && lettersRegex.test(lastName) && lettersRegex.test(gorod))) {
				alert('Поля: Фамилия, Имя, Город\nдолжны содержать только буквы');
                event.preventDefault(); 
            }
        });

	</script>
	
	<script>
		if (new URLSearchParams(window.location.search).get('act') === 'changePassword') {
			document.addEventListener('DOMContentLoaded', function() {
				document.getElementById('formNewPass').addEventListener('submit', function(event) {
					password = document.getElementById('password').value;
					
					// Регулярные выражения для проверки пароля
					hasUpperCase = /[A-Z]/.test(password);
					hasLowerCase = /[a-z]/.test(password);
					hasDigit = /\d/.test(password);
					hasSpecialChar = /[!@#$%^&*]/.test(password);
					isLongEnough = password.length >= 8;
	
					if (!(hasUpperCase && hasLowerCase && hasDigit && hasSpecialChar && isLongEnough)) {
						alert('Пароль не соответствует требованиям:\n' +
							'- Должен содержать хотя бы одну большую букву\n' +
							'- Должен содержать хотя бы одну маленькую букву\n' +
							'- Должен содержать хотя бы одну цифру\n' +
							'- Должен содержать хотя бы один специальный символ: !@#$%^&*\n' +
							'- Должен содержать не менее 8 символов');
						event.preventDefault(); 
					}else if (passwordInput.value !== password2Input.value) {
						alert('Повторный пароль указан неверно');
						event.preventDefault(); 
					}
				});
			});
		}
	</script>
</body>
</html>
