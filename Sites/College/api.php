<?
$log='admin';
$pas='w324324';
$rd=date('d.m.Y');
$rt=date('H:i');
$per=1;
$link=mysqli_connect('127.0.0.1','root','root','spo_dmu');
if ($link == false){
    print("Ошибка: Невозможно подключиться к MySQL " . mysqli_connect_error());
}
else {
    print("Соединение установлено успешно");
}
$querry='INSERT INTO users SET login="'.$log.'", password="'.$pas.'", reg_date="'.$rd.'", reg_time="'.$rt.'", permission='.$per;
$h=mysqli_query($link,$querry);
print_r($h);
?>