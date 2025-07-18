function checkstarpass() {
	var chpass = $('#spass').val();
	$.ajax({
	    type: "POST",
	    url: "newpass.php",
   		data: {
  			chpass:chpass
	   	},
	   	success: function(response){
	   		$('#resultquerynpass').text(response);
	   		if (response=='Пароль верный.') {
	   			$('#resultquerynpass').css('color','green');
	   			$('#spass').css('color','green');
	   			goodstarpass=true;
	   		}else{
	   			$('#resultquerynpass').css('color','red');
	   			$('#spass').css('color','red');
	   			goodstarpass=false;
	   		}
	   	}
	 });
}

function savenewpass() {
	var spass = $('#spass').val();
	var npass1 = $('#pass1').val();
	var npass2 = $('#pass2').val();
	if (goodstarpass==true && goodnpass==true && goodpass1==true) {
		$.ajax({
		    type: "POST",
		    url: "newpass.php",
	   		data: {
	  			npass1:npass1,
	  			npass2:npass2
		   	},
		   	success: function(response){
		   		$('#resultquerynpass').text(response);
		   		if (response=='Пароль успешно изменен.') {
		   			$('#resultquerynpass').css('color','green');
		   			setTimeout(function(){
							window.location.href = 'http://v324s.kl.com.ua/kinotea/profile';
						}, 1 * 1000);
		   		}else{
		   			$('#resultquerynpass').css('color','red');
		   		}
		   	}
		 });
	}
}