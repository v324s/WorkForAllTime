info_glav=false;
		info_brends=false;
		info_team=false;
		info_onas=false;
		info_conts=false;
		revers=false;
		marginleft=0;
		function slidr() {
			if (goslide) {
				if (revers==false && marginleft-marginleft-marginleft<($("#dor").innerWidth())*11/1.2) {
					marginleft-=1;
					$("#sliderbrand").css('margin-left',marginleft);
				}else{
					revers=true;
					if (revers==true && marginleft<(($("#dor").innerWidth())*11)-($("#dor").innerWidth())*11/1.2) {
						marginleft+=1;
						$("#sliderbrand").css('margin-left',marginleft);
					}else{
						revers=false;
					}
				}
			}
		}
		function slider() {
			if (goslide){
				setInterval(slidr,10);
			}
		}
		
		glav3_4=($("#slide_1").innerHeight())-($("#slide_1").innerHeight()/2);
		glbrend=($("#slide_1").innerHeight())+($("#slide_2").innerHeight())-($("#slide_2").innerHeight()/7);
		glbrona=($("#slide_1").innerHeight())+($("#slide_2").innerHeight())+($("#slide_3").innerHeight())-($("#slide_3").innerHeight()/2);
		glbronkont=($("#slide_1").innerHeight())+($("#slide_2").innerHeight())+($("#slide_3").innerHeight())+($("#slide_4").innerHeight())-($("#slide_4").innerHeight()/5);
		viewmap=false;
		$('#openmap').click(function () {
			if (!viewmap){
				$('#framemap').show();
				$('#map').show();
				$('#openmap').text('закрыть карту');
				viewmap=true;
			}else{
				$('#framemap').hide();
				$('#map').hide();
				$('#openmap').text('смотреть на карте');
				viewmap=false;
			}
		});
		$('#sliderbrand').click(function () {
			if (goslide){
				goslide=false;
			}else{
				goslide=true;
			}
		});
		$(window).on("scroll", function() {
			/*if ($(window).scrollTop() >0) {
				$('#shapkamenu').css('background','#00000077');
			}else{
				$('#shapkamenu').css('background','none');
			}*/
			if (info_glav==false && $(window).scrollTop() >=0 && $(window).scrollTop() < glav3_4) {
	    		info_glav=true;
	    		info_brends=false;
				info_team=false;
				info_onas=false;
				info_conts=false;
	    		$('#navbtn_glav').css('border-bottom','2px solid');
	    		$('#navbtn_brends').css('border-bottom','none');
	    		$('#navbtn_team').css('border-bottom','none');
	    		$('#navbtn_onas').css('border-bottom','none');
	    		$('#navbtn_conts').css('border-bottom','none');
	    	}
	    	if (info_brends==false && $(window).scrollTop() > glav3_4) {
	    		info_glav=false;
	    		info_brends=true;
				info_team=false;
				info_onas=false;
				info_conts=false;
	    		$('#navbtn_glav').css('border-bottom','none');
	    		$('#navbtn_brends').css('border-bottom','2px solid');
	    		$('#navbtn_team').css('border-bottom','none');
	    		$('#navbtn_onas').css('border-bottom','none');
	    		$('#navbtn_conts').css('border-bottom','none');
	    	}
	    	if (info_team==false && $(window).scrollTop() > glbrend) {
	    		info_glav=false;
	    		info_brends=false;
				info_team=true;
				info_onas=false;
				info_conts=false;
	    		$('#navbtn_glav').css('border-bottom','none');
	    		$('#navbtn_brends').css('border-bottom','none');
	    		$('#navbtn_team').css('border-bottom','2px solid');
	    		$('#navbtn_onas').css('border-bottom','none');
	    		$('#navbtn_conts').css('border-bottom','none');
	    	}
	    	if (info_onas==false && $(window).scrollTop() > glbrona) {
	    		info_glav=false;
	    		info_brends=false;
				info_team=false;
				info_onas=true;
				info_conts=false;
	    		$('#navbtn_glav').css('border-bottom','none');
	    		$('#navbtn_brends').css('border-bottom','none');
	    		$('#navbtn_team').css('border-bottom','none');
	    		$('#navbtn_onas').css('border-bottom','2px solid');
	    		$('#navbtn_conts').css('border-bottom','none');
	    	}
	    	if (info_conts==false && $(window).scrollTop() > glbronkont) {
	    		info_glav=false;
	    		info_brends=false;
				info_team=false;
				info_onas=false;
				info_conts=true;
	    		$('#navbtn_glav').css('border-bottom','none');
	    		$('#navbtn_brends').css('border-bottom','none');
	    		$('#navbtn_team').css('border-bottom','none');
	    		$('#navbtn_onas').css('border-bottom','none');
	    		$('#navbtn_conts').css('border-bottom','2px solid');
	    	}
	    });

window.scroolnizhe = (function () {
  var timer, start, factor;
  
  return function (target, duration) {
    var offset = window.pageYOffset,
        delta  = target - window.pageYOffset; // Y-offset difference
    duration = duration || 1000;              // default 1 sec animation
    start = Date.now();                       // get start time
    factor = 0;
    
    if( timer ) {
      clearInterval(timer); // stop any running animations
    }
    
    function step() {
      var y;
      factor = (Date.now() - start) / duration; // get interpolation factor
      if( factor >= 1 ) {
        clearInterval(timer); // stop animation
        factor = 1;           // clip to max 1.0
      } 
      y = factor * delta + offset;
      window.scrollBy(0, y - window.pageYOffset);
    }
    
    timer = setInterval(step, 10);
    return timer;
  };
}());