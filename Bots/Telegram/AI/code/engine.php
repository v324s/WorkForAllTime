<?php
header("Content-Type: application/json; charset=UTF-8");


require_once('settings.php');
require_once('telegram.php');
require_once('logs.php');


$tg = new Telegram();
$logs = new Logs();



// connectionClose(200);
// // connectionClose(403);
// exit();


$logs->requestReceived();
$headers = getallheaders();

    
$processed = false;
if ($headers['X-Telegram-Bot-Api-Secret-Token'] == WEBHOOK_SECRET_TOKEN) {
    if ($headers['Content-Type'] == 'application/json') {
        $body = json_decode(file_get_contents('php://input'), true);
    }
    
    if (!$processed && isset($body['callback_query'])) {        
        switch ($body['callback_query']['data']) {
            case 'developer':
                logs("❕ Пользователь {$body['callback_query']['from']['first_name']}({$body['callback_query']['from']['id']}) запросил информацию о разработчике.");
                $res=json_decode($tg->asnwerCallbackQuery($body['callback_query']['id'], "🤖 Данный бот  создал студент УлГУ гр. ИС-З-21\n\nГусев В.Е.\n\nВ рамках прохождения производственной практики", true), true);
                if ($res['ok']){
                    logs("✔️ Пользователю {$body['callback_query']['from']['first_name']}({$body['callback_query']['from']['id']}) успешно предоставили информацию о разработчике.");
                }else{
                    logs("❌ Пользователю {$body['callback_query']['from']['first_name']}({$body['callback_query']['from']['id']}) не удалось предоставили информацию о разработчике по причине: {$res['description']}");
                }
            break;
        }
    }
    
    
    // ОБРАБОТКА КОМАНД
    if (!$processed && isset($body['message']) && isset($body['message']['entities']) && $body['message']['entities'][0]['type'] == 'bot_command' && $body['message']['chat']['type'] == 'private') {
        switch (mb_strtolower($body['message']['text'])) {
            case '/start':
                $processed = true;
                logs("❕ Пользователь {$body['message']['from']['first_name']}({$body['message']['from']['id']}) написал команду /start");
                
                $answer = "👋 Привет\\!\n\nЗдесь ты можешь пообщаться с CHATGPT 🤖";
                $res=json_decode($tg->sendMessage($body['message']['from']['id'],$answer,[
                    'parse_mode'=>'markdownv2',
                    'reply_markup' => [
                        'inline_keyboard' => [
                            [
                                [
                                    'text' => "⚙️ О разработчике",
                                    'callback_data' => "developer"
                                ]
                            ]
                        ]
                    ]
                ]), true);
                if ($res['ok']) {
                    logs("✔️ Пользователю {$body['message']['from']['first_name']}({$body['message']['from']['id']}) успешно ответили на команду /start.");
                    $res=json_decode($tg->deleteMessage($body['message']['from']['id'], $body['message']['message_id']), true);
                    $res['ok'] ? logs("✔️ Удалили сообщение №{$body['message']['message_id']} \"{$body['message']['text']}\" пользователя {$body['message']['from']['first_name']}({$body['message']['from']['id']}).") : logs("❌ Не удалось удалить сообщение №{$body['message']['message_id']} \"{$body['message']['text']}\" пользователя {$body['message']['from']['first_name']}({$body['message']['from']['id']}) по причине: {$res['description']}");
                }else{
                    logs("❌ Пользователю {$body['message']['from']['first_name']}({$body['message']['from']['id']}) не удалось ответить на команду /start. По причине: {$res['description']}.");
                }
            break;
        }
    }
    
    // Сообщения в личку 
    if (!$processed && isset($body['message']) && $body['message']['chat']['type'] == 'private') {
        if (isset($body['message']['text'])) {
            $processed = true;

            $tg->sendChatAction($body['message']['from']['id'],"typing");


            $aiResponse = askAI($body['message']['text']);

            if (isset($aiResponse['choices'][0]['message']['content'])) {
                $res=json_decode($tg->sendMessage($body['message']['from']['id'],formatToMarkdown($aiResponse['choices'][0]['message']['content']),['parse_mode'=>'MarkdownV2']), true);
                if ($res['ok']) {
                    logs("✔️ Пользователю {$body['message']['from']['first_name']}({$body['message']['from']['id']}) успешно ответили (MD2) на запрос \"{$body['message']['text']}\".");
                }else{
                    logs("❌ Пользователю {$body['message']['from']['first_name']}({$body['message']['from']['id']}) не удалось ответить (MD2) на запрос {$body['message']['text']}. По причине: {$res['description']}.");
    
                    $res=json_decode($tg->sendMessage($body['message']['from']['id'],$aiResponse['choices'][0]['message']['content']), true);
                    if ($res['ok']) {
                        logs("✔️ Пользователю {$body['message']['from']['first_name']}({$body['message']['from']['id']}) успешно ответили на запрос \"{$body['message']['text']}\".");
                    }else{
                        logs("❌ Пользователю {$body['message']['from']['first_name']}({$body['message']['from']['id']}) не удалось ответить на запрос {$body['message']['text']}. По причине: {$res['description']}.");
                        $tg->sendMessage($body['message']['from']['id'],"Ошибка. Не удалось получить ответ");
                    }
                }
            }else{
                $tg->sendMessage($body['message']['from']['id'],"Ошибка. Не удалось получить ответ");
            }

        }
        
    }
}
function askAI($prompt) {
    global $logs;

    $headers = [
        'Content-Type: application/json',
        'Authorization: Bearer '.AI_API_KEY
    ];

    $data = [
        'model' => 'gpt-4o-mini',
        'messages' => [
            ['role' => 'user', 'content' => $prompt]
        ],
        "temperature" => 0.7
    ];

    $ch = curl_init(AI_API);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    $response = curl_exec($ch);
    curl_close($ch);

    $responseData = json_decode($response, true);

    $logs->inFile('gptQuery',$responseData);

    return $responseData;
}
function formatToMarkdown($str) {
    // *bold \*text*
    // _italic \*text_
    // __underline__
    // ~strikethrough~
    // ||spoiler||
    // *bold _italic bold ~italic bold strikethrough ||italic bold strikethrough spoiler||~ __underline italic bold___ bold*
    // [inline URL](http://www.example.com/)
    // [inline mention of a user](tg://user?id=123456789)
    // ![👍](tg://emoji?id=5368324170671202286)
    // `inline fixed-width code`
    // ```
    // pre-formatted fixed-width code block
    // ```
    // ```python
    // pre-formatted fixed-width code block written in the Python programming language
    // ```
    // >Block quotation started
    // >Block quotation continued
    // >Block quotation continued
    // >Block quotation continued
    // >The last line of the block quotation
    // **>The expandable block quotation started right after the previous block quotation
    // >It is separated from the previous block quotation by an empty bold entity
    // >Expandable block quotation continued
    // >Hidden by default part of the expandable block quotation started
    // >Expandable block quotation continued
    // >The last line of the expandable block quotation with the expandability mark||
    // '_', '*', '[', ']', '(', ')', '~', '`', '>', '#', '+', '-', '=', '|', '{', '}', '.', '!'
    $str = str_replace(".", "\\.", $str);
    $str = str_replace("_", "\\_", $str);
    $str = str_replace("*", "\\*", $str);
    $str = str_replace("[", "\\[", $str);
    $str = str_replace("]", "\\]", $str);
    $str = str_replace("(", "\\(", $str);
    $str = str_replace(")", "\\)", $str);
    $str = str_replace("~", "\\~", $str);
    $str = str_replace("#", "\\#", $str);
    $str = str_replace("+", "\\+", $str);
    $str = str_replace("=", "\\=", $str);
    $str = str_replace("-", "\\-", $str);
    $str = str_replace("!", "\\!", $str);
    $str = str_replace("{", "\\{", $str);
    $str = str_replace("}", "\\}", $str);
    return $str;
}
function logs($text) : void {
    global $logs;
    $logs->main($text);
}
function connectionClose(int $code) {
    http_response_code($code);
    header("Connection: close");
    ob_start();
    $size = ob_get_length();
    header("Content-Length: $size");
    ob_end_flush();
    flush();
}
?>
