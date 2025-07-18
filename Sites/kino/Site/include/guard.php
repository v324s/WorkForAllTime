<?
session_start();
if ($_GET['code']) {
	$code=$_GET['code'];
	setcookie('code',$code);
	header('location: index');
	$vk_app_id = '';  // id вашего приложения
	$vk_app_secret = '';  // секретный ключ вашего приложения

	$url = 'https://oauth.vk.com/access_token?client_id='.$vk_app_id.'&client_secret='.$vk_app_secret.'&code='.$code.'&redirect_uri=http://localhost/';
	$result = file_get_contents($url);
	$result = json_decode($result, true);
	$access_token = $result['access_token'];
	$user_id = $result['user_id'];
	setcookie('acctoken',$access_token);
	setcookie('user_id',$user_id);
	$_SESSION['user_id']=$user_id;
	$_SESSION['acctoken']=$access_token;
}
if ($_COOKIE['code'] && $_COOKIE['acctoken'] && $_COOKIE['user_id']) {
	$sess_login=$_COOKIE['code'];
	$sess_pass=$_COOKIE['acctoken'];
	$sess_id=$_COOKIE['user_id'];
	if ($_SESSION['user_id']!=$sess_id) {
		setcookie('acctoken','');
		setcookie('code','');
		setcookie('user_id','');
		session_regenerate_id();
		header('location:index');
	}
	if ($_SESSION['acctoken']!=$sess_pass) {
		setcookie('acctoken','');
		setcookie('code','');
		setcookie('user_id','');
		session_regenerate_id();
		header('location:index');
	}
	$url='https://api.vk.com/method/users.get?user_ids='.$sess_id.'&name_case=nom&fields=first_name,last_name,bdate,country,crop_photo,city,counters,domain,followers_count&v=5.80&access_token='.$sess_pass;
	$result = file_get_contents($url);
	$result = json_decode($result, true);
	$us_img=$result['response']['0']['crop_photo']['photo']['sizes']['2']['url'];
	$us_imya=$result['response']['0']['first_name'];
	$us_fama=$result['response']['0']['last_name'];
	$us_dr=$result['response']['0']['bdate'];

	$sess_img=$us_img;
	$userlogined=true;
	$res=mysqli_query($con,"SELECT * from userskinoteavk where vkid='$sess_id'");
	if (mysqli_num_rows($res)>0) {
		$user=mysqli_fetch_array($res);
		$actionlogin='success';
	}else{
	/*
	if ($user['vkid']!=$sess_login) {*/
		$regdate=date('d.m.Y');
		$time=date('H')+1;
		$tim=date('i:s');
		$regtime=$time.':'.$tim;
		$status='active';
		mysqli_query($con,"INSERT into userskinoteavk(vkid,vkname,vkfamil,vkdr,vkimg,reg_date,reg_time,status) values ('$sess_id','$us_imya','$us_fama','$us_dr','$us_img','$regdate','$regtime','$status')");


		$text = $regdate." (".$regtime.")||Регистрация на сайте";
		$fp = fopen("userhis/".$sess_id.".txt", "a");
		fwrite($fp, $text);
		fclose($fp);
		$actionlogin='success';
	}
}
?>