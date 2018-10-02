<?php

require_once ("vendor/autoload.php");
require_once ("Config/conf.php");

if (strtoupper(substr($_SERVER["HTTTP_USER_AGENT"], 0, 6)) == "GITHUB") 
{
    $_GET["Agent"] = "Github";
}
else if (strtoupper(substr($_SERVER["HTTTP_USER_AGENT"], 0, 8)) == "TELEGRAM")
{ 
    $_GET["Agent"] = "Telegram";
}
else $_GET["Agent"] = "Github"; // for tests

require_once ("App/start.php");