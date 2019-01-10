<?php

namespace App\Controllers;

use App\Models\BotModel;
use App\Services\TelegramService;

class TelegramController{
    private $Update;
    private $Chat_id;
    private $Command;

    public function __construct(){
        $this->init();
    }

    public function update($chat_id, $command){
        $command = new Command($chat_id, $command);
        $command->run();
    }


    private function init(){
        $this->Update = json_decode(file_get_contents("php://input"), true); // Recive Update from Telegram request
        $this->Update = $this->Update["message"];

        $this->UpdateProcess($this->Update);
    }

    private function UpdateProcess($Update){
        $this->Chat_id = $Update["chat"]["id"];

        if($this->is_command()) 
            $this->Command = $Update["text"];
        else 
            die();
        
        $this->update($this->Chat_id, $this->Command);
    }

    private function is_command(){
        return $this->Update["entities"][0]["type"] === "bot_command";
    }
}

class Command{
    private $Command;
    private $Chat_id;

 // Ex.
    //     private function *name*(*params*){
    //         $vars
    //         ...
    //         $txt or $msg = operatons with send information
    //         ...
    //         send($txt or $msg);
    //     }
    //
    //      For separate messages use $txt[i]
    //      
    //      ADD COMMANDS VIA BOTFATHER /setcommands
    //      FOR EASE THE ALGORITHM YOU CAN OPTION /setprivacy FOR COMMANDS
    //      SET YOUR CONTACT IN THE BOT DESCRPITION VIA /setdescription

    public function __construct($chat_id, $command, $params = NULL){ // .... !!!PARAMS START WITH [1] ....
        $this->Chat_id = $chat_id;

        $commandpars = explode(" ", substr($command, 1));

        $command = [
            "command" => $commandpars[0],
            "params" => NULL
        ];
        unset($commandpars[0]);
        $command["params"] = $commandpars;

        $this->Command = $command;
        
        if(!method_exists($this, $this->Command["command"])) $this->Command["command"] = "nocommand";
    }

    public function run(){
        $this->{$this->Command["command"]}($this->Command["params"]);
    }

    private function nocommand(){
        TelegramService::SendMessage($this->Chat_id, "404: Command Not Found!");
    }

    private function start(){
        $token = $this->generateToken();
        if((new BotModel)->setUser($this->Chat_id, $token)){
            $txt[1] = "Success!";
            $txt[2] = "https://bot.saatsazov.com/Github/notify/" . $token;
        }
        else{
            $txt = "Fail! Please Try again later or contact with us.";
        }
        $this->send($txt);
    }
    
    private function help(){
        $txt = "after /start you'll get message with your webhook adress that you have to input as a Github Webhook adress. Sample: \nhttps://bot.saatsazov.com/Github/notify/*YOUR TOKEN*";
        $this->send($txt);
    }

    private function generateToken(){
        return md5(time() . mt_rand(1, 100000));
    }

    private function send($msg){
        foreach(is_array($msg) ? $msg : array($msg) as &$txt){
            TelegramService::SendMessage($this->Chat_id, $txt);
        }
    }
}