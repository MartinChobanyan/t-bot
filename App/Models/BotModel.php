<?php

namespace App\Models;

class BotModel{
    private static $link;

    function __construct(){
        $this->$link = mysqli_connect(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
    }
    function __destruct(){
        mysqli_close($this->$link);
    }

    public function getChat($token){

    }

    public function setUser($chat_id, $token){

    }
}