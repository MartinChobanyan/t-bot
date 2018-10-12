<?php

namespace App;

class App{
    private const baseNamespace = 'App\\Controllers\\';
    private $controller;
    private $method;

    function __construct(){
        $this->init();
    }

    public function run(){
       // echo "running...";
    }

    private function init(){
        if(empty($_GET["params"])) die("FORBIDDEN!");
        
        $controllername = $_GET["params"][0] + "Controller";
        $methodname = $_GET["params"][1];

        if(!class_exists($path = self::baseNamespace . $controllername) || !method_exists($this->controller, $methodname)) die("UNEXPECTED REQUEST!"); 
        
        $this->controller = new $path;
        $this->method = $methodname;

    }
}