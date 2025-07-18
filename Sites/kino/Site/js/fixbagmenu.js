$("#avaclick").click(function () {
      $("#spisact").slideToggle("slow");
});

open=false;
$("#openminimenu").click(function () {
	if (open==false) {
		open=true;
		$("#openminimenu").css("background","url(img/menu1.png)");
		$("#mmenu").slideToggle("slow");
	}else{
		open=false;
		$("#openminimenu").css("background","url(img/menu.png)");
		$("#mmenu").slideToggle("slow");
	}
});