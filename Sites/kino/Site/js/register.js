$(function($) { 
		$('#tel').mask('+7 (999) 999-99-99');
		
	});

// запрос на регистрацию

function regaymenya() {
	var imya = $('#name').val();
    var familia = $('#famil').val();
    var otchestvo = $('#otch').val();
    var logi = $('#login').val();
    var mail = $('#email').val();
    var telephone = $('#tel').val();
    var passw1 = $('#pass1').val();
    var passw2 = $('#pass2').val();
	if (goodtel==true && goodlogin==true && goodpass==true && imya!='' && familia!='' && otchestvo!='' && logi!='' && mail!='' && telephone!='' && passw1!='' && passw2!='') {
		if (passw1==passw2) {
			var pass=passw1;
			$.ajax({
		        type: "POST",
		        url: "ajax/registeruser.php",
		        data: {
		        	name:imya, 
		       		famil:familia,
		       		otch:otchestvo,
		       		login:logi,
		       		email:mail,
		       		tel:telephone,
		       		pass:pass
		       	},
		       	success: function(response){
		       		window.location.href = 'http://v324s.kl.com.ua/kinotea?act=login';
		       	}
		    });
		}else{
			alert('Введеные пароли не совпадают.');
		}
	}else{
		alert('Заполните все поля.');
	}
}

// проверка логина на занятость

function checklogin() {
	var clogin = $('#login').val();
	$.ajax({
	    type: "POST",
	    url: "ajax/registeruser.php",
   		data: {
  			chlogin:clogin
	   	},
	   	success: function(response){
	   		$('#resultqueryreg').text(response);
	   		if (response=='Логин свободен.') {
	   			$('#resultqueryreg').css('color','green');
	   			$('#login').css('color','green');
	   			goodlogin=true;
	   		}else{
	   			$('#resultqueryreg').css('color','red');
	   			$('#login').css('color','red');
	   			goodlogin=false;
	   		}
	   	}
	 });
}

// проверка телефона на занятость

function checktel() {
	var telep = $('#tel').val();
	$.ajax({
	    type: "POST",
	    url: "ajax/registeruser.php",
	    data: {
	   		telephone:telep
	   	},
	   	success: function(response){
	   		$('#resultqueryreg').text(response);
	   		if (response!='Аккаунт с таким номером телефона уже существует.') {
	   			$('#resultqueryreg').css('color','green');
	   			$('#tel').css('color','white');
	   			goodtel=true;
	   		}else{
	   			$('#resultqueryreg').css('color','red');
  			$('#tel').css('color','red');
  			goodtel=false;
  		}
  	}
});
}

// проверка паролей на схожесть


function checkpass() {
	var password1 = $('#pass1').val();
	var password2 = $('#pass2').val();

	if (password1==password2) {
		$('#pass1').css('color','green');
		$('#pass2').css('color','green');
		$('#resultquerypass').text('');
		goodpass=true;
	}else{
		$('#pass1').css('color','red');
		$('#pass2').css('color','red');
		goodpass=false;
		$('#resultquerypass').text('Новый пароль слишком короткий.');
	}
}