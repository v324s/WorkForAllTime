<?
try {
    // $dbh = new PDO('mysql:dbname=ucheba_2_inet_magaz;host=127.0.0.1', 'root', 'root',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
    $dbh = new PDO('mysql:dbname=ucheba_2_inet_magaz;host=127.0.0.1', 'root', 'root');
} catch (PDOException $e) {
    die($e->getMessage());
}

require_once('include/add.php');
require_once('include/delete.php');
require_once('include/edit.php');
require_once('include/get.php');


?>