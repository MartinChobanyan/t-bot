<?php

namespace App\Controllers;

use App\Models\BotModel;

class Telegram{
    //private $chat_id;

    function __construct($vars){
        //$this->chat_id;
    }

    public static function SendMessage($chat_id, $message){
        if(empty($chat_id) || empty($message)) return FALSE;
        $parameters = [
            'chat_id' => $chat_id,
            'text' => $message
        ];
        $result = TELEGRAM_REQUEST_BASE . http_build_query($parameters);
        return file_get_contents($result);
    }

    public function RunCommand($command){
        
    }
}