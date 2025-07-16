<?
if(basename($_SERVER['SCRIPT_FILENAME']) == basename(__FILE__) && count(get_included_files()) <= 1){
    header("Location: /");
    exit();
    // Файлы пытались открыть напрямую
}




class Logs{

    public function main($text)
    {
        file_put_contents('logs/logs.txt', date("d.m.Y H:i:s").' - '.print_r($text,1)."\n", FILE_APPEND);
    }

    public function inFile(string $type, $text)
    {
        file_put_contents('logs/'.$type.'.txt', date("d.m.Y H:i:s").' - '.print_r($text,1)."\n", FILE_APPEND);
    }


    public function requestReceived(){
        $headers = getallheaders();
        if ($headers['Content-Type'] == 'application/json') {
            $data = json_decode(file_get_contents('php://input'), true);
        }else{
            $data = file_get_contents('php://input');
        }
        $query = [
            'headers' => $headers,
            'body' => $data
        ];
        if (count($_POST)>0) {
            $query['post'] = $_POST;
        }
        if (count($_GET)>0) {
            $query['get'] = $_GET;
        }
        self::inFile('request_received', $query);
    }
}

?>
