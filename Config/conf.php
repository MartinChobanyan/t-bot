<?php

// BOT
    define("TELEGRAM_BOT_TOKEN", "");
    define("TELEGRAM_REQUEST_BASE", "https://api.telegram.org/bot" . TELEGRAM_BOT_TOKEN . "/");

// DB PARAMS
    define("DBMS", ""); // MySQL or SQLite


    // MySQL
    define("DB_HOSTNAME", "localhost");
    define("DB_DATABASE", "BotBase");
    define("DB_USERNAME", "root");
    define("DB_PASSWORD", "");

    // SQLite
    define("DB_PATH", "DB/BotBase.db"); // From "../index.php" = home