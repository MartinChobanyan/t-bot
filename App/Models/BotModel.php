<?php

namespace App\Models;

class BotModel{
    private static $link;
    //private static $DATA; => In case, if we wanna conserve all DB data on object creating for further operations. 

    function __construct(){
        $this->$link = mysqli_connect(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
    }
    function __destruct(){
        mysqli_close($this->$link);
    }

    public function getChat($token){
        $query = "SELECT `chat_id` FROM `User` WHERE  `token` = $token";
        $result = mysqli_query($this->$link, $query);
        $row = mysqli_fetch_row($result);
        $chat = $row[0];
        mysqli_free_result($result);
        return $chat;
    }

    public function setUser($chat_id, $token){
        $query = "INSERT INTO `User` (`id`, `chat_id`, `token`) VALUES ('', $chat_id, $token)";
        $result = mysqli_query($this->$link, $query);
        if($result) return TRUE;
        return FALSE;
    }
}