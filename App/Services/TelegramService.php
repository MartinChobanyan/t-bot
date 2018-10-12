<?php

namespace App\Services;

class TelegramService{
    public static function SendMessage($chat_id, $message){
        if(empty($chat_id) || empty($message)) return FALSE;
        $parameters = [
            'chat_id' => $chat_id,
            'text' => $message
        ];
        $result = TELEGRAM_REQUEST_BASE . http_build_query($parameters);
        return file_get_contents($result);
    }
}