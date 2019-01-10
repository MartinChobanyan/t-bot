<?php

namespace App;

class App{
    private static $baseNamespace = "App\\Controllers\\";
    private $controller;
    private $method;

    function __construct(){
        $this->init();
    }

    public function run(){
        $this->controller->{$this->method}();
    }

    private function init(){
        if(!isset($_GET["params"]) || count($_GET["params"]) < 2) die("FORBIDDEN!");
        
        $controllername = $_GET["params"][0] . "Controller";
        $methodname = $_GET["params"][1];

        if(!class_exists($path = App::$baseNamespace . $controllername)) die("UNEXPECTED REQUEST!"); 
        
        $this->controller = new $path;

        if(!method_exists($this->controller, $methodname)) die("UNEXPECTED REQUEST!");

        $this->method = $methodname;
    }
}