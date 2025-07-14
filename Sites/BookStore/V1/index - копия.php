<?
	include 'include/settings.php';
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link href="fonts/css.css" rel="stylesheet">
	<title>Книжный дизайн</title>
	<style type="text/css">
		html,body{
			margin: 0;
			padding: 0;
			font-family: 'Roboto', sans-serif;
			overflow-x: hidden;

		}
		body{
			height: 100vh;
		}
		.mainhead{
			background-color: black;
			color: white;
		}
		.headico{
			    width: 80px;
    		min-height: 70px;
			height: 100%;
			background-image:url(img/ico/ico_white.png);
			background-size: contain;
			background-position: center;
			background-repeat: no-repeat;
			display: inline-block;
		}
		.icoinfo, .icokorz, .icoknigi{
			width: 50px;
			height: 50px;
			background-size: cover;
			background-position: center;
			background-repeat: no-repeat;
			display: inline-block;
		}
		.icokorz{
			background-image:url(img/ico/wshopping_cart_PNG38.png);
		}
		.icoinfo{
			background-image:url(img/ico/winformation.png);
		}
		.icoknigi{
			background-image:url(img/ico/wbooks.png);
		}
		.headinfo{
			text-align: center;
			height: 100%;
			width: 30%;
			display: inline-block;
		}
		h1,h2, p{
			margin: 0;
		}
		h2{    color: #ff0303;
			    font-size: 20px;
		}
		.zagalovkihead{
			vertical-align: top;
			display: inline-block;
		}
		.podinfohead{
			width: 98%;
			height: 100%;
			padding: 1%;
		}
		.menulist{    
			margin-left: 1.5%;
    margin-right: 1.5%;
			width: 67%;
			display: inline-block;
			text-align: right;
		}
		.itemmenu{
			display: inline-block;
			text-align: center;
			margin-left: 20px;
			padding-right: 20px;
		}
		.itemmenu:hover{
			color: #ff0303;
			cursor: pointer;
		}
		.foot{
			position: absolute;
			width: 100%;
			background-color: black;
			bottom: 0;
		}
		.infafoot{
			padding: 1% 0;
			color: white;
			text-align: center;
		}
		.osnovcontent{
			width: 90%;
			margin: 0 auto;
			    height: 100%;
		}
		.textosnovi{
			width: 60%;
			margin: 0 auto;
			    height: 100%;
		}
		.marginbuton{
			width: 100%;
			text-align: center;
			margin-top: 8%;
			    position: absolute;
    left: 0;
    /* height: 5%; */
    right: 0;
    top: 40%;
		}
		#buttongokatal{
			margin: 0 auto;
			background-color: #ff0303;
		    padding: 2% 6%;
		    width: max-content;
		    margin: 0 auto;
		    color: white;
		        letter-spacing: 2px;
    font-size: 20px;
    font-weight: 500;
    border-radius: 10px;
		}
		#buttongokatal:hover{
			cursor: pointer;
			background-color: #d00303;
		}
	</style>
</head>
<body>
	<header class="mainhead">
		<div class="podinfohead">
			<div class="headinfo">
				<div class="headico"></div>
				<div class="zagalovkihead"><h1>"Книжный дизайн"</h1>
					 <h2>Книжный интернет-магазин</h2>
				</div>
			</div><div class="menulist">
					<div class="itemmenu" onclick="window.location.href='katalog';">
						<div class="icoknigi"></div>
						<p>Каталог</p>
					</div>
					<div class="itemmenu" onclick="window.location.href='info';">
						<div class="icoinfo"></div>
						<p>О нас</p>
					</div>
					<div class="itemmenu" onclick="window.location.href='korzina';">
						<div class="icokorz"></div>
						<p>Корзина</p>
					</div>
			</div>
		</div>
	</header>
	<section style="height: 55%;position: relative;">
		<main class="osnovcontent">
			<div class="textosnovi" style="padding-top: 5%">
				<center><h3>Книжный интернет-магазин «Книжный дизайн»</h3></center>
				<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;«Книжный дизайн» – крупный интернет-магазин книг, успешно работающий в Димитровграде и других регионах России. В нём вы можете заказывать книги в любое время 24 часа в сутки.<br>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;В интернет-магазине «Книжный дизайн» вы найдёте книги на любой вкус, для этого мы сделали удобный каталог, тематические подборки и специальные акции.
	Уверены, вам понравится наш книжный интернет-магазин. Добро пожаловать!</p>
				<div class="marginbuton">
					<div id="buttongokatal">Перейти к каталогу</div>
				</div>
			</div>
		</main>
	</section>
	<footer class="foot">
		<div class="infafoot">
			Димитровградский Технический Колледж<br>
			Курсовой проект<br>
			© Биисова Р. Р., 2020
		</div>
	</footer>
</body>
</html>