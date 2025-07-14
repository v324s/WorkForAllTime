numslidevi=1;
		$("#text_"+numslidevi).css("color","#0EC261");
		if (window.innerWidth>1023) {
			startslider=true;
		}else{
			startslider=false;
		}
		predslide=0;
		slidminone=4;
		teklang='ru';

viewanothersl=false;
perevestilvniz=false;
function scrollbot() {
	  	samiyniz=$('html').height();
	  	window.scrollTo(0, (samiyniz*2));
}
/*
$(window).scroll(function () {
  if ($('html').scrollTop() > (window.innerHeight/5) && perevestilvniz==false) {
  		console.log('vnizu');
	  	perevestilvniz=true;
	  	scrollbot();
  }else if ($('html').scrollTop() < (window.innerHeight/2)) {
  	console.log('naverhu');
  	perevestilvniz=false;
  }
});*/
		function translate() {
			if (teklang=='ru') {
				$('#li1').text("PARKING");				// menu
				$('#li2').text("INSURANCE");				// menu
				$('#li3').text("GASOLINE");				// menu
				$('#li4').text("SERVICE");				// menu
				$('#mlang').text("Рус");					// button language
				$('#lang').text("Рус");						// button language
				$('.z2').text("Car Sharing");				// main block
				$('.z3').text("Car rental by minute"); 		// main block
				$('.fontbutzabr').text("Book now");			// button main
				$('#slide_1').find('.zagolovsl').text("Free parking");			// slide 1
				$('#slide_1').find('.inform').text("Leave your car in paid city parking lots and permitted places without violating traffic rules, as well as at airports.");						// slide 1
				$('#slide_2').find('.zagolovsl').text("Insurance");				// slide 2
				$('#slide_2').find('.inform').text("Full insurance car");		// slide 2
				$('#slide_3').find('.zagolovsl').text("Gasoline");				// slide 3
				$('#slide_3').find('.inform').text("Full tank at any gas station of the city at our expense"); // slide 3
				$('#slide_4').find('.zagolovsl').text("Service");				//slide 4
				$('#slide_4').find('.inform').text("The car undergoes weekly maintenance"); 					//slide 4
				$('#mslide_1').find('.zagolovsl').text("Free parking");			// slide 1
				$('#mslide_1').find('.inform').text("Leave your car in paid city parking lots and permitted places without violating traffic rules, as well as at airports.");						// slide 1
				$('#mslide_2').find('.zagolovsl').text("Insurance");				// slide 2
				$('#mslide_2').find('.inform').text("Full insurance car");		// slide 2
				$('#mslide_3').find('.zagolovsl').text("Gasoline");				// slide 3
				$('#mslide_3').find('.inform').text("Full tank at any gas station of the city at our expense"); // slide 3
				$('#mslide_4').find('.zagolovsl').text("Service");				//slide 4
				$('#mslide_4').find('.inform').text("The car undergoes weekly maintenance"); 					//slide 4
				$('.city').text("Ulyanovsk");				// position
				$('#butpodrob_1').children('.fontbutzabr').text("More details");		// button slide 1
				$('#butpodrob_2').children('.fontbutzabr').text("More details");		// button slide 2
				$('#butpodrob_3').children('.fontbutzabr').text("More details");		// button slide 3
				$('#butpodrob_4').children('.fontbutzabr').text("More details");		// button slide 4
				teklang='en';
			}else{
				$('#li1').text("ПАРКОВКА");
				$('#li2').text("СТРАХОВКА");
				$('#li3').text("БЕНЗИН");
				$('#li4').text("ОБСЛУЖИВАНИЕ");
				$('#mlang').text("Eng");
				$('#lang').text("Eng");
				$('.z2').text("Каршеринг");
				$('.z3').text("Поминутная аренда автомобилей");
				$('.fontbutzabr').text("Забронировать");
				$('#slide_1').find('.zagolovsl').text("Бесплатная парковка");
				$('#slide_1').find('.inform').text("Оставляйте машину на платных городских парковках и разрешенных местах, не нарушая ПДД, а также в аэропортах.");
				$('#slide_2').find('.zagolovsl').text("Страховка");
				$('#slide_2').find('.inform').text("Полная страховка страховка автомобиля");
				$('#slide_3').find('.zagolovsl').text("Бензин");
				$('#slide_3').find('.inform').text("Полный бак на любой заправке города за наш счёт");	
				$('#slide_4').find('.zagolovsl').text("Обслуживание");
				$('#slide_4').find('.inform').text("Автомобиль проходит еженедельное ТО");
				$('#mslide_1').find('.zagolovsl').text("Бесплатная парковка");
				$('#mslide_1').find('.inform').text("Оставляйте машину на платных городских парковках и разрешенных местах, не нарушая ПДД, а также в аэропортах.");
				$('#mslide_2').find('.zagolovsl').text("Страховка");
				$('#mslide_2').find('.inform').text("Полная страховка страховка автомобиля");
				$('#mslide_3').find('.zagolovsl').text("Бензин");
				$('#mslide_3').find('.inform').text("Полный бак на любой заправке города за наш счёт");	
				$('#mslide_4').find('.zagolovsl').text("Обслуживание");
				$('#mslide_4').find('.inform').text("Автомобиль проходит еженедельное ТО");
				$('.city').text("Ульяновск");
				$('#butpodrob_1').children('.fontbutzabr').text("Подробнее");
				$('#butpodrob_2').children('.fontbutzabr').text("Подробнее");
				$('#butpodrob_3').children('.fontbutzabr').text("Подробнее");
				$('#butpodrob_4').children('.fontbutzabr').text("Подробнее");
				teklang='ru';
			}
		}

		function openslide(numslide) {
			window.location.hash = "#yakorsl_"+numslide;
			startslider=false;
			if (numslide!=numslidevi){
	    		$("#li"+numslidevi).css("color","#FFFFFF");
	    		$("#gs_"+numslidevi).removeClass("dotact");
				$('#slide_'+numslidevi).css('display','none');
			}
			$("#li"+numslide).css("color","#0EC261");
    		$('#slide_'+numslidevi).css('z-index','0');
			/*$('#slide_'+numslidevi).css('z-index','0');
    		$("#gs_"+numslidevi).removeClass("dotact");
    		$("#text_"+numslidevi).css("color","#FFFFFF");
    		$("#text_"+numslidevi).css("color","#0EC261");*/
    		$("#gs_"+numslide).addClass("dotact");
    		$('#slide_'+numslide).css('z-index','1');
    		$('#slide_'+numslide).show("slide", { direction: "right" }, 500);
    		numslidevi=numslide;
    		$('#menu').hide(300);
		}

		function previslide() {
		  if (numslidevi>0) {
		  	if (numslidevi==1) {
		  		if ($('#next').css('background')=='#0ec2612b') {
		  			nextgreen=true;
		  		}else{
		  			previgreen=true;
		  		}
		  	}
		  	if (predslide && predslide!=numslidevi) {
				$('#slide_'+slidminone).css('display','block');
		  	}
    		$('#slide_'+numslidevi).hide("slide", { direction: "right" }, 500);

    		$("#gs_"+numslidevi).removeClass("dotact");
    		$("#text_"+numslidevi).css("color","#FFFFFF");
    		$("#text_"+slidminone).css("color","#0EC261");
    		$("#gs_"+slidminone).addClass("dotact");
		  	if (numslidevi==1) {
    			predslide=numslidevi;
    			numslidevi=4;
    			slidminone=3;
    		}else{
    			predslide=numslidevi;
    			numslidevi--;
    			slidminone=numslidevi-1;
    			if (numslidevi==1) {
	    			slidminone=4;
	    		}
    		}
    		if (numslidevi>1) {
    			$('#previ').css('background','none');
    			$('#next').css('background','none');
    		}else{
    			
    				$('#next').css('background','#0ec2612b');
    			/* if (previgreen) {
					$('#previ').css('background','#0ec2612b');
    			}*/
    		}
    		/*$('#slide_'+slidminone).css('z-index','0');
    		
    		$('#slide_'+numslidevi).css('z-index','1');
    		$('#slide_'+numslidevi).hide("slide", { direction: "right" }, 500);
    		$('#slide_'+numslidevi).css('z-index','0');
    		$('#slide_'+slidminone).css('z-index','1');*/
    		$('#slide_'+numslidevi).css('z-index','0');
    		$('#slide_'+slidminone).css('z-index','1');
		  }
		}
		function nextslide() {
		  if (numslidevi<5) {
		  	if (numslidevi==1) {
		  		if ($('#next').css('background')=='#0ec2612b') {
		  			nextgreen=true;
		  		}else{
		  			previgreen=true;
		  		}
		  	}
		  	if (predslide && predslide!=numslidevi) {
				$('#slide_'+predslide).css('display','none');
		  	}
		  	if (numslidevi==4) {
    			predslide=numslidevi;
    			numslidevi=1;
    			slidminone=4;
    		}else{
    			predslide=numslidevi;
    			numslidevi++;
    			slidminone=numslidevi-1;
    		}
    		if (numslidevi>1) {
    			$('#previ').css('background','none');
    			$('#next').css('background','none');
    		}else{
    				$('#next').css('background','#0ec2612b');
    			/*if (previgreen) {
					$('#previ').css('background','#0ec2612b');
    			}*/
    		}
    		$('#slide_'+predslide).css('z-index','0');
    		$("#gs_"+predslide).removeClass("dotact");
    		$("#text_"+predslide).css("color","#FFFFFF");
    		$("#text_"+numslidevi).css("color","#0EC261");
    		$("#gs_"+numslidevi).addClass("dotact");
    		$('#slide_'+numslidevi).css('z-index','1');
    		$('#slide_'+numslidevi).show("slide", { direction: "right" }, 500);
		  }
		}
		nextgreen=false;
		previgreen=false;
		function slider() {
			
		  if (numslidevi<5 && startslider) {
		  	if (window.innerWidth>1023) {
				startslider=true;
			}else{
				startslider=false;
			}
		  	if (numslidevi==1) {
		  		if ($('#next').css('background')=='#0ec2612b') {
		  			nextgreen=true;
		  		}else{
		  			previgreen=true;
		  		}
		  	}
		  	if (predslide) {
				$('#slide_'+predslide).css('display','none');
		  	}
		  	if (numslidevi==4) {
    			predslide=numslidevi;
    			numslidevi=1;
    			slidminone=4;
    		}else{
    			predslide=numslidevi;
    			numslidevi++;
    			slidminone=numslidevi-1;
    		}
    		if (numslidevi>1) {
    				$('#previ').css('background','none');
    				$('#next').css('background','none');
    		}else{
    				$('#next').css('background','#0ec2612b');
    			/*if (previgreen) {
					$('#previ').css('background','#0ec2612b');
    			}*/
    		}
    		$('#slide_'+predslide).css('z-index','0');
    		$("#gs_"+predslide).removeClass("dotact");
    		$("#text_"+predslide).css("color","#FFFFFF");
    		$("#text_"+numslidevi).css("color","#0EC261");
    		$("#gs_"+numslidevi).addClass("dotact");
    		$('#slide_'+numslidevi).css('z-index','1');
    		$('#slide_'+numslidevi).show("slide", { direction: "right" }, 500);
		  }
		}
		setInterval(slider, 5000);

		$('#next').click(function () {
			nextslide();
			startslider=false;
		});
		$('#closemenu').click(function () {
			$('#menu').hide(300);
		});
		$('#lang').click(function () {
			translate();
		});
		$('#mlang').click(function () {
			translate();
		});
		$('#mobmenu').click(function () {
			$('#menu').show(300);
		});
		$('#menu_btn').click(function () {
			$('#menu').show(300);
		});
		$('#previ').click(function () {
			previslide();
			startslider=false;
		});