<?php
header("Content-Type: application/json");

require_once('include/class_data.php');

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'GET':
        $workWith = $_GET['resource'] ?? false;
        if ($workWith) {
            switch (mb_strtolower($workWith)) {
                case 'deals':
                    $data = new Data('deals');
                    $id = $_GET['id'] ?? null;
                    $result = $data->get($id);
                    if ($result !== false){
                        http_response_code(200);
                        echo json_encode(['ok'=>true, $id ? 'deal' : 'deals' => $result]);
                    }else{
                        http_response_code($id ? 404 : 500);
                        echo json_encode(['ok'=>false,'description'=>$id ? 'Сделка не найдена' : 'Не удалось получить данные']);
                    }
                break;
    
                case 'contacts':
                    $data = new Data('contacts');
                    $id = $_GET['id'] ?? null;
                    $result = $data->get($id);
                    if ($result !== false){
                        http_response_code(200);
                        echo json_encode(['ok'=>true, $id ? 'contact' : 'contacts' => $result]);
                    }else{
                        http_response_code($id ? 404 : 500);
                        echo json_encode(['ok'=>false,'description'=>$id ? 'Персона не найдена' : 'Не удалось получить данные']);
                    }
                break;

                default:
                    http_response_code(500);
                    echo json_encode(['ok'=>false,'description'=>'Неизвестный тип "resource"']);
                break;
            }
        }else{
            // http_response_code(404);
            // echo json_encode(['ok'=>false,'description'=>'Отсутствует GET-параметр "resource"']);

            http_response_code(200);
            echo json_encode([
                'ok'=>true,
                'menu'=>[
                    [
                        'name' => 'Сделки',
                        'resource' => 'deals'
                    ],
                    [
                        'name'=>'Контакты',
                        'resource' => 'contacts'
                    ]
                ]
            ]);
        }
    break;

    case 'POST':
        $workWith = $_GET['resource'] ?? false;
        if ($workWith) {
            switch (mb_strtolower($workWith)) {
                case 'deals':
                    $newData = json_decode(file_get_contents('php://input'), true);
                    $deal = [
                        'name' => $newData['name'],
                        'price' => (int) $newData['price'] ?: null,
                        'contacts' => $newData['contacts']
                    ];
                    $data = new Data('deals');
                    if ($data->insert($deal)){
                        http_response_code(201);
                        echo json_encode(['ok'=>true]);
                    }else{
                        http_response_code(500);
                        echo json_encode(['ok'=>false]);
                    }
                break;
    
                case 'contacts':
                    $newData = json_decode(file_get_contents('php://input'), true);
                    $contact = [
                        'first_name' => $newData['first_name'],
                        'last_name' => $newData['last_name'] ?: '',
                        'deals' => $newData['deals'],
                    ];
                    $data = new Data('contacts');
                    if ($data->insert($contact)){
                        http_response_code(201);
                        echo json_encode(['ok'=>true]);
                    }else{
                        http_response_code(500);
                        echo json_encode(['ok'=>false]);
                    }
                break;

                default:
                    http_response_code(404);
                    echo json_encode(['ok'=>false,'description'=>'Неизвестный тип "resource"']);
                break;
            }
        }else{
            http_response_code(404);
            echo json_encode(['ok'=>false,'description'=>'Отсутствует GET-параметр "resource"']);
        }
    break;

    case 'PUT':
        $workWith = $_GET['resource'] ?? false;
        if ($workWith) {
            switch (mb_strtolower($workWith)) {
                case 'deals':
                    $newData = json_decode(file_get_contents('php://input'), true);
                    if ($id = (int)$_GET['id']) {
                        $deal = [
                            'id' => $id,
                            'name' => $newData['name'],
                            'price' => (int)$newData['price'],
                            'contacts' => $newData['contacts']
                        ];
                        $data = new Data('deals');
                        if ($data->update($id, $deal)){
                            http_response_code(200);
                            echo json_encode(['ok'=>true]);
                        }else{
                            http_response_code($id ? 404 : 500);
                            echo json_encode(['ok'=>false, 'description' => $id ? 'Сделка не найдена' : 'Не удалось изменить данные']);
                        }
                    }else{
                        http_response_code(400);
                        echo json_encode(['ok'=>false, 'description' => 'Отсутствует GET-параметр "id"']);
                    }
                break;
    
                case 'contacts':
                    $newData = json_decode(file_get_contents('php://input'), true);
                    if ($id = (int)$_GET['id']) {
                        $contact = [
                            'id' => $id,
                            'first_name' => $newData['first_name'],
                            'last_name' => $newData['last_name'],
                            'deals' => $newData['deals'],
                        ];
                        $data = new Data('contacts');
                        if ($data->update($id, $contact)){
                            http_response_code(201);
                            echo json_encode(['ok'=>true]);
                        }else{
                            http_response_code($id ? 404 : 500);
                            echo json_encode(['ok'=>false, 'description' => $id ? 'Контакт не найден' : 'Не удалось изменить данные']);
                        }
                    }else{
                        http_response_code(400);
                        echo json_encode(['ok'=>false, 'description' => 'Отсутствует GET-параметр "id"']);
                    }
                break;

                default:
                    http_response_code(404);
                    echo json_encode(['ok'=>false,'description'=>'Неизвестный тип "resource"']);
                break;
            }
        }else{
            http_response_code(404);
            echo json_encode(['ok'=>false,'description'=>'Отсутствует GET-параметр "resource"']);
        }
    break;

    case 'DELETE':
        $workWith = $_GET['resource'] ?? false;
        if ($workWith) {
            switch (mb_strtolower($workWith)) {
                case 'deals':
                    $data = new Data('deals');
                    $id = $_GET['id'] ?? null;
                    if ($id !== null) {
                        $result = $data->delete($id);
                        if ($result !== false){
                            http_response_code(204);
                        }else{
                            http_response_code(404);
                            echo json_encode(['ok'=>false,'description'=>'Сделка не найдена']);
                        }
                    }else{
                        http_response_code(400);
                        echo json_encode(['ok'=>false,'description'=>'Отсутствует GET-параметр "id"']);
                    }
                break;
    
                case 'contacts':
                    $data = new Data('contacts');
                    $id = $_GET['id'] ?? null;
                    if ($id !== null) {
                        $result = $data->delete($id);
                        if ($result !== false){
                            http_response_code(204);
                        }else{
                            http_response_code(404);
                            echo json_encode(['ok'=>false,'description'=>'Контакт не найден']);
                        }
                    }else{
                        http_response_code(400);
                        echo json_encode(['ok'=>false,'description'=>'Отсутствует GET-параметр "id"']);
                    }
                break;

                default:
                    http_response_code(404);
                    echo json_encode(['ok'=>false,'description'=>'Неизвестный тип "resource"']);
                break;
            }
        }else{
            http_response_code(404);
            echo json_encode(['ok'=>false,'description'=>'Отсутствует GET-параметр "resource"']);
        }
    break;
    
}
?>