<?php

$headers = array(
    'Accept-Encoding' => 'json',
    'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/103.0.5060.114 Safari/537.36 OPR/89.0.4447.64'
);

if ($_POST['url']){
    $url = $_POST['url'];  
}else{
    echo 'Вы не указали ссылку';
    exit();
}
    
$html=get($url, array(
    'headers' => array(
        'Accept-Encoding: '.$headers['Accept-Encoding'],
        'User-Agent: '.$headers['User-Agent']
    )
));


preg_match_all('#<span class="tooltip-right" title="Дата публикации отзыва: .+?">(.+?)</span>#su',$html,$arr_dateTime); // даты
preg_match_all('#<span itemprop="name">(.+?)</span>#su',$html,$arr_author); // авторы
preg_match_all('#<meta itemprop="ratingValue" content="([0-9])">#su',$html,$arr_grade); // оценки
preg_match_all('#<div class="review-teaser" itemprop="description">(.+?)</div>#su',$html,$arr_text); // отзывы

$mass=[];
for ($i=0; $i < count($arr_dateTime[1]) ; $i++) { 
    $mass[] = [
        "date" => $arr_dateTime[1][$i],
        "author" => $arr_author[1][$i],
        "grade" => $arr_grade[1][$i],
        "text" => $arr_text[1][$i]
    ];
}

if ($_POST['json']=='true')
    print_r(json_encode($mass));
elseif ($_POST['json']=='false')
    print_r($html);


function get($url = null, $params = null) {
    $ch = curl_init();
    
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
    
    if(isset($params['headers'])) {
        curl_setopt($ch, CURLOPT_HTTPHEADER, $params['headers']);
    }

    $result = curl_exec($ch);
    curl_close($ch);
    
    return $result;
}

?>
