<?php
// IT'S ROUTER FILE

require_once ("../vendor/autoload.php");
require_once ("../Config/conf.php");

$_GET["params"] = explode("/", substr($_SERVER["REQUEST_URI"], 1));

require_once ("../App/start.php");