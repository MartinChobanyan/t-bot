<?php

namespace App;

class App{
    private const baseNamespace = "App\\Controllers\\";
    private $controller;
    private $method;

    function __construct(){
        $this->init();
    }

    public function run(){
        $this->controller->{$this->method}();
    }

    private function init(){
        if(empty($_GET["params"])) die("FORBIDDEN!");
        
        $controllername = $_GET["params"][1] . "Controller";
        $methodname = $_GET["params"][2];

        if(!class_exists($path = self::baseNamespace . $controllername)) die("UNEXPECTED REQUEST!"); 
        
        $this->controller = new $path;

        if(!method_exists($this->controller, $methodname)) die("UNEXPECTED REQUEST!");

        $this->method = $methodname;
    }
}