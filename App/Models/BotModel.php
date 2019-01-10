<?php

namespace App\Models;

use PDO;

class BotModel{
    private static $pdo;

    function __construct(){
        $this->init(DBMS, DB_PATH);
    }
    function __destruct(){
        BotModel::$pdo = NULL;
    }

    private function init($DBMS, $DB_PATH){
        $opt = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_BOTH,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];
        switch($DBMS = strtolower($DBMS)){
            case "mysql":  
                $dsn = ($DBMS . ": host=" . DB_HOSTNAME . ";dbname=" . DB_DATABASE . ";charset=utf8");
                BotModel::$pdo = new PDO($dsn, DB_USERNAME, DB_PASSWORD, $opt);
                break;
            case "sqlite": 
                $dsn = ($DBMS . ":../" . $DB_PATH);
                BotModel::$pdo = new PDO($dsn, NULL, NULL, $opt);
                $this->sqlite_crttb();
                break;
            default: 
                die("UNEXPECTED DBMS");
        }
        return TRUE;
    }

    private function sqlite_crttb(){
        BotModel::$pdo->exec("CREATE TABLE IF NOT EXISTS `Users` (
        `id` INT PRIMARY KEY,
        `chat_id` INT NOT NULL,
        `token` TEXT NOT NULL
        )");
    }

    public function getChatId($token){
        $stmt = BotModel::$pdo->prepare("SELECT chat_id FROM Users WHERE token = :token");
        $stmt->execute(["token" => $token]);
        $row = $stmt->fetch();
        $chat_id = $row[0];
        return $chat_id;
    }
    
    private function chat_exists($chat_id){
       $stmt = BotModel::$pdo->prepare("SELECT id FROM Users WHERE  chat_id = :chat_id");
       $stmt->execute(["chat_id" => $chat_id]);
       return !empty($stmt->fetch());
    }

    public function setUser($chat_id, $token){
        if(!($this->chat_exists($chat_id))){
            $query = "INSERT INTO `Users` (`chat_id`, `token`) VALUES (:chat_id, :token)";
        }else{
            $query = "UPDATE `Users` SET `token` = :token WHERE `chat_id` = :chat_id";
        }
        $stmt = BotModel::$pdo->prepare($query);
        $result = $stmt->execute(["chat_id" => $chat_id, "token" => $token]);
        return $result ? TRUE : FALSE;
    }
}