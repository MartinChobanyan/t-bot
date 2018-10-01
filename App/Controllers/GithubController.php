<?php

namespace App\Controllers;

use App\Models\BotModel;

class GithubController{
    private $Token;
    private $Data;

    function __construct($token){
        $this->Token = $token;
    }

    public function DataProccessing($data){

    }
}