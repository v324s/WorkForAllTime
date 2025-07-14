<?
// function cartStatus() {
// 	$cart="";
// 	if (@$_COOKIE['cart']) { $cart=$_COOKIE['cart'];}
// 	if (@$_GET['addtocart']) {
// 		if (!@$_COOKIE['cart']) {
// 			$cart=$_GET['addtocart'];
// 		} else {
// 			$cart=$cart."|".$_GET['addtocart'];
// 		}
// 		setcookie("cart","$cart");
// 	}
// 	if (@$_GET['clear']) {
// 		setcookie("cart","");
// 		$cart="";
// 	}
// 	if ($cart=="") { $cartCount="0"; }
// 	else {
// 		$cartArr=explode("|",$cart);
// 		$cartCount=count($cartArr);
// 	}
// 	return $cartCount;
// }
// $cartCount=cartStatus();

// echo explode('?', $_SERVER['REQUEST_URI'])[0].'?book='.$_GET['book'];
function checkActionWithCart() {
	global $conn;
	if ($_GET['removefromfav']>-1 && isset($_SESSION['user_id'])) {
		$uid = $_SESSION['user_id'];
		$fav = favoriteGet();
		unset($fav[$_GET['removefromfav']]);

		if (count($fav)>0) {
			$newfav = json_encode($fav);
			$res = mysqli_query($conn, "UPDATE `users` SET favorite='$newfav' WHERE id='$uid'");
		}else{
			favoriteClear();
		}

		header('Location: '.explode('?', $_SERVER['REQUEST_URI'])[0].'?get=favorite');
		
	}
	if ($_GET['removefromcart']>-1 && isset($_SESSION['user_id'])) {
		$uid = $_SESSION['user_id'];
		$cart = cartGet();
		unset($cart[$_GET['removefromcart']]);

		if (count($cart)>0) {
			$newCart = json_encode($cart);
			$res = mysqli_query($conn, "UPDATE `users` SET cart='$newCart' WHERE id='$uid'");
		}else{
			cartClear();
		}

		header('Location: '.explode('?', $_SERVER['REQUEST_URI'])[0]);
		
	}
	if ($_GET['addtocart'] && isset($_SESSION['user_id'])) {
		$uid = $_SESSION['user_id'];
		$result = mysqli_query($conn, "SELECT cart FROM users WHERE id='$uid'");
		$row = mysqli_fetch_assoc($result);
		$cart = json_decode($row['cart'], true);

		if (!is_array($cart)) {
			$cart = [];
		}
		$cart[] = intval($_GET['addtocart']);
		$cart_json = json_encode($cart);
		$res = mysqli_query($conn, "UPDATE `users` SET cart='$cart_json' WHERE id='$uid'");

		if ($_GET['book']) {
			header('Location: '.explode('?', $_SERVER['REQUEST_URI'])[0].'?book='.$_GET['book']);
		}else{
			header('Location: '.explode('?', $_SERVER['REQUEST_URI'])[0]);
		}
		
	}elseif ($_GET['addtocart'] && !isset($_SESSION['user_id'])) {
		header('Location: profile');
	}
	if ($_GET['addtofav'] && isset($_SESSION['user_id'])) {
		// header('Location: inf?book='.$_GET['book']);
		
		$uid = $_SESSION['user_id'];
		$result = mysqli_query($conn, "SELECT `favorite` FROM users WHERE id='$uid'");
		$row = mysqli_fetch_assoc($result);
		$favorite = json_decode($row['favorite'], true);

		if (!is_array($favorite)) {
			$favorite = [];
		}
		$favorite[] = intval($_GET['addtofav']);
		$favorite_json = json_encode($favorite);
		$res = mysqli_query($conn, "UPDATE `users` SET favorite='$favorite_json' WHERE id='$uid'");

		if ($_GET['book']) {
			header('Location: '.explode('?', $_SERVER['REQUEST_URI'])[0].'?book='.$_GET['book']);
		}else{
			header('Location: '.explode('?', $_SERVER['REQUEST_URI'])[0]);
		}
	}elseif ($_GET['addtofav'] && !isset($_SESSION['user_id'])) {
		header('Location: profile');
	}
}

function cartClear() {
	global $conn;
	if (isset($_SESSION['user_id'])){
		$uid = $_SESSION['user_id'];
		mysqli_query($conn,"UPDATE `users` SET `cart`=null WHERE id='$uid'");
	}
}
function cartGet() {
	global $conn;
	if (isset($_SESSION['user_id'])){
		$uid = $_SESSION['user_id'];
		$res=mysqli_query($conn,"SELECT `cart` FROM `users` WHERE id='$uid'");
		$row = mysqli_fetch_assoc($res);
		$cartArr = json_decode($row['cart'], true);
	}else{
		$cartArr=[];
	}
	return $cartArr;
}

function favoriteClear() {
	global $conn;
	if (isset($_SESSION['user_id'])){
		$uid = $_SESSION['user_id'];
		mysqli_query($conn,"UPDATE `users` SET `favorite`=null WHERE id='$uid'");
	}
}
function favoriteGet() {
	global $conn;
	if (isset($_SESSION['user_id'])){
		$uid = $_SESSION['user_id'];
		$res=mysqli_query($conn,"SELECT `favorite` FROM `users` WHERE id='$uid'");
		$row = mysqli_fetch_assoc($res);
		$favoriteArr = json_decode($row['favorite'], true);
	}else{
		$favoriteArr=[];
	}
	return $favoriteArr;
}
checkActionWithCart();
$cart=cartGet();
$cartCount=0;
if (cartGet() != null) {
	$cartCount=count(cartGet());
}
$favorites=favoriteGet();
$favoritesCount=0;
if (favoriteGet() != null) {
	$favoritesCount=count(favoriteGet());
}


?>
