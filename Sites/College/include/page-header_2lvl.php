	<header class="shapka">
			<div class="shapka-padding">
				<main class="shapka_forlogo">
					<a href="../../index.php"><div class="shapka_logo"></div></a>
				</main>
				<nav class="shapka_nav">
					<ul class="shapka_nav_ul">
						<li class="shapka_nav_ul_li" id="head-m-1">
							<a href="../../index.php" class="mainMenu_li_a">Главная</a>
							<div class="mainMenu_li_div" id="head-notvisible-1">
								<ul>
									<li class="hidden-menu-li">
										<a href="../../news.php">Новости</a>
									</li>
									<li class="hidden-menu-li">
										<a href="../../adv.php">Объявления</a>
									</li>
								</ul>
							</div>
						</li>
						<li class="shapka_nav_ul_li" id="head-m-2">
							<a href="../../sveden" class="mainMenu_li_a">Сведения об организации</a>
							<div class="mainMenu_li_div" id="head-notvisible-2">
								<ul>
									<li class="hidden-menu-li">
										<a href="">Основные сведения</a>
									</li>
									<li class="hidden-menu-li">
										<a href="">Документы</a>
									</li>
									<li class="hidden-menu-li">
										<a href="">Образование и образовательные программы</a>
									</li>
									<li class="hidden-menu-li">
										<a href="">Руководство и педагогический состав</a>
									</li>
									<li class="hidden-menu-li">
										<a href="">Контакты</a>
									</li>
								</ul>
							</div>
						</li>
					</ul>
					<svg id="big-menu" class="forsvgico" viewBox="0 0 17 14" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M16 1H1V3.5H16V1Z" class="forsvgico-el" />
						<path d="M16 6H1V8.5H16V6Z" class="forsvgico-el"/>
						<path d="M16 11H1V13.5H16V11Z" class="forsvgico-el"/>
					</svg>
					<script type="text/javascript">
						$("#head-m-1").hover(function () {
							$("#head-m-1").children('#head-notvisible-1').css( 'visibility', 'visible' );
							$("#head-m-1").children('#head-notvisible-1').css( 'opacity', '1' );
						}, function () {
							$("#head-m-1").children('#head-notvisible-1').css( 'visibility', 'hidden' );
							$("#head-m-1").children('#head-notvisible-1').css( 'opacity', '0' );
						});
						$("#head-m-2").hover(function () {
							$("#head-m-2").children('#head-notvisible-2').css( 'visibility', 'visible' );
							$("#head-m-2").children('#head-notvisible-2').css( 'opacity', '1' );
						}, function () {
							$("#head-m-2").children('#head-notvisible-2').css( 'visibility', 'hidden' );
							$("#head-m-2").children('#head-notvisible-2').css( 'opacity', '0' );
						});


						$(function() {
							 let header = $('.shapka');

							 $(window).scroll(function() {
							   if($(this).scrollTop() > 1) {
							    header.addClass('header_fixed');
							    $('#kostil-for-header').css('height','90px');
							   } else {
							    $('#kostil-for-header').css('height','0px');
							    header.removeClass('header_fixed');
							   }
							 });
							});

						bigmenu=false;
						$('#big-menu').click(function () {
							if (!bigmenu) {
								bigmenu=true;
								$('body').css('overflow','hidden');
								$('.bg-for-big-menu').show();
								$('.big-menu').show();
							}else{
								bigmenu=false;
								$('.body').css('overflow','auto');
								$('.bg-for-big-menu').hide();
								$('.big-menu').hide();
							}
						})
					</script>
				</nav>
			</div>
		</header>