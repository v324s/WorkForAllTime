<?php
header('Content-Type: application/json; charset=utf-8'); 

require_once('settings.php');
require_once('logs.php');


$logs = new Logs();
$logs->requestReceived();



$headers = getallheaders();

if (isset($_POST)) {
    switch ($_POST['method']) {
        case 'clearCart':
            if (isset($_POST['book'])) {
                $uid = 8;
                $answer = [];
                $sql = "UPDATE ".DB_TABLE_USERS." SET `cart`=:cart WHERE `id`=:uid";
                $sth = $pdo->prepare($sql);
                try {
                    $res = $sth->execute([
                        'uid' => $uid,
                        'cart' => null
                    ]);
                    $answer['ok'] = true;
                }catch (\Throwable $th) {
                    $answer["ok"] = false;
                    $answer["error"] = $th->getMessage();
            
                }
                echo json_encode($answer);
            }
        break;
        case 'removeFromCart':
            if (isset($_POST['book'])) {
                $uid = 8;
                $answer = [];
                $pdo = connect();
                $sql = "SELECT `cart` FROM ".DB_TABLE_USERS." WHERE `id`=:uid";
                $sth = $pdo->prepare($sql);
                try {
                    $res = $sth->execute([
                        'uid' => $uid
                    ]);
                    $row = $sth->fetch();
                    if ($row['cart'] != null) {
                        $cart = json_decode($row['cart'], true);
                        $answer["old"] = $cart;
                        if (count($cart) > 1) {
                            $key = array_search($_POST['book'], $cart);
                            if ($key !== false) {
                                unset($cart[$key]);
                            }
                            $cart = array_values($cart);
                            $answer["new"] = $cart;
                            $cart_new = json_encode($cart);
                            // $cart_new = $cart;
                        }else{
                            $cart_new = null;
                        }
                        $pdo = connect();
                        $sql = "UPDATE ".DB_TABLE_USERS." SET `cart`=:cart WHERE `id`=:uid";
                        $sth = $pdo->prepare($sql);
                        try {
                            $res = $sth->execute([
                                'uid' => $uid,
                                'cart' => $cart_new
                            ]);
                            $answer['ok'] = true;
                        }catch (\Throwable $th) {
                            $answer["ok"] = false;
                            $answer["error"] = $th->getMessage();
                
                        }
                    }else{
                        $answer["ok"] = false;
                    }
                }catch (\Throwable $th) {
                    $answer["ok"] = false;
                    $answer["error"] = $th->getMessage();
        
                }
                echo json_encode($answer);
            }
        break;
        case 'addToCart':
            if (isset($_POST['book'])) {
                $uid = 8;
                $answer = [];
                $pdo = connect();
                $sql = "SELECT `cart` FROM ".DB_TABLE_USERS." WHERE `id`=:uid";
                $sth = $pdo->prepare($sql);
                try {
                    $res = $sth->execute([
                        'uid' => $uid
                    ]);
                    $row = $sth->fetch();
                    if ($row['cart'] != null) {
                        $cart = json_decode($row['cart'], true);
                        if (!is_array($cart)) {
                            $cart = [];
                        }
                        $cart[] = intval($_POST['book']);
		                $cart_json = json_encode($cart);
                        $pdo = connect();
                        $sql = "UPDATE ".DB_TABLE_USERS." SET `cart`=:cart WHERE `id`=:uid";
                        $sth = $pdo->prepare($sql);
                        try {
                            $res = $sth->execute([
                                'uid' => $uid,
                                'cart' => $cart_json
                            ]);
                            $answer['ok'] = true;
                        }catch (\Throwable $th) {
                            $answer["ok"] = false;
                            $answer["error"] = $th->getMessage();
                
                        }
                    }else{
                        $cart = [];
                        $cart[] = intval($_POST['book']);
		                $cart_json = json_encode($cart);
                        $pdo = connect();
                        $sql = "UPDATE ".DB_TABLE_USERS." SET `cart`=:cart WHERE `id`=:uid";
                        $sth = $pdo->prepare($sql);
                        try {
                            $res = $sth->execute([
                                'uid' => $uid,
                                'cart' => $cart_json
                            ]);
                            $answer['ok'] = true;
                        }catch (\Throwable $th) {
                            $answer["ok"] = false;
                            $answer["error"] = $th->getMessage();
                
                        }
                    }
                }catch (\Throwable $th) {
                    $answer["ok"] = false;
                    $answer["error"] = $th->getMessage();
        
                }
                echo json_encode($answer);
            }
        break;
    }
}
if (isset($_GET)) {
    switch ($_GET['method']) {
        case 'getMainMessage':
            $answer = [
                "ok" => true,
                "message" => "«Dream Library» – крупный интернет-магазин книг, успешно работающий в Красноярске и других регионах России. В нём вы можете заказывать книги в любое время 24 часа в сутки.\nВ интернет-магазине «Dream Library» вы найдёте книги на любой вкус, для этого мы сделали удобный каталог, тематические подборки и специальные акции. Уверены, вам понравится наш книжный интернет-магазин. Добро пожаловать!"
            ];
            echo json_encode($answer);
        break;

        case 'getBook':
            if (isset($_GET['id'])) {
                $answer = [
                    "ok" => true
                ];
                $pdo = connect();
                $sql = "SELECT `id`,`cena` AS `price`,`name`,`avtor` AS `author`,`vozogr` AS `age`,`izdatelstvo` AS `published`,`seria` AS `series`,`godidat` AS `year`,`kolvostr` AS `numberOfPages`,`format`,`tipoblozh` AS `typeOfCover`,`ves` AS `weight`,`annotacia` AS `annotation`,`img` FROM ".DB_TABLE_BOOKS." WHERE `id`=:id";
                $sth = $pdo->prepare($sql);
                try {
                    $res = $sth->execute([
                        'id' => $_GET['id']
                    ]);
                    $row = $sth->fetchAll();
                    if ($row) {
                        $filteredResult = removeNumericKeys($row);
                        $answer["book"] = $filteredResult;
                    }
                }catch (\Throwable $th) {
                    $answer["ok"] = false;
                    $answer["error"] = $th->getMessage();
        
                }
                echo json_encode($answer);
            }
        break;

        case 'getCatalog':
            $answer = [
                "ok" => true
            ];
            $pdo = connect();
            $sql = "SELECT `id`,`cena` AS `price`,`name`,`avtor` AS `author`,`img` FROM ".DB_TABLE_BOOKS;
            $sth = $pdo->prepare($sql);
            try {
                $res = $sth->execute();
                $row = $sth->fetchAll();
                if ($row) {
                    $filteredResult = removeNumericKeys($row);
                    $answer["data"] = $filteredResult;
                }
            }catch (\Throwable $th) {
                $answer["ok"] = false;
                $answer["error"] = $th->getMessage();
    
            }
            echo json_encode($answer);
        break;

        case 'getCart':
            $uid = 8;
            $answer = [
                "ok" => true
            ];
            $pdo = connect();
            $sql = "SELECT `cart` FROM ".DB_TABLE_USERS." WHERE `id`=:uid";
            $sth = $pdo->prepare($sql);
            try {
                $res = $sth->execute([
                    'uid' => $uid
                ]);
                $row = $sth->fetch();
                if ($row['cart'] != null) {
                    $cart = json_decode($row['cart']);
                    $str = implode(',', $cart);
                    $pdo = connect();
                    $sql = "SELECT `id`,`cena` AS `price`,`name`,`avtor` AS `author`,`img` FROM ".DB_TABLE_BOOKS." WHERE `id` IN ({$str})";

                    $sth = $pdo->prepare($sql);
                    try {
                        $res = $sth->execute();
                        $row = $sth->fetchAll();
                        if ($row != null) {
                            $result=[];
                            foreach ($cart as $key) {
                                foreach ($row as $book) {
                                    if ($key == $book['id']) {
                                        $result[]=$book;
                                    }
                                }
                            }
                            $answer['cart']=$result;
                        }else{
                            $answer["cart"] = null;
                        }
                    }catch (\Throwable $th) {
                        $answer["ok"] = false;
                        $answer["error"] = $th->getMessage();
                    }
                }else{
                    $answer["cart"] = [];
                }
            }catch (\Throwable $th) {
                $answer["ok"] = false;
                $answer["error"] = $th->getMessage();
    
            }
            echo json_encode($answer);
        break;
        

        case 'getProfile':
            $uid = 8;
            $answer = [
                "ok" => true
            ];

            $pdo = connect();
            $sql = "SELECT `email`, `first_name`, `last_name`, `llast_name` AS `middle_name`, `tel`, `gorod`, `address`, `regtime` FROM ".DB_TABLE_USERS." WHERE `id`=:uid";
            $sth = $pdo->prepare($sql);
            try {
                $res = $sth->execute([
                    'uid' => $uid
                ]);
                $row = $sth->fetchAll();
                if ($row) {
                    $filteredResult = removeNumericKeys($row);
                    $answer["profile"] = $filteredResult;
                }
            }catch (\Throwable $th) {
                $answer["ok"] = false;
                $answer["error"] = $th->getMessage();
            }

            $pdo = connect();
            $sql = "SELECT COUNT(`id`) FROM ".DB_TABLE_REVIEWS." WHERE `uid`=:uid";
            $sth = $pdo->prepare($sql);
            try {
                $res = $sth->execute([
                    'uid' => $uid
                ]);
                $row = $sth->fetchAll();
                if ($row) {
                    $answer["profile"][0]['reviews'] = $row[0][0];
                }
            }catch (\Throwable $th) {
                $answer["ok"] = false;
                $answer["error"] = $th->getMessage();
            }

            $pdo = connect();
            $sql = "SELECT COUNT(`PRICE`) FROM ".DB_TABLE_ORDERS." WHERE `uid`=:uid";
            $sth = $pdo->prepare($sql);
            try {
                $res = $sth->execute([
                    'uid' => $uid
                ]);
                $row = $sth->fetchAll();
                if ($row) {
                    $answer["profile"][0]['orders'] = (int)$row[0][0];
                }
            }catch (\Throwable $th) {
                $answer["ok"] = false;
                $answer["error"] = $th->getMessage();
            }

            $pdo = connect();
            $sql = "SELECT SUM(`PRICE`) FROM ".DB_TABLE_ORDERS." WHERE `uid`=:uid";
            $sth = $pdo->prepare($sql);
            try {
                $res = $sth->execute([
                    'uid' => $uid
                ]);
                $row = $sth->fetchAll();
                if ($row) {
                    $answer["profile"][0]['totalPriceOrders'] = (int)$row[0][0];
                }
            }catch (\Throwable $th) {
                $answer["ok"] = false;
                $answer["error"] = $th->getMessage();
            }
            echo json_encode($answer);
        break;
    }
}








function removeNumericKeys($data) {
    $result = array();
    foreach ($data as $key => $value) {
        if (is_array($value)) {
            $result[$key] = removeNumericKeys($value);
        } else {
            if (is_string($key)) {
                $result[$key] = $value;
            }
        }
    }
    return $result;
}


function connect(){
    try {
        $conn = new PDO('mysql:dbname=' . DB_NAME . ';host=' . DB_SERVER, DB_LOGIN, DB_PASS);
        $conn->exec("set names utf8mb4");
        $conn->exec("set character set utf8mb4");
        return $conn; 
    } catch (PDOException $exception) {
        $logs->inFile('db', "Ошибка подключения к базе данных: " . $exception->getMessage());
        return "Ошибка подключения к базе данных: " . $exception->getMessage();
    }
}
?>
