<?php

namespace App\Controllers;

use App\Models\BotModel;
use App\Services\TelegramService; 

class GithubController{
    private $Token;
    private $Data;

//    public function __construct(){
//        //$this->init();
//    }

    public function notify(){
        $this->init();

        $chat_id = $this->getChatId($this->Token);
        $text = $this->DataProcess($this->Data);

        return TelegramService::SendMessage($chat_id, $text);
    }

    private function getChatId($token){
        return (new BotModel)->getChatId($token);
    }

    private function DataProcess($data){
        list($date, $time) = explode('T', $data["head_commit"]["timestamp"]);

        $message = '';
        $message .= "At " . $date . ' ' . $time . "\n--------\n";
        $message .= $data["pusher"]["name"] . "\n\n";
    
        if(!empty($data["head_commit"]["added"])) {
            $message .= "\tAdded:\n\t\t\t" . json_encode($data["head_commit"]["added"]) . "\n";
        }
        if(!empty($data["head_commit"]["removed"])) {
            $message .= "\tRemoved:\n\t\t\t" . json_encode($data["head_commit"]["removed"]) . "\n";
        }
        if(!empty($data["head_commit"]["modified"])) {
            $message .= "\tEdited:\n\t\t\t" . json_encode($data["head_commit"]["modified"]) . "\n";
        }
    
        $message .= "\nIn " . $data["repository"]["name"];

        return $message;
    }

    private function init(){
        if(empty($_GET["params"][2])) die("TOKEN MISSING");

        $_POST["token"] = $_GET["params"][2];

        $token = $_POST["token"];
        
        if(isset($_POST["payload"])){ 
            $data = $_POST["payload"];
        }
        else die("GET THE FUCK OFF!");

        $this->Token = $token;
        $this->Data = json_decode($data, true);
    }
}