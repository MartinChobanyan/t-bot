<?php

namespace App\Controllers;

use App\Models\BotModel;

class TelegramController{
    private $chat_id;

    function __construct($chat_id){
        $this->chat_id = $chat_id;
    }

    public function SendMessage(){
        
    }

    public function RunCommand($command){

    }
}