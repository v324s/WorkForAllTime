$( document ).ready(function(){
	  $("#hoversett").hover(function(){ 
	    	$("#settitle").css("color", "red");
	    }, function(){ 	
		    $("#settitle").css("color", "white");
	  });
	  $("#hoverseans").hover(function(){ 
	    	$("#seanstitle").css("color", "red");
	    }, function(){ 	
		    $("#seanstitle").css("color", "white");
	  });
	  $("#hoverhist").hover(function(){ 
	    	$("#histtitle").css("color", "red");
	    }, function(){ 	
		    $("#histtitle").css("color", "white");
	  });
	});