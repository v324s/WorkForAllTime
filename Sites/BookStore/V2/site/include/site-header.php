<header class="mainhead">
		<div class="podinfohead">
			<a href="index">
			<div class="headinfo">
				<div class="headico" style="width:100%"></div>
				<div class="zagalovkihead" style="display:none"><h1>Dream Library</h1>
					 <h2>Книжный интернет-магазин</h2>
				</div>
			</a>
			</div><div class="menulist">
					<a href="katalog">
					<div class="itemmenu">
						<div class="icoknigi"></div>
						<p>Каталог</p>
					</div>
					</a>
					<a href="info">
					<div class="itemmenu" onclick="window.location.href='info';">
						<div class="icoinfo"></div>
						<p>О нас</p>
					</div>
					</a>
					<a href="korzina">
					<div class="itemmenu" onclick="window.location.href='korzina';">
						<div class="icokorz">
							<div class="counttovinkorz"><? if ($cartCount) {echo $cartCount;} else {echo '0';} ?></div>
						</div>
						<p>Корзина</p>
					</div>
					</a>
					<a href="korzina?get=favorite">
					<div class="itemmenu" onclick="window.location.href='korzina?get=favorite';">
						<div class="icoFavorites">
							<div class="counttovinkorz"><? if ($favoritesCount) {echo $favoritesCount;} else {echo '0';} ?></div>
						</div>
						<p>Желаемое</p>
					</div>
					</a>
					<a href="profile">
					<div class="itemmenu" onclick="window.location.href='profile';">
						<div class="icoprofile"></div>
						<p>Профиль</p>
					</div>
					</a>
			</div>
		</div>
</header>
