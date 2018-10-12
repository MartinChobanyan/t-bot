<?php

require_once ("vendor/autoload.php");
require_once ("Config/conf.php");

$_GET["params"] = explode('/', $_SERVER["REQUEST_URI"]);

require_once ("App/start.php");