function podrob(id) {
	filmid=$('#'+id).attr('id');
	document.getElementById('poverhvseh').style.display='block';
	document.getElementById('poverhvseh').style.overflowY='auto';
	document.getElementById('body').style.overflowY='hidden';
	$.ajax({
	    type: "POST",
	    url: "ajax/getfilminfo.php",
   		data: {
  			inffilm:filmid
	   	},
	   	beforeSend: function () {
	   		document.getElementById('resultsquery').style.color="white";
			document.getElementById('resultsquery').innerHTML='Загрузка...';
					   	},
	   	success: function(response){
	   		document.getElementById('resultsquery').innerHTML=response;
	   	}
	 });
}
function podrobnee(id) {
	filmid=$('#'+id).attr('id');
	document.getElementById('poverhvseh').style.display='block';
	document.getElementById('poverhvseh').style.overflowY='auto';
	document.getElementById('body').style.overflowY='hidden';
	filmidd=$('#'+id).attr('filmaida');
	$.ajax({
	    type: "POST",
	    url: "ajax/getfilminfo.php",
   		data: {
  			inffilm:filmidd
	   	},
	   	beforeSend: function () {
	   		document.getElementById('resultsquery').style.color="white";
			document.getElementById('resultsquery').innerHTML='Загрузка...';
					   	},
	   	success: function(response){
	   		document.getElementById('resultsquery').innerHTML=response;
	   	}
	 });
}
function podrobneeava(id) {
	filmid=$('#'+id).attr('id');
	document.getElementById('poverhvseh').style.display='block';
	document.getElementById('poverhvseh').style.overflowY='auto';
	document.getElementById('body').style.overflowY='hidden';
	filmidd=$('#'+id).attr('filmaida');
	$.ajax({
	    type: "POST",
	    url: "ajax/getfilminfo.php",
   		data: {
  			inffilm:filmidd
	   	},
	   	beforeSend: function () {
	   		document.getElementById('resultsquery').style.color="white";
			document.getElementById('resultsquery').innerHTML='Загрузка...';
					   	},
	   	success: function(response){
	   		document.getElementById('resultsquery').innerHTML=response;
	   	}
	 });
}

function buytick(id) {
	filmid=$('#'+id).attr('id');
	document.getElementById('poverhvseh').style.display='block';
	document.getElementById('poverhvseh').style.overflowY='auto';
	document.getElementById('body').style.overflowY='hidden';
	$.ajax({
	    type: "POST",
	    url: "ajax/getfilminfo.php",
   		data: {
  			buytifilm:filmid
	   	},
	   	beforeSend: function () {
	   		document.getElementById('resultsquery').style.color="white";
			document.getElementById('resultsquery').innerHTML='Загрузка...';
					   	},
	   	success: function(response){
	   		document.getElementById('resultsquery').innerHTML=response;
	   	}
	 });
}
function buytickininfo(id) {
	filmid=$('#'+id).attr('kiid');
	$.ajax({
	    type: "POST",
	    url: "ajax/getfilminfo.php",
   		data: {
  			buyfilminf:filmid
	   	},
	   	success: function(response){
	   		document.getElementById('blockbuyticket').innerHTML=response;
	   		var poverhvseh = document.getElementById("poverhvseh");
		  	poverhvseh.scrollTop = poverhvseh.scrollHeight;
	   	}
	 });
}
function bronmesta(id) {
	if (mesta!='') {
		idfilm=$('#'+id).attr('id');
		hsmesto=mesta;
		$.ajax({
	    type: "POST",
	    url: "ajax/getfilminfo.php",
   		data: {
  			idfilm:idfilm,
  			seltime:filmtime,
  			hsmesto:hsmesto
	   	},
	   	success: function(response){
	   		document.getElementById('blockbuyticket').innerHTML=response;
	   		var poverhvseh = document.getElementById("poverhvseh");
		  	poverhvseh.scrollTop = poverhvseh.scrollHeight;
	   	}
	 	});
	}else{
		alert('Выберите место');
	}
}
function podtverzhdenie(id) {
	podtime=$('#'+id).attr('sstime');
	podfilm=$('#'+id).attr('filmec');
	podmesto=$('#'+id).attr('zabmesto');
	$.ajax({
	    type: "POST",
	    url: "ajax/getfilminfo.php",
   		data: {
  			podtime:podtime,
  			podfilm:podfilm,
  			podmesto:podmesto
	   	},
	   	success: function(response){
	   		document.getElementById('blockbuyticket').innerHTML=response;
	   		var poverhvseh = document.getElementById("poverhvseh");
		  	poverhvseh.scrollTop = poverhvseh.scrollHeight;
	   	}
	 });
}
function afisettimefilm(id) {
	mesta=[];
	document.getElementById('poverhvseh').style.display='block';
	document.getElementById('poverhvseh').style.overflowY='auto';
	document.getElementById('body').style.overflowY='hidden';
	afilmtime=$('#'+id).attr('time');
	afilmidd=$('#'+id).attr('kid');
	$.ajax({
	    type: "POST",
	    url: "ajax/getfilminfo.php",
   		data: {
  			afishafilmid:afilmidd,
  			afishafilmtime:afilmtime
	   	},
	   		beforeSend: function () {
	   		document.getElementById('resultsquery').style.color="white";
			document.getElementById('resultsquery').innerHTML='Загрузка...';
					   	},
	   	success: function(response){
	   		document.getElementById('resultsquery').innerHTML=response;
	   	}
	 });
}
function settimefilm(id) {
	mesta=[];
	filmtime=$('#'+id).attr('time');
	filmidd=$('#'+id).attr('kid');
	$.ajax({
	    type: "POST",
	    url: "ajax/getfilminfo.php",
   		data: {
  			filmidd:filmidd,
  			filmtime:filmtime
	   	},
	   	success: function(response){
	   		document.getElementById('blockbuyticket').innerHTML=response;
	   		var poverhvseh = document.getElementById("poverhvseh");
		  	poverhvseh.scrollTop = poverhvseh.scrollHeight;
	   	}
	 });
}
var mesto_1;
var mesta=[];
function setmesto(id) {
	mestobilovibrano=false;
	var numstrmas;
	for (var i=0; i < mesta.length; i++) {
		if (mesta[i][0]==id){
			mestobilovibrano=true;
			numstrmas=i;
		}
	}
	if (mestobilovibrano==true) {
		document.getElementById(mesta[numstrmas][0]).style.background='#737373';
		mesta.splice(numstrmas, 1);
	}else{
		if (mesta.length<5) {
			filmtime=$('#'+id).attr('tfilm');
			cemesto=$('#'+id).attr('id');
			filmidd=$('#'+id).attr('kid');
			infamesta=[cemesto,filmidd,filmtime];
			mesta.push(infamesta);
			//$('#'+mesto_1).css('background','#737373');
			document.getElementById(id).style.background='#0594bf';
		}else{
			alert('Вы можете забронировать только не более 5-ти мест на сеанс.');
		}
	}
	/*filmtime=$('#'+id).attr('tfilm');
	cemesto=$('#'+id).attr('id');
	filmidd=$('#'+id).attr('kid');
	if (cemesto==mesto_1){
		document.getElementById(id).style.background='#737373';
		mesto_1='';
	}else{
		document.getElementById(id).style.background='#0594bf';
			mesto_1=cemesto;
			console.log('mesto_1 = '+mesto_1);
	}*/
}
/*function setmesto(id) {
	if (mesto_1) {
		/*$('#ch_'+mesto_1).attr('checked',false);
<input checked="false" type="checkbox" id="ch_'.$mesto.'" style="display:none;">
if (document.getElementById('ch_'+id).checked){
		document.getElementById(id).style.background='#737373';
		mesto_1='';
	}else{
		document.getElementById(id).style.background='#0594bf';
			mesto_1=cemesto;
			console.log('mesto_1 = '+mesto_1);
	}
		*/
		/*$('#'+mesto_1).css('background','#737373');
	}
	
	filmtime=$('#'+id).attr('tfilm');
	cemesto=$('#'+id).attr('id');
	filmidd=$('#'+id).attr('kid');
	if (cemesto==mesto_1){
		document.getElementById(id).style.background='#737373';
		mesto_1='';
	}else{
		document.getElementById(id).style.background='#0594bf';
			mesto_1=cemesto;
			console.log('mesto_1 = '+mesto_1);
	}
}*/