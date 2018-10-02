<?php

namespace App;

class App{
    private const baseNamespace = 'App\\Controllers\\';
    private $controller;

    function __construct(){
        $this->init();
    }

    public function run(){
       // echo "running...";
    }

    private function init(){
        if(empty($_GET["Agent"])) die("FORBIDDEN!");
        
        $controllername = $_GET["Agent"];

        if(!class_exists($path = self::baseNamespace . $controllername)) die("UNEXPECTED REQUEST!"); 
        
        $this->controller = new $path($_POST);
    }
}