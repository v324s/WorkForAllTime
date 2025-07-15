<?
include "../include/settings.php";
include "../include/adm_settings.php";
session_start();
?>
<div>Заголовок <input type="text" id="title"></div>
<div id="result">
	<!-- Результат из upload.php -->
</div>
<input type="file" multiple id="js-file">
<button>Картинка</button>
<button>Ссылка</button>
<button>Видео</button>
<textarea id="text"></textarea>
<button onclick="preview();">Предосмотр</button>
<iframe id="framePreview" src="../news/temp.php" width="100%" height="800px"></iframe>
<script type="text/javascript">
	function preview() {
		$.post("../api/previewNewNews.php",{title:$('#title').val(),text:$('#text').val()},function(e){console.log(e)});
		window.parent.document.getElementById('framePreview').contentWindow.location.reload(true);
	}


	$("#js-file").change(function(){
	if (window.FormData === undefined) {
		alert('В вашем браузере FormData не поддерживается')
	} else {
		var formData = new FormData();
		formData.append('file', $("#js-file")[0].files[0]);

		$.ajax({
			type: "POST",
			url: '../api/uploadImg.php',
			cache: false,
			contentType: false,
			processData: false,
			data: formData,
			dataType : 'json',
			success: function(msg){
				if (msg.error == '') {
					$("#js-file").hide();
					$('#result').html(msg.success);
				} else {
					$('#result').html(msg.error);
				}
			}
		});
	}
});
</script>
