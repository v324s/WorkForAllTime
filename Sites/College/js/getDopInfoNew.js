$.post('../api/getDopInfoNew.php',{newId:newId},function (e){
	let el=JSON.parse(e);
	$("#countViewers").text("Просмотров: "+el["viewers"]);
	$("#addDate").text(el["add_date"]);
});