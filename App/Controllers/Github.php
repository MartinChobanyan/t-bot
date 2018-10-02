<?php

namespace App\Controllers;

use App\Models\BotModel;

class Github{
    private $Token;
    private $Data;

    function __construct(&$vars){
        $this->Token = $vars["token"];
        $this->Data = $vars["payload"];
    }

    public function DataProccessing(){
        $data = json_decode($this->Data, true);
    }
}