function action_delete(table, id) {
    if (confirm("Вы уверены, что хотите удалить строку "+id+" ?")) {
        $.post('server', {action: 'delete', table: table, id:id}, function (e){alert(e)});
        $.get('server', {action: 'get', table: table}, function (e){$('#response').html(e)});
    }
}