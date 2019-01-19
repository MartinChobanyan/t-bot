<?php

namespace App\Services;

class TelegramService{
    public static function SendMessage($chat_id, $message, $reply_markup = NULL){
        if(empty($chat_id) || empty($message)) return FALSE;
        $parameters = [
            'chat_id' => $chat_id,
            'text' => $message,
            'parse_mode' => "Markdown",
            'reply_markup' => $reply_markup
        ];
        $result = TELEGRAM_REQUEST_BASE . "sendmessage?" . http_build_query($parameters);
        return file_get_contents($result);
    }
}