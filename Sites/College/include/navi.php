<?
define("op", '<i class="fa fa-angle-right" aria-hidden="true"></i>');
?>

<section class="sp-title">
	<div class="sp-title_container">
		<p class="sp-title_p">
			<span><strong>Навигация</strong></span><br><br>
			<span>
				<strong>
					<?

if ($location) {
	if (strpos($location, '/')) {
		$arrloc=explode("/", $location);
		$dotslink=count($arrloc);
		for ($i=0; $i < $dotslink; $i++) {
			checkCase($arrloc[$i],1,$dotslink-$i);
		}
		//foreach ($arrloc as $key) {
		//	echo $key;
		//	checkCase($arrloc[$key],1,$dotslink-$key);
			/*switch ($arrloc[$key]) {
				case 'index':
					/*echo '<a class="footer-a" href="';
					for ($i=0; $i < $arrloc-$key; $i++) {
						echo "../";
					}
					echo 'index.php">Главная</a>'.op;*/
					/*genLink("index.php","Главная",$arrloc-$key);
					break;
				case 'sveden':
					genLink("index.php","Сведения об организации",$arrloc-$key);
					break;
			}*/
		//}
	}else{
		checkCase($location,1);
	}
}
if ($tekpos) {
	checkCase($tekpos,0);
}
					?>
			<!--		<a class="footer-a" href="../../index.php">Главная</a>

					<a class="footer-a" href="../index.php">Сведения об организации</a>

					Документы -->
				</strong>
			</span>
		</p>
	</div>
</section>

<?
function checkCase($val,$genlink,$offset=null)
{
	switch ($val) {
		case 'index':
			if ($genlink==1) {
				genLink("index.php","Главная",$offset);
			}else{
				echo "Главная";
			};
			break;
		case 'sveden':
			if ($genlink==1) {
				genLink("index.php","Сведения об организации",$offset);
			}else{
				echo "Сведения об организации";
			};
			break;
		case 'docs':
			if ($genlink==1) {
				genLink("index.php","Документы",$offset);
			}else{
				echo "Документы";
			};
			break;
	}
}

function genLink($src,$name,$offset)
{
	echo ' <a class="footer-a" href="';
	for ($i=0; $i < $offset; $i++) {
		echo "../";
	}
	echo $src.'">'.$name.'</a> '.op.' ';
}
?>