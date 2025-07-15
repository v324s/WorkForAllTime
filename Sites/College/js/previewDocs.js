function previewDocs(src) {
	$('.bg-for-big-menu').show();
	$('.preview').show();
	$('body').css('overflow','hidden');
	$('#preview_embed').attr('src', src);
}


$("#preview_but_close").click(function () {
	$('.bg-for-big-menu').hide();
	$('.preview').hide();
	$('body').css('overflow','auto');
	$('#preview_embed').attr('src', '');
});