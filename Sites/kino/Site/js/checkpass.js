function checkpass() {
	var password1 = $('#pass1').val();
	var password2 = $('#pass2').val();
	if (password1==password2) {
		$('#pass1').css('color','green');
		$('#pass2').css('color','green');
		goodnpass=true;
	}else{
		$('#pass1').css('color','red');
		$('#pass2').css('color','red');
		goodnpass=false;
	}	
}
function chpass1() {
	var password1=$('#pass1').val();
	if (password1.length>5) {
		goodpass1=true;
		$('#resultquerynpass').text('');
		$('#pass1').css('color','white');
	}else{
		goodpass1=false;
		$('#resultquerynpass').text('Новый пароль слишком короткий.');
		$('#resultquerynpass').css('color','red');
		$('#pass1').css('color','red');
	}
}