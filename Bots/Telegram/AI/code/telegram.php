<?
require_once('settings.php');

class Telegram{
   

    public function asnwerCallbackQuery($cbq_id, $str, bool $show_alert){
        return file_get_contents(API_HOST."answerCallbackQuery?callback_query_id={$cbq_id}&show_alert={$show_alert}&text=".urlencode($str));
    }

    public function sendMessage($chat_id, $text, $settings = null){
        $params = [
            'chat_id' => $chat_id,
            'text' => $text
        ];
        if (isset($settings)) {
            foreach ($settings as $key => $value) {
                switch ($key) {
                    case 'message_thread_id':
                        if ($value) {
                            $params['message_thread_id'] = $value;
                        }
                        break;
                    case 'reply_parameters':
                        if ($value) {
                            $params['reply_parameters'] = $value;
                        }
                        break;
                    case 'protect_content':
                        if ($value) {
                            $params['protect_content'] = true;
                        }
                        break;
                    case 'disable_notification':
                        if ($value) {
                            $params['disable_notification'] = true;
                        }
                        break;
                    case 'disable_web_page_preview':
                        if ($value) {
                            $params['disable_web_page_preview'] = true;
                        }
                        break;
                    case 'reply_to_message_id':
                        // Если пользователь удалит сообщение, то сообщение не перешлется и отправится только текст
                        if ($value) {
                            $params['reply_to_message_id'] = $value;
                            $params['allow_sending_without_reply'] = true;
                        }
                        break;
                    case 'reply_markup':
                        // value =
                        // [
                        //         'inline_keyboard' => [
                        //             [
                        //                 ['text' => "1_1", "callback_data" => "1"],
                        //                 ['text' => "1_2", "callback_data" => "2"]
                        //             ],
                        //             [
                        //                 ['text' => "2_1", "callback_data" => "1"],
                        //                 ['text' => "2_2", "callback_data" => "2"]
                        //             ]
                        //         ]
                        // ]
                        $params['reply_markup'] = json_encode($value);
                        break;
                    case 'parse_mode':
                        switch (strtolower($value)) {
                            case 'html':
                                    // <b>bold</b>, <strong>bold</strong>
                                    // <i>italic</i>, <em>italic</em>
                                    // <u>underline</u>, <ins>underline</ins>
                                    // <s>strikethrough</s>, <strike>strikethrough</strike>, <del>strikethrough</del>
                                    // <span class="tg-spoiler">spoiler</span>, <tg-spoiler>spoiler</tg-spoiler>
                                    // <b>bold <i>italic bold <s>italic bold strikethrough <span class="tg-spoiler">italic bold strikethrough spoiler</span></s> <u>underline italic bold</u></i> bold</b>
                                    // <a href="http://www.example.com/">inline URL</a>
                                    // <a href="tg://user?id=123456789">inline mention of a user</a>
                                    // <tg-emoji emoji-id="5368324170671202286">👍</tg-emoji>
                                    // <code>inline fixed-width code</code>
                                    // <pre>pre-formatted fixed-width code block</pre>
                                    // <pre><code class="language-python">pre-formatted fixed-width code block written in the Python programming language</code></pre>
                                // $url.="&parse_mode=HTML";
                                $params['parse_mode'] = 'HTML';
                                break;
                            case 'markdown':
                                    // *bold text*
                                    // _italic text_
                                    // [inline URL](http://www.example.com/)
                                    // [inline mention of a user](tg://user?id=123456789)
                                    // `inline fixed-width code`
                                    // ```
                                    // pre-formatted fixed-width code block
                                    // ```
                                    // ```python
                                    // pre-formatted fixed-width code block written in the Python programming language
                                    // ```
                                // $url.="&parse_mode=Markdown";
                                $params['parse_mode'] = 'Markdown';
                                break;
                            case 'markdownv2':
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
                                // $url.="&parse_mode=MarkdownV2";
                                $params['parse_mode'] = 'MarkdownV2';
                                break;
                        }
                        break;
                }
            }
        }
        return query(API_HOST."sendMessage?".http_build_query($params));
    }

    public function deleteMessage($chat_id, $message_id) {
        $params = [
            'chat_id' => $chat_id,
            'message_id' => $message_id
        ];
        
        return query(API_HOST."deleteMessage?".http_build_query($params));
    }

    public function sendChatAction($chat_id, $action, $settings = null) {
        $params = [
            'chat_id' => $chat_id,
            'action' => $action
        ];
        if (isset($settings)) {
            foreach ($settings as $key => $value) {
                switch ($key) {
                    case 'business_connection_id':
                        if ($value) {
                            $params['business_connection_id'] = $value;
                        }
                    break;
                    case 'message_thread_id':
                        if ($value) {
                            $params['message_thread_id'] = true;
                        }
                    break;
                }
            }
        }
        return query(API_HOST."sendChatAction?".http_build_query($params));
    }
    
    public function getWebhookInfo(){
        return query(API_HOST."getWebhookInfo");
    }

    public function deleteWebhook(){
        return query(API_HOST."deleteWebhook?drop_pending_updates=true");
    }

    public function setWebhook($url, $secret_token = null) {
        $url = API_HOST."setwebhook?url={$url}";
        if ($secret_token) {
            $url.="&secret_token={$secret_token}";
        }

        return query($url);
    }
}


$headers = array(
    'Accept-Encoding' => 'json'
);





function get($url = null, $params = null) {
    $ch = curl_init();
    
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);

    if (isset($params['params'])) {
        $url = $url . '?' . http_build_query($params['params']);
        curl_setopt($ch, CURLOPT_URL, $url);
    }
    
    if (isset($params['headers'])) {
        curl_setopt($ch, CURLOPT_HTTPHEADER, $params['headers']);
    }
    

    curl_setopt($ch, CURLOPT_HEADER, true);
    
    
    $result = curl_exec($ch);
    $result_explode = explode("\r\n\r\n", $result);
    
    $head = ((isset($result_explode[0])) ? $result_explode[0]."\r\n" : '').''.((isset($result_explode[1])) ? $result_explode[1] : '');
    $body = $result_explode[count($result_explode) - 1];
    
    
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    
    $info = curl_getinfo($ch);
    curl_close($ch);

    if (preg_match('|\/(\w+)\?|', $url, $matches)) {
        $actionMethod = $matches[1];
    }else{
        if (preg_match('|\:\w+\/(\w+)|', $url, $matches)) {
            $actionMethod = $matches[1];
        }
    }
    $options=explode('?',$url);
    $queryArray = [];

    parse_str($options[1], $queryArray);
    $data = [
        'code' => $http_code,
        'head' => explode("\n",$head),
        'body' => $body
    ];

    $actionMethod ? $data['method'] = $actionMethod : false;
    count($queryArray)>0 ? $data['options'] = $queryArray : false;
    $data['timeRequest'] = $info['total_time'];

    return $data;
}


function query($url) {
    $result_query = get($url);
    file_put_contents('logs/TelegramQuery.txt', date("d.m.Y H:i:s").' - '.print_r($result_query,1)."\n", FILE_APPEND);
    switch ($result_query['code']) {
        case 400:
            file_put_contents('logs/ErrorsTelegramQuery.txt', date("d.m.Y H:i:s").' - '.print_r($result_query,1)."\n", FILE_APPEND);
            return $result_query['body'];
            break;

        case 403:
            file_put_contents('logs/ErrorsTelegramQuery.txt', date("d.m.Y H:i:s").' - '.print_r($result_query,1)."\n", FILE_APPEND);
            return $result_query['body'];
            break;
        
        case 200:
            return $result_query['body'];
            break;
        
        default:
            return $result_query;
            break;
    }
}

?>
