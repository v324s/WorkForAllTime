function showTable(table, obj){
    $('.ta-center li.selected').removeClass('selected');
    $(obj).addClass('selected');
    $.get('server', {action: 'get', table: table}, function (e){$('#response').html(e)});
}

