<?

if ($_POST['action']=='delete' && $_POST['table'] && $_POST['id']) {
    
    $sql = "DELETE FROM {$_POST['table']} WHERE `id`=:id";
    $sth=$dbh->prepare($sql);
    $res=$sth->execute(array('id'=>$_POST['id']));
          
    if ($res){
        echo 'Запись удалена!';
    }else{
        echo 'Не удалось удалить запись';
    }
}






?>